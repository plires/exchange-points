require('./bootstrap')
require('../../../node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js')
require('../../../node_modules/admin-lte/dist/js/adminlte.js')
require('../../../node_modules/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')

window.Vue = require('../../../node_modules/vue/dist/vue.common.dev.js')
import Swal from '../../../node_modules/admin-lte/plugins/sweetalert2/sweetalert2.all.js'
import Func from './functions.js'
import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)

const app = new Vue({
  el: '#app',

  data: {
    users: [],
    nameUser: '',
    roles: [],
    formUser: {
      name: '',
      lastname: '',
      role_id: 2,
      document: '',
      email: '',
      points: '',
      birthday: '',
      phone: '',
      street: '',
      street_number: '',
      city: '',
      province: '',
      country: '',
      postal_code: '',
      password: '',
      password_confirmation: ''
    },
    modeUserEdit: false,
    titleFormUser: '',
    entryPass: true,
    paginate: ['users'],
    authUser: {},
    errors: []
  },

  mixins: [Func],

  methods: {

  	async getUsers() {
      this.loading()
      let response = await axios.get('/admin/get_users')
      this.users = response.data.sort().sort((a, b) => b.id - a.id)
      this.loading()
  	},

    getRoleUser(idRole) {
      var roleName
      this.roles.forEach(function (role) {
        if (role.id == idRole ) {
          roleName = role.name
        }
      })
      return roleName

    },

    async getRoles() {
      this.loading()
      let response = await axios.get('/admin/get_roles')
      this.roles = response.data
      this.loading()
    },

    checkFormUser: function () {

      this.cleanErrors()

      if (!this.entryPass) {

        if ( this.formUser.name && this.formUser.lastname && this.formUser.document && this.validateEmail(this.formUser.email) && $.isNumeric(this.formUser.role_id) ) {
          this.formUser.password = ''
          this.formUser.password_confirmation = ''
          return true
        }

      } else {
        if ( this.formUser.name && this.formUser.lastname && this.formUser.document && this.validateEmail(this.formUser.email) && $.isNumeric(this.formUser.role_id) && this.formUser.password && this.formUser.password_confirmation && this.formUser.password === this.formUser.password_confirmation ) {
          return true
        }
      }

      if (!this.formUser.name) {
        this.errors.push('El nombre es obligatorio.')
      }

      if (!this.formUser.lastname) {
        this.errors.push('El apellido es obligatorio.')
      }

      if (!this.formUser.document) {
        this.errors.push('El documento de identidad es obligatorio.')
      }

      if (!this.validateEmail(this.formUser.email)) {
        this.errors.push('El email no es válido.')
      }

      if (!$.isNumeric( this.formUser.role_id )) {
        this.errors.push('Asigne un rol de usuario válido.')
      }

      if ( this.entryPass && !this.formUser.password_confirmation  ) {
        this.errors.push('Ingresá la nueva contraseña y validala.')
      }

      if ( this.entryPass && this.formUser.password != this.formUser.password_confirmation  ) {
        this.errors.push('Las contraseñas no coinciden.')
      }

      return false

    },

    validateEmail(email) {
		  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		  return re.test(email)
		},

    sendUser() {

      let checked = this.checkFormUser()

      if (checked) {
        this.saveUser(this.formUser)
      }

    },

    saveUser(formUser) {

      if (this.modeUserEdit) {
        var axiosMethod = axios.put
        var url = '/admin/users/'+ formUser.id
        var msgError = 'Error al editar este usuario.'
        var verb = 'editado'
      } else {
        var axiosMethod = axios.post
        var url = '/admin/users'
        var msgError = 'Error al crear este usuario.'
        var verb = 'agregado'
      }

      this.loading()

      axiosMethod(url, formUser).then(response => {

        this.getUsers()
        
        this.createAlert(
          'Éxito', 
          'Excelente!, el usuario ' + response.data.user_created.name + ' ha sido '+ verb +' exitosamente!', 
          'success', 
          'Cerrar'
        )

        this.resetUserForm()
        $('#modal-user').modal("hide")

        this.loading()

      })
      .catch(errorsLaravel => {

        let msgError = errorsLaravel.response.data
      	this.laravelErrorHandling(errorsLaravel.response.data, msgError)
        this.loading()
        
      })

    }, 

    deleteUser(id) {
      this.formUser.id = id

      Swal.fire({
        title: 'Estas seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminarlo!'
      }).then((result) => {
        if (result.isConfirmed) {

        	this.loading()

          axios.post('/admin/users/'+ id, {
            _method: 'DELETE'
          })
          .then( response => {

            Swal.fire(
              'Eliminado!',
              'El recurso '+ response.data.user_deleted.name +' ha sido eliminado.',
              'success'
            )

            this.getUsers()

            this.loading()

          })
          .catch( errorsLaravel => {

            let msgError = "El usuario no pudo ser eliminado."
            this.laravelErrorHandling(errorsLaravel.response.data, msgError)
            this.loading()

          })

        }
      })

    },

    showFormUserEdit(id) {

      this.cleanErrors()
      this.setEditUserForm(true)
      $('#modal-user').modal("show")
      this.fillInputsFormUser(id)

    },

    setEditUserForm(mode) {
      if (mode) {
        this.titleFormUser = 'Edición de Usuario'
        this.modeUserEdit = true
        this.entryPass = false
      } else {
        this.titleFormUser = 'Creación de Usuario'
        this.modeUserEdit = false
        this.entryPass = true
      }
    },

    fillInputsFormUser(id) {
    	
      let user = this.users.filter( (user) => user.id == id )

      this.formUser = {
        id: user[0].id,
        name: user[0].name,
        lastname: user[0].lastname,
        role_id: user[0].role_id,
        document: user[0].document,
        email: user[0].email,
        points: user[0].points,
        birthday: user[0].birthday,
        phone: user[0].phone,
        street: user[0].street,
        street_number: user[0].street_number,
        city: user[0].city,
        province: user[0].province,
        country: user[0].country,
        postal_code: user[0].postal_code,
      }

    },

    createAlert(title, text, icon, btnTxt) {
      Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: btnTxt
      })
    },

    resetUserForm() {
      this.setEditUserForm(false)
      this.cleanErrors()

      $(".form-control").val("")

      this.formUser = {
        name: '',
        lastname: '',
        role_id: 2,
        document: '',
        email: '',
        points: '',
        birthday: '',
        phone: '',
        street: '',
        street_number: '',
        city: '',
        province: '',
        country: '',
        postal_code: '',
        password: '',
        password_confirmation: ''
      }

    }, 

    changeUserConfirmed(userId, userConfirmed) {

      axios.put('/admin/users/' + userId + '/cambiar_confirmed', {
        id: userId,
        confirmed: userConfirmed,
      }).then(response => {

        this.getUsers()
        
        this.createAlert(
          'Éxito', 
          'Excelente!, el usuario ' + response.data.user_confirmed_updated.name + ' Cambio su estado', 
          'success', 
          'Cerrar'
        )

      })
      .catch(errorsLaravel => {

        let msgError = errorsLaravel.response.data
        this.laravelErrorHandling(errorsLaravel.response.data, msgError)
        this.loading()
        
      })

    }

  },

  created() {
    this.getUsers()
  	this.getRoles()
    this.setEditUserForm(false)
    this.getAuthUser()
  },

  computed: {

    filteredUsers() {
      return this.users.filter( (user) => user.lastname.toLowerCase().includes(this.nameUser.toLowerCase()) )
    }

  }

})

//Date picker
$('#birthday').datetimepicker({
    format: 'YYYY-MM-DD',
    minDate:new Date('1900-01-01')

});

$("#birthday").on("change.datetimepicker", ({date, oldDate}) => {
  if (typeof date !== 'undefined') {
    let datePartial = date._d.toLocaleDateString().split('/')
    let dateFormat = datePartial[2] + '-' + datePartial[1] + '-' + datePartial[0]
    $("#birthday_input").val(dateFormat)[0].dispatchEvent(new Event('input'))
    app.formUser.birthday = dateFormat
  }
})



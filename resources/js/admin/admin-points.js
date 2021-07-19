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
    // pointsUsers: [],
    lastNameUser: '',
    formPoints: {
      id:'',
      lastname:'',
      email:'',
      phone:'',
      points_old: '',
      points_bdd: '',
      points: '',
    },
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

    async getRoles() {
      this.loading()
      let response = await axios.get('/admin/get_roles')
      this.roles = response.data
      this.loading()
    },

    checkformPoints: function () {

      this.cleanErrors()

      let pointsNew = parseFloat(this.formPoints.points)
      let pointsBdd = parseFloat(this.formPoints.points_bdd)
      let pointsOld = parseFloat(this.formPoints.points_old)

      if ( pointsNew && Number.isInteger(pointsNew) && pointsBdd === pointsOld  ) {
        return true
      }

      if (pointsBdd !== pointsOld) {
        this.errors.push('Se modificó el valor de puntos manualmente. Refresca la página.')
      }

      if (!pointsNew) {
        this.errors.push('Debe incluir los puntos a sumar o restar.')
      }

      if (pointsNew == 0) {
        this.errors.push('Ingrersá un valor de puntos diferente a 0.')
      }

      if (!Number.isInteger(pointsNew)) {
        this.errors.push('Sólo se aceptan valores enteros.')
      }

      return false

    },

    sendPoints() {

      let checked = this.checkformPoints()

      if (checked) { 
        this.savePoints(this.formPoints) 
      }

    },

    savePoints(formPoints) {

      const form = document.querySelector('#pointsForm')
      var formData = new FormData(form);

      for ( let key in formData ) {
        formData.append(key, formData[key])
      }

      var axiosMethod = axios.put
      formData.append('_method', 'PUT')
      var url = '/admin/users/'+ formPoints.id
      var verb = 'editado'
      var verb2 = 'editar'

      this.loading()

      axiosMethod(url, formPoints).then(response => {

        $('#modal-points').modal("hide")
        this.getUsers()
        
        this.createAlert(
          'Éxito', 
          'Excelente! el usuario ' + response.data.user_points_updated.lastname + ', tiene ahora ' + response.data.user_points_updated.points + ' puntos!', 
          'success', 
          'Cerrar'
        )

        this.resetPointsForm()

        this.loading()

      })
      .catch(errorsLaravel => {

        let msgError = "La operación no pudo completarse.."
      	this.laravelErrorHandling(errorsLaravel.response.data, msgError)
        loading()
        
      })

    },

    resetPointsForm() {
      this.cleanErrors()
      this.formPoints.points = 0
    },

    fillInputsformPoints(id) {

      this.resetPointsForm()
      
      let userPoints =  this.users.filter( (user) => user.id == id )

      this.formPoints = {
        id: userPoints[0].id,
        lastname: userPoints[0].lastname,
        email: userPoints[0].email,
        points_old: userPoints[0].points,
        points_bdd: userPoints[0].points
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

  },

  created() {
    this.getUsers()
    this.getAuthUser()
  },

  computed: {

    filteredUsers() {
      return this.users.filter( (user) => user.lastname.toLowerCase().includes(this.lastNameUser.toLowerCase()) )
    }

  }

})

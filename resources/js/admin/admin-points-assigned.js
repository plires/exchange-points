require('./bootstrap')
require('../../../node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js')
require('../../../node_modules/admin-lte/plugins/select2/js/select2.full.min.js')
require('../../../node_modules/admin-lte/dist/js/adminlte.js')

window.Vue = require('../../../node_modules/vue/dist/vue.common.dev.js')
import Swal from '../../../node_modules/admin-lte/plugins/sweetalert2/sweetalert2.all.js'
import Func from './functions.js'
import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)

const app = new Vue({
  el: '#app',

  data: {
    users: [],
    transactions: [],
    user_id: 1,
    paginate: ['transactions'],
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

    async getPointsAssigned() {
      this.loading()
      let response = await axios.get('/admin/get_points_assigned')
      this.transactions = response.data.sort().sort((a, b) => b.id - a.id)
      this.loading()
    },

    getNameUser(user_id) {
      let user = this.users.filter( (user) => user.id == user_id )
      return user[0].name
    },

    createAlert(title, text, icon, btnTxt) {
      Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: btnTxt
      })
    },

    filterByUserId(user_id) {
      if (user_id) {
        this.user_id = user_id
        this.transactions = this.transactions.filter( (transaction) => transaction.user_id == user_id )
      } 
    },

    getDateFormated(date) {
      let onlyDate = date.split('T')
      let dateParts = onlyDate[0].split('-')
      let yyyy = dateParts[0]
      let mm = dateParts[1]
      let dd = dateParts[2]
      return dd + '/' + mm + '/' + yyyy
    },

    getTimeFormated(date) {
      let onlyDate = date.split('T')
      let timeParts = onlyDate[1].split(':')
      let hh = timeParts[0]
      let min = timeParts[1]
      return hh + ':' + min
    },

    deleteTransaction(transaction_id) {

      Swal.fire({
        title: 'Estas seguro?',
        text: "Esta operación eliminará la asignación de puntos y restablecerá la cantidad de puntos del usuario!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
      }).then((result) => {
        if (result.isConfirmed) {

          this.loading()

          axios.post('/admin/points-assigned/'+ transaction_id, {
            _method: 'DELETE'
          })
          .then( response => {

            Swal.fire(
              'Eliminado!',
              'La asignación de '+ response.data.points_deleted.quantity +' puntos ha sido eliminado.',
              'success'
            )

            this.getPointsAssigned()

            this.loading()

          })
          .catch( errorsLaravel => {

            let msgError = "No pudo ser eliminada esta transacción."
            this.laravelErrorHandling(errorsLaravel.response.data, msgError)

          })

        }
      })

    }

  },

  created() {
    this.getUsers()
    this.getAuthUser()
    this.getPointsAssigned()
  }

})

//Initialize Select2 Elements
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'
})

// Bind an event
$('#selectSearchByUser').on('select2:select', function (e) { 
  let user_id = parseInt(e.params.data.element.dataset.id) // Obtenemos el id del "data-id" del option
  app.filterByUserId(user_id)
});


$('.select2-container').on("click", function () {
    app.getPointsAssigned()
});
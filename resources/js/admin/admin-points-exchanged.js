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
    products: [],
    usersNews: [],
    exchanges: [],
    totalExchangesDetail: [],
    exchangesDetail: [],
    user_id: 0,
    new_user_id: 1,
    product_id: 1,
    userObject : { },
    productsCart : {},
    subtotal_amount : 0,
    paginate: ['exchanges'],
    authUser: {},
    total_amount: 0,
    items: 0,
    errors: []
  },

  mixins: [Func],

  methods: {

  	async getUsers() {
      this.loading()
      let response = await axios.get('/admin/get_users')
      this.users = response.data.sort().sort((a, b) => b.id - a.id)
      this.usersNews = response.data.sort().sort((a, b) => b.id - a.id)
      this.loading()
  	},

    async getPointsExchanged() {
      this.loading()
      let response = await axios.get('/admin/get_points_exchanged')
      this.exchanges = response.data.sort().sort((a, b) => b.id - a.id)
      this.loading()
    },

    async getExchangedDetail() {
      this.loading()
      let response = await axios.get('/admin/get_exchanges_details')
      this.totalExchangesDetail = response.data.sort().sort((a, b) => b.id - a.id)
      this.loading()
    },

    async getProducts() {
      this.loading()
      let response = await axios.get('/admin/get_products')
      this.products = response.data.sort().sort((a, b) => b.id - a.id)
      this.loading()
    },

    getNameUser(user_id) {
      let user = this.users.filter( (user) => user.id == user_id )
      return user[0].lastname 
    },

    getNameProduct(product_id) {
      let product = this.products.filter( (product) => product.id == product_id )
      return product[0].name 
    },

    showImage(product_id) {
      let image = this.products.filter( (product) => product.id == product_id )

      if (!image[0].image) {
        return '/img/no-image.gif'
      } else if ( image[0].image.includes('http') ) {
        return image[0].image
      } else {
        return '/storage/' + image[0].image
      }

    },

    viewDetailExchange(id) {

      let exchange = this.exchanges.filter( (exchange) => exchange.id == id )
      this.exchangesDetail = this.totalExchangesDetail.filter( (exchangeDetail) => exchangeDetail.exchange_id == id )

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
        this.exchanges = this.exchanges.filter( (exchange) => exchange.user_id == user_id )
      } 
    },

    getNewUser(user_id) {
      if (user_id) {
        this.new_user_id = user_id
        let user = this.usersNews.filter( (user) => user.id == user_id )
        this.userObject = user[0]
      }
    },

    addProduct(product_id) {

      let product = this.products.filter( (product) => product.id == product_id )
      product = product[0]

      if (this.productsCart[product.id]) {
        this.productsCart[product.id].quantity += 1;
      } else {
        this.$set(this.productsCart, product.id, {
          id: product.id,
          name: product.name,
          quantity: 1,
          price: product.price
        })
      }

      this.$forceUpdate();

      return 1;

    },

    removeProduct: function(product) {
      if (this.productsCart[product.id].quantity > 1) {
        this.productsCart[product.id].quantity -= 1;
      } else {
        this.productsCart[product.id].quantity = 0;
        delete this.productsCart[product.id];
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

    deleteExchange(exchange_id) {

      Swal.fire({
        title: 'Estas seguro?',
        text: "Esta operación eliminará el canje de puntos, restablecerá la cantidad de puntos del usuario y el stock de los productos!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
      }).then((result) => {
        if (result.isConfirmed) {

          this.loading()

          axios.post('/admin/points-exchanged/'+ exchange_id, {
            _method: 'DELETE'
          })
          .then( response => {

            Swal.fire(
              'Eliminado!',
              'El canje de '+ response.data.exchanged_deleted.points_quantity +' puntos ha sido eliminado.',
              'success'
            )

            this.getPointsExchanged()
            this.getExchangedDetail()

            this.loading()

          })
          .catch( errorsLaravel => {

            let msgError = "La operación no pudo ser eliminada."
            this.laravelErrorHandling(errorsLaravel.response.data, msgError)
            this.loading()

          })

        }
      })

    }, 

    checkFormExchange: function () {

      let name =  this.userObject.lastname
      let points =  this.userObject.points
      let products =  this.productsCart

      if ( name && Object.keys(products).length > 0 && this.subtotal_amount <= points  ) {
        return true
      } 

      this.cleanErrors()

      if (name == undefined) {
        this.errors.push('Falta cargar el usuario.')
      }

      if (Object.keys(products).length === 0) {
        this.errors.push('No hay ningún Producto seleccionado.');
      }

      if (this.subtotal_amount > points) {
        this.errors.push('El usuario no tiene los puntos suficientes para este canje.');
      }

      return false

    },

    sendExchanged() {

      let checked = this.checkFormExchange()  

      if (checked) { 
        
        var formData = new FormData();

        formData.append('user_id', this.userObject.id)
        formData.append('total', this.subtotal_amount)

        for ( var key in this.productsCart ) {
          formData.append('products[]', JSON.stringify(this.productsCart[key]));
        }

        axios.post('/admin/points-exchanged/', formData)

        .then(response => {

          $('#modal-exchanged').modal("hide")
          this.getUsers()
          this.getPointsExchanged()
          this.getExchangedDetail()
          this.getProducts()

          this.createAlert(
            'Éxito', 
            response.data.exchanged_created, 
            'success', 
            'Cerrar'
          )

        })
        .catch(errorsLaravel => {

          let msgError = "La operación no pudo completarse."
          this.laravelErrorHandling(errorsLaravel.response.data, msgError)
          
        })

      }

    }, 

    resetExchangeForm() {
      this.new_user_id = 0
      this.userObject = {}
      this.userObject.points = ''
      this.productsCart = {}
      this.errors = []
      $('#selectSearchByNewUser').val(null).trigger('change');
      $('#selectSearchByProduct').val(null).trigger('change');
      // Limpiar los selects
    }

  },

  computed: {

    subtotal: function() {
      this.subtotal_amount = 0;
      for (let product in this.productsCart) {
        this.subtotal_amount += (parseInt(this.productsCart[product].price) * parseInt(this.productsCart[product].quantity));
      }
      return this.subtotal_amount;
    },

    total: function() {

      this.total_amount = 0

      if (this.exchangesDetail.length > 0) {

        for (let product in this.exchangesDetail) {
          this.total_amount += this.exchangesDetail[product].price * this.exchangesDetail[product].quantity
        }

      }

      return this.total_amount

    },

    countItems: function() {

      this.items = 0

      if (this.exchangesDetail.length > 0) {

        for (let product in this.exchangesDetail) {
          console.log(product)
          this.items += this.exchangesDetail[product].quantity
        }

      }

      return this.items

    },

  },

  created() {
    this.getUsers()
    this.getAuthUser()
    this.getPointsExchanged()
    this.getExchangedDetail()
    this.getProducts()
  }

})

//Initialize Select2 Elements
$('#selectSearchByUser').select2({
  theme: 'bootstrap4',
  placeholder: "Seleccioná un usuario",
  allowClear: true
})

//Initialize Select2 Elements
$('#selectSearchByNewUser').select2({
  theme: 'bootstrap4',
  placeholder: 'Seleccioná un usuario',
  allowClear: true
})

//Initialize Select2 Elements
$('#selectSearchByProduct').select2({
  theme: 'bootstrap4',
  placeholder: 'Seleccioná un producto',
})

$('#selectSearchByUser').on("select2:open", function (e) { 
  app.getPointsExchanged()
})

// Bind an event
$('#selectSearchByUser').on('select2:select', function (e) { 
  let user_id = parseInt(e.params.data.element.dataset.id) // Obtenemos el id del "data-id" del option
  app.filterByUserId(user_id)
})

// Bind an event
$('#selectSearchByNewUser').on('select2:select', function (e) { 
  let user_id = parseInt(e.params.data.element.dataset.id) // Obtenemos el id del "data-id" del option
  app.getNewUser(user_id)
});

$('#selectSearchByNewUser').on("select2:open", function (e) { 
  app.new_user_id = 0
  app.userObject = {}
  app.userObject.points = ''
})

// Bind an event
$('#selectSearchByProduct').on('select2:select', function (e) { 
  let product_id = parseInt(e.params.data.element.dataset.id) // Obtenemos el id del "data-id" del option
  app.addProduct(product_id)
});


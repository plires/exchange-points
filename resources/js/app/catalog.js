require('./app')
require('../../../node_modules/slick-carousel/slick/slick.js')
require('../../../node_modules/admin-lte/plugins/jquery/jquery.min.js')

window.Vue = require('../../../node_modules/vue/dist/vue.common.dev.js')

import Swal from '../../../node_modules/admin-lte/plugins/sweetalert2/sweetalert2.all.js'
import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)

const app = new Vue({ 
  el: '#app',
  data: {
    // paginate: ['users'],
    authUser: {},
    products: {},
    products_featured: {},
    counterItemCart: 0,
    product: {},
    product_id: '',
    product_name: '',
    product_availability: 0,
    product_description: '',
    product_price: '',
    product_image: '',
    cart: {},
    total_amount: 0,
    counterItemCart: 0,
    alert: '',
    errors: [],
  },

  methods: {

    async getAuthUser() {
      this.loading()
      let response = await axios.get('exchange/get_user_auth')
      this.authUser = response.data
      localStorage.setItem('authUser', JSON.stringify(response.data));
      this.loading()
    },

    async getProducts() {
      this.loading()
      let response = await axios.get('exchange/get_products')
      this.products = response.data
      this.products_featured = this.products.filter( (product) => product.featured == 1)
      this.loading()
    },

    toogleNav() {
      $('#navigation').toggleClass('show')
      $('#cart').removeClass('show')
      $('#edit_user').removeClass('show')
    },

    toogleCart() {
      $('#cart').toggleClass('show')
      $('#navigation').removeClass('show')
      $('#edit_user').removeClass('show')
    },

    toogleMenuUser() {
      $('#edit_user').toggleClass('show')
      $('#navigation').removeClass('show')
      $('#cart').removeClass('show')
    },

    loading() {
      $('#spinner').toggleClass('show_spinner')
    },

    showImage(image) {

      if (!image) {
        return '/img/no-image.gif'
      } else if ( image.includes('http') ) {
        return image
      } else {
        return '/storage/' + image
      }

    }, 

    showModal(productId) {
      $('#modalProduct').modal('show')
      let product = this.products.filter( (product) => product.id == productId)
      this.product = product[0]
      this.product_id = product[0].id
      this.product_name = product[0].name
      this.product_availability = product[0].availability
      this.product_description = product[0].description
      this.product_price = product[0].price
      this.product_image = product[0].image
    },

    addProduct: function(product) {

      if (this.cart[product.name]) {
        this.cart[product.name].quantity += 1
      } else {
        Vue.set(this.cart, product.name, {
          id: product.id,
          name: product.name,
          quantity: 1,
          description: product.description,
          price: product.price,
          image: product.image
        })
      }

      setTimeout(function(){ app.availablePoints() }, 100)
      localStorage.setItem('cart', JSON.stringify(this.cart));

      return 1

    },

    removeProduct: function(product) {

      if (this.cart[product.name].quantity > 1) {
        this.cart[product.name].quantity -= 1
      } else {
        this.cart[product.name].quantity = 0
        delete this.cart[product.name]
      }

      setTimeout(function(){ app.availablePoints() }, 100)
      localStorage.setItem('cart', JSON.stringify(this.cart));

    },

    availablePoints() {

      if (this.authUser.points < this.total_amount) {

        this.alert = 'No tenés puntos suficientes para continuar canjeando'
        $('#btnAdd').prop('disabled', true)
        $('.btnCartAddProduct').prop('disabled', true)
        $('#btn_finalizar_pedido').prop('disabled', true)
        $('#btn_finalizar_pedido').addClass('hidden')
        $('#points_cart').addClass('color_alert')
        $('#menu_cart').addClass('color_alert')
        $('#btnCanjeModal').addClass('hidden')

      } else {

        this.alert = ''
        $('#btnAdd').prop('disabled', false)
        $('.btnCartAddProduct').prop('disabled', false)
        $('#btn_finalizar_pedido').prop('disabled', false)
        $('#btn_finalizar_pedido').removeClass('hidden')
        $('#points_cart').removeClass('color_alert')
        $('#menu_cart').removeClass('color_alert')
        $('#btnCanjeModal').removeClass('hidden')
      }

    },

    showConfirmation() {
      console.log(this.cart)
    }

  },

  computed: {

    total: function() {

      this.total_amount = 0

      if (Object.keys(this.cart).length > 0) {

        for (let product in this.cart) {
          this.total_amount += this.cart[product].price * this.cart[product].quantity
        }

        setTimeout(function(){ app.availablePoints() }, 100)
                
      }

      return this.total_amount.toLocaleString('de-DE')

    },

    count_items_cart: function() {
      this.counterItemCart = 0
      if (Object.keys(this.cart).length > 0) {
        // animateCart()
        for (let product in this.cart) {
          this.counterItemCart += this.cart[product].quantity
        }
      }

      return this.counterItemCart
    }

  },

  mounted() {
    if(localStorage.cart) this.cart = JSON.parse(localStorage.getItem('cart'))
    if(localStorage.authUser) this.authUser = JSON.parse(localStorage.getItem('authUser'))
    this.getAuthUser()
    this.getProducts()
  },

})

setTimeout(function(){
  $('.responsive').slick({
    dots: true,
    pauseOnFocus: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
}, 500);





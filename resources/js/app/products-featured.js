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
    paginate: ['users'],
    authUser: {},
    products: {},
    products_featured: {},
    errors: []
  },

  methods: {

    async getAuthUser() {
      this.loading()
      let response = await axios.get('exchange/get_user_auth')
      this.authUser = response.data
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

    }
    
  },

  created() {
    this.getAuthUser()
    this.getProducts()
  },

  computed: {

  }

})

setTimeout(function(){
  $('.responsive').slick({
    dots: true,
    infinite: true,
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
          infinite: true,
          dots: true
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
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
}, 500);





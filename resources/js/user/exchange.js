require('./app')
require('../../../node_modules/admin-lte/plugins/jquery/jquery.min.js')
require('../../../node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js')
require('../../../node_modules/admin-lte/dist/js/adminlte.js')

window.Vue = require('../../../node_modules/vue/dist/vue.common.dev.js')
console.log(Vue)
import Swal from '../../../node_modules/admin-lte/plugins/sweetalert2/sweetalert2.all.js'
import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)

const app = new Vue({
  el: '#app',

  data: {
    title: 'asdasdasdasd',
    paginate: ['users'],
    authUser: {},
    errors: []
  },

  methods: {

    async getAuthUser() {
      this.loading()
      let response = await axios.get('/exchange/get_user_auth')
      this.authUser = response.data
      this.loading()
    },

    loading() {
      $('#spinner').toggleClass('show_spinner');
    },

  },

  created() {
    this.getAuthUser()
  },

  computed: {

  }

})



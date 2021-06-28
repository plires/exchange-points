require('./bootstrap')
require('../../../node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js')
require('../../../node_modules/admin-lte/dist/js/adminlte.js')

window.Vue = require('../../../node_modules/vue/dist/vue.common.dev.js')
import Swal from '../../../node_modules/admin-lte/plugins/sweetalert2/sweetalert2.all.js'
import Func from './functions.js'

const app = new Vue({
  el: '#app',

  data: {
    authUser: {},
  },

  mixins: [Func],

  methods: {

    downloadTemplateExcel() {

      this.loading()

        axios.post('/export_template/')
        .then( response => {

          Swal.fire(
            'Plantilla descargada!',
            'Buscá en tu carpeta de descargas el archivo, editalo y subilo',
            'success'
          )

          this.loading()

        })
        .catch( errorsLaravel => {
          
          let msgError = "La descarga no pudo completarse."
          this.laravelErrorHandling(errorsLaravel.response.data, msgError)

        })

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
    this.getAuthUser()
  },

  computed: {

  }

})

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
    errors: []
  },

  mixins: [Func],

  methods: {

    uploadTemplate() {

      var btn =  $('#btn_upload_excel')
      btn.prop('disabled', true)

      const form = document.querySelector('#importForm')
      var formData = new FormData(form);

      var file = document.querySelector('#file-template');

      if (file.files[0] != undefined) {
        formData.append("file", file.files[0]);
      }

      this.loading()

        axios.post('/admin/import_template/', formData)
        .then( response => {

          this.errors = []

          Swal.fire(
            'Plantilla cargada!',
            'Los puntos de los usuarios fueron modificados exitosamente',
            'success'
          )

          btn.prop('disabled', false)
          this.loading()

        })
        .catch( errorsLaravel => {

          let msgError = "La operación de asignación de puntos no pudo ser completada. Verificá e intentá nuevamente"
          this.laravelErrorHandling(errorsLaravel.response.data, msgError)
          btn.prop('disabled', false)
          this.loading()

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
  }

})

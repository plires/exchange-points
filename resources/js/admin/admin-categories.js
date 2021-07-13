require('./bootstrap')
require('../../../node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js')
require('../../../node_modules/admin-lte/dist/js/adminlte.js')

window.Vue = require('../../../node_modules/vue/dist/vue.common.dev.js')
import Swal from '../../../node_modules/admin-lte/plugins/sweetalert2/sweetalert2.all.js'
import Func from './functions.js'
import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)

const app = new Vue({
  el: '#app',

  data: {
    categories: [],
    nameCategory: '',
    formCategories: {
      id:'',
      name:'',
      description:'',
    },
    paginate: ['categories'],
    modeCategoryEdit: false,
    titleFormCategory: '',
    authUser: {},
    errors: []
  },

  mixins: [Func],

  methods: {

    async getCategories() {
      this.loading()
      let response = await axios.get('/admin/get_categories')
      this.categories = response.data.sort().sort((a, b) => b.id - a.id)
      this.loading()
    },

    checkformCategories: function () {

      this.cleanErrors()
      let category = this.formCategories.name

      if ( category ) {
        return true
      }

      if (!category) {
        this.errors.push('Ingresá el nombre de la categoría.')
      }

      return false

    },

    sendCategory() {

      let checked = this.checkformCategories()

      if (checked) { 
        this.saveCategory(this.formCategories) 
      }

    },

    saveCategory(formCategory) {

      if (this.modeCategoryEdit) {
        var axiosMethod = axios.put
        var url = '/admin/categories/'+ formCategory.id
        let msgError = "Error al editar esta categoría."
        var verb = 'editada'
      } else {
        var axiosMethod = axios.post
        var url = '/admin/categories'
        let msgError = "Error al crear esta categoría."
        var verb = 'agregada'
      }

      this.loading()

      axiosMethod(url, formCategory).then(response => {

        $('#modal-category').modal("hide")
        this.getCategories()
        
        this.createAlert(
          'Éxito', 
          'Excelente!, la categoría ' + response.data.category_created.name + ' ha sido '+ verb +' exitosamente!', 
          'success', 
          'Cerrar'
        )

        this.resetCategoryForm()
        $('#modal-category').modal("hide")

        this.loading()

      })
      .catch(errorsLaravel => {

        let msgError = errorsLaravel.response.data
        this.laravelErrorHandling(errorsLaravel.response.data, msgError)
        this.loading()
        
      })

    }, 

    deleteCategory(id) {
      this.formCategories.id = id

      Swal.fire({
        title: 'Estas seguro?',
        text: 'Todos lo productos asociados a esta categoría pasaran automáticamente a la categoría "Sin Categoría". No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminarla!'
      }).then((result) => {
        if (result.isConfirmed) {


          this.loading()

          axios.post('/admin/categories/'+ id, {
            _method: 'DELETE'
          })
          .then( response => {

            Swal.fire(
              'Eliminado!',
              'El recurso '+ response.data.category_deleted.name +' ha sido eliminado.',
              'success'
            )

            this.getCategories()

            this.loading()

          })
          .catch( errorsLaravel => {

            let msgError = "La categoría no pudo ser eliminada."
            this.laravelErrorHandling(errorsLaravel.response.data, msgError)

          })

        }
      })

    },

    showFormCategoryEdit(id) {

      this.cleanErrors()
      this.setEditCategoryForm(true)
      $('#modal-category').modal("show")
      this.fillInputsFormCategory(id)

    },

    setEditCategoryForm(mode) {
      if (mode) {
        this.titleFormCategory = 'Edición de la categoría'
        this.modeCategoryEdit = true
      } else {
        this.titleFormCategory = 'Creación de Categoría'
        this.modeCategoryEdit = false
      }
    },

    resetCategoryForm() {

      this.setEditCategoryForm(false)
      this.cleanErrors()

      $(".form-control").val("")

      this.formCategories = {
        name: '',
        description: '',
      }

    },

    fillInputsFormCategory(id) {

      let category =  this.categories.filter( (category) => category.id == id )

      this.formCategories = {
        id: category[0].id,
      }

      $("#name").val(category[0].name)[0].dispatchEvent(new Event('input'))
      $("#description").val(category[0].description)[0].dispatchEvent(new Event('input'))
    	
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
    this.getCategories()
    this.getAuthUser()
  },

  computed: {

    filteredCategories() {
      return this.categories.filter( (category) => category.name.toLowerCase().includes(this.nameCategory.toLowerCase()) )
    }

  }

})

require('./bootstrap')
require('../../../node_modules/admin-lte/plugins/jquery/jquery.min.js')
require('../../../node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js')
require('../../../node_modules/admin-lte/dist/js/adminlte.js')

window.Vue = require('../../../node_modules/vue/dist/vue.min.js')
import Swal from '../../../node_modules/admin-lte/plugins/sweetalert2/sweetalert2.all.js'
import Func from './functions.js'
import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)

const app = new Vue({
  el: '#app',

  data: {
    products: [],
    nameProduct: '',
    categories: [],
    formProduct: {
      sku:'',
      name:'',
      description:'',
      price:'',
      availability:'',
      category_id: 1,
      is_active: true,
      featured: false
    },
    modeProductEdit: false,
    titleFormProduct: '',
    paginate: ['products'],
    authUser: {},
    errors: []
  },

  mixins: [Func],

  methods: {
    
  	async getProducts() {
      this.loading()
      let response = await axios.get('/admin/get_products')
      this.products = response.data.sort().sort((a, b) => b.id - a.id)
      this.loading()
  	},

    getCategoryProduct(idCategory) {

      var categoryName
      this.categories.forEach(function (category) {
        if (category.id == idCategory ) {
          categoryName = category.name
        }
      })
      return categoryName

    },

    async getCategories() {
      this.loading()
      let response = await axios.get('/admin/get_categories')
      this.categories = response.data
      this.loading()
    },

    checkFormProduct: function () { 

      let sku = this.formProduct.sku
      let name = this.formProduct.name
      let price = parseFloat(this.formProduct.price) 
      let availability = parseFloat(this.formProduct.availability)
      let category = parseFloat(this.formProduct.category_id)

      if ( sku && name && Number.isInteger(price) && Number.isInteger(availability) &&  Number.isInteger(category) && category != 0 ) {
        return true
      } 

      this.cleanErrors()

      if (!sku) {
        this.errors.push('El SKU del producto es obligatorio.')
      }

      if (!name) {
        this.errors.push('El nombre del producto es obligatorio.')
      }

      if ( !price || !Number.isInteger(price) ) {
        this.errors.push('Ingrese un precio válido (número entero)')
      }

      if ( !availability || !Number.isInteger(availability) ) {
        this.errors.push('Ingrese un stock válido (número entero)')
      }

      if ( !category || !Number.isInteger(category) ) {
        this.errors.push('Ingrese una categoría')
      }

      return false

    },

    sendProduct() {

      let checked = this.checkFormProduct()

      if (checked) { 
        this.saveProduct(this.formProduct)
      }

    },

    saveProduct(formProduct) {

      const form = document.querySelector('#productForm')
      var formData = new FormData(form);

      var imagefile = document.querySelector('#image');

      this.formProduct.is_active = this.formProduct.is_active ? 1 : 0; // Convertimos los valores a bool para que pase la validacion de laravel
      this.formProduct.featured = this.formProduct.featured ? 1 : 0; // Convertimos los valores a bool para que pase la validacion de laravel

      for ( let key in formProduct ) {
        formData.append(key, formProduct[key])
      }

      if (imagefile.files[0] != undefined) {
        formData.append("image", imagefile.files[0]);
      } 

      if (this.modeProductEdit) {
        var btn =  $('#btn_edit_product')
        btn.prop('disabled', true)

        var axiosMethod = axios.post
        formData.append('_method', 'PUT')
        var url = '/admin/products/'+ formProduct.id
        var verb = 'editado'
        let msgError = "Error al editar este producto."
      } else {
        var btn =  $('#btn_add_product')
        btn.prop('disabled', true)

        formData.append('_method', 'POST')
        var axiosMethod = axios.post
        var url = '/admin/products/'
        let msgError = "Error al agregar este producto."
        var verb2 = 'editar'
      }

      this.loading()

      axiosMethod(url, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(response => {

        $('#modal-product').modal("hide")
        this.getProducts()
        
        this.createAlert(
          'Éxito', 
          'Excelente!, el producto ' + response.data.product_created.name + ' ha sido '+ verb +' exitosamente!', 
          'success', 
          'Cerrar'
        )

        document.getElementById("image").value = "";

        this.resetProductForm()
        $('#modal-product').modal("hide")

        btn.prop('disabled', false)
        this.loading()

      })
      .catch(errorsLaravel => {

        let msgError = errorsLaravel.response.data
      	this.laravelErrorHandling(errorsLaravel.response.data, msgError)
        btn.prop('disabled', false)
        this.loading()
        
      })

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

    deleteProduct(id) {

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

          axios.post('/admin/products/'+ id, {
            _method: 'DELETE'
          })
          .then( response => {

            Swal.fire(
              'Eliminado!',
              'El recurso '+ response.data.product_deleted.name +' ha sido eliminado.',
              'success'
            )

            this.getProducts()

            this.loading()

          })
          .catch( errorsLaravel => {
            
            let msgError = "El producto no pudo ser eliminado."
            this.laravelErrorHandling(errorsLaravel.response.data, msgError)

          })

        }
      })

    },

    showFormEdit(id) {

      this.cleanErrors()
      this.setEditProductForm(true)
      $('#modal-product').modal("show")
      this.fillInputsFormProduct(id)

    },

    setEditProductForm(mode) {
      if (mode) {
        this.titleFormProduct = 'Edición de Producto'
        this.modeProductEdit = true
      } else {
        this.titleFormProduct = 'Creación de Producto'
        this.modeProductEdit = false
      }
    },

    fillInputsFormProduct(id) {
    	
			var idTemp, categoryTemp, isActive, featured

      this.products.forEach(function (product) {
        if (product.id == id ) {
          $("#sku").val(product.sku)[0].dispatchEvent(new Event('input'))
          $("#name").val(product.name)[0].dispatchEvent(new Event('input'))
          $("#description").val(product.description)[0].dispatchEvent(new Event('input'))
          $("#price").val(product.price)[0].dispatchEvent(new Event('input'))
          $("#availability").val(product.availability)[0].dispatchEvent(new Event('input'))
          $("#image_content").attr("src",app.showImage(product.image))

    			idTemp = product.id
          categoryTemp = product.category_id
          isActive = product.is_active
    			featured = product.featured
        }
      })

      this.formProduct.id = idTemp
      this.formProduct.category_id = categoryTemp
      this.formProduct.is_active = isActive
      this.formProduct.featured = featured

    },

    createAlert(title, text, icon, btnTxt) {
      Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: btnTxt
      })
    }, 

    cleanErrors() {
      this.errors = []
    }, 

    resetProductForm() { 
      this.setEditProductForm(false)
      this.cleanErrors()

      $("#image_content").attr("src",'/img/no-image.gif')

      this.formProduct = {
        sku: '',
        name: '',
        description: '',
        price: '',
        availability: '',
        featured: false,
        is_active: true,
        category_id: 0
      }

    }, 

  },

  created() {
    this.getProducts()
  	this.getCategories()
    this.setEditProductForm(false)
    this.getAuthUser()
  },

  computed: {

    filteredProducts() {
      return this.products.filter( (product) => product.name.toLowerCase().includes(this.nameProduct.toLowerCase()) )
    }    

  }

})



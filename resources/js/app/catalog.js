require('./app')
require('../../../node_modules/slick-carousel/slick/slick.js')
require('../../../node_modules/admin-lte/plugins/jquery/jquery.min.js')
require('../../../node_modules/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')

window.Vue = require('../../../node_modules/vue/dist/vue.common.dev.js')
import Swal from '../../../node_modules/admin-lte/plugins/sweetalert2/sweetalert2.all.js'

const app = new Vue({ 
  el: '#app',
  data: {
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
    formUser: {
      name: '',
      lastname: '',
      document: '',
      email: '',
      points: '',
      birthday: '',
      phone: '',
      street: '',
      street_number: '',
      city: '',
      province: '',
      country: '',
      postal_code: '',
      password: '',
      password_confirmation: ''
    },
    modePasswordEdit: false,
    entryPass: false,
    alert: '',
    errors: [],
  },

  methods: {

    async getAuthUser() {
      this.loading()
      let response = await axios.get('exchange/get_user_auth')
      this.authUser = response.data
      localStorage.removeItem('authUser')
      localStorage.setItem('authUser', JSON.stringify(response.data))
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

    closeAllWindows() {
      $('#cart').removeClass('show')
      $('#navigation').removeClass('show')
      $('#edit_user').removeClass('show')
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
      this.closeAllWindows()

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
      localStorage.setItem('cart', JSON.stringify(this.cart))

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
      localStorage.setItem('cart', JSON.stringify(this.cart))

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

    hiddenModalProduct() {
      $('#modalProduct').modal('hide')
    },

    createAlert(title, text, icon, btnTxt) {
      Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: btnTxt
      })
    },

    checkFormExchange: function () {

      this.cleanErrors()

      if ( this.cart.length != 0 ) {
        return true
      }

      if ( this.cart.length != 0 && this.authUser.length != 0 ) {
        this.errors.push('Agregá artículos al carrito de compra.')
      }

      if ( this.cart.length != 0 && this.authUser.length != 0 ) {
        this.errors.push('No existe un usuario logueado en la plataforma. Actualice esta página y volve a intentarlo.')
      }

      return false

    },

    sendExchanged() {

      $('#btn_confirmar_canje').prop('disabled', true)

      let checked = this.checkFormExchange()  

      if (checked) {

        var formData = new FormData()

        formData.append('user_id', this.authUser.id)

        formData.append('total', this.total.replace('.', ''))

        for ( var key in this.cart ) {
          formData.append('products[]', JSON.stringify(this.cart[key]))
        }

        this.loading()
        axios.post('/user-points-exchanged/', formData)

        .then(response => {

          $('#modalconfirmation').modal("hide")

          this.createAlert(
            'Éxito', 
            response.data.exchanged_created, 
            'success', 
            'Cerrar'
          )

          localStorage.removeItem('cart')
          localStorage.removeItem('authUser')
          this.cart = {}

          this.getAuthUser()
          this.getProducts()

          this.loading()

        })
        .catch(errorsLaravel => {

          if (typeof errorsLaravel.response.data.errors !== 'undefined') {

            this.errors = [].concat.apply([], Object.values(errorsLaravel.response.data.errors));
            
            let msgError = ''

            this.errors.forEach(error => 
              msgError += '<li>' + error + '</li><br>'
            );

            Swal.fire({
              title: 'Error',
              html: '<ul style="text-align: left;">' + msgError + '</ul>',
              icon: 'error',
              confirmButtonText: 'Cerrar'
            })
            
            this.loading()
          }
          
        })

      }

      $('#btn_confirmar_canje').prop('disabled', false)

    },

    showFormUserEdit() {

      this.closeAllWindows()
      this.cleanErrors()
      $('#modal-user').modal("show")
      this.fillInputsFormUser()

    },

    fillInputsFormUser() {
      
      this.formUser = {
        id: this.authUser.id,
        name: this.authUser.name,
        lastname: this.authUser.lastname,
        document: this.authUser.document,
        email: this.authUser.email,
        points: this.authUser.points,
        birthday: this.authUser.birthday,
        phone: this.authUser.phone,
        street: this.authUser.street,
        street_number: this.authUser.street_number,
        city: this.authUser.city,
        province: this.authUser.province,
        country: this.authUser.country,
        postal_code: this.authUser.postal_code,
      }

    },

    cleanErrors() {
      this.errors = []
    },

    sendUser() {

      let checked = this.checkFormUser()

      if (checked) {
        this.saveUser(this.formUser)
      }

    },

    checkFormUser: function () {

      this.cleanErrors()

      if (!this.entryPass) {

        if ( this.formUser.name && this.formUser.lastname && this.formUser.document && this.validateEmail(this.formUser.email) ) {
          this.formUser.password = ''
          this.formUser.password_confirmation = ''
          return true
        }

      } else {
        if ( this.formUser.name && this.formUser.lastname && this.formUser.document && this.validateEmail(this.formUser.email) && this.formUser.password && this.formUser.password_confirmation && this.formUser.password === this.formUser.password_confirmation ) {
          return true
        }
      }

      if (!this.formUser.name) {
        this.errors.push('El nombre es obligatorio.')
      }

      if (!this.formUser.lastname) {
        this.errors.push('El apellido es obligatorio.')
      }

      if (!this.formUser.document) {
        this.errors.push('El documento de identidad es obligatorio.')
      }

      if (!this.validateEmail(this.formUser.email)) {
        this.errors.push('El email no es válido.')
      }

      if ( this.entryPass && !this.formUser.password_confirmation  ) {
        this.errors.push('Ingresá la nueva contraseña y validala.')
      }

      if ( this.entryPass && this.formUser.password != this.formUser.password_confirmation  ) {
        this.errors.push('Las contraseñas no coinciden.')
      }

      return false

    },

    saveUser(formUser) {

      var axiosMethod = axios.put
      var url = '/user/' + this.authUser.id
      console.log(url)
      var msgError = 'Error al editar este usuario.'
      var verb = 'editado'

      this.loading()

      axiosMethod(url, formUser).then(response => {

        this.getAuthUser()
        
        this.createAlert(
          'Éxito', 
          'Excelente!, el usuario ' + response.data.user_created.name + ' ha sido '+ verb +' exitosamente!', 
          'success', 
          'Cerrar'
        )

        this.resetUserForm()
        $('#modal-user').modal("hide")

        this.closeAllWindows()
        this.loading()

      })
      .catch(errorsLaravel => {

        if (typeof errorsLaravel.response.data.errors !== 'undefined') {

          this.errors = [].concat.apply([], Object.values(errorsLaravel.response.data.errors));
          
          this.closeAllWindows()
          this.loading()
        }
        
      })

    },

    resetUserForm() {
      this.cleanErrors()

      $(".form-control").val("")

      this.entryPass = false

      this.formUser = {
        name: '',
        lastname: '',
        document: '',
        email: '',
        points: '',
        birthday: '',
        phone: '',
        street: '',
        street_number: '',
        city: '',
        province: '',
        country: '',
        postal_code: '',
        password: '',
        password_confirmation: ''
      }

    },

    validateEmail(email) {
      const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email)
    },

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
        for (let product in this.cart) {
          this.counterItemCart += this.cart[product].quantity
        }
      }

      return this.counterItemCart
    }

  },

  mounted() {
    if(localStorage.cart) this.cart = JSON.parse(localStorage.getItem('cart'))
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
    ]
  });
}, 500);

//Date picker
$('#birthday').datetimepicker({
    format: 'YYYY-MM-DD',
    minDate:new Date('1900-01-01')

});

$("#birthday").on("change.datetimepicker", ({date, oldDate}) => {
  if (typeof date !== 'undefined') {
    let datePartial = date._d.toLocaleDateString().split('/')
    let dateFormat = datePartial[2] + '-' + datePartial[1] + '-' + datePartial[0]
    $("#birthday_input").val(dateFormat)[0].dispatchEvent(new Event('input'))
    app.formUser.birthday = dateFormat
  }
})




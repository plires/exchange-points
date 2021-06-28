export default {

	methods: {

    async getAuthUser() {
      this.loading()
      let response = await axios.get('/admin/get_user_auth')
      this.authUser = response.data
      this.loading()
    },

    loading() {
		  $('#spinner').toggleClass('show_spinner');
		},

		laravelErrorHandling(errorsLaravel, msgError = null) {

      if (typeof errorsLaravel.server_out !== 'undefined') {
        this.createAlert(
          'Error', 
          errorsLaravel.server_out, 
          'error', 
          'Cerrar'
        )
        this.loading()
      }

    	if (typeof errorsLaravel.other_errors !== 'undefined') {
        this.createAlert(
          'Error', 
          msgError, 
          'error', 
          'Cerrar'
        )
        this.loading()
      }

      if (typeof errorsLaravel.error_import !== 'undefined') {
        this.errors.push(errorsLaravel.error_import)
        this.loading()
      }

      if (typeof errorsLaravel.errors !== 'undefined') {
        this.errors = [].concat.apply([], Object.values(errorsLaravel.errors));
        this.loading()
      }

      if (typeof errorsLaravel.message !== 'undefined') {
        this.errors = [].concat.apply([], Object.values(errorsLaravel.errors));
        this.loading()
      }

    },

    cleanErrors() {
      this.errors = []
    }

  }
}

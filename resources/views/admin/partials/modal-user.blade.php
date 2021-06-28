<div class="modal fade" id="modal-user">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div :class="[modeUserEdit ? 'bg-warning' : 'bg-primary', 'modal-header']">
        <h4 class="modal-title">@{{ titleFormUser }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Errores -->
      @include('admin.partials.errors')

      <form id="userForm" class="needs-validation" novalidate>
        @csrf
        <div class="modal-body">
          <!-- general form elements -->
          <div class="card">
            
            <!-- /.card-header -->
            <!-- form start -->
              <div class="card-body">

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">Nombre *</label>
                    <input required type="text" class="form-control" id="name" id="name" placeholder="Nombre (*)" v-model="formUser.name">
                    <div class="invalid-feedback">
                      Ingresá un nombre.
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="email">Email *</label>
                    <input required type="email" class="form-control" id="email" name="email" placeholder="Email (*)" v-model="formUser.email">
                    <div class="invalid-feedback">
                      Ingresá un email.
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="phone">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="(+598) 2708.60.10" v-model="formUser.phone">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="birthday">Fecha de Nacimiento:</label>
                    <div class="input-group date" id="birthday" data-target-input="nearest">
                      <input id="birthday_input" type="text" class="form-control datetimepicker-input" data-target="#birthday" name="birthday" v-model="formUser.birthday"/>
                      <div class="input-group-append" data-target="#birthday" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-10">
                    <label for="street">Calle</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Calle Libertad" v-model="formUser.street">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="street_number">Número</label>
                    <input type="text" class="form-control" id="street_number" name="street_number" placeholder="2738" v-model="formUser.street_number">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="city">Ciudad</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Rivera" v-model="formUser.city">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="province">Provincia</label>
                    <input type="text" class="form-control" id="province" name="province" placeholder="Montevideo" v-model="formUser.province">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="country">Pais</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Uruguay" v-model="formUser.country">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="postal_code">CP</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="11000" v-model="formUser.postal_code">
                  </div>
                </div>

                <div class="form-group">
                  <label for="role_id">Rol *</label>
                  <select required class="custom-select form-control-border" id="role_id" name="role_id" v-model="formUser.role_id">
                    <option 
                      v-for="rol in roles" 
                      :key="rol.id" 
                      :value="rol.id" 
                      :selected="rol.name === 'user'">
                        @{{ rol.name }}
                    </option>
                  </select>
                  <div class="invalid-feedback">
                    Ingresá el rol del nuevo usuario.
                  </div>
                </div>

                <div v-if="modeUserEdit" class="form-group col-md-6">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="password_reset" id="password_reset" v-model="entryPass">
                    <label class="form-check-label" for="password_reset">
                      Restablecer Contraseña
                    </label>
                  </div>
                </div>

                <div v-if="entryPass" class="form-row">
                  <div class="form-group col-md-6">
                    <label for="password">Ingresá nueva contraseña para este usuario</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nueva contraseña" v-model="formUser.password">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="password_confirmation">Repetir la nueva contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repetir contraseña" v-model="formUser.password_confirmation">
                  </div>
                </div>
                
              </div>
              <!-- /.card-body -->
              
          </div>
          <!-- /.card -->
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button v-if="!modeUserEdit" type="button" type="submit" @click.prevent="sendUser" name="send" class="btn btn-primary">Agregar</button>
          <button v-else type="button" type="submit" @click.prevent="sendUser" name="send" class="btn btn-warning">Guardar Cambios</button>
        </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
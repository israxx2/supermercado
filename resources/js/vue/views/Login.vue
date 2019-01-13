<template>
  <div class="hold-transition login-page container fluid cubrir">
    <div class="login-box">
      <div class="login-logo">
        <a>
          <b>mini</b>Market
        </a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese sus datos para iniciar sesión.</p>

        <!-- FORMULARIO DE LOGIN -->
        <form>
          <!-- <div class="form-group has-feedback {{ $errors->has('rut') ? ' is-invalid' : '' }}"> -->
          <div class="form-group has-feedback">
            <input
              type="text"
              id="rut"
              name="rut"
              class="form-control rut"
              placeholder="Rut"
              required
            >
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <!-- @if ($errors->has('rut')) -->
            <span class="invalid-feedback" role="alert">
              <!-- <strong>{{ $errors->first('rut') }}</strong> -->
            </span>
            <!-- @endif -->
          </div>

          <!-- <div class="form-group has-feedback {{ $errors->has('password') ? ' is-invalid' : '' }}"> -->
          <div class="form-group has-feedback">
            <input
              type="password"
              id="password"
              name="password"
              class="form-control"
              placeholder="Password"
              required
            >
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

            <!-- @if ($errors->has('password')) -->
            <span class="invalid-feedback" role="alert">
              <!-- <strong>{{ $errors->first('password') }}</strong> -->
            </span>
            <!-- @endif -->
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input class="form-check-input" type="checkbox" name="remember" id="remember"> Recordarme
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- FIN FORMULARIO DE LOGIN -->
        <div class="social-auth-links text-center">
          <p>- O -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat">
            <i class="fa fa-facebook"></i> Iniciar sesión con
            Facebook
          </a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat">
            <i class="fa fa-google-plus"></i> Iniciar sesión con
            Google+
          </a>
        </div>
        <!-- /.social-auth-links -->
        <!-- @if (Route::has('password.request')) -->
        <a class="btn btn-link">Olvidé mi contraseña</a>
        <br>
        <!-- @endif -->
        <a class="text-center">Crear nueva cuenta</a>
      </div>
      <!-- /.login-box-body -->
    </div>
  </div>
</template>

<script>
export default {
  created() {},
  data: () => ({}),
  props: {},
  methods: {}
};
</script>

<style scoped>
.cubrir {
  height: 100hv;
  width: 100wv;
}
</style>

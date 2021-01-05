<?php
/* session_start();
$cerrar_sesion = $_GET['cerrar_sesion'];
if ($cerrar_sesion) {
  session_destroy();
} */
include_once('funciones/db.php');
include_once('funciones/conexion.php');
include_once('templates/header.php');

?>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="http://www.bateriasecuador.com/">
        <img src="img/logo-baterias.png" alt="Logo baterias" class="brand-image elevation-3" style="opacity: .8; width: 80%;">
      </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Inicia sesión aquí</p>

        <form name="login-admin-form" id="login-admin" method="post" action="login-admin.php">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="usuario" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-12">
              <input type="hidden" name="login-admin" value="1">
              <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <?php

  include_once('templates/footer.php');
  ?>
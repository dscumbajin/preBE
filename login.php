<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
  exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
  // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
  // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
  require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("funciones/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
  // the user is logged in. you can do whatever you want here.
  // for demonstration purposes, we simply show the "you are logged in" view.
  header("location: admin-area.php");
} else {
  // the user is not logged in. you can do whatever you want here.
  // for demonstration purposes, we simply show the "you are not logged in" view.
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

          <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
            <?php
            // show potential errors / feedback (from login object)
            if (isset($login)) {
              if ($login->errors) {
            ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <strong>Error!</strong>

                  <?php
                  foreach ($login->errors as $error) {
                    echo $error;
                  }
                  ?>
                </div>
              <?php
              }
              if ($login->messages) {
              ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <strong>Aviso!</strong>
                  <?php
                  foreach ($login->messages as $message) {
                    echo $message;
                  }
                  ?>
                </div>
            <?php
              }
            }
            ?>


            <div class="input-group mb-3">
              <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Usuario">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="user_password" id="user_password" type="password" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-12">

                <button type="submit" class="btn btn-primary btn-block" name="login" id="submit">Iniciar Sesión</button>
              </div>
              <!-- /.col -->
            </div>

          </form><!-- /form -->
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

  <?php
}
include_once('templates/footer.php');
  ?>
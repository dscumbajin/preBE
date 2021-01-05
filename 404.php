<?php
include_once('funciones/sesiones.php');
include_once('funciones/funciones.php');
include_once('templates/header.php');
include_once('templates/barra.php');
include_once('templates/navegacion.php');

?>

<style>
        .error-box {
            height: 100%;
            position: relative;
            width: 100%;
        }
        
        .error-box .footer {
            width: 100%;
            left: 0px;
            right: 0px;
        }
        
        .error-body {
            padding-top: 5%;
        }
        
        .error-body h1 {
            font-size: 210px;
            font-weight: 900;
            text-shadow: 4px 4px 0 #ffffff, 6px 6px 0 #263238;
            line-height: 210px;
        }
    </style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

      <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>404</h1>
                <h3 class="text-uppercase">Página no encontrada !</h3>
                <p class="text-muted m-t-30 m-b-30"></p>
                            <br>
                <footer class="footer text-center">© Baterias Ecuador.</footer>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include_once('templates/footer.php');
?>
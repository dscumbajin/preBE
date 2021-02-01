<?php
include_once('funciones/db.php');
include_once('funciones/conexion.php');
include_once('templates/header.php');

session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
  header("location: login.php");
  exit;
}

include_once('templates/barra.php');
include_once('templates/navegacion.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid center">
      <div class="row mb-2">
        <div class="col-sm-10">
          <h1>Presupuestos</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">

    <div class="card">
      <div class="container">
        <div class="panel panel-info">
          <br>
          <div class="panel-body">


            <form class="form-horizontal" role="form" id="datos_cotizacion">

              <div class="form-group row">
                <label for="q" class="col-md-2 control-label">Presupuesto Mes</label>
                <div class="col-md-5">
                  <input type="text" class="form-control" id="q" placeholder="Año - mes - vendedor - linea" onkeyup='load(1);'>
                </div>
                <div class="col-md-3">
                  <button type="button" class="btn btn-default" onclick='load(1);'>
                    <span><i class="fas fa-search"></i></span> Buscar</button>
                  <span id="loader"></span>
                </div>

              </div>



            </form>
            <div id="resultados"></div><!-- Carga los datos ajax -->
            <div class='outer_div'></div><!-- Carga los datos ajax -->

          </div>
        </div>

      </div>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->


</div>
<!-- /.content-wrapper -->

<?php

include_once('templates/footer.php');
?>

<script type="text/javascript" src="js/presupuesto/presupuesto-mes.js"></script>
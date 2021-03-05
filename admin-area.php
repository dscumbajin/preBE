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
<br>
  <!-- Main content -->
  <section class="content">
  <div class="row">
  <div class="col-lg-3 col-6">
    <?php
    $sql = "SELECT COUNT(idUsu) AS admin FROM admins ";
    $resultado = $con->query($sql);
    $registrados = $resultado->fetch_assoc();
    ?>
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?php echo $registrados['admin'] ?><sup style="font-size: 20px"></sup></h3>

        <p>Usuarios</p>
      </div>
      <div class="icon">
      <i class="fas fa-users"></i>
      </div>
      <a href="lista-admin.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->

  <div class="col-lg-3 col-6">
    <?php
    $sql = "SELECT COUNT(codVen) AS vendedor FROM vendedor ";
    $resultado = $con->query($sql);
    $registrados = $resultado->fetch_assoc();
    ?>
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?php echo $registrados['vendedor'] ?><sup style="font-size: 20px"></sup></h3>

        <p>Vendedores</p>
      </div>
      <div class="icon">
      <i class="fas fa-universal-access"></i>
      </div>
      <a href="lista-vendedor.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->

  
  <div class="col-lg-3 col-6">
    <?php
    $sql = "SELECT COUNT(codLinea) AS listalinea FROM listalinea WHERE estadoLinea = 1";
    $resultado = $con->query($sql);
    $registrados = $resultado->fetch_assoc();
    ?>
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3><?php echo $registrados['listalinea'] ?><sup style="font-size: 20px"></sup></h3>

        <p>Linea Negocio</p>
      </div>
      <div class="icon">
      <i class="fas fa-sitemap"></i>
      </div>
      <a href="lista-linea.php" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  </div>
  </section>
</div>

<?php

include_once('templates/footer.php');
?>
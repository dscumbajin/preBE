<?php
include_once('funciones/db.php');
include_once('funciones/conexion.php');
include_once('templates/header.php');

session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
  header("location: login.php");
  exit;
}
$codLinea = $_GET['codLinea'];
$nomLinea = $_GET['nomLinea'];
/* if (!filter_var($id, FILTER_VALIDATE_INT)) {
  header("Location: ./404.php");
} */
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
                    <h1>Vendedores - <?php echo $nomLinea;?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="registros" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Vendedor</th>
                                        <th>Año</th>
                                        <th>Unidades Vendidas</th>
                                        <th>Unidades Promociones</th>
                                        <th>Unidades Garantía</th>
                                        <th>Ventas</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                  try {
                    $sql = "SELECT vendedor.nomVen, anio, ventasU, promocionU, garantiaU, facturadoV, historial_ventas.codVen, historial_ventas.codLinea ";
                    $sql .= " FROM historial_ventas ";
                    $sql .= " INNER JOIN vendedor ";
                    $sql .= " ON vendedor.codVen = historial_ventas.codVen ";
                    $sql .= " WHERE historial_ventas.codLinea = $codLinea ";     
                    $resultado = $con->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }
                  while ($historial_ventas = $resultado->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $historial_ventas['nomVen']; ?></td>
                                        <td><?php echo $historial_ventas['anio']; ?></td>
                                        <td><?php echo $historial_ventas['ventasU']; ?></td>
                                        <td><?php echo $historial_ventas['promocionU']; ?></td>
                                        <td><?php echo $historial_ventas['garantiaU']; ?></td>
                                        <td> <i class="fas fa-dollar-sign"></i>
                                            <?php echo $historial_ventas['facturadoV']; ?></td>

                                        <td>
                                            <a href="crea-pres-anio.php?codVen=<?php echo $historial_ventas['codVen']?>&codLinea=<?php echo $historial_ventas['codLinea']?>">
                                            <button type="submit" data-toggle="modal" data-target="#formUsuario" class="btn btn-outline-secondary" > <i class="fas fa-plus-circle" ></i> Nuevo</button>  
                                            </a>

                                        </td>
                                    </tr>
                                    <?php } ?>


                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->

<?php

include_once('templates/footer.php');
?>
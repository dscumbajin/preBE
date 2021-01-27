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
          <h1>Presupuestos - 2020</h1>
        </div>

        <button type="submit" data-toggle="modal" data-target="#formUsuario" class="btn btn-dark float-right"> <i class="fas fa-plus-circle"></i> Nuevo</button>

        <?php include_once('modal/crear-usuario.php'); ?>
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
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Vendedor</th>
                    <th>Estado</th>
                    <th>Cantidad Mes</th>
                    <th>Cantidad Promos</th>
                    <th>Cantidad Garantía</th>
                    <th>Cantidad Total</th>
                    <th>Presupuesto</th>
                    <th>Linea</th>
                    <th>Segmento</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {

                    $sql = "SELECT presupuesto_mes.idPresMes, anio, mes, cantMesU, cantPromoU, cantGarantU, cantTotalU, presMesV, vendedor.codVen, nomVen, estadoVen, listalinea.codLinea, nomLinea, desSeg ";
                    $sql .= " FROM presupuesto_mes ";
                    $sql .= " INNER JOIN presupuesto_anio ";
                    $sql .= " ON presupuesto_anio.idPresAnio = presupuesto_mes.idPresAnio ";
                    $sql .= " INNER JOIN listalinea ";
                    $sql .= " ON listalinea.codLinea=presupuesto_anio.codLinea ";
                    $sql .= " INNER JOIN vendedor ";
                    $sql .= " ON vendedor.codVen=presupuesto_anio.codVen ";
                    $sql .= " INNER JOIN segmento ";
                    $sql .= " ON segmento.codSeg = vendedor.codSeg ";

                    $resultado = $con->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }
                  while ($presupuesto = $resultado->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $presupuesto['anio'] ?></td>
                      <td><?php
                          $dt = new DateTime($presupuesto['mes']);
                          echo $dt->format('Y/m/d'); ?></td>
                      <td><?php echo $presupuesto['nomVen']; ?></td>
                      <td><?php echo $presupuesto['estadoVen']; ?></td>
                      <td><?php echo $presupuesto['cantMesU']; ?></td>
                      <td><?php echo $presupuesto['cantPromoU']; ?></td>
                      <td><?php echo $presupuesto['cantGarantU']; ?></td>
                      <td><?php echo $presupuesto['cantTotalU']; ?></td>
                      <td> <i class="fas fa-dollar-sign"></i> <?php echo $presupuesto['presMesV']; ?></td>
                      <td><?php echo $presupuesto['nomLinea']; ?></td>
                      <td><?php echo $presupuesto['desSeg']; ?></td>


                      <td>
                        <?php if ($_SESSION['user_nivel'] == 2) : ?>
                          <a href="editar-proyecto.php?id=<?php echo $presupuesto['idPresMes']; ?>">
                            <i class="fas fa-pen editar"></i>
                          </a>
                          <a href="#" data-id="<?php echo $presupuesto['idPresMes']; ?>" data-tipo="proyecto" class="borrar_registro">
                            <i class="far fa-trash-alt eliminar"></i>
                          </a>
                        <?php endif; ?>
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
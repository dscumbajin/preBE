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
          <h1>Vendedores</h1>
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
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $sql = "SELECT * FROM vendedor ";
                    $resultado = $con->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }
                  while ($vendedor = $resultado->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $vendedor['codVen']; ?></td>
                      <td><?php echo $vendedor['nomVen']; ?></td>
                      <td>
                        <?php
                        if ($vendedor['estadoVen'] == 1) {
                          
                          echo '<span class="badge badge-primary">Activo</span>';
                        } else {
                          echo '<span class="badge badge-danger">Inactivo</span>';
                        }
                        ?>
                      </td>
                      <td>
                        <a href="editar-vendedor.php?id=<?php echo $vendedor['idUsu']; ?>">
                          <i class="fas fa-pen editar"></i>
                        </a>
                        <a href="#" data-id="<?php echo $vendedor['idUsu']; ?>" data-tipo="vendedor" class="borrar_registro">
                          <i class="far fa-trash-alt eliminar"></i>
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
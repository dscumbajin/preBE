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
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
                </div>
                <a type="button" data-toggle="modal" data-target="#formUsuario"> <i class="fas fa-comments" style="color: #007bff; font-size: 20px;"></i></a>
               <?php include_once('modal/crear-usuario.php');?> 
            
            </div>
        </div><!-- /.container-fluid -->
    </section>

</div>
<!-- /.content-wrapper -->

<?php

include_once('templates/footer.php');
?>
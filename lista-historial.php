<?php
/*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
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
                    <h1>CARGAR HISTORIAL VENTAS</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="container">
                <br>
                <div class="panel panel-info">

                    <div class="panel-body">

                        <form action="files.php" method="post" enctype="multipart/form-data" id="filesForm">
                            <div class="col-md-4 offset-md-4">
                                <input class="form-control" type="file" name="fileContacts" id="fileHistorial">
                                <br>
                                <button type="button" id= "cargar_historial" onclick="uploadHistorial()" class="btn btn-primary form-control">Cargar</button>
                                <br>
                            </div>
                        </form>
                        <br>

                    </div>
                </div>

            </div>
            <!-- /.card-header -->

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<?php

include_once('templates/footer.php');
?>

<script>
    function uploadHistorial() {


        var Form = new FormData($('#filesForm')[0]);
        $.ajax({

            url: "./ajax/importar.php",
            type: "post",
            data: Form,
            processData: false,
            contentType: false,
            success: function(data) {
                alert('Registros Agregados!');
            }
        });
    }
</script>
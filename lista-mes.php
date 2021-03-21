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
                    <h1>CARGAR PRESUPUESTO MES</h1>
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

                        <div class="card">
                            <div class="card-header">
                                ARCHIVO DE PRESUPUESTOS MES
                            </div>
                            <div class="card-body">
                                <form action="#" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <input type="file" id="txt_archivo" class="form-control" accept=".csv,.xlsx,.xls">
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" title="Cargar Excel" class="btn btn-danger" onclick="CargarExcel()" style="width: 100%;"><i class="far fa-file-excel"></i> Cargar</button>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" title="Guardar Excel" disabled id="btn_registrar" class="btn btn-primary" onclick="Registrar_Excel()" style="width: 100%;"><i class="far fa-file-excel"></i> Guardar</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12" id="div_tabla"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
    $('#input[type="file"]').on('change', function() {
        var ext = $(this).val().split('.').pop();
        if ($(this).val() != '') {
            if (ext == "xls" || ext == 'csv' || ext == 'xlsx') {

            } else {
                $(this).val('');
                Swal.fire("Mensaje de Error", "Extención no permitida: " + ext + "", "error");
            }
        }
    });

    function CargarExcel() {
        var excel = $('#txt_archivo').val();
        if (excel === "") {
            return Swal.fire("Mensaje de advertencia", "Seleccionar un archivo excel", "warning");
        }
        var formData = new FormData();
        var files = $('#txt_archivo')[0].files[0];
        formData.append('archivoexcel', files);
        $.ajax({
            url: 'importar_mes.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(resp) {
                $('#div_tabla').html(resp);
                document.getElementById('btn_registrar').disabled = false;
            }

        });
        return false;
    }

    function Registrar_Excel() {
        var contador = 0;
        var arreglo_idPresAnio = new Array();
        var arreglo_mes = new Array();
        var arreglo_cantMesU = new Array();
        var arreglo_cantPromoU = new Array();
        var arreglo_cantGarantU = new Array();
        var arreglo_cantTotalU = new Array();
        var arreglo_presMesV = new Array();

        $("#tabla_detalle tbody#tbody_tabla_detalle tr").each(function() {
            arreglo_idPresAnio.push($(this).find('td').eq(0).text());
            arreglo_mes.push($(this).find('td').eq(1).text());
            arreglo_cantMesU.push($(this).find('td').eq(2).text());
            arreglo_cantPromoU.push($(this).find('td').eq(3).text());
            arreglo_cantGarantU.push($(this).find('td').eq(4).text());
            arreglo_cantTotalU.push($(this).find('td').eq(5).text());
            arreglo_presMesV.push($(this).find('td').eq(6).text());
            contador++;
        });
        if (contador == 0) {
            return Swal.fire("Mensaje de Adverntencia", "La tabla tiene que tener como mínimo 1 dato", "warning");
        }

        var idPresAnio = arreglo_idPresAnio.toString();
        var mes = arreglo_mes.toString();
        var cantMesU = arreglo_cantMesU.toString();
        var cantPromoU = arreglo_cantPromoU.toString();
        var cantGarantU = arreglo_cantGarantU.toString();
        var cantTotalU = arreglo_cantTotalU.toString();
        var presMesV = arreglo_presMesV.toString();

        $.ajax({
            url: 'controlador_mes.php',
            type: 'POST',
            data: {
                idPresAnio: idPresAnio,
                mes: mes,
                cantMesU: cantMesU,
                cantPromoU: cantPromoU,
                cantGarantU: cantGarantU,
                cantTotalU: cantTotalU,
                presMesV: presMesV,
            },
        }).done(function(resp){
            Swal.fire("Mensaje de confirmación","Datos registrados", "success");
            $('#div_tabla').html("");
        })
       
    }
</script>
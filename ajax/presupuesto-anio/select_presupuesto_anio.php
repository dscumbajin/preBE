<?php
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/

require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
$codLinea = mysqli_real_escape_string($con, (strip_tags($_REQUEST['codLinea'], ENT_QUOTES)));
$anio = mysqli_real_escape_string($con, (strip_tags($_REQUEST['anio'], ENT_QUOTES)));
$nomVen = mysqli_real_escape_string($con, (strip_tags($_REQUEST['nomVen'], ENT_QUOTES)));
?>
<div class="card card-dark">
    <div class="card-header">
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
        <div class="form-horizontal row">
            <!--Formulario de busqueda-->
            <div class="col-md-3" style="text-align: center;">
                <samp style="font-weight: bold;">Reasignar presupuesto</samp>
            </div>

            <a class="linea"><span>|</span></a>

            <label for="txtBusqueda" class="col-md-2 control-label">Vendedor</label>

            <div class="col-md-5">

                <select class="form-control seleccionar select2-primary" id="txtBusqueda" name="txtBusqueda" required>
                    <option value="" selected>--Seleccionar vendedor--</option>
                    <?php
                    try {
                        $sql = " SELECT * FROM presupuesto_anio, vendedor, listalinea ";
                        $sql .= " WHERE presupuesto_anio.codVen = vendedor.codVen ";
                        $sql .= " AND presupuesto_anio.codLinea = listalinea.codLinea ";
                        $sql .= " AND presupuesto_anio.codLinea = '$codLinea' ";
                        $sql .= " AND anio = '$anio' ";
                        $sql .= " AND presupuesto_anio.activoAnio = 1 ";
                        $sql .= " AND vendedor.nomVen != '$nomVen' ";
                        $resultado = $con->query($sql);
                        while ($vendedor = $resultado->fetch_assoc()) { ?>
                            <option value="<?php echo $vendedor['nomVen']; ?>">
                                <?php echo $vendedor['nomVen']; ?></option>
                    <?php }
                    } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-1 ">
                <span><i class="fas fa-search"></i></span></button>
                <span id="loader"></span>

            </div>
        </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body" style="display: block;">

        <section id="tabla_resultados_delete"></section>
    </div>
</div>

<script type="text/javascript">
    $('#txtBusqueda').on('change', function() {
        var codLinea = $("#codLinea").val();
        var txtBusqueda = $('#txtBusqueda').val();
        var anio = $("#anio").val();
        var url = './ajax/presupuesto-anio/buscar_vendedor_presupuesto.php';
        console.log(`codLinea: ${codLinea} anio: ${anio} txtBusqueda: ${txtBusqueda}`);
        if (txtBusqueda != "") {
            $.ajax({
                tyoe: 'POST',
                url: url,
                data: 'codLinea=' + codLinea + '&anio=' + anio + '&txtBusqueda=' + txtBusqueda,
                beforeSend: function(objeto) {
                    $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
                },
                success: function(datos) {
                    $('#tabla_resultados_delete').show();
                    $('#tabla_resultados_delete').html('');
                    $('#tabla_resultados_delete').html(datos);
                    $('#loader').html('');
                    //Bloqueo de Inputs
                    $("#delVentas").attr("readonly", true);
                    $("#delPres").attr("readonly", true);
                    $("#delGran").attr("readonly", true);
                    $("#delTotal").attr("readonly", true);
                    // Conversion Inputs int
                    var delete_ventas_presupuesto = $("#delete_ventas_presupuesto").val();
                    delete_ventas_presupuesto = parseInt(delete_ventas_presupuesto);
                    var delete_promos_presupuesto = $("#delete_promos_presupuesto").val();
                    delete_promos_presupuesto = parseInt(delete_promos_presupuesto);
                    var delete_garantia_presupuesto = $("#delete_garantia_presupuesto").val();
                    delete_garantia_presupuesto = parseInt(delete_garantia_presupuesto);
                    var delete_total_presupuesto = $("#delete_total_presupuesto").val();
                    delete_total_presupuesto = parseInt(delete_total_presupuesto);
                    //Calculos de nuevos valores

                    var delVentas = $("#delVentas").val();
                    delVentas = parseInt(delVentas);
                    var delProm = $("#delProm").val();
                    delProm = parseInt(delProm);
                    var delGran = $("#delGran").val();
                    delGran = parseInt(delGran);
                    var delTotal = $("#delTotal").val();
                    delTotal = parseInt(delTotal);

                    $("#delVentas").val(delete_ventas_presupuesto + delVentas);
                    $("#delProm").val(delete_promos_presupuesto + delProm);
                    $("#delGran").val(delete_garantia_presupuesto + delGran);
                    $("#delTotal").val(delete_total_presupuesto + delTotal);

                }

            });

        }
        $('#tabla_resultados_delete').hide();

    });
</script>
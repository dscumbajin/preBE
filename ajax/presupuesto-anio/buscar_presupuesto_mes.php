<?php
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
$idPresAnio = intval($_REQUEST['idPresAnio']);

// Ejecutamos la consulta de busqueda
?>
<div class="table-responsive">
    <form method="post" id="editar_presupuesto_mes" name="editar_presupuesto_mes">
        <div id="resultados_ajax2"></div>
        <table id="registros" class="table table-bordered table-striped">
            <thead>
                <tr>

                    <th>Mes</th>
                    <th>Porcentaje</th>
                    <th>Cantidad Mes</th>
                    <th>Cantidad Promos</th>
                    <th>Cantidad Garantía</th>
                    <th>Cantidad Total</th>
                    <th>$ Presupuesto</th>

                </tr>
            </thead>
            <tbody>
                <?php
                /* $fechaActual = date('Y-m-d');
                AND mes >= '$fechaActual' */
                try {
                    $sql = " SELECT * FROM presupuesto_mes WHERE idPresAnio = $idPresAnio ";

                    $resultado = $con->query($sql);
                } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                }
                while ($presMes = $resultado->fetch_assoc()) {
                    $idMes = $presMes['idPresMes'] ?>
                    <tr>

                        <td hidden><input name="idPresMes[]" value="<?php echo $presMes['idPresMes'] ?>" /></td>
                        <td><input class="bloquear" id="mes<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="mes[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['mes'] ?>" required></td>
                        <td><input class="decimales" onclick="enter(<?php echo $idMes ?>)" id="porcentaje<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="porcentaje[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['porcentaje']; ?>" required></td>
                        <td><input class="bloquear" id="cantMesU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantMesU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantMesU']; ?>" required></td>
                        <td><input class="bloquear" id="cantPromoU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantPromoU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantPromoU']; ?>" required></td>
                        <td><input class="bloquear" id="cantGarantU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantGarantU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantGarantU']; ?>" required></td>
                        <td><input class="bloquear" id="cantTotalU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantTotalU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantTotalU']; ?>" required></td>
                        <td><input class="bloquear" id="presMesV<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="presMesV[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['presMesV']; ?>" required></td>
                    </tr>
                <?php  } ?>
            </tbody>

        </table>
        <div class="card-footer">
            <button type="submit" class="btn btn-success float-right" id="actualizar_datos_mes">Actualizar</button>
        </div>
    </form>


</div>
<script>
    $(function() {

        /* $("#registros").DataTable({
            "responsive": false,
            "autoWidth": false,
            "pageLength": 12,
            "language": {
                paginate: {
                    next: 'Siguiente',
                    previous: 'Anterior',
                    last: 'Último',
                    firts: 'Primero'
                },
                info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
                emptyTable: 'No hay registros',
                infoEmpty: 'Mostrando 0 to 0 of 0 Entradas',
                search: 'Buscar: ',
                lengthMenu: "Mostrar _MENU_ Entradas ",
                infoFiltered: " (Filtrado de un total de _MAX_  entradas)"
            }

        });
 */
        // VALIDACIONES
        $('.decimales').on('input', function() {
            this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
        });

        //BLOQUEAR
        $('.bloquear').attr("readonly", true);

        $("#editar_presupuesto_mes").submit(function(event) {
            $('#actualizar_datos_mes').attr("disabled", true);

            var parametros = $(this).serialize();
            console.log(parametros);
            $.ajax({
                type: "POST",
                url: "./ajax/presupuesto-anio/editar_presupuesto_mes.php",
                data: parametros,
                beforeSend: function(objeto) {
                    $("#resultados_ajax2").html("Mensaje: Cargando...");
                },
                success: function(datos) {
                    $("#resultados_ajax2").html(datos);
                    $('#actualizar_datos_mes').attr("disabled", false);
                    load(1);
                }
            });
            event.preventDefault();
        })



    });

    function enter(id) {
        //desabilitar todo
        //cuando haga clic habilitar

        $('#porcentaje' + id).on('input', function() {

            //VALORES DE PRESUPUESTO AÑO
            var cantidad_ventas_presupuesto = $("#mod_ventas_presupuesto").val();
            cantidad_ventas_presupuesto = parseInt(cantidad_ventas_presupuesto);
            var cantidad_promos_presupuesto = $("#mod_promos_presupuesto").val();
            cantidad_promos_presupuesto = parseInt(cantidad_promos_presupuesto);
            var cantidad_garantia_presupuesto = $("#mod_garantia_presupuesto").val();
            cantidad_garantia_presupuesto = parseInt(cantidad_garantia_presupuesto);

            var precioMeta = $("#mod_precioMeta").val();
            precioMeta = parseFloat(precioMeta);
            
            //VALOR DEL PORCENTAJE
            var porcentajeInput = $('#porcentaje' + id).val();
            porcentajeInput = parseFloat(porcentajeInput);
            var porcentaje = porcentajeInput / 100;

            //VALORES DE PRESUPUESTO MES
            var cantMesU = Math.round(cantidad_ventas_presupuesto * porcentaje);
            var cantPromoU = Math.round(cantidad_promos_presupuesto * porcentaje);
            var cantGarantU = Math.round(cantidad_garantia_presupuesto * porcentaje);
            var cantTotalU = Math.round(cantMesU + cantPromoU +cantGarantU);
            var presMesV = precioMeta * cantTotalU;

            $('#cantMesU' + id).val(cantMesU);
            $('#cantPromoU' + id).val(cantPromoU);
            $('#cantGarantU' + id).val(cantGarantU);
            $('#cantTotalU' + id).val(cantTotalU);
            $('#presMesV' + id).val(presMesV);

        });
    }
</script>
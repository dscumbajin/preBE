<?php
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos

$codVen = mysqli_real_escape_string($con, (strip_tags($_REQUEST['codVen'], ENT_QUOTES)));
$anio= mysqli_real_escape_string($con, (strip_tags($_REQUEST['anio'], ENT_QUOTES)));
// Ejecutamos la consulta de busqueda
?>
<style>
.trT { display: block; float: left; width: 83px; }
.thT, .tdT { display: block;width: 83px; }

</style>


<div class="table-responsive" >
    <div id="resultados_ajax2"></div>
    <table id="registros" class="table table-bordered table-striped">
       
            <tr class="trT">
                <th class="thT">Mes</th>
                <th class="thT">Total</th>
                <th class="thT">Presupuesto</th>
            </tr>
      
            <?php

            try {
                $sql = " SELECT SUM(cantTotalU) AS total, COUNT(codLinea) AS num, AVG(precioMeta) AS meta,(SUM(cantTotalU)*AVG(precioMeta)) AS calculo, mes, vendedor.codVen, vendedor.nomVen ";
                $sql .= " FROM presupuesto_mes, presupuesto_anio, vendedor ";
                $sql .= " WHERE presupuesto_anio.idPresAnio = presupuesto_mes.idPresAnio";
                $sql .= " AND presupuesto_anio.codVen = vendedor.codVen";
                $sql .= " AND vendedor.codVen = '$codVen' ";
                $sql .= " AND presupuesto_anio.anio = '$anio' ";
                $sql .= " AND presupuesto_anio.activoAnio = 1 ";
                $sql .= " GROUP BY codVen, mes";
                $resultado = $con->query($sql);
            } catch (Exception $e) {
                $error = $e->getMessage();
                echo $error;
            }
            while ($detalle = $resultado->fetch_assoc()) { ?>
                <tr class="trT">
                    <input type="hidden" id="numLineas" value="<?php echo $detalle['num'] ?>">
                    <td style="text-transform: uppercase; font-weight: bold;" class="tdT"><?php setlocale(LC_TIME, "spanish");
							$date = new DateTime($detalle['mes']);
							$fecha = strftime("%b", $date->getTimestamp());
							echo $fecha;?></td>
                    <td  class="tdT"><?php echo $detalle['total'] ?></td>
                    <td  class="tdT"><i class="fas fa-dollar-sign"></i> <?php echo  $format_number = number_format($detalle['calculo'], 2); ?></td>
                </tr>
            <?php  } ?>
        

    </table>

</div>

<!-- <script>
    $(function() {

        $("#registros").DataTable({
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
                zeroRecords: "No se encontraron registros coincidentes",
                info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
                emptyTable: 'No hay registros',
                infoEmpty: 'Mostrando 0 to 0 of 0 Entradas',
                search: 'Buscar: ',
                lengthMenu: "Mostrar _MENU_ Entradas ",
                infoFiltered: " (Filtrado de un total de _MAX_  entradas)"
            }

        });

    });
</script> -->
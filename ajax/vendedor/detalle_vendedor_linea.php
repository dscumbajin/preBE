<?php
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos

$codVen = mysqli_real_escape_string($con, (strip_tags($_REQUEST['codVen'], ENT_QUOTES)));

// Ejecutamos la consulta de busqueda
?>
<div class="table-responsive">
    <div id="resultados_ajax2"></div>
    <table id="registros" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Mes</th>
                <th>Total</th>
                <th>Presupuesto</th>
            </tr>
        </thead>
        <tbody>
            <?php

            try {
                $sql = " SELECT SUM(cantTotalU) AS total, COUNT(codLinea) AS num, AVG(precioMeta) AS meta,(SUM(cantTotalU)*AVG(precioMeta)) AS calculo, mes, vendedor.codVen, vendedor.nomVen ";
                $sql .= " FROM presupuesto_mes, presupuesto_anio, vendedor ";
                $sql .= " WHERE presupuesto_anio.idPresAnio = presupuesto_mes.idPresAnio";
                $sql .= " AND presupuesto_anio.codVen = vendedor.codVen";
                $sql .= " AND vendedor.codVen = '$codVen' GROUP BY codVen, mes";
                $resultado = $con->query($sql);
            } catch (Exception $e) {
                $error = $e->getMessage();
                echo $error;
            }
            while ($detalle = $resultado->fetch_assoc()) { ?>
                <tr>
                    <input type="hidden" id="numLineas" value="<?php echo $detalle['num'] ?>">
                    <td><?php echo $detalle['mes'] ?></td>
                    <td><?php echo $detalle['total'] ?></td>
                    <td><i class="fas fa-dollar-sign"></i> <?php echo $detalle['calculo'] ?></td>
                </tr>
            <?php  } ?>
        </tbody>

    </table>

</div>

<script>
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
                info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
                emptyTable: 'No hay registros',
                infoEmpty: 'Mostrando 0 to 0 of 0 Entradas',
                search: 'Buscar: ',
                lengthMenu: "Mostrar _MENU_ Entradas ",
                infoFiltered: " (Filtrado de un total de _MAX_  entradas)"
            }

        });

        
       
    });
</script>
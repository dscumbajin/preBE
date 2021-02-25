<?php
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
$idPresAnio = intval($_REQUEST['idPresAnio']);

// Ejecutamos la consulta de busqueda
?>
<div class="table-responsive">
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
            try {
                $sql = " SELECT * FROM presupuesto_mes WHERE idPresAnio = $idPresAnio";

                $resultado = $con->query($sql);
            } catch (Exception $e) {
                $error = $e->getMessage();
                echo $error;
            }
            while ($presMes = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $presMes['mes']; ?></td>
                    <td><?php echo $presMes['porcentaje']; ?></td>
                    <td><?php echo $presMes['cantMesU']; ?></td>
                    <td><?php echo $presMes['cantPromoU']; ?></td>
                    <td><?php echo $presMes['cantGarantU']; ?></td>
                    <td><?php echo $presMes['cantTotalU']; ?></td>
                    <td><?php echo $presMes['presMesV']; ?></td>

                </tr>
            <?php } ?>
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
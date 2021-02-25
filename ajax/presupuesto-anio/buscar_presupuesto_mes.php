<?php
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
$idPresAnio = intval($_REQUEST['idPresAnio']);

// Ejecutamos la consulta de busqueda
?>
<div class="table-responsive">
    <form method="POST">
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

                        <td hidden><input name="idPresMes[]" value="<?php echo $presMes['idPresMes'] ?>" /></td>
                        <td><input id="mes<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="mes[<?php echo $presMes['idPresMes'] ?>]" value="<?php
                                                                                                                                                                        setlocale(LC_TIME, "spanish");
                                                                                                                                                                        $date = new DateTime($presMes['mes']);
                                                                                                                                                                        $fecha = strftime("%B", $date->getTimestamp());
                                                                                                                                                                        echo $fecha;
                                                                                                                                                                        ?>"></td>
                        <td><input id="porcentaje<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="porcentaje[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['porcentaje']; ?>"></td>
                        <td><input id="cantMesU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantMesU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantMesU']; ?>"></td>
                        <td><input id="cantPromoU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantPromoU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantPromoU']; ?>"></td>
                        <td><input id="cantGarantU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantGarantU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantGarantU']; ?>"></td>
                        <td><input id="cantTotalU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantTotalU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantTotalU']; ?>"></td>
                        <td><input id="presMesV<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="presMesV[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['presMesV']; ?>"></td>

                    </tr>
                <?php } ?>
            </tbody>

        </table>
        <input type="submit" name="actualizar" value="Actualizar Registros" class="btn btn-info col-md-offset-9 float-right" />
    </form>
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
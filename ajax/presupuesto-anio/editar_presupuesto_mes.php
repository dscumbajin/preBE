<?php

/*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/

include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/

/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de funcionesuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
// escaping, additionally removing everything that could be (html/javascript-) code

if (!empty($_POST['valorVenta']) && !empty($_POST['valorPromo']) && !empty($_POST['valorGaran']) && !empty($_POST['valorTotal'])) {
    //Actualizar
    $idPresAnio = intval($_POST['idPresAnio']);
    $valorVenta = intval($_POST['valorVenta']);
    $valorPromo = intval($_POST['valorPromo']);
    $valorGaran = intval($_POST['valorGaran']);
    $valorTotal = intval($_POST['valorTotal']);
    $sql = "UPDATE presupuesto_anio SET ventasPresU='" . $valorVenta . "', promoPresU='" . $valorPromo . "', garantPresU='" . $valorGaran . "', totalPresU='" . $valorTotal . "' WHERE idPresAnio='" . $idPresAnio . "'";
    $query_update = mysqli_query($con, $sql);
}


foreach ($_POST['idPresMes'] as $ids) {
    $porcentaje = floatval($_POST['porcentaje'][$ids]);
    $cantMesU = intval($_POST['cantMesU'][$ids]);
    $cantPromoU = intval($_POST['cantPromoU'][$ids]);
    $cantGarantU = intval($_POST['cantGarantU'][$ids]);
    $cantTotalU = intval($_POST['cantTotalU'][$ids]);
    $presMesV = floatval($_POST['presMesV'][$ids]);


    $actualizar = $con->query("UPDATE presupuesto_mes SET cantMesU='$cantMesU', cantPromoU='$cantPromoU', cantGarantU='$cantGarantU',
                                                        cantTotalU='$cantTotalU', presMesV='$presMesV', porcentaje='$porcentaje' WHERE idPresMes='$ids'");
}

if ($actualizar == true) {
    $messages[] = "Lista de presupuestos actualizada satisfactoriamente.";
} else {
    $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($con);
}


if (isset($errors)) {

?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
            echo $error;
        }
        ?>
    </div>
<?php
}
if (isset($messages)) {

?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
<?php
}

?>
<?php

include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST["idEliminarAnterior"])) {
    $errors[] = "Id Anterior pres vacio";
} else if (empty($_POST["delIdPres"])) {
    $errors[] = "Id Actual pres vacio";
} else if (empty($_POST["delVentas"])) {
    $errors[] = "Ventas vacio";
} else if (empty($_POST["delProm"])) {
    $errors[] = "Promociones vacio";
} else if (empty($_POST["delGran"])) {
    $errors[] = "Garantias vacio";
} else if (empty($_POST["delTotal"])) {
    $errors[] = "Total vacio";
} else if (
    !empty($_POST["idEliminarAnterior"]) &&
    !empty($_POST["delIdPres"]) &&
    !empty($_POST["delVentas"]) &&
    !empty($_POST["delProm"]) &&
    !empty($_POST["delGran"]) &&
    !empty($_POST["delTotal"])
) {

    /* Connect To Database*/
    require_once("../../funciones/db.php"); //Contiene las variables de funcionesuracion para conectar a la base de datos
    require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
    // escaping, additionally removing everything that could be (html/javascript-) code
    $idEliminarAnterior = intval($_POST["idEliminarAnterior"]);
    $delIdPres = intval($_POST["delIdPres"]); /* mysqli_real_escape_string($con, (strip_tags($_POST["delIdPres"], ENT_QUOTES))); */
    $delVentas = intval($_POST["delVentas"]);
    $delProm   = intval($_POST["delProm"]);
    $delGran   = intval($_POST["delGran"]);
    $delTotal  = intval($_POST["delTotal"]);
    $activoAnio = 0;

    echo "Actualizacion es curso";
    //Actualizar al nuevo vendedor
    $sql = "UPDATE presupuesto_anio SET ventasPresU='" . $delVentas . "', promoPresU='" . $delProm . "', garantPresU='" . $delGran . "', totalPresU='" . $delTotal . "' WHERE idPresAnio='" . $delIdPres . "'";
    $query_update = mysqli_query($con, $sql);
    if ($query_update) {
        // Actualizar estado del presupuesto anio anterior
        $sql2 = "UPDATE presupuesto_anio SET activoAnio='" . $activoAnio . "' WHERE idPresAnio='" . $idEliminarAnterior . "'";
        $query_update2 = mysqli_query($con, $sql2);
        if ($query_update2) {
            $messages[] = "Eliminado - ";
        } else {
            $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($con);
        }
        $messages[] = "Reasignacion de presupuesto satisfactoria";
    } else {
        $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($con);
    }
} else {
    $errors[] = "Error desconocido.";
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
<?php
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['codVenAnio'])) {
	$errors[] = "Código vendedor vacio";
}
elseif (empty($_POST['codLineaAnio'])) {
	$errors[] = "Código linea vacío";

} else if (!empty($_POST['codVenAnio']) && !empty($_POST['codLineaAnio'])) {
	/* Connect To Database*/
	require_once("../../funciones/db.php"); //Contiene las variables de funcionesuracion para conectar a la base de datos
	require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code

	//Buscar el Id del presupuesto del anio
	$codigoPresAnio;
	$venPreAnio =  mysqli_real_escape_string($con, (strip_tags($_POST["codVenAnio"], ENT_QUOTES)));
	$linPreAnio =  mysqli_real_escape_string($con, (strip_tags($_POST["codLineaAnio"], ENT_QUOTES)));
	$sqlAnio = "SELECT * FROM presupuesto_anio WHERE codVen = $venPreAnio AND codLinea = $linPreAnio ";
	$queryAnio = mysqli_query($con, $sqlAnio);
	while ($row = mysqli_fetch_array($queryAnio)) {
		$codigoPresAnio = $row['idPresAnio'];
	}
	echo $codigoPresAnio;

	/* $anioPre =  mysqli_real_escape_string($con, (strip_tags($_POST["anioHist"], ENT_QUOTES)));
	$codVenPre = mysqli_real_escape_string($con, (strip_tags($_POST["codVenHist"], ENT_QUOTES)));
	$codLineaPre = mysqli_real_escape_string($con, (strip_tags($_POST["codLineaHist"], ENT_QUOTES)));
	$vendidasPre = intval($_POST["vendidasNuevo"]);
	$promocionPre = intval($_POST["promocionNuevo"]);
	$garantiaPre = intval($_POST["garantiaNuevo"]);
	$totalPre = intval($_POST["totalAnio"]);

	$sql = "INSERT INTO presupuesto_anio (anio , ventasPresU, promoPresU, garantPresU, totalPresU, codVen, codLinea ) VALUES ('$anioPre','$vendidasPre','$promocionPre','$garantiaPre', '$totalPre', '$codVenPre', '$codLineaPre')";
	$query_new_insert = mysqli_query($con, $sql);
	if ($query_new_insert) {
		$messages[] = "Presupuesto anual ingresado satisfactoriamente.";
		$generado = 1;
		$sql = "UPDATE historial_ventas SET generado='" . $generado . "' WHERE codVen='" . $codVenPre . "' AND codLinea='" . $codLineaPre . "'";
		$query_update = mysqli_query($con, $sql);
	} else {
		$errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($con);
	}
} else {
	$errors[] = "Error desconocido.";
} */
/* 
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
} */

?>
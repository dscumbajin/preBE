<?php
 /*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['mod_id'])) {
	$errors[] = "ID vacío";
} else if (empty($_POST['mod_nombre'])) {
	$errors[] = "Nombre vacío";
}  else if ($_POST['mod_estado'] == "") {
	$errors[] = "Selecciona el estado del vendedor";
} else if (
	!empty($_POST['mod_id']) &&
	!empty($_POST['mod_nombre']) &&
	$_POST['mod_estado'] != ""
) {
	/* Connect To Database*/
	require_once("../../funciones/db.php"); //Contiene las variables de funcionesuracion para conectar a la base de datos
	require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
	$nombre = mysqli_real_escape_string($con, (strip_tags($_POST["mod_nombre"], ENT_QUOTES)));
	$estado = intval($_POST['mod_estado']);
	$id_vendedor = mysqli_real_escape_string($con, (strip_tags($_POST['mod_id'], ENT_QUOTES)));

	$sql = "UPDATE vendedor SET nomVen='" . $nombre . "', estadoVen='" . $estado . "' WHERE codVen='" . $id_vendedor . "'";
	$query_update = mysqli_query($con, $sql);
	if ($query_update) {
		$messages[] = "Vendedor ha sido actualizado satisfactoriamente.";
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
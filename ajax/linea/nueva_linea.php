<?php

 /*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
	
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['codigo'])) {
	$errors[] = "Código vacío";
}
elseif (empty($_POST['nombre'])) {
	$errors[] = "Nombre vacío";
} else if (!empty($_POST['codigo'])) {
	/* Connect To Database*/
	require_once("../../funciones/db.php"); //Contiene las variables de funcionesuracion para conectar a la base de datos
	require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code


	$codLinea = mysqli_real_escape_string($con, (strip_tags($_POST["codigo"], ENT_QUOTES)));
	$nomLinea = mysqli_real_escape_string($con, (strip_tags($_POST["nombre"], ENT_QUOTES)));
	$estadoLinea = intval($_POST['estado']);

	$sql = "INSERT INTO listalinea (codLinea , nomLinea, estadoLinea ) VALUES ('$codLinea','$nomLinea','$estadoLinea')";
	$query_new_insert = mysqli_query($con, $sql);
	if ($query_new_insert) {
		$messages[] = "Linea ingresada satisfactoriamente.";
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
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
} else if (empty($_POST['mod_usuario'])) {
	$errors[] = "Usuario vacío";
} else if (empty($_POST['mod_nombre'])) {
	$errors[] = "Nombre vacío";
} else if ($_POST['mod_perfil'] == "") {
	$errors[] = "Selecciona el perfil del Usuario";
} else if (
	!empty($_POST['mod_id']) &&
	!empty($_POST['mod_usuario']) &&
	!empty($_POST['mod_nombre']) &&
	$_POST['mod_perfil'] != ""
) {
	/* Connect To Database*/
	require_once("../../funciones/db.php"); //Contiene las variables de funcionesuracion para conectar a la base de datos
	require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code

	$opciones = array(
		'cost' => 12
	);

	$usuario = mysqli_real_escape_string($con, (strip_tags($_POST["mod_usuario"], ENT_QUOTES)));
	$nombre = mysqli_real_escape_string($con, (strip_tags($_POST["mod_nombre"], ENT_QUOTES)));
	$password = mysqli_real_escape_string($con, (strip_tags($_POST["mod_password"], ENT_QUOTES)));
	$email = mysqli_real_escape_string($con, (strip_tags($_POST["mod_email"], ENT_QUOTES)));
	$perfil = intval($_POST['mod_perfil']);
	$id_usuario = intval($_POST['mod_id']);

	if (empty($_POST['mod_password'])) {
		$sql = "UPDATE admins SET usuario='" . $usuario . "', nombreUsu='" . $nombre . "', mail='" . $email . "', idPerfil='" . $perfil . "' WHERE idUsu='" . $id_usuario . "'";
	} else {
		$password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
		$sql = "UPDATE admins SET usuario='" . $usuario . "', password='" . $password_hashed . "' , nombreUsu='" . $nombre . "', mail='" . $email . "', idPerfil='" . $perfil . "' WHERE idUsu='" . $id_usuario . "'";
	}
	$query_update = mysqli_query($con, $sql);
	if ($query_update) {
		$messages[] = "Usuario ha sido actualizado satisfactoriamente.";
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
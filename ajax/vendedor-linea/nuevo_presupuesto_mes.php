<?php
 /*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['codVenAnio'])) {
	$errors[] = "Código vendedor vacio";
} elseif (empty($_POST['codLineaAnio'])) {
	$errors[] = "Código linea vacío";
} else if (!empty($_POST['codVenAnio']) && !empty($_POST['codLineaAnio'])) {
	/* Connect To Database*/
	require_once("../../funciones/db.php"); //Contiene las variables de funcionesuracion para conectar a la base de datos
	require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code

	//Buscar el Id del presupuesto del anio
	$precioMeta = floatval($_POST["precioMeta"]);
	$venPreAnio =  mysqli_real_escape_string($con, (strip_tags($_POST["codVenAnio"], ENT_QUOTES)));
	$linPreAnio =  mysqli_real_escape_string($con, (strip_tags($_POST["codLineaAnio"], ENT_QUOTES)));
	$sqlAnio = "SELECT * FROM presupuesto_anio WHERE codVen = $venPreAnio AND codLinea = $linPreAnio ";
	$queryAnio = mysqli_query($con, $sqlAnio);
	while ($row = mysqli_fetch_array($queryAnio)) {
		$codigoPresAnio = $row['idPresAnio'];
	}


	$items1 = ($_POST['mes']);
	$items2 = ($_POST['ventasMes']);
	$items3 = ($_POST['promosMes']);
	$items4 = ($_POST['garantiaMes']);
	$items5 = ($_POST['totalMes']);
	$items6 = ($_POST['presMes']);
	$items7 = ($_POST['porcentaje']);

	///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
	while (true) {

		//// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
		$item1 = current($items1);
		$item2 = current($items2);
		$item3 = current($items3);
		$item4 = current($items4);
		$item5 = current($items5);
		$item6 = current($items6);
		$item7 = current($items7);

		////// ASIGNARLOS A VARIABLES ///////////////////
		$mes = (($item1 !== false) ? $item1 : ", &nbsp;");
		$ventasMes = (($item2 !== false) ? $item2 : ", &nbsp;");
		$promosMes = (($item3 !== false) ? $item3 : ", &nbsp;");
		$garantiaMes = (($item4 !== false) ? $item4 : ", &nbsp;");
		$totalMes = (($item5 !== false) ? $item5 : ", &nbsp;");
		$presMes = (($item6 !== false) ? $item6 : ", &nbsp;");
		$porcentaje = (($item7 !== false) ? $item7 : ", &nbsp;");
		//// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
		$valores = '(' . $codigoPresAnio . ',"' . $mes . '",' . $ventasMes . ',' . $promosMes . ',' . $garantiaMes . ',' . $totalMes . ',' . $presMes . ' ,' . $porcentaje . '),';

		//////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
		$valoresQ = substr($valores, 0, -1);

		///////// QUERY DE INSERCIÓN ////////////////////////////
		$sql = "INSERT INTO presupuesto_mes (idPresAnio, mes, cantMesU, cantPromoU, cantGarantU, cantTotalU, presMesV, porcentaje) 
					VALUES $valoresQ";

		$sqlRes = $con->query($sql);


		// Up! Next Value
		$item1 = next($items1);
		$item2 = next($items2);
		$item3 = next($items3);
		$item4 = next($items4);
		$item5 = next($items5);
		$item6 = next($items6);
		$item7 = next($items7);

		// Check terminator
		if ($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false) break;
	}

	if ($sqlRes) {
		$messages[] = "Presupuesto mensual ingresado satisfactoriamente.";
		//Actualizar la meta en la tabla presupuesto_anio
		$sql = "UPDATE presupuesto_anio SET precioMeta='" . $precioMeta . "' WHERE idPresAnio='" . $codigoPresAnio . "'";
		$query_update = mysqli_query($con, $sql);
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
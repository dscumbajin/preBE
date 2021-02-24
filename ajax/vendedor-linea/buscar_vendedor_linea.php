<?php

include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id'])) {
	$id_vendedor = $_GET['id'];

	if ($delete1 = mysqli_query($con, "DELETE FROM vendedor WHERE codVen='" . $id_vendedor . "'")) {
?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Aviso!</strong> Datos eliminados exitosamente.
		</div>
	<?php
	} else {
	?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
		</div>
	<?php

	}
}

if ($action == 'ajax') {
	// escaping, additionally removing everything that could be (html/javascript-) code
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$codLinea = mysqli_real_escape_string($con, (strip_tags($_REQUEST['codLinea'], ENT_QUOTES)));
	$aColumns = array('historial_ventas.anio', 'vendedor.nomVen', 'historial_ventas.codVen', 'ventasU'); //Columnas de busqueda
	$sTable = "historial_ventas, vendedor";
	$sWhere = "WHERE historial_ventas.codVen = vendedor.codVen AND historial_ventas.generado != 1
	AND historial_ventas.codLinea = $codLinea ";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE historial_ventas.codVen = vendedor.codVen AND historial_ventas.generado != 1
		AND historial_ventas.codLinea = $codLinea AND (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	$sWhere .= " order by ventasU DESC ";

	include '../pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = 10; //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
	$row = mysqli_fetch_array($count_query);
	$numrows = $row['numrows'];
	$total_pages = ceil($numrows / $per_page);
	$reload = '../../lista-vendedor-linea.php';
	//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data
	if ($numrows > 0) {

	?>
		<div class="table-responsive">
			<table id="registros" class="table table-bordered table-striped">
				<tr class="info">

					<th>Vendedor</th>
					<th>Año</th>
					<th>Unidades Vendidas</th>
					<th>Unidades Promociones</th>
					<th>Unidades Garantía</th>
					<th>Ventas</th>
					<th>Acciones</th>

				</tr>
				<?php
				while ($row = mysqli_fetch_array($query)) {

					$id_historial = $row['idHisVen'];
					$cod_vendedor = $row['codVen'];
					$cod_linea = $row['codLinea'];
					$nombre_vendedor = $row['nomVen'];
					$anio_historial = $row['anio'];
					$vendidas_histroial = $row['ventasU'];
					$promocion_historial = $row['promocionU'];
					$garantia_historial = $row['garantiaU'];
					$facturado_historial = $row['facturadoV'];
				?>

					<input type="hidden" value="<?php echo $cod_vendedor; ?>" id="cod_vendedor<?php echo $id_historial; ?>">
					<input type="hidden" value="<?php echo $cod_linea; ?>" id="cod_linea<?php echo $id_historial; ?>">
					<input type="hidden" value="<?php echo $nombre_vendedor; ?>" id="nombre_vendedor<?php echo $id_historial; ?>">
					<input type="hidden" value="<?php echo $anio_historial; ?>" id="anio_historial<?php echo $id_historial; ?>">
					<input type="hidden" value="<?php echo $vendidas_histroial; ?>" id="vendidas_histroial<?php echo $id_historial; ?>">
					<input type="hidden" value="<?php echo $promocion_historial; ?>" id="promocion_historial<?php echo $id_historial; ?>">
					<input type="hidden" value="<?php echo $garantia_historial; ?>" id="garantia_historial<?php echo $id_historial; ?>">
					<input type="hidden" value="<?php echo $facturado_historial; ?>" id="facturado_historial<?php echo $id_historial; ?>">

					<tr id="registro<?php echo $id_historial ?>">

						<td><?php echo $nombre_vendedor; ?></td>
						<td><?php echo $anio_historial; ?></td>
						<td><?php echo $vendidas_histroial; ?></td>
						<td><?php echo $promocion_historial; ?></td>
						<td><?php echo $garantia_historial; ?></td>
						<td><i class="fas fa-dollar-sign"> <?php echo $facturado_historial; ?></td>
						<td><span>
								<a class="btn btn-outline-secondary" href="#" title='Crear presupuesto año' onclick="obtener_datos('<?php echo $id_historial; ?>');" data-toggle="modal" data-target="#nuevoPresupuestoAnio"><i class="fas fa-plus-circle"></i>Crear presupuesto</a>
							</span>
						</td>

					</tr>
				<?php
				}
				?>

			</table>
			<div class="paginacion">

				<?php
				echo paginate($reload, $page, $total_pages, $adjacents);
				?>

			</div>
		</div>
	<?php
	} else { ?>

		<?php if ($_GET['q'] != "") {
		?>
			<div class="alert alert-danger text-center" role="alert">
				No existe un Histroial de ventas filtrados con el dato: <?php echo $_GET['q']; ?>
			</div>
<?php
		}
	}
}
?>
<script>
	function crearCookie(nombre, valor, dias) {
		var expira;
		if (dias) {
			var date = new Date();
			date.setTime(date.getTime() + (dias * 24 * 60 * 60 * 1000));
			expira = "; expires=" + date.toGMTString();
		} else {
			expira = "";
		}
		document.cookie = escape(nombre) + "=" + escape(valor) + expira + "; path=/";
	}
</script>
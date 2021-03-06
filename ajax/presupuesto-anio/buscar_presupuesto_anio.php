<?php
 /*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/

include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
	// escaping, additionally removing everything that could be (html/javascript-) code
	// idUsu, usuario, nombreUsu, password, mail, idPerfil
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$aColumns = array('anio', 'nomVen', 'nomLinea'); //Columnas de busqueda
	$sTable = "presupuesto_anio, vendedor, listalinea";
	$sWhere = " WHERE presupuesto_anio.codVen = vendedor.codVen 
	AND vendedor.estadoVen != 0 
	AND presupuesto_anio.activoAnio = 1 
	AND presupuesto_anio.codLinea = listalinea.codLinea";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE presupuesto_anio.codVen = vendedor.codVen 
		AND vendedor.estadoVen != 0
		AND presupuesto_anio.activoAnio = 1 
		AND presupuesto_anio.codLinea = listalinea.codLinea AND (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	$sWhere .= " ORDER BY idPresAnio DESC ";
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
	$reload = '../../lista-presupuesto-anio.php';
	//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data
	if ($numrows > 0) {

?>
		<div class="table-responsive">
			<table id="registros" class="table table-bordered table-striped ">
				<thead>
					<tr class="info">
						<th>Año</th>
						<th>Vendedor</th>
						<th>Linea</th>
						<th>Presupuesto Ventas</th>
						<th>Cantidad Promociones</th>
						<th>Cantidad Garantía</th>
						<th>Cantidad Total</th>
						<th>Acciones</th>

					</tr>
				</thead>
				<tbody>
					<?php
					while ($row = mysqli_fetch_array($query)) {
						$id_presupuesto = $row['idPresAnio'];
						$anio_presupuesto = $row['anio'];
						$id_linea = $row['codLinea'];
						$id_vendedor = $row['codVen'];
						$vendedor_presupuesto = $row['nomVen'];
						$linea_presupuesto = $row['nomLinea'];
						$cantidad_ventas_presupuesto = $row['ventasPresU'];
						$cantidad_promos_presupuesto = $row['promoPresU'];
						$cantidad_garantia_presupuesto = $row['garantPresU'];
						$cantidad_total_presupuesto = $row['totalPresU'];
						$precioMeta = $row['precioMeta'];
					?>

						<input type="hidden" value="<?php echo $anio_presupuesto; ?>" id="anio_presupuesto<?php echo $id_presupuesto; ?>">
						<input type="hidden" value="<?php echo $vendedor_presupuesto; ?>" id="vendedor_presupuesto<?php echo $id_presupuesto; ?>">
						<input type="hidden" value="<?php echo $cantidad_ventas_presupuesto; ?>" id="cantidad_ventas_presupuesto<?php echo $id_presupuesto; ?>">
						<input type="hidden" value="<?php echo $cantidad_promos_presupuesto; ?>" id="cantidad_promos_presupuesto<?php echo $id_presupuesto; ?>">
						<input type="hidden" value="<?php echo $cantidad_garantia_presupuesto; ?>" id="cantidad_garantia_presupuesto<?php echo $id_presupuesto; ?>">
						<input type="hidden" value="<?php echo $cantidad_total_presupuesto; ?>" id="cantidad_total_presupuesto<?php echo $id_presupuesto; ?>">
						<input type="hidden" value="<?php echo $linea_presupuesto; ?>" id="linea_presupuesto<?php echo $id_presupuesto; ?>">
						<input type="hidden" value="<?php echo $precioMeta; ?>" id="precioMeta<?php echo $id_presupuesto; ?>">
						<input type="hidden" value="<?php echo $id_linea; ?>" id="id_linea<?php echo $id_presupuesto; ?>">

						<tr>
							<td><?php echo $anio_presupuesto; ?></td>
							<td class="nomover"><a  href="#" title='Detalle' onclick="detalle_presupuesto('<?php echo $id_vendedor; ?>', '<?php echo $id_presupuesto; ?>');" data-toggle="modal" data-target="#detallePresupuesto"><?php echo $vendedor_presupuesto; ?> </a></td>
							<td><?php echo $linea_presupuesto; ?></td>
							<td><?php echo $cantidad_ventas_presupuesto; ?></td>
							<td><?php echo $cantidad_promos_presupuesto; ?></td>
							<td><?php echo $cantidad_garantia_presupuesto; ?></td>
							<td><?php echo $cantidad_total_presupuesto; ?></td>
							<td><span>
									<a href="#" title='Editar presupuesto' onclick="buscar_datos_mes('<?php echo $id_presupuesto; ?>');" data-toggle="modal" data-target="#modPresupuestoAnio"><i class="fas fa-pen editar"></i></a>
									<?php if ($_SESSION['user_nivel'] == 2) : ?>
										<a href="#" id="crearCookie" title='Borrar presupuesto' onclick="eliminar('<?php echo $id_presupuesto; ?>')"data-toggle="modal" data-target="#deletePresupuestoAnio"><i class="far fa-trash-alt eliminar"></i></a>
									<?php endif; ?>
								</span>
							</td>

						</tr>

					<?php
					}
					?>
				</tbody>
			</table>
			<div class="paginacion">

				<?php
				echo paginate($reload, $page, $total_pages, $adjacents);
				?>

			</div>
		</div>
		<?php
	} else {
		if ($_GET['q'] != "") {
		?>
			<div class="alert alert-danger text-center" role="alert">
				No existen presupuestos filtrados con el dato: <?php echo $_GET['q']; ?>
			</div>
<?php
		}
	}
}
?>

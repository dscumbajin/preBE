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
	// idUsu, vendedor, nombreUsu, password, mail, idestado
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$aColumns = array('codVen', 'nomVen'); //Columnas de busqueda
	$sTable = "vendedor, segmento";
	$sWhere = "WHERE vendedor.codSeg = segmento.codSeg";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE vendedor.codSeg = segmento.codSeg AND (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	$sWhere .= " order by nomVen";
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
	$reload = '../../lista-vendedor.php';
	//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data
	if ($numrows > 0) {

	?>
		<div class="table-responsive">
			<table id="registros" class="table table-bordered table-striped">
				<tr class="info">

					<th>Código</th>
					<th>Nombre</th>
					<th>Estado</th>
					<th>Segemento</th>
					<th>Acciones</th>

				</tr>
				<?php
				while ($row = mysqli_fetch_array($query)) {

					$id_vendedor = $row['codVen'];
					$nombre_vendedor = $row['nomVen'];
					$estado_vendedor = $row['estadoVen'];
					$segemento_vendedor = $row['desSeg'];
					$codigo_segmento = $row['codSeg'];
					if ($estado_vendedor == 1) {
						$estado = '<h6><span class="badge badge-primary">Activo</span></h6>';
					} else {
						$estado = '<h6><span class="badge badge-danger">Inactivo</span></h6>';
					}
				?>

					<input type="hidden" value="<?php echo $nombre_vendedor; ?>" id="nombre_vendedor<?php echo $id_vendedor; ?>">
					<input type="hidden" value="<?php echo $estado_vendedor; ?>" id="estado_vendedor<?php echo $id_vendedor; ?>">
					<input type="hidden" value="<?php echo $codigo_segmento; ?>" id="segmento_vendedor<?php echo $id_vendedor; ?>">
					<tr>
						<td><?php echo $id_vendedor; ?></td>
						<td><a href="#" title='Detalle' onclick="detalle_presupuesto('<?php echo $id_vendedor; ?>');" data-toggle="modal" data-target="#detallePresupuesto"> <?php echo $nombre_vendedor; ?></a></td>
						<td><?php echo $estado; ?></td>
						<td><?php echo $segemento_vendedor; ?></td>
						<td><span>
								<a href="#" title='Editar vendedor' onclick="obtener_datos('<?php echo $id_vendedor; ?>');" data-toggle="modal" data-target="#modVendedor"><i class="fas fa-pen editar"></i></a>
								<?php if ($_SESSION['user_nivel'] == 2) : ?>
								<a href="#" title='Borrar vendedor' onclick="eliminar('<?php echo $id_vendedor; ?>')"> <i class="far fa-trash-alt eliminar"></i></a>
								<?php endif; ?>
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
	} else {
		if ($_GET['q'] != "") {
		?>
			<div class="alert alert-danger text-center" role="alert">
				No existen vendedores filtrados con el dato: <?php echo $_GET['q']; ?>
			</div>
<?php
		}
	}
}
?>

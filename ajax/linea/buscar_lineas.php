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
	$aColumns = array('codLinea', 'nomLinea'); //Columnas de busqueda
	$sTable = "listalinea";
	$sWhere = "";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	$sWhere .= " order by   estadoLinea DESC";
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
	$reload = '../../lista-linea.php';
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
					<th>Acciones</th>

				</tr>
				<?php
				while ($row = mysqli_fetch_array($query)) {

					$id_linea = $row['codLinea'];
					$nombre_linea = $row['nomLinea'];
					$estado_linea = $row['estadoLinea'];
					if ($estado_linea == 1) {
						$estado = '<h6><span class="badge badge-primary">Activo</span></h6>';
					} else {
						$estado = '<h6><span class="badge badge-danger">Inactivo</span></h6>';
					}
				?>

					<input type="hidden" value="<?php echo $nombre_linea; ?>" id="nombre_linea<?php echo $id_linea; ?>">
					<input type="hidden" value="<?php echo $estado_linea; ?>" id="estado_linea<?php echo $id_linea; ?>">
					<tr>
						<td><?php echo $id_linea; ?></td>
						<td><?php echo $nombre_linea; ?></td>
						<td><?php echo $estado; ?></td>
						<td><span>
								<a href="#" title='Editar linea' onclick="obtener_datos('<?php echo $id_linea; ?>');" data-toggle="modal" data-target="#modLinea"><i class="fas fa-pen editar"></i></a>
								<?php if ($_SESSION['user_nivel'] == 2) : ?>
									<a href="#" title='Borrar linea' onclick="eliminar('<?php echo $id_linea; ?>')"> <i class="far fa-trash-alt eliminar"></i></a>
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
				No existen lineas de negocio filtrados con el dato: <?php echo $_GET['q']; ?>
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
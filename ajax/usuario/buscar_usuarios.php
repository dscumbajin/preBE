<?php

include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id'])) {
	$id_admin = $_GET['id'];

	if ($delete1 = mysqli_query($con, "DELETE FROM admins WHERE idUsu='" . $id_admin . "'")) {
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
	// idUsu, usuario, nombreUsu, password, mail, idPerfil
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$aColumns = array('usuario', 'nombreUsu'); //Columnas de busqueda
	$sTable = "admins";
	$sWhere = "";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	$sWhere .= " order by usuario";
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
	$reload = '../../usuarios.php';
	//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data
	if ($numrows > 0) {

	?>
		<div class="table-responsive">
			<table id="registros" class="table table-bordered table-striped">
				<tr class="info">

					<th>Usuario</th>
					<th>Nombre</th>
					<th>Email</th>
					<th>Perfil</th>
					<th>Acciones</th>

				</tr>
				<?php
				while ($row = mysqli_fetch_array($query)) {
					// idUsu, usuario, nombreUsu, password, mail, idPerfil
					$id_usuario = $row['idUsu'];
					$password_usuario = $row['password'];
					$usuario_usuario = $row['usuario'];
					$nombre_usuario = $row['nombreUsu'];
					$email_usuario = $row['mail'];
					$perfil_usuario = $row['idPerfil'];
					if ($perfil_usuario == 1) {
						$perfil = '<h6><span class="badge badge-primary">User</span></h6>';
					} else {
						$perfil = '<h6><span class="badge badge-success">Administrador</span></h6>';
					}
				?>

					<input type="hidden" value="<?php echo $usuario_usuario; ?>" id="usuario_usuario<?php echo $id_usuario; ?>">
					<input type="hidden" value="<?php echo $nombre_usuario; ?>" id="nombre_usuario<?php echo $id_usuario; ?>">
					<input type="hidden" value="<?php echo $email_usuario; ?>" id="email_usuario<?php echo $id_usuario; ?>">
					<input type="hidden" value="<?php echo $perfil_usuario; ?>" id="perfil_usuario<?php echo $id_usuario; ?>">
					<input type="hidden" value="<?php echo $password_usuario; ?>" id="password_usuario<?php echo $id_usuario; ?>">

					<tr>
						<td><?php echo $usuario_usuario; ?></td>
						<td><?php echo $nombre_usuario; ?></td>
						<td><?php echo $email_usuario; ?></td>
						<td><?php echo $perfil; ?></td>
						<td><span>
								<a href="#" title='Editar usuario' onclick="obtener_datos('<?php echo $id_usuario; ?>');" data-toggle="modal" data-target="#modUsuario"><i class="fas fa-pen editar"></i></a>
								<a href="#" title='Borrar usuario' onclick="eliminar('<?php echo $id_usuario; ?>')"> <i class="far fa-trash-alt eliminar"></i></a>
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
				No existen usuarios filtrados con el dato: <?php echo $_GET['q']; ?>
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
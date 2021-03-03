<?php

include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos


$codLinea= mysqli_real_escape_string($con, (strip_tags($_REQUEST['codLinea'], ENT_QUOTES)));
$anio= mysqli_real_escape_string($con, (strip_tags($_REQUEST['anio'], ENT_QUOTES)));
$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['txtBusqueda'], ENT_QUOTES)));
?>
<div class="table-responsive">
	<table id="registros" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Año</th>
				<th>Vendedor</th>
				<th>Linea</th>
				<th>Cantidad Año</th>
				<th>Cantidad Promos</th>
				<th>Cantidad Garantía</th>
				<th>Cantidad Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
			try {
				$sql = " SELECT * FROM presupuesto_anio, vendedor, listalinea ";
				$sql .= " WHERE presupuesto_anio.codVen = vendedor.codVen ";
				$sql .= " AND presupuesto_anio.codLinea = listalinea.codLinea ";
				$sql .= " AND presupuesto_anio.codLinea = '$codLinea' ";
				$sql .= " AND anio = $anio ";
				$sql .= " AND nomVen LIKE '%$q%' ";
				$resultado = $con->query($sql);
				echo $sql;
			} catch (Exception $e) {
				$error = $e->getMessage();
				echo $error;
			}
			while ($row = $resultado->fetch_assoc()) {
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
				<tr>

					<td><?php echo $anio_presupuesto; ?></td>
					<td><a href="#" title='Detalle' onclick="detalle_presupuesto('<?php echo $id_vendedor; ?>', '<?php echo $id_presupuesto; ?>');" data-toggle="modal" data-target="#detallePresupuesto"><?php echo $vendedor_presupuesto; ?> </a< /td>
					<td><?php echo $linea_presupuesto; ?></td>
					<td><?php echo $cantidad_ventas_presupuesto; ?></td>
					<td><?php echo $cantidad_promos_presupuesto; ?></td>
					<td><?php echo $cantidad_garantia_presupuesto; ?></td>
					<td><?php echo $cantidad_total_presupuesto; ?></td>

				</tr>
			<?php } ?>
		</tbody>

	</table>
</div>
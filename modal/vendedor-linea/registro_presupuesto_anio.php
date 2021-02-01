	<?php
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="nuevoPresupuestoAnio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Crear presupuesto año</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="guardar_vendedor" name="guardar_vendedor">
							<div id="resultados_ajax"></div>


							

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	<?php
	}
	?>
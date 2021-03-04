	<?php
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="nuevoSegmento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" style="font-weight: bold;">Agregar Segmento</h4>
							<button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="guardar_segmento" name="guardar_segmento">
							<div id="resultados_ajax"></div>

							<div class="form-group row">
								<label for="segmento" class="col-sm-3 control-label">Segmento</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="segmento" name="segmento" required>
								</div>
							</div>

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
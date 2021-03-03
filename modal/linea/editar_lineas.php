	<?php
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="modLinea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar vendedor</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="editar_linea" name="editar_linea">
							<div id="resultados_ajax2"></div>
						
							<div class="form-group">
								<label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="mod_nombre" name="mod_nombre" required>
									<input type="hidden" name="mod_id" id="mod_id">
								</div>
							</div>

							<div class="form-group">
								<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
								<div class="col-sm-8">
									<select class="form-control seleccionar select2-primary" id="mod_estado" name="mod_estado" required>
										<option value=""selected>-- Selecciona estado --</option>
										<option value="1">Activo</option>
										<option value="0">Inactivo</option>
									</select>
								</div>
							</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	<?php
	}
	?>
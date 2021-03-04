	<?php
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="nuevaLinea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" style="font-weight: bold;">Agregar Linea Negocio</h4>
							<button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="guardar_linea" name="guardar_linea">
							<div id="resultados_ajax"></div>


							<div class="form-group row">
								<label for="codigo" class="col-sm-3 control-label">Código</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="codigo" name="codigo" required>
								</div>
							</div>

							<div class="form-group row">
								<label for="nombre" class="col-sm-3 control-label">Nombre</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="nombre" name="nombre" required>
								</div>
							</div>

							<div class="form-group row">
								<label for="estado" class="col-sm-3 control-label">Estado</label>
								<div class="col-sm-9">
									<select class="form-control seleccionar select2-primary" id="estado" name="estado" required>
										<option value="">-- Selecciona estado --</option>
										<option value="1" selected>Activo</option>
										<option value="0">Inactivo</option>
									</select>
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
	<?php
	 /*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="modVendedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" style="font-weight: bold;">Editar Vendedor</h4>
							<button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="editar_vendedor" name="editar_vendedor">
							<div id="resultados_ajax2"></div>

							<div class="form-group row">
								<label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="mod_nombre" name="mod_nombre" required>
									<input type="hidden" name="mod_id" id="mod_id">
								</div>
							</div>

							<div class="form-group row">
								<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
								<div class="col-sm-9">
									<select class="form-control seleccionar select2-primary" id="mod_estado" name="mod_estado" required>
										<option value="" selected>-- Selecciona estado --</option>
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
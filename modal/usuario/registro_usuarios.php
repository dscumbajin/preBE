	<?php
	 /*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="nuevoUsuario">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" style="font-weight: bold;">Agregar Usuario</h4>
							<button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
							<div id="resultados_ajax"></div>

							<div class="form-group row">
								<label for="nombre" class="col-sm-3 control-label">Nombre</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="nombre" name="nombre" required>
								</div>
							</div>

							<div class="form-group row">
								<label for="usuario" class="col-sm-3 control-label">Usuario</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="usuario" name="usuario" required>
								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-sm-3 control-label">Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="password" name="password" required>
								</div>
							</div>

							<div class="form-group row">
								<label for="email" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" id="email" name="email">

								</div>
							</div>


							<div class="form-group row">
								<label for="perfil" class="col-sm-3 control-label">Perfil</label>
								<div class="col-sm-9">
									<select class="form-control seleccionar select2-primary" id="perfil" name="perfil" required>
										<option value="">-- Selecciona estado --</option>
										<option value="1" selected>User</option>
										<option value="2">Administrador</option>
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
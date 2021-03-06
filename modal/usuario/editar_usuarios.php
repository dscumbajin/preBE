	<?php
	 /*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="modUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" style="font-weight: bold;">Editar Usuario</h4>
							<button type="button" id="closeEditUsuario" class="close btn-danger" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
							<div id="resultados_ajax2"></div>

							<div class="form-group row">
								<label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="mod_nombre" name="mod_nombre" required>

								</div>
							</div>

							<div class="form-group row">
								<label for="mod_usuario" class="col-sm-3 control-label">Usuario</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="mod_usuario" name="mod_usuario" required>
									<input type="hidden" name="mod_id" id="mod_id">
								</div>
							</div>

							<div class="form-group row">
								<label for="mod_email" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" id="mod_email" name="mod_email">
								</div>
							</div>

							<div class="form-group row">
								<label for="mod_perfil" class="col-sm-3 control-label">Perfil</label>
								<div class="col-sm-9">
									<select class="form-control" id="mod_perfil" name="mod_perfil" required>
										<option value="">-- Selecciona estado --</option>
										<option value="1" selected>User</option>
										<option value="2">Administrador</option>
									</select>
								</div>
							</div>

							<section id="cambio_pass">
								<div class="form-group row">
									<label for="mod_password" class="col-sm-3 control-label">Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" id="mod_password" name="mod_password">
									</div>
								</div>
								<div class="form-group row">
									<label for="mod_password_very" class="col-sm-3 control-label">Verificar Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" id="mod_password_very" name="mod_password_very">
									</div>
								</div>
								<span id="resultado_password" style="font-weight: bold;"></span>
							</section>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" id="btn_cambio_pass">Cambiar Password</button>
						<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	<?php
	}
	?>

	<script>
	
	</script>
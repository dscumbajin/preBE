	<?php
	if (isset($con)) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="modVendedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar vendedor</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="editar_vendedor" name="editar_vendedor">
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
										<option value="">-- Selecciona estado --</option>
										<option value="1" selected>Activo</option>
										<option value="0">Inactivo</option>
									</select>
								</div>
							</div>

							<!-- <div class="form-group">
								<label for="mod_segmento" class="col-sm-3 control-label">Segmento</label>
								<div class="col-sm-8">
									<select class="form-control seleccionar select2-primary" id="mod_segmento" name="mod_segmento" required>
										<?php
										/* try {
											$sql = " SELECT * FROM segmento";

											$resultado = $con->query($sql);
											while ($segmento = $resultado->fetch_assoc()) { ?>
												<option value="<?php echo $segmento['codSeg']; ?>">
													<?php echo $segmento['codSeg'] . " - " . $segmento['desSeg']; ?></option>
										<?php }
										} catch (Exception $e) {
											echo "Error: " . $e->getMessage();
										} */
										?>
									</select>
								</div>
							</div> -->

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
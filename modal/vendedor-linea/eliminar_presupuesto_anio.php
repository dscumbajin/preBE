	<?php
	if (isset($con)) {
	?>
		<div class="modal fade" id="deletePresupuestoAnio">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"> <span style="font-weight: bold;" id="tituloEliminacion"></span></h4>
						<button type="button" id="closeDelete" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<div class="card card-dark">
							<div class="card-header">
								<h3 class="card-title">Datos Actuales</h3>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>

								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body" style="display: block;">
								<div class="row form-group">
									<input type="hidden" name="anio" id="anio">
									<input type="hidden" name="codLinea" id="codLinea">
									<div class="col-sm-3">
										<label>Presupuesto Ventas</label>
										<input type="text" class="form-control numero" name="delete_ventas_presupuesto" id="delete_ventas_presupuesto" required>
									</div>
									<!-- /.form-group -->
									<div class="col-sm-3">
										<label>Promociones</label>
										<input type="text" class="form-control numero" name="delete_promos_presupuesto" id="delete_promos_presupuesto" required>
									</div>
									<div class="col-sm-3">
										<label>Garantias</label>
										<input type="text" class="form-control numero" name="delete_garantia_presupuesto" id="delete_garantia_presupuesto" required>
									</div>
									<!-- /.form-group -->
									<div class="col-sm-3">
										<label>TOTAL</label>
										<input type="text" class="form-control numero" name="delete_total_presupuesto" id="delete_total_presupuesto" required>
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.row -->
							</div>
						</div>

						<div class="card card-dark">
							<div class="card-header">

								<div class="form-horizontal row">
									<!--Formulario de busqueda-->
									<div class="col-md-3" style="text-align: center;">
										<samp style="font-weight: bold;">Reasignar presupuesto</samp>
									</div>

									<a class="linea"><span>|</span></a>

									<label for="txtBusqueda" class="col-md-2 control-label">Vendedor</label>

									<div class="col-md-5">

										<select class="form-control seleccionar select2-primary" id="txtBusqueda" name="txtBusqueda" required>
											<option value="0" selected>Seleccionar vendedor</option>
											<?php
											try {
												$sql = " SELECT * FROM vendedor WHERE estadoVen = 1";

												$resultado = $con->query($sql);
												while ($vendedor = $resultado->fetch_assoc()) { ?>
													<option value="<?php echo $vendedor['nomVen']; ?>">
														<?php echo $vendedor['nomVen']; ?></option>
											<?php }
											} catch (Exception $e) {
												echo "Error: " . $e->getMessage();
											}
											?>
										</select>
									</div>
									<div class="col-md-1 ">
										<span><i class="fas fa-search"></i></span></button>
										<span id="loader"></span>

									</div>
								</div>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body" style="display: block;">

								<section id="tabla_resultados_delete"></section>
							</div>
						</div>

					</div>
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	<?php
	}
	?>

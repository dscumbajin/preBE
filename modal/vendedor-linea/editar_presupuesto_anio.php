	<?php
	/*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
	if (isset($con)) {
	?>
		<div class="modal fade" id="modPresupuestoAnio">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"> <span style="font-weight: bold;" id="vendedor-linea"></span></h4>
						<button type="button" id="close" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
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
								<div class="row">

									<div class="col-sm-3">
										<label>Presupuesto Ventas</label>
										<input type="text" class="form-control numero" name="mod_ventas_presupuesto" id="mod_ventas_presupuesto" pattern="^[0-9]+(.[0-9]+)?$" required>
									</div>
									<!-- /.form-group -->
									<div class="col-sm-3">
										<label>Promociones</label>
										<input type="text" class="form-control numero" name="mod_promos_presupuesto" id="mod_promos_presupuesto" pattern="^[0-9]+(.[0-9]+)?$" required>
									</div>
									<!-- /.form-group -->

									<div class="col-sm-3">
										<label>Garantias</label>
										<input type="text" class="form-control numero" name="mod_garantia_presupuesto" id="mod_garantia_presupuesto" pattern="^[0-9]+(.[0-9]+)?$" required>
									</div>
									<!-- /.form-group -->
									<div class="col-sm-2">
										<label>TOTAL</label>
										<input type="text" class="form-control numero" name="mod_total_presupuesto" id="mod_total_presupuesto" pattern="^[0-9]+(.[0-9]+)?$" required>
									</div>
									<!-- /.form-group -->

									<div class="col-sm-1">
										<label id="actualizar_cantidades"><i id="icono_bloc" class="fas fa-lock eliminar"></i></label>
										<!-- <a title="Actualizar cantidades" href="#" id="actualizar_cantidades"><i id="icono_bloc" class="fas fa-lock eliminar"></i></a> -->
										<input type="text" class="form-control" id="incremento_edicion" >
									</div>

									<input type="hidden" name="mod_precioMeta" id="mod_precioMeta">
								</div>
								
								<!-- /.row -->
							</div>

						</div>

						<div class="card card-dark">
							<div class="card-header">


								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>

								<div class="col-sm-4">
									Porcentaje asignado: <span class="btn" style="font-weight: bold; color: white;" id="porAs">100</span> %
								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body" style="display: block;">

								<section id="tabla_resultados"> </section>
							</div>
						</div>

					</div>
					<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button -->
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	<?php
	}
	?>
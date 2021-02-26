	<?php
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


						<div class="card-body">

							<div class="form-group row" id="total_anio">
								<div class="col-sm-3">
									<span style="font-weight: bold;">Ventas</span>
									<input type="text" class="form-control numero" name="mod_ventas_presupuesto" id="mod_ventas_presupuesto" pattern="^[0-9]+(.[0-9]+)?$" required>
								</div>
								<div class="col-sm-3">
									<span style="font-weight: bold;">Promociones</span>
									<input type="text" class="form-control numero" name="mod_promos_presupuesto" id="mod_promos_presupuesto" pattern="^[0-9]+(.[0-9]+)?$" required>
								</div>
								<div class="col-sm-3">
									<span style="font-weight: bold;">Garantias</span>
									<input type="text" class="form-control numero" name="mod_garantia_presupuesto" id="mod_garantia_presupuesto" pattern="^[0-9]+(.[0-9]+)?$" required>
								</div>
								<div class="col-sm-3">
									<span style="font-weight: bold;">Presupuesto + Promos + Garantias</span>
									<input type="text" class="form-control numero" name="mod_total_presupuesto" id="mod_total_presupuesto" pattern="^[0-9]+(.[0-9]+)?$" required>
								</div>
								<input type="hidden" name="mod_precioMeta" id="mod_precioMeta">
							</div>
						</div>

						<hr>
						<span id="porAs">Porcentaje asignado</span>
						<hr>
						<section id="tabla_resultados">

						</section>

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
	<?php
	 /*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
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
									<input type="hidden" id="idBorrar" name="idBorrar" />
									<input type="hidden" name="anio" id="anio">
									<input type="hidden" name="codLinea" id="codLinea">
									<input type="hidden" name="nomVendedor" id="nomVendedor">
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
								<div class="row float-right">
									<button class="btn btn-outline-warning " id="next_panel" type="button">Next</button>
								</div>
							</div>
						</div>

						<section id="select_resultados"></section>

					</div>

					<section id="tabla_resultados_delete"></section>
				</div>
			</div>

		</div>
	
	<?php
	}
	?>
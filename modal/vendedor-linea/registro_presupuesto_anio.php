	<?php
	if (isset($con)) {
	?>
	<!-- Modal -->
	<!-- <div class="modal fade" id="nuevoPresupuestoAnio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Crear presupuesto año</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="post" id="guardar_vendedor" name="guardar_vendedor">
							<div id="resultados_ajax"></div>


							

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
					</div>
					</form>
				</div>
			</div>
		</div> -->


	<div class="modal fade" id="nuevoPresupuestoAnio">
	    <div class="modal-dialog modal-xl">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title"> <span id="vendedor"></span></h4>
	                <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">

	                <form class="form-horizontal" method="post" id="guardar_pres_anio" name="guardar_pres_anio">
	                    <div class="card-body">
	                        <div class="form-group row">
	                            <label for="incremento_anio" class="col-sm-3 col-form-label">Porcentaje de incremento
	                                año</label>
	                            <div class="col-sm-6">
	                                <input type="int" class="form-control" id="incremento_anio" placeholder="Porcentaje" required>
									<input type="hidden" name="vendidas" id="vendidas">
									<input type="hidden" name="promocion" id="promocion">
									<input type="hidden" name="garantia" id="garantia">
	                            </div>
	                            <div class="col-sm-3">
	                                <button type="button" class="btn btn-dark" id="calcularAnio">Calcular</button>
	                            </div>
	                        </div>
	                        <hr>
	                        <!-- Resultados del calculo de presupuestos por año-->
	                        <div class="form-group row" id="total_anio">
	                            <div class="col-sm-3">
	                                <span>Ventas</span>
	                                <input type="text" class="form-control" id="vendidasNuevo" >
	                            </div>
	                            <div class="col-sm-3">
	                                <span>Promociones</span>
	                                <input type="text" class="form-control" id="promocionNuevo" >
	                            </div>
	                            <div class="col-sm-3">
	                                <span>Garantias</span>
	                                <input type="text" class="form-control" id="garantiaNuevo" >
	                            </div>
	                            <div class="col-sm-3">
	                                <span>Presupuesto +  Promos + Garantias</span>
	                                <input type="text" class="form-control" id="totalAnio" >
	                            </div>
	                        </div>
	                    </div>
	                    <!-- /.card-body -->
	                    <div class="card-footer">
	                        <button type="submit" class="btn btn-default float-right" id="guardar_datos">Guardar</button>
	                    </div>
	                    <!-- /.card-footer -->
	                </form>

	                <hr>
					<form id="formMes" class="form-horizontal">
	                    <div class="card-body">
	                        <div class="form-group row">
	                            <label for="incremento_anio" class="col-sm-3 col-form-label">Mensual</label>
	                     
	                            <div class="col-sm-3">
	                                <button type="button" class="btn btn-dark" id="calcularAnio">Calcular</button>
	                            </div>
	                        </div>
	                        <hr>

	                        <div class="form-group row" >
	                          
	                        </div>
	                    </div>
	                    <!-- /.card-body -->
	                    <div class="card-footer">
	                        <button type="submit" class="btn btn-default float-right">Guardar</button>
	                    </div>
	                    <!-- /.card-footer -->
	                </form>


	            </div>

	        </div>
	        <!-- /.modal-content -->
	    </div>
	    <!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<?php
	}
	?>
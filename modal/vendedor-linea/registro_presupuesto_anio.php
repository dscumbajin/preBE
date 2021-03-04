	<?php
	$codLinea = $_GET['codLinea'];
	if (isset($con)) {
	?>

		<div class="modal fade" id="nuevoPresupuestoAnio">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"> <span style="font-weight: bold;" id="vendedor"></span></h4>
						<button type="button" id="close" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">


						<div class="card card-dark">
							<div class="card-header">
								
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>

								</div>
								<div class="form-group row">
									<label for="incremento_anio" class="col-sm-3 col-form-label">Porcentaje de incremento
										año</label>
									<div class="col-sm-6">
										<input class="form-control decimales" id="incremento_anio" placeholder="Porcentaje" type="text" pattern="^[0-9]+(.[0-9]+)?$" required>
										<!-- Para calculo del presupuesto del año siguiente-->
										<input type="hidden" name="vendidas" id="vendidas">
										<input type="hidden" name="promocion" id="promocion">
										<input type="hidden" name="garantia" id="garantia">
										<input type="hidden" name="facturado" id="facturado">

									</div>
								<!-- 	<div class="col-sm-3">
										<button type="button" class="btn btn-dark" id="calcularAnio">Calcular</button>
									</div> -->
								</div>
							</div>
							<div class="card-body" style="display: block;">
								<form class="form-horizontal" method="post" id="guardar_pres_anio" name="guardar_pres_anio">
									<div id="resultados_ajax"></div>
									<div class="card-body">
										<!--Pra registro en la base de datos-->
										<input type="hidden" name="anioHist" id="anioHist">
										<input type="hidden" name="codVenHist" id="codVenHist">
										<input type="hidden" name="codLineaHist" id="codLineaHist">
										<!-- Resultados del calculo de presupuestos por año-->
										<div class="form-group row" id="total_anio">
											<div class="col-sm-3">
												<span>Ventas</span>
												<input type="text" class="form-control" name="vendidasNuevo" id="vendidasNuevo" readonly="readonly">
											</div>
											<div class="col-sm-3">
												<span>Promociones</span>
												<input type="text" class="form-control" name="promocionNuevo" id="promocionNuevo" readonly="readonly">
											</div>
											<div class="col-sm-3">
												<span>Garantias</span>
												<input type="text" class="form-control" name="garantiaNuevo" id="garantiaNuevo" readonly="readonly">
											</div>
											<div class="col-sm-3">
												<span>Presupuesto + Promos + Garantias</span>
												<input type="text" class="form-control" name="totalAnio" id="totalAnio" readonly="readonly">
											</div>
										</div>
									</div>
									<!-- /.card-body -->
									<div class="card-footer">
										<button type="submit" class="btn btn-success float-right" id="guardar_datos">Guardar</button>
									</div>
									<!-- /.card-footer -->
								</form>
							</div>

						</div>


						<hr>
						<div id="formMes" class="card-body">

							<div class="form-group row">
								<div id="resultados_ajaxmes"></div>
								<form class="form-horizontal" method="post" id="guardar_pres_mes" name="guardar_pres_mes">

									<span style="font-weight: bold;">Presupuesto mensual</span>
									<hr>
									<input type="hidden" name="codVenAnio" id="codVenAnio">
									<input type="hidden" name="codLineaAnio" id="codLineaAnio">
									<input type="hidden" id="precioPromedio">
									<div class="form-group row">
										<div class="col-sm-4">
											<input class="form-control decimales" name="precioMeta" id="precioMeta" placeholder="PRECIO POR META" type="text" pattern="^[0-9]+(.[0-9]+)?$" required>
										</div>
										<div class="col-sm-4">
											<label for="precioMeta">PRECIO POR META</label>
										</div>
										<div class="col-sm-4">
											Porcentaje asignado: <span class="btn" id="tituloPor"></span> %
										</div>
									</div>

									<div class="col-sm-8 col-md-8 col-lg-12">
										<div class="table-responsive ">
											<table class="table-bordered  ">
												<tr class="info">
													<th>Mes</th>
													<th>% </th>
													<th>Unidades Vendidas</th>
													<th>Unidades Promociones</th>
													<th>Unidades Garantía</th>
													<th>Total</th>
													<th>Facturación</th>
												</tr>

												<tr>
													<td><span>Enero</span></td>
													<td><input id="porEnero" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesEnero" name="mes[]" />
													<td><input id="venEnero" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proEnero" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaEnero" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totEnero" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presEnero" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
													</td>
													<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Febrero</span></td>
													<td><input id="porFebrero" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesFebrero" name="mes[]" />
													<td><input id="venFebrero" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proFebrero" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaFebrero" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totFebrero" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presFebrero" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />

														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Marzo</span></td>
													<td><input id="porMarzo" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesMarzo" name="mes[]" />
													<td><input id="venMarzo" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proMarzo" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaMarzo" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totMarzo" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presMarzo" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Abril</span></td>
													<td><input id="porAbril" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesAbril" name="mes[]" />
													<td><input id="venAbril" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proAbril" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaAbril" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totAbril" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presAbril" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Mayo</span></td>
													<td><input id="porMayo" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesMayo" name="mes[]" />
													<td><input id="venMayo" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proMayo" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaMayo" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totMayo" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presMayo" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Junio</span></td>
													<td><input id="porJunio" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesJunio" name="mes[]" />
													<td><input id="venJunio" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proJunio" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaJunio" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totJunio" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presJunio" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Julio</span></td>
													<td><input id="porJulio" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesJulio" name="mes[]" />
													<td><input id="venJulio" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proJulio" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaJulio" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totJulio" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presJulio" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Agosto</span></td>
													<td><input id="porAgosto" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesAgosto" name="mes[]" />
													<td><input id="venAgosto" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proAgosto" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaAgosto" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totAgosto" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presAgosto" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Septiembre</span></td>
													<td><input id="porSeptiembre" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesSeptiembre" name="mes[]" />
													<td><input id="venSeptiembre" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proSeptiembre" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaSeptiembre" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totSeptiembre" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presSeptiembre" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Octubre</span></td>
													<td><input id="porOctubre" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesOctubre" name="mes[]" />
													<td><input id="venOctubre" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proOctubre" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaOctubre" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totOctubre" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presOctubre" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Noviembre</span></td>
													<td><input id="porNoviembre" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesNoviembre" name="mes[]" />
													<td><input id="venNoviembre" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proNoviembre" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaNoviembre" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totNoviembre" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presNoviembre" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
												<tr>
													<td><span>Diciembre</span></td>
													<td><input id="porDiciembre" class="form-control decimales" required name="porcentaje[]" placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
													</td>
													<input type="hidden" id="mesDiciembre" name="mes[]" />
													<td><input id="venDiciembre" class="form-control" required name="ventasMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="proDiciembre" class="form-control" required name="promosMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="garaDiciembre" class="form-control" required name="garantiaMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="totDiciembre" class="form-control" required name="totalMes[]" placeholder="" readonly="readonly" />
													</td>
													<td><input id="presDiciembre" class="form-control" required name="presMes[]" placeholder="" readonly="readonly" />
														<!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
												</tr>
											</table>
										</div>

										<div class="card-footer">
											<button type="submit" class="btn btn-success float-right" id="guardar_datos_mes">Guardar</button>
										</div>
									</div>
								</form>


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
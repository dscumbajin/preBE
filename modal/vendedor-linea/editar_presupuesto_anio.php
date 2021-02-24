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

						<form class="form-horizontal" method="post" id="editar_presupuesto_anio" name="editar_presupuesto_anio">
							<div id="resultados_ajax"></div>
							<div class="card-body">
								
								<!-- Datos presupuestos por año-->
								<div class="form-group row" id="total_anio">
									<div class="col-sm-3">
										<span style="font-weight: bold;">Ventas</span>
										<input type="text" class="form-control numero" name="mod_ventas_presupuesto" id="mod_ventas_presupuesto"  pattern="^[0-9]+(.[0-9]+)?$" required >
									</div>
									<div class="col-sm-3">
										<span style="font-weight: bold;">Promociones</span>
										<input type="text" class="form-control numero" name="mod_promos_presupuesto" id="mod_promos_presupuesto"  pattern="^[0-9]+(.[0-9]+)?$" required >
									</div>
									<div class="col-sm-3">
										<span style="font-weight: bold;">Garantias</span>
										<input type="text" class="form-control numero" name="mod_garantia_presupuesto" id="mod_garantia_presupuesto"  pattern="^[0-9]+(.[0-9]+)?$" required >
									</div>
									<div class="col-sm-3">
										<span style="font-weight: bold;">Presupuesto + Promos + Garantias</span>
										<input type="text" class="form-control numero" name="mod_total_presupuesto" id="mod_total_presupuesto"  pattern="^[0-9]+(.[0-9]+)?$" required >
									</div>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-success float-right" id="actualizar_datos">Actualizar</button>
							</div>
							<!-- /.card-footer -->
						</form>

						<hr>
						<!-- <div id="formMes" class="card-body">

							<div class="form-group row">
								<div id="resultados_ajaxmes"></div>
								<form class="form-horizontal" method="post" id="guardar_pres_mes" name="guardar_pres_mes">

									<span>Presupuesto mensual</span>
									<hr>
									<input type="hidden" name="codVenAnio" id="codVenAnio">
									<input type="hidden" name="codLineaAnio" id="codLineaAnio">
									<input type="hidden" id="precioPromedio">
									<div class="form-group row">
										<div class="col-sm-4">
											<input class="form-control decimales" id="precioMeta" placeholder="PRECIO POR META" type="text" pattern="^[0-9]+(.[0-9]+)?$" required>
										</div>
										<div class="col-sm-4">
											<label for="precioMeta">PRECIO POR META</label>
										</div>
										<div class="col-sm-4">
											Porcentaje asignado: <span id="tituloPor"></span> %
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
													<td><input id="porEnero" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
													
												</tr>
												<tr>
													<td><span>Febrero</span></td>
													<td><input id="porFebrero" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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

														
												</tr>
												<tr>
													<td><span>Marzo</span></td>
													<td><input id="porMarzo" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
														
												</tr>
												<tr>
													<td><span>Abril</span></td>
													<td><input id="porAbril" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
														
												</tr>
												<tr>
													<td><span>Mayo</span></td>
													<td><input id="porMayo" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
														
												</tr>
												<tr>
													<td><span>Junio</span></td>
													<td><input id="porJunio" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
														
												</tr>
												<tr>
													<td><span>Julio</span></td>
													<td><input id="porJulio" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
														
												</tr>
												<tr>
													<td><span>Agosto</span></td>
													<td><input id="porAgosto" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
														
												</tr>
												<tr>
													<td><span>Septiembre</span></td>
													<td><input id="porSeptiembre" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
														
												</tr>
												<tr>
													<td><span>Octubre</span></td>
													<td><input id="porOctubre" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
														
												</tr>
												<tr>
													<td><span>Noviembre</span></td>
													<td><input id="porNoviembre" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
														
												</tr>
												<tr>
													<td><span>Diciembre</span></td>
													<td><input id="porDiciembre" class="form-control decimales" required placeholder="%" type="text" pattern="^[0-9]+(.[0-9]+)?$" />
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
 -->
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
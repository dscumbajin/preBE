	<?php
	$codLinea = $_GET['codLinea'];
	if (isset($con)) {
	?>

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
	                    <div id="resultados_ajax"></div>
	                    <div class="card-body">
	                        <div class="form-group row">
	                            <label for="incremento_anio" class="col-sm-3 col-form-label">Porcentaje de incremento
	                                año</label>
	                            <div class="col-sm-6">
	                                <input type="number" class="form-control" id="incremento_anio" placeholder="Porcentaje"
	                                    min="0" max="100" required>
	                                <!--Pra registro en la base de datos-->
	                                <input type="hidden" name="anioHist" id="anioHist">
	                                <input type="hidden" name="codVenHist" id="codVenHist">
	                                <input type="hidden" name="codLineaHist" id="codLineaHist">

	                                <!-- Para calculo del presupuesto del año siguiente-->
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
	                                <input type="text" class="form-control" name="vendidasNuevo" id="vendidasNuevo">
	                            </div>
	                            <div class="col-sm-3">
	                                <span>Promociones</span>
	                                <input type="text" class="form-control" name="promocionNuevo" id="promocionNuevo">
	                            </div>
	                            <div class="col-sm-3">
	                                <span>Garantias</span>
	                                <input type="text" class="form-control" name="garantiaNuevo" id="garantiaNuevo">
	                            </div>
	                            <div class="col-sm-3">
	                                <span>Presupuesto + Promos + Garantias</span>
	                                <input type="text" class="form-control" name="totalAnio" id="totalAnio">
	                            </div>
	                        </div>
	                    </div>
	                    <!-- /.card-body -->
	                    <div class="card-footer">
	                        <button type="submit"  class="btn btn-success float-right" id="guardar_datos">Guardar</button>
	                    </div>
	                    <!-- /.card-footer -->
	                </form>

	                <hr>
	                <div class="card-body">

	                    <div class="form-group row">

	                        <form class="form-horizontal" method="post" id="guardar_pres_mes" name="guardar_pres_mes">
	                            <h3 class="">Agregar presupuesto Mes - <span id="tituloPor"></span> % por asignar</h3>
	                            <div class="table-responsive">
	                                <table id="tabla" class="table table-bordered table-striped">
	                                    <th>Mes</th>
	                                    <th>% </th>
	                                    <th>Unidades Vendidas</th>
	                                    <th>Unidades Promociones</th>
	                                    <th>Unidades Garantía</th>
	                                    <th>Total</th>


	                                    <tr class="fila-fija">

	                                       <!--  <input type="hidden" required name="idPresAnio[]" /> -->

	                                        <td><span>Enero</span></td>
	                                        <td><input id="porEnero" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venEnero" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proEnero" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaEnero" class="form-control" required name="garantiaMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="totEnero" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Febrero</span></td>
	                                        <td><input id="porFebrero" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venFebrero" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proFebrero" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaFebrero" class="form-control" required name="garantiaMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="totFebrero" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Marzo</span></td>
	                                        <td><input id="porMarzo" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venMarzo" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proMarzo" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaMarzo" class="form-control" required name="garantiaMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="totMarzo" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Abril</span></td>
	                                        <td><input id="porAbril" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venAbril" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proAbril" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaAbril" class="form-control" required name="garantiaMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="totAbril" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Mayo</span></td>
	                                        <td><input id="porMayo" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venMayo" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proMayo" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaMayo" class="form-control" required name="garantiaMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="totMayo" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Junio</span></td>
	                                        <td><input id="porJunio" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venJunio" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proJunio" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaJunio" class="form-control" required name="garantiaMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="totJunio" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Julio</span></td>
	                                        <td><input id="porJulio" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venJulio" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proJulio" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaJulio" class="form-control" required name="garantiaMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="totJulio" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Agosto</span></td>
	                                        <td><input id="porAgosto" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venAgosto" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proAgosto" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaAgosto" class="form-control" required name="garantiaMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="totAgosto" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Septiembre</span></td>
	                                        <td><input id="porSeptiembre" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venSeptiembre" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proSeptiembre" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaSeptiembre" class="form-control" required
	                                                name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id="totSeptiembre" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Octubre</span></td>
	                                        <td><input id="porOctubre" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venOctubre" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proOctubre" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaOctubre" class="form-control" required name="garantiaMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="totOctubre" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Noviembre</span></td>
	                                        <td><input id="porNoviembre" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venNoviembre" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proNoviembre" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaNoviembre" class="form-control" required
	                                                name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id="totNoviembre" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Diciembre</span></td>
	                                        <td><input id="porDiciembre" class="form-control" required placeholder="%" />
	                                        </td>

	                                        <td><input id="venDiciembre" class="form-control" required name="ventasMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="proDiciembre" class="form-control" required name="promosMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <td><input id="garaDiciembre" class="form-control" required
	                                                name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id="totDiciembre" class="form-control" required name="totalMes[]"
	                                                placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                </table>
	                            </div>
	                            <div>
	                                <!--   <input type="submit" name="insertar" value="Guardar" class="btn btn-dark" /> -->
	                                <!--  <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Más
	                                        + </button> -->
	                                <button type="submit" class="btn btn-success float-right"
	                                    id="guardar_datos_mes">Guardar</button>


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
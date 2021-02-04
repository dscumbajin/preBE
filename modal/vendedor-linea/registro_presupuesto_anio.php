	<?php
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
	                    <div class="card-body">
	                        <div class="form-group row">
	                            <label for="incremento_anio" class="col-sm-3 col-form-label">Porcentaje de incremento
	                                año</label>
	                            <div class="col-sm-6">
	                                <input type="int" class="form-control" id="incremento_anio" placeholder="Porcentaje"
	                                    required>
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
	                                <input type="text" class="form-control" id="vendidasNuevo" disabled>
	                            </div>
	                            <div class="col-sm-3">
	                                <span>Promociones</span>
	                                <input type="text" class="form-control" id="promocionNuevo" disabled>
	                            </div>
	                            <div class="col-sm-3">
	                                <span>Garantias</span>
	                                <input type="text" class="form-control" id="garantiaNuevo" disabled>
	                            </div>
	                            <div class="col-sm-3">
	                                <span>Presupuesto + Promos + Garantias</span>
	                                <input type="text" class="form-control" id="totalAnio" disabled>
	                            </div>
	                        </div>
	                    </div>
	                    <!-- /.card-body -->
	                    <div class="card-footer">
	                        <button type="submit" class="btn btn-success float-right" id="guardar_datos">Guardar</button>
	                    </div>
	                    <!-- /.card-footer -->
	                </form>

	                <hr>
	                <form id="formMes" class="form-horizontal">
	                    <div class="card-body">

	                        <div class="form-group row">

	                            <form method="post">
	                                <h3 class="">Agregar presupuesto Mes  - <span id="tituloPor"></span> % por asignar</h3>
	                                <table class="table" id="tabla">
	                                    <th>Mes</th>
	                                    <th>% </th>
	                                    <th>Unidades Vendidas</th>
	                                    <th>Unidades Promociones</th>
	                                    <th>Unidades Garantía</th>
	                                    <th>Total</th>


	                                    <tr class="fila-fija">

	                                        <input type="hidden" required name="idPresAnio[]" />

	                                        <td><span>Enero</span></td>
	                                        <td><input id= "porEnero" class="form-control" required placeholder="%" /></td>
	                                        
											<td><input id= "venEnero" class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proEnero" class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaEnero" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totEnero" class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Febrero</span></td>
	                                        <td><input id= "porFebrero"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venFebrero"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proFebrero"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaFebrero" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totFebrero"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Marzo</span></td>
	                                        <td><input id= "porMarzo"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venMarzo"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proMarzo"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaMarzo" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totMarzo"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Abril</span></td>
	                                        <td><input id= "porAbril"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venAbril"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proAbril"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaAbril" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totAbril"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Mayo</span></td>
	                                        <td><input id= "porMayo"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venMayo"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proMayo"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaMayo" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totMayo"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Junio</span></td>
	                                        <td><input id= "porJunio"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venJunio"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proJunio"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaJunio" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totJunio"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Julio</span></td>
	                                        <td><input id= "porJulio"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venJulio"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proJulio"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaJulio" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totJulio"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Agosto</span></td>
	                                        <td><input id= "porAgosto"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venAgosto"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proAgosto"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaAgosto" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totAgosto"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Septiembre</span></td>
	                                        <td><input id= "porSeptiembre"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venSeptiembre"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proSeptiembre"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaSeptiembre" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totSeptiembre"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Octubre</span></td>
	                                        <td><input id= "porOctubre"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venOctubre"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proOctubre"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaOctubre" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totOctubre"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Noviembre</span></td>
	                                        <td><input id= "porNoviembre"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venNoviembre"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proNoviembre"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaNoviembre" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totNoviembre"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                    <tr class="fila-fija">
	                                        <td><span>Diciembre</span></td>
	                                        <td><input id= "porDiciembre"  class="form-control" required placeholder="%" /></td>

	                                        <td><input id= "venDiciembre"  class="form-control" required name="ventasMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "proDiciembre"  class="form-control" required name="promosMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "garaDiciembre" class="form-control" required name="garantiaMes[]" placeholder="" />
	                                        </td>
	                                        <td><input id= "totDiciembre"  class="form-control" required name="totalMes[]" placeholder="" />
	                                        </td>
	                                        <!-- <td class="eliminar"><input type="button" value="Menos -" /></td> -->
	                                    </tr>
	                                </table>

	                                <div>
	                                    <input type="submit" name="insertar" value="Guardar" class="btn btn-dark" />
	                                    <!--  <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Más
	                                        + </button> -->

	                                </div>
	                            </form>
	                            <?php

												//////////////////////// PRESIONAR EL BOTÓN //////////////////////////
												if(isset($_POST['insertar']))

												{


												$items1 = ($_POST['ventasMes']);
												$items2 = ($_POST['promosMes']);
												$items3 = ($_POST['garantiaMes']);
												$items4 = ($_POST['totalMes']);
												
												///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, promosMes,  Y GRUPO////////////////////)
												while(true) {

													//// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
													$item1 = current($items1);
													$item2 = current($items2);
													$item3 = current($items3);
													$item4 = current($items4);
													
													////// ASIGNARLOS A VARIABLES ///////////////////
													$id=(( $item1 !== false) ? $item1 : ", &nbsp;");
													$nom=(( $item2 !== false) ? $item2 : ", &nbsp;");
													$carr=(( $item3 !== false) ? $item3 : ", &nbsp;");
													$gru=(( $item4 !== false) ? $item4 : ", &nbsp;");

													//// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
													$valores='('.$id.',"'.$nom.'","'.$carr.'","'.$gru.'"),';

													//////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
													$valoresQ= substr($valores, 0, -1);
													
													///////// QUERY DE INSERCIÓN ////////////////////////////
													$sql = "INSERT INTO alumnos (id_alumno, promosMes, , grupo) 
													VALUES $valoresQ";

													
													$sqlRes=$conexion->query($sql) or mysql_error();

													
													// Up! Next Value
													$item1 = next( $items1 );
													$item2 = next( $items2 );
													$item3 = next( $items3 );
													$item4 = next( $items4 );
													
													// Check terminator
													if($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;
									
												}
										
												}

											?>

	                        </div>
	                    </div>
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
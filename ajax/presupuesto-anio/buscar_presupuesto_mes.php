<?php

 /*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
    
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos
$idPresAnio = intval($_REQUEST['idPresAnio']);

// Ejecutamos la consulta de busqueda
?>
<div class="table-responsive">
    <form method="post" id="editar_presupuesto_mes" name="editar_presupuesto_mes">
        <div id="resultados_ajax2"></div>
        <table id="registros" class="table table-bordered table-striped">
            <thead>
                <tr>

                    <th>Mes</th>
                    <th>Porcentaje</th>
                    <th>Cantidad Mes</th>
                    <th>Cantidad Promos</th>
                    <th>Cantidad Garantía</th>
                    <th>Cantidad Total</th>
                    <th>$ Presupuesto</th>

                </tr>
            </thead>
            <tbody>
                <?php
                /* $fechaActual = date('Y-m-d');
                AND mes >= '$fechaActual' */
                try {
                    $sql = " SELECT * FROM presupuesto_mes WHERE idPresAnio = $idPresAnio ";

                    $resultado = $con->query($sql);
                    $i = 0;
                } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                }
                while ($presMes = $resultado->fetch_assoc()) {
                    $idMes = $presMes['idPresMes'];
                ?>
                    <tr id="tr<?php echo $i ?>">

                        <td hidden><input name="idPresMes[]" value="<?php echo $presMes['idPresMes'] ?>" /></td>
                        <td><input class="bloquear" id="mes<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="mes[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['mes'] ?>" required></td>
                        <td><input class="bloquear decimales" onclick="enter(<?php echo $idMes ?>)" id="porcentaje<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="porcentaje[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['porcentaje']; ?>" required></td>
                        <td><input class="bloquear" id="cantMesU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantMesU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantMesU']; ?>" required></td>
                        <td><input class="bloquear" id="cantPromoU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantPromoU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantPromoU']; ?>" required></td>
                        <td><input class="bloquear" id="cantGarantU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantGarantU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantGarantU']; ?>" required></td>
                        <td><input class="bloquear" id="cantTotalU<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="cantTotalU[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['cantTotalU']; ?>" required></td>
                        <td><input class="bloquear" id="presMesV<?php echo $presMes['idPresMes'] ?>" style="width: 100px;" type="text" name="presMesV[<?php echo $presMes['idPresMes'] ?>]" value="<?php echo $presMes['presMesV']; ?>" required></td>
                    </tr>
                <?php $i++;
                } ?>
            </tbody>

        </table>
        <div class="card-footer">
            <button type="submit" class="btn btn-success float-right" id="actualizar_datos_mes">Actualizar</button>
        </div>
    </form>


</div>
<style>
    .red {
        color: red;
    }
</style>
<script>
    //Porcentje asignado
    function tituloPreAnio(enero, febrero, marzo, abril, mayo, junio, julio, agosto, septiembre, octubre, noviembre, diciembre) {

        var totalTitulo = enero + febrero + marzo + abril + mayo + junio + julio + agosto + septiembre + octubre + noviembre + diciembre;

        totalTitulo = parseFloat(totalTitulo);
        totalTitulo = Math.round(totalTitulo);
        if (totalTitulo <= 100) {
            $('#actualizar_datos_mes').attr("disabled", false);
            $('#porAs').removeClass('filledInputs');

        } else {
            $('#actualizar_datos_mes').attr("disabled", true);
            $('#porAs').addClass('filledInputs');
        }
        $("#porAs").text(totalTitulo);
    }
    //BLOQUEAR
    $('.bloquear').attr("readonly", true);

    //Bloquear tr
    $('#tr0').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr0").find("input").eq(1).val());

        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr0").find("input").eq(2).attr("readonly", false);

            $("#tr0").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porEnero)) {
                    var subPorcentajes = porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr0").find("input").eq(2).on("input", function() {
                        var porEnero = $(this).val();
                        porEnero = parseFloat(porEnero);
                        if (porEnero <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {
                    var valor = $("#tr0").find("input").eq(2).val();
                }
            });
        } else {
            $("#tr0").find("input").eq(2).addClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });

    //Bloquear Febrero
    $('#tr1').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr1").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr1").find("input").eq(2).attr("readonly", false);

            $("#tr1").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porFebrero)) {
                    var subPorcentajes = porEnero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr1").find("input").eq(2).on("input", function() {
                        var porFebrero = $(this).val();
                        porFebrero = parseFloat(porFebrero);
                        if (porFebrero <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {
                    var valor = $("#tr1").find("input").eq(2).val();
                }
            });
        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).addClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });

    //Bloquear Marzo
    $('#tr2').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr2").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr2").find("input").eq(2).attr("readonly", false);

            $("#tr2").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porMarzo)) {
                    var subPorcentajes = porEnero + porFebrero + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr2").find("input").eq(2).on("input", function() {
                        var porMarzo = $(this).val();
                        porMarzo = parseFloat(porMarzo);
                        if (porMarzo <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {
                    var valor = $("#tr2").find("input").eq(2).val();
                }
            });
        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).addClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });
    //Bloquear Abril
    $('#tr3').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr3").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr3").find("input").eq(2).attr("readonly", false);

            $("#tr3").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porAbril)) {
                    var subPorcentajes = porEnero + porFebrero + porMarzo + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr3").find("input").eq(2).on("input", function() {

                        var porAbril = $(this).val();
                        porAbril = parseFloat(porAbril);
                        if (porAbril <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {

                    var valor = $("#tr3").find("input").eq(2).val();

                }

            });

        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).addClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });

    //Bloquear Mayo
    $('#tr4').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr4").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr4").find("input").eq(2).attr("readonly", false);

            $("#tr4").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porMayo)) {
                    var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr4").find("input").eq(2).on("input", function() {

                        var porMayo = $(this).val();
                        porMayo = parseFloat(porMayo);
                        if (porMayo <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {

                    var valor = $("#tr4").find("input").eq(2).val();

                }

            });

        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).addClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });

    //Bloquear Junio
    $('#tr5').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr5").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr5").find("input").eq(2).attr("readonly", false);

            $("#tr5").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porJunio)) {
                    var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr5").find("input").eq(2).on("input", function() {

                        var porJunio = $(this).val();
                        porJunio = parseFloat(porJunio);
                        if (porJunio <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {

                    var valor = $("#tr5").find("input").eq(2).val();

                }

            });

        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).addClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });

    //Bloquear Julio
    $('#tr6').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr6").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr6").find("input").eq(2).attr("readonly", false);

            $("#tr6").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porJulio)) {
                    var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr6").find("input").eq(2).on("input", function() {

                        var porJulio = $(this).val();
                        porJulio = parseFloat(porJulio);
                        if (porJulio <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {

                    var valor = $("#tr6").find("input").eq(2).val();

                }

            });

        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).addClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });
    //Bloquear Agosto
    $('#tr7').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr7").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr7").find("input").eq(2).attr("readonly", false);

            $("#tr7").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porAgosto)) {
                    var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr7").find("input").eq(2).on("input", function() {

                        var porAgosto = $(this).val();
                        porAgosto = parseFloat(porAgosto);
                        if (porAgosto <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {

                    var valor = $("#tr7").find("input").eq(2).val();

                }

            });

        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).addClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });
    //Bloquear Septiembre
    $('#tr8').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr8").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr8").find("input").eq(2).attr("readonly", false);

            $("#tr8").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porSeptiembre)) {
                    var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porOctubre + porNoviembre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr8").find("input").eq(2).on("input", function() {

                        var porSeptiembre = $(this).val();
                        porSeptiembre = parseFloat(porSeptiembre);
                        if (porSeptiembre <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {

                    var valor = $("#tr8").find("input").eq(2).val();

                }

            });

        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).addClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });
    //Bloquear Octubre
    $('#tr9').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr9").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr9").find("input").eq(2).attr("readonly", false);

            $("#tr9").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porOctubre)) {
                    var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porNoviembre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr9").find("input").eq(2).on("input", function() {

                        var porOctubre = $(this).val();
                        porOctubre = parseFloat(porOctubre);
                        if (porOctubre <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {

                    var valor = $("#tr9").find("input").eq(2).val();

                }

            });

        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).addClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });

    //Bloquear Noviembre
    $('#tr10').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr10").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr10").find("input").eq(2).attr("readonly", false);

            $("#tr10").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porNoviembre)) {
                    var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porDiciembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr10").find("input").eq(2).on("input", function() {

                        var porNoviembre = $(this).val();
                        porNoviembre = parseFloat(porNoviembre);
                        if (porNoviembre <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {

                    var valor = $("#tr10").find("input").eq(2).val();

                }

            });

        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).addClass("red");
            $("#tr11").find("input").eq(2).removeClass("red");
        }

    });
    //Bloquear tr
    $('#tr11').on('click', function() {
        // Fecha actual del sistema
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        // Fecha del input
        var input_fecha = new Date($("#tr11").find("input").eq(1).val());
        if (input_fecha > fecha_actual) {
            for (let i = 0; i < 12; i++) {
                $("#tr" + i).find("input").eq(2).removeClass("red");
            }
            //Habilitar input %
            $("#tr11").find("input").eq(2).attr("readonly", false);

            $("#tr11").find("input").eq(2).on('input', function() {
                var porEnero = $("#tr0").find("input").eq(2).val();
                porEnero = parseFloat(porEnero);
                var porFebrero = $("#tr1").find("input").eq(2).val();
                porFebrero = parseFloat(porFebrero);
                var porMarzo = $("#tr2").find("input").eq(2).val();
                porMarzo = parseFloat(porMarzo);
                var porAbril = $("#tr3").find("input").eq(2).val();
                porAbril = parseFloat(porAbril);
                var porMayo = $("#tr4").find("input").eq(2).val();
                porMayo = parseFloat(porMayo);
                var porJunio = $("#tr5").find("input").eq(2).val();
                porJunio = parseFloat(porJunio);
                var porJulio = $("#tr6").find("input").eq(2).val();
                porJulio = parseFloat(porJulio);
                var porAgosto = $("#tr7").find("input").eq(2).val();
                porAgosto = parseFloat(porAgosto);
                var porSeptiembre = $("#tr8").find("input").eq(2).val();
                porSeptiembre = parseFloat(porSeptiembre);
                var porOctubre = $("#tr9").find("input").eq(2).val();
                porOctubre = parseFloat(porOctubre);
                var porNoviembre = $("#tr10").find("input").eq(2).val();
                porNoviembre = parseFloat(porNoviembre);
                var porDiciembre = $("#tr11").find("input").eq(2).val();
                porDiciembre = parseFloat(porDiciembre);

                if (isNaN(porDiciembre)) {
                    var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre;
                    var comparacion = 100 - subPorcentajes;
                    confirm(`Debes ingresar un valor menor o igual a: ${comparacion}`);
                    $("#tr11").find("input").eq(2).on("input", function() {
                        var porDiciembre = $(this).val();
                        porDiciembre = parseFloat(porDiciembre);
                        if (porDiciembre <= comparacion) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);

                        }
                        tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);
                        var tituloPor = $("#porAs").text();
                        tituloPor = parseInt(tituloPor);
                        if (tituloPor == 100) {
                            $('#actualizar_datos_mes').attr("disabled", false);
                        } else {
                            $('#actualizar_datos_mes').attr("disabled", true);
                        }
                    });
                } else {
                    var valor = $("#tr11").find("input").eq(2).val();
                }
            });
        } else {
            $("#tr0").find("input").eq(2).removeClass("red");
            $("#tr1").find("input").eq(2).removeClass("red");
            $("#tr2").find("input").eq(2).removeClass("red");
            $("#tr3").find("input").eq(2).removeClass("red");
            $("#tr4").find("input").eq(2).removeClass("red");
            $("#tr5").find("input").eq(2).removeClass("red");
            $("#tr6").find("input").eq(2).removeClass("red");
            $("#tr7").find("input").eq(2).removeClass("red");
            $("#tr8").find("input").eq(2).removeClass("red");
            $("#tr9").find("input").eq(2).removeClass("red");
            $("#tr10").find("input").eq(2).removeClass("red");
            $("#tr11").find("input").eq(2).addClass("red");
        }
    });

    function enter(id) {
        //desabilitar todo
        //cuando haga clic habilitar
        $('#porcentaje' + id).on('input', function() {

            //VALORES DE PRESUPUESTO AÑO
            var cantidad_ventas_presupuesto = $("#mod_ventas_presupuesto").val();
            cantidad_ventas_presupuesto = parseInt(cantidad_ventas_presupuesto);
            var cantidad_promos_presupuesto = $("#mod_promos_presupuesto").val();
            cantidad_promos_presupuesto = parseInt(cantidad_promos_presupuesto);
            var cantidad_garantia_presupuesto = $("#mod_garantia_presupuesto").val();
            cantidad_garantia_presupuesto = parseInt(cantidad_garantia_presupuesto);

            var precioMeta = $("#mod_precioMeta").val();
            precioMeta = parseFloat(precioMeta);

            //VALOR DEL PORCENTAJE
            var porcentajeInput = $('#porcentaje' + id).val();
            porcentajeInput = parseFloat(porcentajeInput);
            var porcentaje = porcentajeInput / 100;

            //VALORES DE PRESUPUESTO MES
            var cantMesU = Math.round(cantidad_ventas_presupuesto * porcentaje);
            var cantPromoU = Math.round(cantidad_promos_presupuesto * porcentaje);
            var cantGarantU = Math.round(cantidad_garantia_presupuesto * porcentaje);
            var cantTotalU = Math.round(cantMesU + cantPromoU + cantGarantU);
            var presMesV = precioMeta * cantTotalU;

            $('#cantMesU' + id).val(cantMesU);
            $('#cantPromoU' + id).val(cantPromoU);
            $('#cantGarantU' + id).val(cantGarantU);
            $('#cantTotalU' + id).val(cantTotalU);
            $('#presMesV' + id).val(presMesV);

        });
    }
    // VALIDACIONES
    $('.decimales').on('input', function() {
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
    });

    $("#editar_presupuesto_mes").submit(function(event) {
        $('#actualizar_datos_mes').attr("disabled", true);
        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "./ajax/presupuesto-anio/editar_presupuesto_mes.php",
            data: parametros,
            beforeSend: function(objeto) {
                $("#resultados_ajax2").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#resultados_ajax2").html(datos);
                $('#actualizar_datos_mes').attr("disabled", false);
                load(1);
            }
        });
        event.preventDefault();
    })
   
</script>
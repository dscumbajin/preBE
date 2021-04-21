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
        <!--Hiden de cantidades para actualizar-->
        <input type="hidden" name="idPresAnio" value="<?php echo $idPresAnio ?>">
        <input type="hidden" name="valorVenta" id="valorVenta">
        <input type="hidden" name="valorPromo" id="valorPromo">
        <input type="hidden" name="valorGaran" id="valorGaran">
        <input type="hidden" name="valorTotal" id="valorTotal">

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
    //Ocultos
    $("#incremento_edicion").hide();
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

    //PORCENTAJE INCREMENTO
    $("#incremento_edicion").on('input', function() {
        var valor_incre = this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
        valor_incre = parseFloat(valor_incre);
        var ventas = parseInt(localStorage.getItem("ventas"));
        var promos = parseInt(localStorage.getItem("promos"));
        var garantias = parseInt(localStorage.getItem("garantias"));
        var total = parseInt(localStorage.getItem("total"));
        var mas_ventas = Math.round(ventas * (valor_incre / 100));
        var total_vetas_mas = ventas + mas_ventas;
        var mas_promo = Math.round(promos * (valor_incre / 100));
        var total_promos_mas = promos + mas_promo;
        var mas_garantias = Math.round(garantias * (valor_incre / 100));
        var total_garant_mas = garantias + mas_garantias;

        if (isNaN(valor_incre)) {

            $('#mod_ventas_presupuesto').val(ventas);
            $('#mod_promos_presupuesto').val(promos);
            $('#mod_garantia_presupuesto').val(garantias);
            $('#mod_total_presupuesto').val(total);  

        } else {
            if (ventas != total_vetas_mas) {
                $('#mod_ventas_presupuesto').val(total_vetas_mas);
                var mod_ventas = total_vetas_mas
                mod_ventas = parseInt(mod_ventas);
                var mod_promos = $('#mod_promos_presupuesto').val();
                mod_promos = parseInt(mod_promos);
                var mod_garant = $('#mod_garantia_presupuesto').val();
                mod_garant = parseInt(mod_garant);
                $('#valorVenta').val(mod_ventas);
                $('#valorPromo').val(mod_promos);
                $('#valorGaran').val(mod_garant);
                $('#mod_total_presupuesto').val(mod_promos + mod_garant + mod_ventas);
                $('#valorTotal').val(mod_promos + mod_garant + mod_ventas);

                // ACTUALIZACMOS VENTAS
                // Fecha actual del sistema
                var hoy = new Date();
                var tras = hoy.toLocaleDateString('en-US');
                var fecha_actual = new Date(tras);
                // Enero
                var input_enero = new Date($("#tr0").find("input").eq(1).val());
                if (input_enero < fecha_actual) {
                    $("#tr0").find("input").eq(2).addClass("red");
                } else {
                    var por_enero = $("#tr0").find("input").eq(2).val();
                    por_enero = parseFloat(por_enero);
                    var val_enero = mod_ventas * (por_enero / 100);
                    val_enero = parseInt(val_enero);
                    $("#tr0").find("input").eq(3).val(val_enero);
                    var venta_enero = $("#tr0").find("input").eq(4).val();
                    venta_enero = parseInt(venta_enero);
                    var garan_enero = $("#tr0").find("input").eq(5).val();
                    garan_enero = parseInt(garan_enero);
                    //Ingreso total
                    var total_enero = val_enero + venta_enero + garan_enero
                    var meta_enero = localStorage.getItem("meta");
                    meta_enero = parseFloat(meta_enero);
                    $("#tr0").find("input").eq(6).val(total_enero);
                    var pres_enero = parseFloat(total_enero * meta_enero)
                    $("#tr0").find("input").eq(7).val(pres_enero);
                }

                // febrero
                var input_febrero = new Date($("#tr1").find("input").eq(1).val());
                if (input_febrero < fecha_actual) {
                    $("#tr1").find("input").eq(2).addClass("red");
                } else {
                    var por_febrero = $("#tr1").find("input").eq(2).val();
                    por_febrero = parseFloat(por_febrero);
                    var val_febrero = mod_ventas * (por_febrero / 100);
                    val_febrero = parseInt(val_febrero);
                    $("#tr1").find("input").eq(3).val(val_febrero);
                    var venta_febrero = $("#tr1").find("input").eq(4).val();
                    venta_febrero = parseInt(venta_febrero);
                    var garan_febrero = $("#tr1").find("input").eq(5).val();
                    garan_febrero = parseInt(garan_febrero);
                    //Ingreso total
                    var total_febrero = val_febrero + venta_febrero + garan_febrero
                    var meta_febrero = localStorage.getItem("meta");
                    meta_febrero = parseFloat(meta_febrero);
                    $("#tr1").find("input").eq(6).val(total_febrero);
                    var pres_febrero = parseFloat(total_febrero * meta_febrero)
                    $("#tr1").find("input").eq(7).val(pres_febrero);
                }

                // marzo
                var input_marzo = new Date($("#tr2").find("input").eq(1).val());
                if (input_marzo < fecha_actual) {
                    $("#tr2").find("input").eq(2).addClass("red");
                } else {
                    var por_marzo = $("#tr2").find("input").eq(2).val();
                    por_marzo = parseFloat(por_marzo);
                    var val_marzo = mod_ventas * (por_marzo / 100);
                    val_marzo = parseInt(val_marzo);
                    $("#tr2").find("input").eq(3).val(val_marzo);
                    var venta_marzo = $("#tr2").find("input").eq(4).val();
                    venta_marzo = parseInt(venta_marzo);
                    var garan_marzo = $("#tr2").find("input").eq(5).val();
                    garan_marzo = parseInt(garan_marzo);
                    //Ingreso total
                    var total_marzo = val_marzo + venta_marzo + garan_marzo
                    var meta_marzo = localStorage.getItem("meta");
                    meta_marzo = parseFloat(meta_marzo);
                    $("#tr2").find("input").eq(6).val(total_marzo);
                    var pres_marzo = parseFloat(total_marzo * meta_marzo)
                    $("#tr2").find("input").eq(7).val(pres_marzo);
                }

                // abril
                var input_abril = new Date($("#tr3").find("input").eq(1).val());
                if (input_abril < fecha_actual) {
                    $("#tr3").find("input").eq(2).addClass("red");
                } else {
                    var por_abril = $("#tr3").find("input").eq(2).val();
                    por_abril = parseFloat(por_abril);
                    var val_abril = mod_ventas * (por_abril / 100);
                    val_abril = parseInt(val_abril);
                    $("#tr3").find("input").eq(3).val(val_abril);
                    var venta_abril = $("#tr3").find("input").eq(4).val();
                    venta_abril = parseInt(venta_abril);
                    var garan_abril = $("#tr3").find("input").eq(5).val();
                    garan_abril = parseInt(garan_abril);
                    //Ingreso total
                    var total_abril = val_abril + venta_abril + garan_abril
                    var meta_abril = localStorage.getItem("meta");
                    meta_abril = parseFloat(meta_abril);
                    $("#tr3").find("input").eq(6).val(total_abril);
                    var pres_abril = parseFloat(total_abril * meta_abril)
                    $("#tr3").find("input").eq(7).val(pres_abril);
                }

                // mayo
                var input_mayo = new Date($("#tr4").find("input").eq(1).val());
                if (input_mayo < fecha_actual) {
                    $("#tr4").find("input").eq(2).addClass("red");
                } else {
                    var por_mayo = $("#tr4").find("input").eq(2).val();
                    por_mayo = parseFloat(por_mayo);
                    var val_mayo = mod_ventas * (por_mayo / 100);
                    val_mayo = parseInt(val_mayo);
                    $("#tr4").find("input").eq(3).val(val_mayo);
                    var venta_mayo = $("#tr4").find("input").eq(4).val();
                    venta_mayo = parseInt(venta_mayo);
                    var garan_mayo = $("#tr4").find("input").eq(5).val();
                    garan_mayo = parseInt(garan_mayo);
                    //Ingreso total
                    var total_mayo = val_mayo + venta_mayo + garan_mayo
                    var meta_mayo = localStorage.getItem("meta");
                    meta_mayo = parseFloat(meta_mayo);
                    $("#tr4").find("input").eq(6).val(total_mayo);
                    var pres_mayo = parseFloat(total_mayo * meta_mayo)
                    $("#tr4").find("input").eq(7).val(pres_mayo);
                }

                // junio
                var input_junio = new Date($("#tr5").find("input").eq(1).val());
                if (input_junio < fecha_actual) {
                    $("#tr5").find("input").eq(2).addClass("red");
                } else {
                    var por_junio = $("#tr5").find("input").eq(2).val();
                    por_junio = parseFloat(por_junio);
                    var val_junio = mod_ventas * (por_junio / 100);
                    val_junio = parseInt(val_junio);
                    $("#tr5").find("input").eq(3).val(val_junio);
                    var venta_junio = $("#tr5").find("input").eq(4).val();
                    venta_junio = parseInt(venta_junio);
                    var garan_junio = $("#tr5").find("input").eq(5).val();
                    garan_junio = parseInt(garan_junio);
                    //Ingreso total
                    var total_junio = val_junio + venta_junio + garan_junio
                    var meta_junio = localStorage.getItem("meta");
                    meta_junio = parseFloat(meta_junio);
                    $("#tr5").find("input").eq(6).val(total_junio);
                    var pres_junio = parseFloat(total_junio * meta_junio)
                    $("#tr5").find("input").eq(7).val(pres_junio);
                }

                // julio
                var input_julio = new Date($("#tr6").find("input").eq(1).val());
                if (input_julio < fecha_actual) {
                    $("#tr6").find("input").eq(2).addClass("red");
                } else {
                    var por_julio = $("#tr6").find("input").eq(2).val();
                    por_julio = parseFloat(por_julio);
                    var val_julio = mod_ventas * (por_julio / 100);
                    val_julio = parseInt(val_julio);
                    $("#tr6").find("input").eq(3).val(val_julio);
                    var venta_julio = $("#tr6").find("input").eq(4).val();
                    venta_julio = parseInt(venta_julio);
                    var garan_julio = $("#tr6").find("input").eq(5).val();
                    garan_julio = parseInt(garan_julio);
                    //Ingreso total
                    var total_julio = val_julio + venta_julio + garan_julio
                    var meta_julio = localStorage.getItem("meta");
                    meta_julio = parseFloat(meta_julio);
                    $("#tr6").find("input").eq(6).val(total_julio);
                    var pres_julio = parseFloat(total_julio * meta_julio)
                    $("#tr6").find("input").eq(7).val(pres_julio);
                }

                // agosto
                var input_agosto = new Date($("#tr7").find("input").eq(1).val());
                if (input_agosto < fecha_actual) {
                    $("#tr7").find("input").eq(2).addClass("red");
                } else {
                    var por_agosto = $("#tr7").find("input").eq(2).val();
                    por_agosto = parseFloat(por_agosto);
                    var val_agosto = mod_ventas * (por_agosto / 100);
                    val_agosto = parseInt(val_agosto);
                    $("#tr7").find("input").eq(3).val(val_agosto);
                    var venta_agosto = $("#tr7").find("input").eq(4).val();
                    venta_agosto = parseInt(venta_agosto);
                    var garan_agosto = $("#tr7").find("input").eq(5).val();
                    garan_agosto = parseInt(garan_agosto);
                    //Ingreso total
                    var total_agosto = val_agosto + venta_agosto + garan_agosto
                    var meta_agosto = localStorage.getItem("meta");
                    meta_agosto = parseFloat(meta_agosto);
                    $("#tr7").find("input").eq(6).val(total_agosto);
                    var pres_agosto = parseFloat(total_agosto * meta_agosto)
                    $("#tr7").find("input").eq(7).val(pres_agosto);
                }

                // septiembre
                var input_septiembre = new Date($("#tr8").find("input").eq(1).val());
                if (input_septiembre < fecha_actual) {
                    $("#tr8").find("input").eq(2).addClass("red");
                } else {
                    var por_septiembre = $("#tr8").find("input").eq(2).val();
                    por_septiembre = parseFloat(por_septiembre);
                    var val_septiembre = mod_ventas * (por_septiembre / 100);
                    val_septiembre = parseInt(val_septiembre);
                    $("#tr8").find("input").eq(3).val(val_septiembre);
                    var venta_septiembre = $("#tr8").find("input").eq(4).val();
                    venta_septiembre = parseInt(venta_septiembre);
                    var garan_septiembre = $("#tr8").find("input").eq(5).val();
                    garan_septiembre = parseInt(garan_septiembre);
                    //Ingreso total
                    var total_septiembre = val_septiembre + venta_septiembre + garan_septiembre
                    var meta_septiembre = localStorage.getItem("meta");
                    meta_septiembre = parseFloat(meta_septiembre);
                    $("#tr8").find("input").eq(6).val(total_septiembre);
                    var pres_septiembre = parseFloat(total_septiembre * meta_septiembre)
                    $("#tr8").find("input").eq(7).val(pres_septiembre);
                }
                // octubre
                var input_octubre = new Date($("#tr9").find("input").eq(1).val());
                if (input_octubre < fecha_actual) {
                    $("#tr9").find("input").eq(2).addClass("red");
                } else {
                    var por_octubre = $("#tr9").find("input").eq(2).val();
                    por_octubre = parseFloat(por_octubre);
                    var val_octubre = mod_ventas * (por_octubre / 100);
                    val_octubre = parseInt(val_octubre);
                    $("#tr9").find("input").eq(3).val(val_octubre);
                    var venta_octubre = $("#tr9").find("input").eq(4).val();
                    venta_octubre = parseInt(venta_octubre);
                    var garan_octubre = $("#tr9").find("input").eq(5).val();
                    garan_octubre = parseInt(garan_octubre);
                    //Ingreso total
                    var total_octubre = val_octubre + venta_octubre + garan_octubre
                    var meta_octubre = localStorage.getItem("meta");
                    meta_octubre = parseFloat(meta_octubre);
                    $("#tr9").find("input").eq(6).val(total_octubre);
                    var pres_octubre = parseFloat(total_octubre * meta_octubre)
                    $("#tr9").find("input").eq(7).val(pres_octubre);
                }

                // noviembre
                var input_noviembre = new Date($("#tr10").find("input").eq(1).val());
                if (input_noviembre < fecha_actual) {
                    $("#tr10").find("input").eq(2).addClass("red");
                } else {
                    var por_noviembre = $("#tr10").find("input").eq(2).val();
                    por_noviembre = parseFloat(por_noviembre);
                    var val_noviembre = mod_ventas * (por_noviembre / 100);
                    val_noviembre = parseInt(val_noviembre);
                    $("#tr10").find("input").eq(3).val(val_noviembre);
                    var venta_noviembre = $("#tr10").find("input").eq(4).val();
                    venta_noviembre = parseInt(venta_noviembre);
                    var garan_noviembre = $("#tr10").find("input").eq(5).val();
                    garan_noviembre = parseInt(garan_noviembre);
                    //Ingreso total
                    var total_noviembre = val_noviembre + venta_noviembre + garan_noviembre
                    var meta_noviembre = localStorage.getItem("meta");
                    meta_noviembre = parseFloat(meta_noviembre);
                    $("#tr10").find("input").eq(6).val(total_noviembre);
                    var pres_noviembre = parseFloat(total_noviembre * meta_noviembre)
                    $("#tr10").find("input").eq(7).val(pres_noviembre);
                }

                // diciembre
                var input_diciembre = new Date($("#tr11").find("input").eq(1).val());
                if (input_diciembre < fecha_actual) {
                    $("#tr11").find("input").eq(2).addClass("red");
                } else {
                    var por_diciembre = $("#tr11").find("input").eq(2).val();
                    por_diciembre = parseFloat(por_diciembre);
                    var val_diciembre = mod_ventas * (por_diciembre / 100);
                    val_diciembre = parseInt(val_diciembre);
                    $("#tr11").find("input").eq(3).val(val_diciembre);
                    var venta_diciembre = $("#tr11").find("input").eq(4).val();
                    venta_diciembre = parseInt(venta_diciembre);
                    var garan_diciembre = $("#tr11").find("input").eq(5).val();
                    garan_diciembre = parseInt(garan_diciembre);
                    //Ingreso total
                    var total_diciembre = val_diciembre + venta_diciembre + garan_diciembre
                    var meta_diciembre = localStorage.getItem("meta");
                    meta_diciembre = parseFloat(meta_diciembre);
                    $("#tr11").find("input").eq(6).val(total_diciembre);
                    var pres_diciembre = parseFloat(total_diciembre * meta_diciembre)
                    $("#tr11").find("input").eq(7).val(pres_diciembre);
                }


            }
            if (promos != total_promos_mas) {
                $('#mod_promos_presupuesto').val(total_promos_mas);
                var mod_promos = total_promos_mas;
                mod_promos = parseInt(mod_promos);
                var mod_ventas = $('#mod_ventas_presupuesto').val();
                mod_ventas = parseInt(mod_ventas);
                var mod_garant = $('#mod_garantia_presupuesto').val();
                mod_garant = parseInt(mod_garant);
                $('#valorPromo').val(mod_promos);
                $('#valorVenta').val(mod_ventas);
                $('#valorGaran').val(mod_garant);
                $('#mod_total_presupuesto').val(mod_ventas + mod_garant + mod_promos);
                $('#valorTotal').val(mod_promos + mod_garant + mod_ventas);
                // ACTUALIZACMOS promos
                // Fecha actual del sistema
                var hoy = new Date();
                var tras = hoy.toLocaleDateString('en-US');
                var fecha_actual = new Date(tras);
                // Enero
                var input_enero = new Date($("#tr0").find("input").eq(1).val());
                if (input_enero < fecha_actual) {
                    $("#tr0").find("input").eq(2).addClass("red");
                } else {
                    var por_enero = $("#tr0").find("input").eq(2).val();
                    por_enero = parseFloat(por_enero);
                    var val_enero = mod_promos * (por_enero / 100);
                    val_enero = parseInt(val_enero);
                    $("#tr0").find("input").eq(4).val(val_enero);
                    var venta_enero = $("#tr0").find("input").eq(3).val();
                    venta_enero = parseInt(venta_enero);
                    var garan_enero = $("#tr0").find("input").eq(5).val();
                    garan_enero = parseInt(garan_enero);
                    //Ingreso total
                    var total_enero = val_enero + venta_enero + garan_enero
                    var meta_enero = localStorage.getItem("meta");
                    meta_enero = parseFloat(meta_enero);
                    $("#tr0").find("input").eq(6).val(total_enero);
                    var pres_enero = parseFloat(total_enero * meta_enero)
                    $("#tr0").find("input").eq(7).val(pres_enero);
                }

                // febrero
                var input_febrero = new Date($("#tr1").find("input").eq(1).val());
                if (input_febrero < fecha_actual) {
                    $("#tr1").find("input").eq(2).addClass("red");
                } else {
                    var por_febrero = $("#tr1").find("input").eq(2).val();
                    por_febrero = parseFloat(por_febrero);
                    var val_febrero = mod_promos * (por_febrero / 100);
                    val_febrero = parseInt(val_febrero);
                    $("#tr1").find("input").eq(4).val(val_febrero);
                    var venta_febrero = $("#tr1").find("input").eq(3).val();
                    venta_febrero = parseInt(venta_febrero);
                    var garan_febrero = $("#tr1").find("input").eq(5).val();
                    garan_febrero = parseInt(garan_febrero);
                    //Ingreso total
                    var total_febrero = val_febrero + venta_febrero + garan_febrero
                    var meta_febrero = localStorage.getItem("meta");
                    meta_febrero = parseFloat(meta_febrero);
                    $("#tr1").find("input").eq(6).val(total_febrero);
                    var pres_febrero = parseFloat(total_febrero * meta_febrero)
                    $("#tr1").find("input").eq(7).val(pres_febrero);
                }

                // marzo
                var input_marzo = new Date($("#tr2").find("input").eq(1).val());
                if (input_marzo < fecha_actual) {
                    $("#tr2").find("input").eq(2).addClass("red");
                } else {
                    var por_marzo = $("#tr2").find("input").eq(2).val();
                    por_marzo = parseFloat(por_marzo);
                    var val_marzo = mod_promos * (por_marzo / 100);
                    val_marzo = parseInt(val_marzo);
                    $("#tr2").find("input").eq(4).val(val_marzo);
                    var venta_marzo = $("#tr2").find("input").eq(3).val();
                    venta_marzo = parseInt(venta_marzo);
                    var garan_marzo = $("#tr2").find("input").eq(5).val();
                    garan_marzo = parseInt(garan_marzo);
                    //Ingreso total
                    var total_marzo = val_marzo + venta_marzo + garan_marzo
                    var meta_marzo = localStorage.getItem("meta");
                    meta_marzo = parseFloat(meta_marzo);
                    $("#tr2").find("input").eq(6).val(total_marzo);
                    var pres_marzo = parseFloat(total_marzo * meta_marzo)
                    $("#tr2").find("input").eq(7).val(pres_marzo);
                }

                // abril
                var input_abril = new Date($("#tr3").find("input").eq(1).val());
                if (input_abril < fecha_actual) {
                    $("#tr3").find("input").eq(2).addClass("red");
                } else {
                    var por_abril = $("#tr3").find("input").eq(2).val();
                    por_abril = parseFloat(por_abril);
                    var val_abril = mod_promos * (por_abril / 100);
                    val_abril = parseInt(val_abril);
                    $("#tr3").find("input").eq(4).val(val_abril);
                    var venta_abril = $("#tr3").find("input").eq(3).val();
                    venta_abril = parseInt(venta_abril);
                    var garan_abril = $("#tr3").find("input").eq(5).val();
                    garan_abril = parseInt(garan_abril);
                    //Ingreso total
                    var total_abril = val_abril + venta_abril + garan_abril
                    var meta_abril = localStorage.getItem("meta");
                    meta_abril = parseFloat(meta_abril);
                    $("#tr3").find("input").eq(6).val(total_abril);
                    var pres_abril = parseFloat(total_abril * meta_abril)
                    $("#tr3").find("input").eq(7).val(pres_abril);
                }

                // mayo
                var input_mayo = new Date($("#tr4").find("input").eq(1).val());
                if (input_mayo < fecha_actual) {
                    $("#tr4").find("input").eq(2).addClass("red");
                } else {
                    var por_mayo = $("#tr4").find("input").eq(2).val();
                    por_mayo = parseFloat(por_mayo);
                    var val_mayo = mod_promos * (por_mayo / 100);
                    val_mayo = parseInt(val_mayo);
                    $("#tr4").find("input").eq(4).val(val_mayo);
                    var venta_mayo = $("#tr4").find("input").eq(3).val();
                    venta_mayo = parseInt(venta_mayo);
                    var garan_mayo = $("#tr4").find("input").eq(5).val();
                    garan_mayo = parseInt(garan_mayo);
                    //Ingreso total
                    var total_mayo = val_mayo + venta_mayo + garan_mayo
                    var meta_mayo = localStorage.getItem("meta");
                    meta_mayo = parseFloat(meta_mayo);
                    $("#tr4").find("input").eq(6).val(total_mayo);
                    var pres_mayo = parseFloat(total_mayo * meta_mayo)
                    $("#tr4").find("input").eq(7).val(pres_mayo);
                }

                // junio
                var input_junio = new Date($("#tr5").find("input").eq(1).val());
                if (input_junio < fecha_actual) {
                    $("#tr5").find("input").eq(2).addClass("red");
                } else {
                    var por_junio = $("#tr5").find("input").eq(2).val();
                    por_junio = parseFloat(por_junio);
                    var val_junio = mod_promos * (por_junio / 100);
                    val_junio = parseInt(val_junio);
                    $("#tr5").find("input").eq(4).val(val_junio);
                    var venta_junio = $("#tr5").find("input").eq(3).val();
                    venta_junio = parseInt(venta_junio);
                    var garan_junio = $("#tr5").find("input").eq(5).val();
                    garan_junio = parseInt(garan_junio);
                    //Ingreso total
                    var total_junio = val_junio + venta_junio + garan_junio
                    var meta_junio = localStorage.getItem("meta");
                    meta_junio = parseFloat(meta_junio);
                    $("#tr5").find("input").eq(6).val(total_junio);
                    var pres_junio = parseFloat(total_junio * meta_junio)
                    $("#tr5").find("input").eq(7).val(pres_junio);
                }

                // julio
                var input_julio = new Date($("#tr6").find("input").eq(1).val());
                if (input_julio < fecha_actual) {
                    $("#tr6").find("input").eq(2).addClass("red");
                } else {
                    var por_julio = $("#tr6").find("input").eq(2).val();
                    por_julio = parseFloat(por_julio);
                    var val_julio = mod_promos * (por_julio / 100);
                    val_julio = parseInt(val_julio);
                    $("#tr6").find("input").eq(4).val(val_julio);
                    var venta_julio = $("#tr6").find("input").eq(3).val();
                    venta_julio = parseInt(venta_julio);
                    var garan_julio = $("#tr6").find("input").eq(5).val();
                    garan_julio = parseInt(garan_julio);
                    //Ingreso total
                    var total_julio = val_julio + venta_julio + garan_julio
                    var meta_julio = localStorage.getItem("meta");
                    meta_julio = parseFloat(meta_julio);
                    $("#tr6").find("input").eq(6).val(total_julio);
                    var pres_julio = parseFloat(total_julio * meta_julio)
                    $("#tr6").find("input").eq(7).val(pres_julio);
                }

                // agosto
                var input_agosto = new Date($("#tr7").find("input").eq(1).val());
                if (input_agosto < fecha_actual) {
                    $("#tr7").find("input").eq(2).addClass("red");
                } else {
                    var por_agosto = $("#tr7").find("input").eq(2).val();
                    por_agosto = parseFloat(por_agosto);
                    var val_agosto = mod_promos * (por_agosto / 100);
                    val_agosto = parseInt(val_agosto);
                    $("#tr7").find("input").eq(4).val(val_agosto);
                    var venta_agosto = $("#tr7").find("input").eq(3).val();
                    venta_agosto = parseInt(venta_agosto);
                    var garan_agosto = $("#tr7").find("input").eq(5).val();
                    garan_agosto = parseInt(garan_agosto);
                    //Ingreso total
                    var total_agosto = val_agosto + venta_agosto + garan_agosto
                    var meta_agosto = localStorage.getItem("meta");
                    meta_agosto = parseFloat(meta_agosto);
                    $("#tr7").find("input").eq(6).val(total_agosto);
                    var pres_agosto = parseFloat(total_agosto * meta_agosto)
                    $("#tr7").find("input").eq(7).val(pres_agosto);
                }

                // septiembre
                var input_septiembre = new Date($("#tr8").find("input").eq(1).val());
                if (input_septiembre < fecha_actual) {
                    $("#tr8").find("input").eq(2).addClass("red");
                } else {
                    var por_septiembre = $("#tr8").find("input").eq(2).val();
                    por_septiembre = parseFloat(por_septiembre);
                    var val_septiembre = mod_promos * (por_septiembre / 100);
                    val_septiembre = parseInt(val_septiembre);
                    $("#tr8").find("input").eq(4).val(val_septiembre);
                    var venta_septiembre = $("#tr8").find("input").eq(3).val();
                    venta_septiembre = parseInt(venta_septiembre);
                    var garan_septiembre = $("#tr8").find("input").eq(5).val();
                    garan_septiembre = parseInt(garan_septiembre);
                    //Ingreso total
                    var total_septiembre = val_septiembre + venta_septiembre + garan_septiembre
                    var meta_septiembre = localStorage.getItem("meta");
                    meta_septiembre = parseFloat(meta_septiembre);
                    $("#tr8").find("input").eq(6).val(total_septiembre);
                    var pres_septiembre = parseFloat(total_septiembre * meta_septiembre)
                    $("#tr8").find("input").eq(7).val(pres_septiembre);
                }
                // octubre
                var input_octubre = new Date($("#tr9").find("input").eq(1).val());
                if (input_octubre < fecha_actual) {
                    $("#tr9").find("input").eq(2).addClass("red");
                } else {
                    var por_octubre = $("#tr9").find("input").eq(2).val();
                    por_octubre = parseFloat(por_octubre);
                    var val_octubre = mod_promos * (por_octubre / 100);
                    val_octubre = parseInt(val_octubre);
                    $("#tr9").find("input").eq(4).val(val_octubre);
                    var venta_octubre = $("#tr9").find("input").eq(3).val();
                    venta_octubre = parseInt(venta_octubre);
                    var garan_octubre = $("#tr9").find("input").eq(5).val();
                    garan_octubre = parseInt(garan_octubre);
                    //Ingreso total
                    var total_octubre = val_octubre + venta_octubre + garan_octubre
                    var meta_octubre = localStorage.getItem("meta");
                    meta_octubre = parseFloat(meta_octubre);
                    $("#tr9").find("input").eq(6).val(total_octubre);
                    var pres_octubre = parseFloat(total_octubre * meta_octubre)
                    $("#tr9").find("input").eq(7).val(pres_octubre);
                }

                // noviembre
                var input_noviembre = new Date($("#tr10").find("input").eq(1).val());
                if (input_noviembre < fecha_actual) {
                    $("#tr10").find("input").eq(2).addClass("red");
                } else {
                    var por_noviembre = $("#tr10").find("input").eq(2).val();
                    por_noviembre = parseFloat(por_noviembre);
                    var val_noviembre = mod_promos * (por_noviembre / 100);
                    val_noviembre = parseInt(val_noviembre);
                    $("#tr10").find("input").eq(4).val(val_noviembre);
                    var venta_noviembre = $("#tr10").find("input").eq(3).val();
                    venta_noviembre = parseInt(venta_noviembre);
                    var garan_noviembre = $("#tr10").find("input").eq(5).val();
                    garan_noviembre = parseInt(garan_noviembre);
                    //Ingreso total
                    var total_noviembre = val_noviembre + venta_noviembre + garan_noviembre
                    var meta_noviembre = localStorage.getItem("meta");
                    meta_noviembre = parseFloat(meta_noviembre);
                    $("#tr10").find("input").eq(6).val(total_noviembre);
                    var pres_noviembre = parseFloat(total_noviembre * meta_noviembre)
                    $("#tr10").find("input").eq(7).val(pres_noviembre);
                }

                // diciembre
                var input_diciembre = new Date($("#tr11").find("input").eq(1).val());
                if (input_diciembre < fecha_actual) {
                    $("#tr11").find("input").eq(2).addClass("red");
                } else {
                    var por_diciembre = $("#tr11").find("input").eq(2).val();
                    por_diciembre = parseFloat(por_diciembre);
                    var val_diciembre = mod_promos * (por_diciembre / 100);
                    val_diciembre = parseInt(val_diciembre);
                    $("#tr11").find("input").eq(4).val(val_diciembre);
                    var venta_diciembre = $("#tr11").find("input").eq(3).val();
                    venta_diciembre = parseInt(venta_diciembre);
                    var garan_diciembre = $("#tr11").find("input").eq(5).val();
                    garan_diciembre = parseInt(garan_diciembre);
                    //Ingreso total
                    var total_diciembre = val_diciembre + venta_diciembre + garan_diciembre
                    var meta_diciembre = localStorage.getItem("meta");
                    meta_diciembre = parseFloat(meta_diciembre);
                    $("#tr11").find("input").eq(6).val(total_diciembre);
                    var pres_diciembre = parseFloat(total_diciembre * meta_diciembre)
                    $("#tr11").find("input").eq(7).val(pres_diciembre);
                }

            }
            if (garantias != total_garant_mas) {
                $('#mod_garantia_presupuesto').val(total_garant_mas);
                var mod_garantias = total_garant_mas;
                mod_garantias = parseInt(mod_garantias);
                var mod_ventas = $('#mod_ventas_presupuesto').val();
                mod_ventas = parseInt(mod_ventas);
                var mod_promos = $('#mod_promos_presupuesto').val();
                mod_promos = parseInt(mod_promos);
                $('#valorGaran').val(mod_garantias);
                $('#valorVenta').val(mod_ventas);
                $('#valorPromo').val(mod_promos);
                $('#mod_total_presupuesto').val(mod_ventas + mod_promos + mod_garantias);
                $('#valorTotal').val(mod_promos + mod_garantias + mod_ventas);
                // ACTUALIZACMOS promos
                // Fecha actual del sistema
                var hoy = new Date();
                var tras = hoy.toLocaleDateString('en-US');
                var fecha_actual = new Date(tras);
                // Enero
                var input_enero = new Date($("#tr0").find("input").eq(1).val());
                if (input_enero < fecha_actual) {
                    $("#tr0").find("input").eq(2).addClass("red");
                } else {
                    var por_enero = $("#tr0").find("input").eq(2).val();
                    por_enero = parseFloat(por_enero);
                    var val_enero = mod_garantias * (por_enero / 100);
                    val_enero = parseInt(val_enero);
                    $("#tr0").find("input").eq(5).val(val_enero);
                    var venta_enero = $("#tr0").find("input").eq(3).val();
                    venta_enero = parseInt(venta_enero);
                    var promos_enero = $("#tr0").find("input").eq(4).val();
                    promos_enero = parseInt(promos_enero);
                    //Ingreso total
                    var total_enero = val_enero + venta_enero + promos_enero
                    var meta_enero = localStorage.getItem("meta");
                    meta_enero = parseFloat(meta_enero);
                    $("#tr0").find("input").eq(6).val(total_enero);
                    var pres_enero = parseFloat(total_enero * meta_enero)
                    $("#tr0").find("input").eq(7).val(pres_enero);
                }

                // febrero
                var input_febrero = new Date($("#tr1").find("input").eq(1).val());
                if (input_febrero < fecha_actual) {
                    $("#tr1").find("input").eq(2).addClass("red");
                } else {
                    var por_febrero = $("#tr1").find("input").eq(2).val();
                    por_febrero = parseFloat(por_febrero);
                    var val_febrero = mod_garantias * (por_febrero / 100);
                    val_febrero = parseInt(val_febrero);
                    $("#tr1").find("input").eq(5).val(val_febrero);
                    var venta_febrero = $("#tr1").find("input").eq(3).val();
                    venta_febrero = parseInt(venta_febrero);
                    var promos_febrero = $("#tr1").find("input").eq(4).val();
                    promos_febrero = parseInt(promos_febrero);
                    //Ingreso total
                    var total_febrero = val_febrero + venta_febrero + promos_febrero
                    var meta_febrero = localStorage.getItem("meta");
                    meta_febrero = parseFloat(meta_febrero);
                    $("#tr1").find("input").eq(6).val(total_febrero);
                    var pres_febrero = parseFloat(total_febrero * meta_febrero)
                    $("#tr1").find("input").eq(7).val(pres_febrero);
                }

                // marzo
                var input_marzo = new Date($("#tr2").find("input").eq(1).val());
                if (input_marzo < fecha_actual) {
                    $("#tr2").find("input").eq(2).addClass("red");
                } else {
                    var por_marzo = $("#tr2").find("input").eq(2).val();
                    por_marzo = parseFloat(por_marzo);
                    var val_marzo = mod_garantias * (por_marzo / 100);
                    val_marzo = parseInt(val_marzo);
                    $("#tr2").find("input").eq(5).val(val_marzo);
                    var venta_marzo = $("#tr2").find("input").eq(3).val();
                    venta_marzo = parseInt(venta_marzo);
                    var promos_marzo = $("#tr2").find("input").eq(4).val();
                    promos_marzo = parseInt(promos_marzo);
                    //Ingreso total
                    var total_marzo = val_marzo + venta_marzo + promos_marzo
                    var meta_marzo = localStorage.getItem("meta");
                    meta_marzo = parseFloat(meta_marzo);
                    $("#tr2").find("input").eq(6).val(total_marzo);
                    var pres_marzo = parseFloat(total_marzo * meta_marzo)
                    $("#tr2").find("input").eq(7).val(pres_marzo);
                }

                // abril
                var input_abril = new Date($("#tr3").find("input").eq(1).val());
                if (input_abril < fecha_actual) {
                    $("#tr3").find("input").eq(2).addClass("red");
                } else {
                    var por_abril = $("#tr3").find("input").eq(2).val();
                    por_abril = parseFloat(por_abril);
                    var val_abril = mod_garantias * (por_abril / 100);
                    val_abril = parseInt(val_abril);
                    $("#tr3").find("input").eq(5).val(val_abril);
                    var venta_abril = $("#tr3").find("input").eq(3).val();
                    venta_abril = parseInt(venta_abril);
                    var promos_abril = $("#tr3").find("input").eq(4).val();
                    promos_abril = parseInt(promos_abril);
                    //Ingreso total
                    var total_abril = val_abril + venta_abril + promos_abril
                    var meta_abril = localStorage.getItem("meta");
                    meta_abril = parseFloat(meta_abril);
                    $("#tr3").find("input").eq(6).val(total_abril);
                    var pres_abril = parseFloat(total_abril * meta_abril)
                    $("#tr3").find("input").eq(7).val(pres_abril);
                }

                // mayo
                var input_mayo = new Date($("#tr4").find("input").eq(1).val());
                if (input_mayo < fecha_actual) {
                    $("#tr4").find("input").eq(2).addClass("red");
                } else {
                    var por_mayo = $("#tr4").find("input").eq(2).val();
                    por_mayo = parseFloat(por_mayo);
                    var val_mayo = mod_garantias * (por_mayo / 100);
                    val_mayo = parseInt(val_mayo);
                    $("#tr4").find("input").eq(5).val(val_mayo);
                    var venta_mayo = $("#tr4").find("input").eq(3).val();
                    venta_mayo = parseInt(venta_mayo);
                    var promos_mayo = $("#tr4").find("input").eq(4).val();
                    promos_mayo = parseInt(promos_mayo);
                    //Ingreso total
                    var total_mayo = val_mayo + venta_mayo + promos_mayo
                    var meta_mayo = localStorage.getItem("meta");
                    meta_mayo = parseFloat(meta_mayo);
                    $("#tr4").find("input").eq(6).val(total_mayo);
                    var pres_mayo = parseFloat(total_mayo * meta_mayo)
                    $("#tr4").find("input").eq(7).val(pres_mayo);
                }

                // junio
                var input_junio = new Date($("#tr5").find("input").eq(1).val());
                if (input_junio < fecha_actual) {
                    $("#tr5").find("input").eq(2).addClass("red");
                } else {
                    var por_junio = $("#tr5").find("input").eq(2).val();
                    por_junio = parseFloat(por_junio);
                    var val_junio = mod_garantias * (por_junio / 100);
                    val_junio = parseInt(val_junio);
                    $("#tr5").find("input").eq(5).val(val_junio);
                    var venta_junio = $("#tr5").find("input").eq(3).val();
                    venta_junio = parseInt(venta_junio);
                    var promos_junio = $("#tr5").find("input").eq(4).val();
                    promos_junio = parseInt(promos_junio);
                    //Ingreso total
                    var total_junio = val_junio + venta_junio + promos_junio
                    var meta_junio = localStorage.getItem("meta");
                    meta_junio = parseFloat(meta_junio);
                    $("#tr5").find("input").eq(6).val(total_junio);
                    var pres_junio = parseFloat(total_junio * meta_junio)
                    $("#tr5").find("input").eq(7).val(pres_junio);
                }

                // julio
                var input_julio = new Date($("#tr6").find("input").eq(1).val());
                if (input_julio < fecha_actual) {
                    $("#tr6").find("input").eq(2).addClass("red");
                } else {
                    var por_julio = $("#tr6").find("input").eq(2).val();
                    por_julio = parseFloat(por_julio);
                    var val_julio = mod_garantias * (por_julio / 100);
                    val_julio = parseInt(val_julio);
                    $("#tr6").find("input").eq(5).val(val_julio);
                    var venta_julio = $("#tr6").find("input").eq(3).val();
                    venta_julio = parseInt(venta_julio);
                    var promos_julio = $("#tr6").find("input").eq(4).val();
                    promos_julio = parseInt(promos_julio);
                    //Ingreso total
                    var total_julio = val_julio + venta_julio + promos_julio
                    var meta_julio = localStorage.getItem("meta");
                    meta_julio = parseFloat(meta_julio);
                    $("#tr6").find("input").eq(6).val(total_julio);
                    var pres_julio = parseFloat(total_julio * meta_julio)
                    $("#tr6").find("input").eq(7).val(pres_julio);
                }

                // agosto
                var input_agosto = new Date($("#tr7").find("input").eq(1).val());
                if (input_agosto < fecha_actual) {
                    $("#tr7").find("input").eq(2).addClass("red");
                } else {
                    var por_agosto = $("#tr7").find("input").eq(2).val();
                    por_agosto = parseFloat(por_agosto);
                    var val_agosto = mod_garantias * (por_agosto / 100);
                    val_agosto = parseInt(val_agosto);
                    $("#tr7").find("input").eq(5).val(val_agosto);
                    var venta_agosto = $("#tr7").find("input").eq(3).val();
                    venta_agosto = parseInt(venta_agosto);
                    var promos_agosto = $("#tr7").find("input").eq(4).val();
                    promos_agosto = parseInt(promos_agosto);
                    //Ingreso total
                    var total_agosto = val_agosto + venta_agosto + promos_agosto
                    var meta_agosto = localStorage.getItem("meta");
                    meta_agosto = parseFloat(meta_agosto);
                    $("#tr7").find("input").eq(6).val(total_agosto);
                    var pres_agosto = parseFloat(total_agosto * meta_agosto)
                    $("#tr7").find("input").eq(7).val(pres_agosto);
                }

                // septiembre
                var input_septiembre = new Date($("#tr8").find("input").eq(1).val());
                if (input_septiembre < fecha_actual) {
                    $("#tr8").find("input").eq(2).addClass("red");
                } else {
                    var por_septiembre = $("#tr8").find("input").eq(2).val();
                    por_septiembre = parseFloat(por_septiembre);
                    var val_septiembre = mod_garantias * (por_septiembre / 100);
                    val_septiembre = parseInt(val_septiembre);
                    $("#tr8").find("input").eq(5).val(val_septiembre);
                    var venta_septiembre = $("#tr8").find("input").eq(3).val();
                    venta_septiembre = parseInt(venta_septiembre);
                    var promos_septiembre = $("#tr8").find("input").eq(4).val();
                    promos_septiembre = parseInt(promos_septiembre);
                    //Ingreso total
                    var total_septiembre = val_septiembre + venta_septiembre + promos_septiembre
                    var meta_septiembre = localStorage.getItem("meta");
                    meta_septiembre = parseFloat(meta_septiembre);
                    $("#tr8").find("input").eq(6).val(total_septiembre);
                    var pres_septiembre = parseFloat(total_septiembre * meta_septiembre)
                    $("#tr8").find("input").eq(7).val(pres_septiembre);
                }
                // octubre
                var input_octubre = new Date($("#tr9").find("input").eq(1).val());
                if (input_octubre < fecha_actual) {
                    $("#tr9").find("input").eq(2).addClass("red");
                } else {
                    var por_octubre = $("#tr9").find("input").eq(2).val();
                    por_octubre = parseFloat(por_octubre);
                    var val_octubre = mod_garantias * (por_octubre / 100);
                    val_octubre = parseInt(val_octubre);
                    $("#tr9").find("input").eq(5).val(val_octubre);
                    var venta_octubre = $("#tr9").find("input").eq(3).val();
                    venta_octubre = parseInt(venta_octubre);
                    var promos_octubre = $("#tr9").find("input").eq(4).val();
                    promos_octubre = parseInt(promos_octubre);
                    //Ingreso total
                    var total_octubre = val_octubre + venta_octubre + promos_octubre
                    var meta_octubre = localStorage.getItem("meta");
                    meta_octubre = parseFloat(meta_octubre);
                    $("#tr9").find("input").eq(6).val(total_octubre);
                    var pres_octubre = parseFloat(total_octubre * meta_octubre)
                    $("#tr9").find("input").eq(7).val(pres_octubre);
                }

                // noviembre
                var input_noviembre = new Date($("#tr10").find("input").eq(1).val());
                if (input_noviembre < fecha_actual) {
                    $("#tr10").find("input").eq(2).addClass("red");
                } else {
                    var por_noviembre = $("#tr10").find("input").eq(2).val();
                    por_noviembre = parseFloat(por_noviembre);
                    var val_noviembre = mod_garantias * (por_noviembre / 100);
                    val_noviembre = parseInt(val_noviembre);
                    $("#tr10").find("input").eq(5).val(val_noviembre);
                    var venta_noviembre = $("#tr10").find("input").eq(3).val();
                    venta_noviembre = parseInt(venta_noviembre);
                    var promos_noviembre = $("#tr10").find("input").eq(4).val();
                    promos_noviembre = parseInt(promos_noviembre);
                    //Ingreso total
                    var total_noviembre = val_noviembre + venta_noviembre + promos_noviembre
                    var meta_noviembre = localStorage.getItem("meta");
                    meta_noviembre = parseFloat(meta_noviembre);
                    $("#tr10").find("input").eq(6).val(total_noviembre);
                    var pres_noviembre = parseFloat(total_noviembre * meta_noviembre)
                    $("#tr10").find("input").eq(7).val(pres_noviembre);
                }

                // diciembre
                var input_diciembre = new Date($("#tr11").find("input").eq(1).val());
                if (input_diciembre < fecha_actual) {
                    $("#tr11").find("input").eq(2).addClass("red");
                } else {
                    var por_diciembre = $("#tr11").find("input").eq(2).val();
                    por_diciembre = parseFloat(por_diciembre);
                    var val_diciembre = mod_garantias * (por_diciembre / 100);
                    val_diciembre = parseInt(val_diciembre);
                    $("#tr11").find("input").eq(5).val(val_diciembre);
                    var venta_diciembre = $("#tr11").find("input").eq(3).val();
                    venta_diciembre = parseInt(venta_diciembre);
                    var promos_diciembre = $("#tr11").find("input").eq(4).val();
                    promos_diciembre = parseInt(promos_diciembre);
                    //Ingreso total
                    var total_diciembre = val_diciembre + venta_diciembre + promos_diciembre
                    var meta_diciembre = localStorage.getItem("meta");
                    meta_diciembre = parseFloat(meta_diciembre);
                    $("#tr11").find("input").eq(6).val(total_diciembre);
                    var pres_diciembre = parseFloat(total_diciembre * meta_diciembre)
                    $("#tr11").find("input").eq(7).val(pres_diciembre);
                }

            }
        }
    });

    //DESBLOQUEAR
    $('#actualizar_cantidades').on('click', function() {
        //Actiuvar inputs ventas promos garantias
        var total = $("#tr0").find("input").eq(6).val();
        total = parseInt(total);
        var dolar = $("#tr0").find("input").eq(7).val();
        dolar = parseFloat(dolar);
        var meta = dolar / total;
        localStorage.setItem("meta", meta);
        $('#mod_ventas_presupuesto').attr("readonly", false);
        $('#mod_promos_presupuesto').attr("readonly", false);
        $('#mod_garantia_presupuesto').attr("readonly", false);
        $("#incremento_edicion").show();
        $("#icono_bloc").removeClass("fas fa-lock eliminar");
        $("#icono_bloc").addClass("fas fa-lock-open editar");
        var mod_ventas = $('#mod_ventas_presupuesto').val();
        localStorage.setItem("ventas", mod_ventas);
        var mod_promos = $('#mod_promos_presupuesto').val();
        localStorage.setItem("promos", mod_promos);
        var mod_garantias = $('#mod_garantia_presupuesto').val();
        localStorage.setItem("garantias", mod_garantias);
        var mod_total = $('#mod_total_presupuesto').val();
        localStorage.setItem("total", mod_total);

    });

    //Control de input Ventas
    $('#mod_ventas_presupuesto').on('input', function() {
        //Obtener valores de los dos inputs restantes
        var mod_ventas = $('#mod_ventas_presupuesto').val();
        mod_ventas = parseInt(mod_ventas);
        if (isNaN(mod_ventas)) {
            alert('Ingrese un valor mayor o igual a: 0');
        } else {
            var mod_promos = $('#mod_promos_presupuesto').val();
            mod_promos = parseInt(mod_promos);
            var mod_garant = $('#mod_garantia_presupuesto').val();
            mod_garant = parseInt(mod_garant);
            $('#valorVenta').val(mod_ventas);
            $('#valorPromo').val(mod_promos);
            $('#valorGaran').val(mod_garant);
            $('#mod_total_presupuesto').val(mod_promos + mod_garant + mod_ventas);
            $('#valorTotal').val(mod_promos + mod_garant + mod_ventas);

            // ACTUALIZACMOS VENTAS
            // Fecha actual del sistema
            var hoy = new Date();
            var tras = hoy.toLocaleDateString('en-US');
            var fecha_actual = new Date(tras);
            // Enero
            var input_enero = new Date($("#tr0").find("input").eq(1).val());
            if (input_enero < fecha_actual) {
                $("#tr0").find("input").eq(2).addClass("red");
            } else {
                var por_enero = $("#tr0").find("input").eq(2).val();
                por_enero = parseFloat(por_enero);
                var val_enero = mod_ventas * (por_enero / 100);
                val_enero = parseInt(val_enero);
                $("#tr0").find("input").eq(3).val(val_enero);
                var venta_enero = $("#tr0").find("input").eq(4).val();
                venta_enero = parseInt(venta_enero);
                var garan_enero = $("#tr0").find("input").eq(5).val();
                garan_enero = parseInt(garan_enero);
                //Ingreso total
                var total_enero = val_enero + venta_enero + garan_enero
                var meta_enero = localStorage.getItem("meta");
                meta_enero = parseFloat(meta_enero);
                $("#tr0").find("input").eq(6).val(total_enero);
                var pres_enero = parseFloat(total_enero * meta_enero)
                $("#tr0").find("input").eq(7).val(pres_enero);
            }

            // febrero
            var input_febrero = new Date($("#tr1").find("input").eq(1).val());
            if (input_febrero < fecha_actual) {
                $("#tr1").find("input").eq(2).addClass("red");
            } else {
                var por_febrero = $("#tr1").find("input").eq(2).val();
                por_febrero = parseFloat(por_febrero);
                var val_febrero = mod_ventas * (por_febrero / 100);
                val_febrero = parseInt(val_febrero);
                $("#tr1").find("input").eq(3).val(val_febrero);
                var venta_febrero = $("#tr1").find("input").eq(4).val();
                venta_febrero = parseInt(venta_febrero);
                var garan_febrero = $("#tr1").find("input").eq(5).val();
                garan_febrero = parseInt(garan_febrero);
                //Ingreso total
                var total_febrero = val_febrero + venta_febrero + garan_febrero
                var meta_febrero = localStorage.getItem("meta");
                meta_febrero = parseFloat(meta_febrero);
                $("#tr1").find("input").eq(6).val(total_febrero);
                var pres_febrero = parseFloat(total_febrero * meta_febrero)
                $("#tr1").find("input").eq(7).val(pres_febrero);
            }

            // marzo
            var input_marzo = new Date($("#tr2").find("input").eq(1).val());
            if (input_marzo < fecha_actual) {
                $("#tr2").find("input").eq(2).addClass("red");
            } else {
                var por_marzo = $("#tr2").find("input").eq(2).val();
                por_marzo = parseFloat(por_marzo);
                var val_marzo = mod_ventas * (por_marzo / 100);
                val_marzo = parseInt(val_marzo);
                $("#tr2").find("input").eq(3).val(val_marzo);
                var venta_marzo = $("#tr2").find("input").eq(4).val();
                venta_marzo = parseInt(venta_marzo);
                var garan_marzo = $("#tr2").find("input").eq(5).val();
                garan_marzo = parseInt(garan_marzo);
                //Ingreso total
                var total_marzo = val_marzo + venta_marzo + garan_marzo
                var meta_marzo = localStorage.getItem("meta");
                meta_marzo = parseFloat(meta_marzo);
                $("#tr2").find("input").eq(6).val(total_marzo);
                var pres_marzo = parseFloat(total_marzo * meta_marzo)
                $("#tr2").find("input").eq(7).val(pres_marzo);
            }

            // abril
            var input_abril = new Date($("#tr3").find("input").eq(1).val());
            if (input_abril < fecha_actual) {
                $("#tr3").find("input").eq(2).addClass("red");
            } else {
                var por_abril = $("#tr3").find("input").eq(2).val();
                por_abril = parseFloat(por_abril);
                var val_abril = mod_ventas * (por_abril / 100);
                val_abril = parseInt(val_abril);
                $("#tr3").find("input").eq(3).val(val_abril);
                var venta_abril = $("#tr3").find("input").eq(4).val();
                venta_abril = parseInt(venta_abril);
                var garan_abril = $("#tr3").find("input").eq(5).val();
                garan_abril = parseInt(garan_abril);
                //Ingreso total
                var total_abril = val_abril + venta_abril + garan_abril
                var meta_abril = localStorage.getItem("meta");
                meta_abril = parseFloat(meta_abril);
                $("#tr3").find("input").eq(6).val(total_abril);
                var pres_abril = parseFloat(total_abril * meta_abril)
                $("#tr3").find("input").eq(7).val(pres_abril);
            }

            // mayo
            var input_mayo = new Date($("#tr4").find("input").eq(1).val());
            if (input_mayo < fecha_actual) {
                $("#tr4").find("input").eq(2).addClass("red");
            } else {
                var por_mayo = $("#tr4").find("input").eq(2).val();
                por_mayo = parseFloat(por_mayo);
                var val_mayo = mod_ventas * (por_mayo / 100);
                val_mayo = parseInt(val_mayo);
                $("#tr4").find("input").eq(3).val(val_mayo);
                var venta_mayo = $("#tr4").find("input").eq(4).val();
                venta_mayo = parseInt(venta_mayo);
                var garan_mayo = $("#tr4").find("input").eq(5).val();
                garan_mayo = parseInt(garan_mayo);
                //Ingreso total
                var total_mayo = val_mayo + venta_mayo + garan_mayo
                var meta_mayo = localStorage.getItem("meta");
                meta_mayo = parseFloat(meta_mayo);
                $("#tr4").find("input").eq(6).val(total_mayo);
                var pres_mayo = parseFloat(total_mayo * meta_mayo)
                $("#tr4").find("input").eq(7).val(pres_mayo);
            }

            // junio
            var input_junio = new Date($("#tr5").find("input").eq(1).val());
            if (input_junio < fecha_actual) {
                $("#tr5").find("input").eq(2).addClass("red");
            } else {
                var por_junio = $("#tr5").find("input").eq(2).val();
                por_junio = parseFloat(por_junio);
                var val_junio = mod_ventas * (por_junio / 100);
                val_junio = parseInt(val_junio);
                $("#tr5").find("input").eq(3).val(val_junio);
                var venta_junio = $("#tr5").find("input").eq(4).val();
                venta_junio = parseInt(venta_junio);
                var garan_junio = $("#tr5").find("input").eq(5).val();
                garan_junio = parseInt(garan_junio);
                //Ingreso total
                var total_junio = val_junio + venta_junio + garan_junio
                var meta_junio = localStorage.getItem("meta");
                meta_junio = parseFloat(meta_junio);
                $("#tr5").find("input").eq(6).val(total_junio);
                var pres_junio = parseFloat(total_junio * meta_junio)
                $("#tr5").find("input").eq(7).val(pres_junio);
            }

            // julio
            var input_julio = new Date($("#tr6").find("input").eq(1).val());
            if (input_julio < fecha_actual) {
                $("#tr6").find("input").eq(2).addClass("red");
            } else {
                var por_julio = $("#tr6").find("input").eq(2).val();
                por_julio = parseFloat(por_julio);
                var val_julio = mod_ventas * (por_julio / 100);
                val_julio = parseInt(val_julio);
                $("#tr6").find("input").eq(3).val(val_julio);
                var venta_julio = $("#tr6").find("input").eq(4).val();
                venta_julio = parseInt(venta_julio);
                var garan_julio = $("#tr6").find("input").eq(5).val();
                garan_julio = parseInt(garan_julio);
                //Ingreso total
                var total_julio = val_julio + venta_julio + garan_julio
                var meta_julio = localStorage.getItem("meta");
                meta_julio = parseFloat(meta_julio);
                $("#tr6").find("input").eq(6).val(total_julio);
                var pres_julio = parseFloat(total_julio * meta_julio)
                $("#tr6").find("input").eq(7).val(pres_julio);
            }

            // agosto
            var input_agosto = new Date($("#tr7").find("input").eq(1).val());
            if (input_agosto < fecha_actual) {
                $("#tr7").find("input").eq(2).addClass("red");
            } else {
                var por_agosto = $("#tr7").find("input").eq(2).val();
                por_agosto = parseFloat(por_agosto);
                var val_agosto = mod_ventas * (por_agosto / 100);
                val_agosto = parseInt(val_agosto);
                $("#tr7").find("input").eq(3).val(val_agosto);
                var venta_agosto = $("#tr7").find("input").eq(4).val();
                venta_agosto = parseInt(venta_agosto);
                var garan_agosto = $("#tr7").find("input").eq(5).val();
                garan_agosto = parseInt(garan_agosto);
                //Ingreso total
                var total_agosto = val_agosto + venta_agosto + garan_agosto
                var meta_agosto = localStorage.getItem("meta");
                meta_agosto = parseFloat(meta_agosto);
                $("#tr7").find("input").eq(6).val(total_agosto);
                var pres_agosto = parseFloat(total_agosto * meta_agosto)
                $("#tr7").find("input").eq(7).val(pres_agosto);
            }

            // septiembre
            var input_septiembre = new Date($("#tr8").find("input").eq(1).val());
            if (input_septiembre < fecha_actual) {
                $("#tr8").find("input").eq(2).addClass("red");
            } else {
                var por_septiembre = $("#tr8").find("input").eq(2).val();
                por_septiembre = parseFloat(por_septiembre);
                var val_septiembre = mod_ventas * (por_septiembre / 100);
                val_septiembre = parseInt(val_septiembre);
                $("#tr8").find("input").eq(3).val(val_septiembre);
                var venta_septiembre = $("#tr8").find("input").eq(4).val();
                venta_septiembre = parseInt(venta_septiembre);
                var garan_septiembre = $("#tr8").find("input").eq(5).val();
                garan_septiembre = parseInt(garan_septiembre);
                //Ingreso total
                var total_septiembre = val_septiembre + venta_septiembre + garan_septiembre
                var meta_septiembre = localStorage.getItem("meta");
                meta_septiembre = parseFloat(meta_septiembre);
                $("#tr8").find("input").eq(6).val(total_septiembre);
                var pres_septiembre = parseFloat(total_septiembre * meta_septiembre)
                $("#tr8").find("input").eq(7).val(pres_septiembre);
            }
            // octubre
            var input_octubre = new Date($("#tr9").find("input").eq(1).val());
            if (input_octubre < fecha_actual) {
                $("#tr9").find("input").eq(2).addClass("red");
            } else {
                var por_octubre = $("#tr9").find("input").eq(2).val();
                por_octubre = parseFloat(por_octubre);
                var val_octubre = mod_ventas * (por_octubre / 100);
                val_octubre = parseInt(val_octubre);
                $("#tr9").find("input").eq(3).val(val_octubre);
                var venta_octubre = $("#tr9").find("input").eq(4).val();
                venta_octubre = parseInt(venta_octubre);
                var garan_octubre = $("#tr9").find("input").eq(5).val();
                garan_octubre = parseInt(garan_octubre);
                //Ingreso total
                var total_octubre = val_octubre + venta_octubre + garan_octubre
                var meta_octubre = localStorage.getItem("meta");
                meta_octubre = parseFloat(meta_octubre);
                $("#tr9").find("input").eq(6).val(total_octubre);
                var pres_octubre = parseFloat(total_octubre * meta_octubre)
                $("#tr9").find("input").eq(7).val(pres_octubre);
            }

            // noviembre
            var input_noviembre = new Date($("#tr10").find("input").eq(1).val());
            if (input_noviembre < fecha_actual) {
                $("#tr10").find("input").eq(2).addClass("red");
            } else {
                var por_noviembre = $("#tr10").find("input").eq(2).val();
                por_noviembre = parseFloat(por_noviembre);
                var val_noviembre = mod_ventas * (por_noviembre / 100);
                val_noviembre = parseInt(val_noviembre);
                $("#tr10").find("input").eq(3).val(val_noviembre);
                var venta_noviembre = $("#tr10").find("input").eq(4).val();
                venta_noviembre = parseInt(venta_noviembre);
                var garan_noviembre = $("#tr10").find("input").eq(5).val();
                garan_noviembre = parseInt(garan_noviembre);
                //Ingreso total
                var total_noviembre = val_noviembre + venta_noviembre + garan_noviembre
                var meta_noviembre = localStorage.getItem("meta");
                meta_noviembre = parseFloat(meta_noviembre);
                $("#tr10").find("input").eq(6).val(total_noviembre);
                var pres_noviembre = parseFloat(total_noviembre * meta_noviembre)
                $("#tr10").find("input").eq(7).val(pres_noviembre);
            }

            // diciembre
            var input_diciembre = new Date($("#tr11").find("input").eq(1).val());
            if (input_diciembre < fecha_actual) {
                $("#tr11").find("input").eq(2).addClass("red");
            } else {
                var por_diciembre = $("#tr11").find("input").eq(2).val();
                por_diciembre = parseFloat(por_diciembre);
                var val_diciembre = mod_ventas * (por_diciembre / 100);
                val_diciembre = parseInt(val_diciembre);
                $("#tr11").find("input").eq(3).val(val_diciembre);
                var venta_diciembre = $("#tr11").find("input").eq(4).val();
                venta_diciembre = parseInt(venta_diciembre);
                var garan_diciembre = $("#tr11").find("input").eq(5).val();
                garan_diciembre = parseInt(garan_diciembre);
                //Ingreso total
                var total_diciembre = val_diciembre + venta_diciembre + garan_diciembre
                var meta_diciembre = localStorage.getItem("meta");
                meta_diciembre = parseFloat(meta_diciembre);
                $("#tr11").find("input").eq(6).val(total_diciembre);
                var pres_diciembre = parseFloat(total_diciembre * meta_diciembre)
                $("#tr11").find("input").eq(7).val(pres_diciembre);
            }

        }
    });
    //Control de input promos
    $('#mod_promos_presupuesto').on('input', function() {
        //Obtener valores de los dos inputs restantes
        var mod_promos = $('#mod_promos_presupuesto').val();
        mod_promos = parseInt(mod_promos);
        if (isNaN(mod_promos)) {
            alert('Ingrese un valor mayor o igual a: 0');
        } else {
            var mod_ventas = $('#mod_ventas_presupuesto').val();
            mod_ventas = parseInt(mod_ventas);
            var mod_garant = $('#mod_garantia_presupuesto').val();
            mod_garant = parseInt(mod_garant);
            $('#valorPromo').val(mod_promos);
            $('#valorVenta').val(mod_ventas);
            $('#valorGaran').val(mod_garant);
            $('#mod_total_presupuesto').val(mod_ventas + mod_garant + mod_promos);
            $('#valorTotal').val(mod_promos + mod_garant + mod_ventas);
            // ACTUALIZACMOS promos
            // Fecha actual del sistema
            var hoy = new Date();
            var tras = hoy.toLocaleDateString('en-US');
            var fecha_actual = new Date(tras);
            // Enero
            var input_enero = new Date($("#tr0").find("input").eq(1).val());
            if (input_enero < fecha_actual) {
                $("#tr0").find("input").eq(2).addClass("red");
            } else {
                var por_enero = $("#tr0").find("input").eq(2).val();
                por_enero = parseFloat(por_enero);
                var val_enero = mod_promos * (por_enero / 100);
                val_enero = parseInt(val_enero);
                $("#tr0").find("input").eq(4).val(val_enero);
                var venta_enero = $("#tr0").find("input").eq(3).val();
                venta_enero = parseInt(venta_enero);
                var garan_enero = $("#tr0").find("input").eq(5).val();
                garan_enero = parseInt(garan_enero);
                //Ingreso total
                var total_enero = val_enero + venta_enero + garan_enero
                var meta_enero = localStorage.getItem("meta");
                meta_enero = parseFloat(meta_enero);
                $("#tr0").find("input").eq(6).val(total_enero);
                var pres_enero = parseFloat(total_enero * meta_enero)
                $("#tr0").find("input").eq(7).val(pres_enero);
            }

            // febrero
            var input_febrero = new Date($("#tr1").find("input").eq(1).val());
            if (input_febrero < fecha_actual) {
                $("#tr1").find("input").eq(2).addClass("red");
            } else {
                var por_febrero = $("#tr1").find("input").eq(2).val();
                por_febrero = parseFloat(por_febrero);
                var val_febrero = mod_promos * (por_febrero / 100);
                val_febrero = parseInt(val_febrero);
                $("#tr1").find("input").eq(4).val(val_febrero);
                var venta_febrero = $("#tr1").find("input").eq(3).val();
                venta_febrero = parseInt(venta_febrero);
                var garan_febrero = $("#tr1").find("input").eq(5).val();
                garan_febrero = parseInt(garan_febrero);
                //Ingreso total
                var total_febrero = val_febrero + venta_febrero + garan_febrero
                var meta_febrero = localStorage.getItem("meta");
                meta_febrero = parseFloat(meta_febrero);
                $("#tr1").find("input").eq(6).val(total_febrero);
                var pres_febrero = parseFloat(total_febrero * meta_febrero)
                $("#tr1").find("input").eq(7).val(pres_febrero);
            }

            // marzo
            var input_marzo = new Date($("#tr2").find("input").eq(1).val());
            if (input_marzo < fecha_actual) {
                $("#tr2").find("input").eq(2).addClass("red");
            } else {
                var por_marzo = $("#tr2").find("input").eq(2).val();
                por_marzo = parseFloat(por_marzo);
                var val_marzo = mod_promos * (por_marzo / 100);
                val_marzo = parseInt(val_marzo);
                $("#tr2").find("input").eq(4).val(val_marzo);
                var venta_marzo = $("#tr2").find("input").eq(3).val();
                venta_marzo = parseInt(venta_marzo);
                var garan_marzo = $("#tr2").find("input").eq(5).val();
                garan_marzo = parseInt(garan_marzo);
                //Ingreso total
                var total_marzo = val_marzo + venta_marzo + garan_marzo
                var meta_marzo = localStorage.getItem("meta");
                meta_marzo = parseFloat(meta_marzo);
                $("#tr2").find("input").eq(6).val(total_marzo);
                var pres_marzo = parseFloat(total_marzo * meta_marzo)
                $("#tr2").find("input").eq(7).val(pres_marzo);
            }

            // abril
            var input_abril = new Date($("#tr3").find("input").eq(1).val());
            if (input_abril < fecha_actual) {
                $("#tr3").find("input").eq(2).addClass("red");
            } else {
                var por_abril = $("#tr3").find("input").eq(2).val();
                por_abril = parseFloat(por_abril);
                var val_abril = mod_promos * (por_abril / 100);
                val_abril = parseInt(val_abril);
                $("#tr3").find("input").eq(4).val(val_abril);
                var venta_abril = $("#tr3").find("input").eq(3).val();
                venta_abril = parseInt(venta_abril);
                var garan_abril = $("#tr3").find("input").eq(5).val();
                garan_abril = parseInt(garan_abril);
                //Ingreso total
                var total_abril = val_abril + venta_abril + garan_abril
                var meta_abril = localStorage.getItem("meta");
                meta_abril = parseFloat(meta_abril);
                $("#tr3").find("input").eq(6).val(total_abril);
                var pres_abril = parseFloat(total_abril * meta_abril)
                $("#tr3").find("input").eq(7).val(pres_abril);
            }

            // mayo
            var input_mayo = new Date($("#tr4").find("input").eq(1).val());
            if (input_mayo < fecha_actual) {
                $("#tr4").find("input").eq(2).addClass("red");
            } else {
                var por_mayo = $("#tr4").find("input").eq(2).val();
                por_mayo = parseFloat(por_mayo);
                var val_mayo = mod_promos * (por_mayo / 100);
                val_mayo = parseInt(val_mayo);
                $("#tr4").find("input").eq(4).val(val_mayo);
                var venta_mayo = $("#tr4").find("input").eq(3).val();
                venta_mayo = parseInt(venta_mayo);
                var garan_mayo = $("#tr4").find("input").eq(5).val();
                garan_mayo = parseInt(garan_mayo);
                //Ingreso total
                var total_mayo = val_mayo + venta_mayo + garan_mayo
                var meta_mayo = localStorage.getItem("meta");
                meta_mayo = parseFloat(meta_mayo);
                $("#tr4").find("input").eq(6).val(total_mayo);
                var pres_mayo = parseFloat(total_mayo * meta_mayo)
                $("#tr4").find("input").eq(7).val(pres_mayo);
            }

            // junio
            var input_junio = new Date($("#tr5").find("input").eq(1).val());
            if (input_junio < fecha_actual) {
                $("#tr5").find("input").eq(2).addClass("red");
            } else {
                var por_junio = $("#tr5").find("input").eq(2).val();
                por_junio = parseFloat(por_junio);
                var val_junio = mod_promos * (por_junio / 100);
                val_junio = parseInt(val_junio);
                $("#tr5").find("input").eq(4).val(val_junio);
                var venta_junio = $("#tr5").find("input").eq(3).val();
                venta_junio = parseInt(venta_junio);
                var garan_junio = $("#tr5").find("input").eq(5).val();
                garan_junio = parseInt(garan_junio);
                //Ingreso total
                var total_junio = val_junio + venta_junio + garan_junio
                var meta_junio = localStorage.getItem("meta");
                meta_junio = parseFloat(meta_junio);
                $("#tr5").find("input").eq(6).val(total_junio);
                var pres_junio = parseFloat(total_junio * meta_junio)
                $("#tr5").find("input").eq(7).val(pres_junio);
            }

            // julio
            var input_julio = new Date($("#tr6").find("input").eq(1).val());
            if (input_julio < fecha_actual) {
                $("#tr6").find("input").eq(2).addClass("red");
            } else {
                var por_julio = $("#tr6").find("input").eq(2).val();
                por_julio = parseFloat(por_julio);
                var val_julio = mod_promos * (por_julio / 100);
                val_julio = parseInt(val_julio);
                $("#tr6").find("input").eq(4).val(val_julio);
                var venta_julio = $("#tr6").find("input").eq(3).val();
                venta_julio = parseInt(venta_julio);
                var garan_julio = $("#tr6").find("input").eq(5).val();
                garan_julio = parseInt(garan_julio);
                //Ingreso total
                var total_julio = val_julio + venta_julio + garan_julio
                var meta_julio = localStorage.getItem("meta");
                meta_julio = parseFloat(meta_julio);
                $("#tr6").find("input").eq(6).val(total_julio);
                var pres_julio = parseFloat(total_julio * meta_julio)
                $("#tr6").find("input").eq(7).val(pres_julio);
            }

            // agosto
            var input_agosto = new Date($("#tr7").find("input").eq(1).val());
            if (input_agosto < fecha_actual) {
                $("#tr7").find("input").eq(2).addClass("red");
            } else {
                var por_agosto = $("#tr7").find("input").eq(2).val();
                por_agosto = parseFloat(por_agosto);
                var val_agosto = mod_promos * (por_agosto / 100);
                val_agosto = parseInt(val_agosto);
                $("#tr7").find("input").eq(4).val(val_agosto);
                var venta_agosto = $("#tr7").find("input").eq(3).val();
                venta_agosto = parseInt(venta_agosto);
                var garan_agosto = $("#tr7").find("input").eq(5).val();
                garan_agosto = parseInt(garan_agosto);
                //Ingreso total
                var total_agosto = val_agosto + venta_agosto + garan_agosto
                var meta_agosto = localStorage.getItem("meta");
                meta_agosto = parseFloat(meta_agosto);
                $("#tr7").find("input").eq(6).val(total_agosto);
                var pres_agosto = parseFloat(total_agosto * meta_agosto)
                $("#tr7").find("input").eq(7).val(pres_agosto);
            }

            // septiembre
            var input_septiembre = new Date($("#tr8").find("input").eq(1).val());
            if (input_septiembre < fecha_actual) {
                $("#tr8").find("input").eq(2).addClass("red");
            } else {
                var por_septiembre = $("#tr8").find("input").eq(2).val();
                por_septiembre = parseFloat(por_septiembre);
                var val_septiembre = mod_promos * (por_septiembre / 100);
                val_septiembre = parseInt(val_septiembre);
                $("#tr8").find("input").eq(4).val(val_septiembre);
                var venta_septiembre = $("#tr8").find("input").eq(3).val();
                venta_septiembre = parseInt(venta_septiembre);
                var garan_septiembre = $("#tr8").find("input").eq(5).val();
                garan_septiembre = parseInt(garan_septiembre);
                //Ingreso total
                var total_septiembre = val_septiembre + venta_septiembre + garan_septiembre
                var meta_septiembre = localStorage.getItem("meta");
                meta_septiembre = parseFloat(meta_septiembre);
                $("#tr8").find("input").eq(6).val(total_septiembre);
                var pres_septiembre = parseFloat(total_septiembre * meta_septiembre)
                $("#tr8").find("input").eq(7).val(pres_septiembre);
            }
            // octubre
            var input_octubre = new Date($("#tr9").find("input").eq(1).val());
            if (input_octubre < fecha_actual) {
                $("#tr9").find("input").eq(2).addClass("red");
            } else {
                var por_octubre = $("#tr9").find("input").eq(2).val();
                por_octubre = parseFloat(por_octubre);
                var val_octubre = mod_promos * (por_octubre / 100);
                val_octubre = parseInt(val_octubre);
                $("#tr9").find("input").eq(4).val(val_octubre);
                var venta_octubre = $("#tr9").find("input").eq(3).val();
                venta_octubre = parseInt(venta_octubre);
                var garan_octubre = $("#tr9").find("input").eq(5).val();
                garan_octubre = parseInt(garan_octubre);
                //Ingreso total
                var total_octubre = val_octubre + venta_octubre + garan_octubre
                var meta_octubre = localStorage.getItem("meta");
                meta_octubre = parseFloat(meta_octubre);
                $("#tr9").find("input").eq(6).val(total_octubre);
                var pres_octubre = parseFloat(total_octubre * meta_octubre)
                $("#tr9").find("input").eq(7).val(pres_octubre);
            }

            // noviembre
            var input_noviembre = new Date($("#tr10").find("input").eq(1).val());
            if (input_noviembre < fecha_actual) {
                $("#tr10").find("input").eq(2).addClass("red");
            } else {
                var por_noviembre = $("#tr10").find("input").eq(2).val();
                por_noviembre = parseFloat(por_noviembre);
                var val_noviembre = mod_promos * (por_noviembre / 100);
                val_noviembre = parseInt(val_noviembre);
                $("#tr10").find("input").eq(4).val(val_noviembre);
                var venta_noviembre = $("#tr10").find("input").eq(3).val();
                venta_noviembre = parseInt(venta_noviembre);
                var garan_noviembre = $("#tr10").find("input").eq(5).val();
                garan_noviembre = parseInt(garan_noviembre);
                //Ingreso total
                var total_noviembre = val_noviembre + venta_noviembre + garan_noviembre
                var meta_noviembre = localStorage.getItem("meta");
                meta_noviembre = parseFloat(meta_noviembre);
                $("#tr10").find("input").eq(6).val(total_noviembre);
                var pres_noviembre = parseFloat(total_noviembre * meta_noviembre)
                $("#tr10").find("input").eq(7).val(pres_noviembre);
            }

            // diciembre
            var input_diciembre = new Date($("#tr11").find("input").eq(1).val());
            if (input_diciembre < fecha_actual) {
                $("#tr11").find("input").eq(2).addClass("red");
            } else {
                var por_diciembre = $("#tr11").find("input").eq(2).val();
                por_diciembre = parseFloat(por_diciembre);
                var val_diciembre = mod_promos * (por_diciembre / 100);
                val_diciembre = parseInt(val_diciembre);
                $("#tr11").find("input").eq(4).val(val_diciembre);
                var venta_diciembre = $("#tr11").find("input").eq(3).val();
                venta_diciembre = parseInt(venta_diciembre);
                var garan_diciembre = $("#tr11").find("input").eq(5).val();
                garan_diciembre = parseInt(garan_diciembre);
                //Ingreso total
                var total_diciembre = val_diciembre + venta_diciembre + garan_diciembre
                var meta_diciembre = localStorage.getItem("meta");
                meta_diciembre = parseFloat(meta_diciembre);
                $("#tr11").find("input").eq(6).val(total_diciembre);
                var pres_diciembre = parseFloat(total_diciembre * meta_diciembre)
                $("#tr11").find("input").eq(7).val(pres_diciembre);
            }

        }

    });

    //Control de input garantias
    $('#mod_garantia_presupuesto').on('input', function() {
        //Obtener valores de los dos inputs restantes
        var mod_garantias = $('#mod_garantia_presupuesto').val();
        mod_garantias = parseInt(mod_garantias);
        if (isNaN(mod_garantias)) {
            alert('Ingrese un valor mayor o igual a: 0');
        } else {
            var mod_ventas = $('#mod_ventas_presupuesto').val();
            mod_ventas = parseInt(mod_ventas);
            var mod_promos = $('#mod_promos_presupuesto').val();
            mod_promos = parseInt(mod_promos);
            $('#valorGaran').val(mod_garantias);
            $('#valorVenta').val(mod_ventas);
            $('#valorPromo').val(mod_promos);
            $('#mod_total_presupuesto').val(mod_ventas + mod_promos + mod_garantias);
            $('#valorTotal').val(mod_promos + mod_garantias + mod_ventas);
            // ACTUALIZACMOS promos
            // Fecha actual del sistema
            var hoy = new Date();
            var tras = hoy.toLocaleDateString('en-US');
            var fecha_actual = new Date(tras);
            // Enero
            var input_enero = new Date($("#tr0").find("input").eq(1).val());
            if (input_enero < fecha_actual) {
                $("#tr0").find("input").eq(2).addClass("red");
            } else {
                var por_enero = $("#tr0").find("input").eq(2).val();
                por_enero = parseFloat(por_enero);
                var val_enero = mod_garantias * (por_enero / 100);
                val_enero = parseInt(val_enero);
                $("#tr0").find("input").eq(5).val(val_enero);
                var venta_enero = $("#tr0").find("input").eq(3).val();
                venta_enero = parseInt(venta_enero);
                var promos_enero = $("#tr0").find("input").eq(4).val();
                promos_enero = parseInt(promos_enero);
                //Ingreso total
                var total_enero = val_enero + venta_enero + promos_enero
                var meta_enero = localStorage.getItem("meta");
                meta_enero = parseFloat(meta_enero);
                $("#tr0").find("input").eq(6).val(total_enero);
                var pres_enero = parseFloat(total_enero * meta_enero)
                $("#tr0").find("input").eq(7).val(pres_enero);
            }

            // febrero
            var input_febrero = new Date($("#tr1").find("input").eq(1).val());
            if (input_febrero < fecha_actual) {
                $("#tr1").find("input").eq(2).addClass("red");
            } else {
                var por_febrero = $("#tr1").find("input").eq(2).val();
                por_febrero = parseFloat(por_febrero);
                var val_febrero = mod_garantias * (por_febrero / 100);
                val_febrero = parseInt(val_febrero);
                $("#tr1").find("input").eq(5).val(val_febrero);
                var venta_febrero = $("#tr1").find("input").eq(3).val();
                venta_febrero = parseInt(venta_febrero);
                var promos_febrero = $("#tr1").find("input").eq(4).val();
                promos_febrero = parseInt(promos_febrero);
                //Ingreso total
                var total_febrero = val_febrero + venta_febrero + promos_febrero
                var meta_febrero = localStorage.getItem("meta");
                meta_febrero = parseFloat(meta_febrero);
                $("#tr1").find("input").eq(6).val(total_febrero);
                var pres_febrero = parseFloat(total_febrero * meta_febrero)
                $("#tr1").find("input").eq(7).val(pres_febrero);
            }

            // marzo
            var input_marzo = new Date($("#tr2").find("input").eq(1).val());
            if (input_marzo < fecha_actual) {
                $("#tr2").find("input").eq(2).addClass("red");
            } else {
                var por_marzo = $("#tr2").find("input").eq(2).val();
                por_marzo = parseFloat(por_marzo);
                var val_marzo = mod_garantias * (por_marzo / 100);
                val_marzo = parseInt(val_marzo);
                $("#tr2").find("input").eq(5).val(val_marzo);
                var venta_marzo = $("#tr2").find("input").eq(3).val();
                venta_marzo = parseInt(venta_marzo);
                var promos_marzo = $("#tr2").find("input").eq(4).val();
                promos_marzo = parseInt(promos_marzo);
                //Ingreso total
                var total_marzo = val_marzo + venta_marzo + promos_marzo
                var meta_marzo = localStorage.getItem("meta");
                meta_marzo = parseFloat(meta_marzo);
                $("#tr2").find("input").eq(6).val(total_marzo);
                var pres_marzo = parseFloat(total_marzo * meta_marzo)
                $("#tr2").find("input").eq(7).val(pres_marzo);
            }

            // abril
            var input_abril = new Date($("#tr3").find("input").eq(1).val());
            if (input_abril < fecha_actual) {
                $("#tr3").find("input").eq(2).addClass("red");
            } else {
                var por_abril = $("#tr3").find("input").eq(2).val();
                por_abril = parseFloat(por_abril);
                var val_abril = mod_garantias * (por_abril / 100);
                val_abril = parseInt(val_abril);
                $("#tr3").find("input").eq(5).val(val_abril);
                var venta_abril = $("#tr3").find("input").eq(3).val();
                venta_abril = parseInt(venta_abril);
                var promos_abril = $("#tr3").find("input").eq(4).val();
                promos_abril = parseInt(promos_abril);
                //Ingreso total
                var total_abril = val_abril + venta_abril + promos_abril
                var meta_abril = localStorage.getItem("meta");
                meta_abril = parseFloat(meta_abril);
                $("#tr3").find("input").eq(6).val(total_abril);
                var pres_abril = parseFloat(total_abril * meta_abril)
                $("#tr3").find("input").eq(7).val(pres_abril);
            }

            // mayo
            var input_mayo = new Date($("#tr4").find("input").eq(1).val());
            if (input_mayo < fecha_actual) {
                $("#tr4").find("input").eq(2).addClass("red");
            } else {
                var por_mayo = $("#tr4").find("input").eq(2).val();
                por_mayo = parseFloat(por_mayo);
                var val_mayo = mod_garantias * (por_mayo / 100);
                val_mayo = parseInt(val_mayo);
                $("#tr4").find("input").eq(5).val(val_mayo);
                var venta_mayo = $("#tr4").find("input").eq(3).val();
                venta_mayo = parseInt(venta_mayo);
                var promos_mayo = $("#tr4").find("input").eq(4).val();
                promos_mayo = parseInt(promos_mayo);
                //Ingreso total
                var total_mayo = val_mayo + venta_mayo + promos_mayo
                var meta_mayo = localStorage.getItem("meta");
                meta_mayo = parseFloat(meta_mayo);
                $("#tr4").find("input").eq(6).val(total_mayo);
                var pres_mayo = parseFloat(total_mayo * meta_mayo)
                $("#tr4").find("input").eq(7).val(pres_mayo);
            }

            // junio
            var input_junio = new Date($("#tr5").find("input").eq(1).val());
            if (input_junio < fecha_actual) {
                $("#tr5").find("input").eq(2).addClass("red");
            } else {
                var por_junio = $("#tr5").find("input").eq(2).val();
                por_junio = parseFloat(por_junio);
                var val_junio = mod_garantias * (por_junio / 100);
                val_junio = parseInt(val_junio);
                $("#tr5").find("input").eq(5).val(val_junio);
                var venta_junio = $("#tr5").find("input").eq(3).val();
                venta_junio = parseInt(venta_junio);
                var promos_junio = $("#tr5").find("input").eq(4).val();
                promos_junio = parseInt(promos_junio);
                //Ingreso total
                var total_junio = val_junio + venta_junio + promos_junio
                var meta_junio = localStorage.getItem("meta");
                meta_junio = parseFloat(meta_junio);
                $("#tr5").find("input").eq(6).val(total_junio);
                var pres_junio = parseFloat(total_junio * meta_junio)
                $("#tr5").find("input").eq(7).val(pres_junio);
            }

            // julio
            var input_julio = new Date($("#tr6").find("input").eq(1).val());
            if (input_julio < fecha_actual) {
                $("#tr6").find("input").eq(2).addClass("red");
            } else {
                var por_julio = $("#tr6").find("input").eq(2).val();
                por_julio = parseFloat(por_julio);
                var val_julio = mod_garantias * (por_julio / 100);
                val_julio = parseInt(val_julio);
                $("#tr6").find("input").eq(5).val(val_julio);
                var venta_julio = $("#tr6").find("input").eq(3).val();
                venta_julio = parseInt(venta_julio);
                var promos_julio = $("#tr6").find("input").eq(4).val();
                promos_julio = parseInt(promos_julio);
                //Ingreso total
                var total_julio = val_julio + venta_julio + promos_julio
                var meta_julio = localStorage.getItem("meta");
                meta_julio = parseFloat(meta_julio);
                $("#tr6").find("input").eq(6).val(total_julio);
                var pres_julio = parseFloat(total_julio * meta_julio)
                $("#tr6").find("input").eq(7).val(pres_julio);
            }

            // agosto
            var input_agosto = new Date($("#tr7").find("input").eq(1).val());
            if (input_agosto < fecha_actual) {
                $("#tr7").find("input").eq(2).addClass("red");
            } else {
                var por_agosto = $("#tr7").find("input").eq(2).val();
                por_agosto = parseFloat(por_agosto);
                var val_agosto = mod_garantias * (por_agosto / 100);
                val_agosto = parseInt(val_agosto);
                $("#tr7").find("input").eq(5).val(val_agosto);
                var venta_agosto = $("#tr7").find("input").eq(3).val();
                venta_agosto = parseInt(venta_agosto);
                var promos_agosto = $("#tr7").find("input").eq(4).val();
                promos_agosto = parseInt(promos_agosto);
                //Ingreso total
                var total_agosto = val_agosto + venta_agosto + promos_agosto
                var meta_agosto = localStorage.getItem("meta");
                meta_agosto = parseFloat(meta_agosto);
                $("#tr7").find("input").eq(6).val(total_agosto);
                var pres_agosto = parseFloat(total_agosto * meta_agosto)
                $("#tr7").find("input").eq(7).val(pres_agosto);
            }

            // septiembre
            var input_septiembre = new Date($("#tr8").find("input").eq(1).val());
            if (input_septiembre < fecha_actual) {
                $("#tr8").find("input").eq(2).addClass("red");
            } else {
                var por_septiembre = $("#tr8").find("input").eq(2).val();
                por_septiembre = parseFloat(por_septiembre);
                var val_septiembre = mod_garantias * (por_septiembre / 100);
                val_septiembre = parseInt(val_septiembre);
                $("#tr8").find("input").eq(5).val(val_septiembre);
                var venta_septiembre = $("#tr8").find("input").eq(3).val();
                venta_septiembre = parseInt(venta_septiembre);
                var promos_septiembre = $("#tr8").find("input").eq(4).val();
                promos_septiembre = parseInt(promos_septiembre);
                //Ingreso total
                var total_septiembre = val_septiembre + venta_septiembre + promos_septiembre
                var meta_septiembre = localStorage.getItem("meta");
                meta_septiembre = parseFloat(meta_septiembre);
                $("#tr8").find("input").eq(6).val(total_septiembre);
                var pres_septiembre = parseFloat(total_septiembre * meta_septiembre)
                $("#tr8").find("input").eq(7).val(pres_septiembre);
            }
            // octubre
            var input_octubre = new Date($("#tr9").find("input").eq(1).val());
            if (input_octubre < fecha_actual) {
                $("#tr9").find("input").eq(2).addClass("red");
            } else {
                var por_octubre = $("#tr9").find("input").eq(2).val();
                por_octubre = parseFloat(por_octubre);
                var val_octubre = mod_garantias * (por_octubre / 100);
                val_octubre = parseInt(val_octubre);
                $("#tr9").find("input").eq(5).val(val_octubre);
                var venta_octubre = $("#tr9").find("input").eq(3).val();
                venta_octubre = parseInt(venta_octubre);
                var promos_octubre = $("#tr9").find("input").eq(4).val();
                promos_octubre = parseInt(promos_octubre);
                //Ingreso total
                var total_octubre = val_octubre + venta_octubre + promos_octubre
                var meta_octubre = localStorage.getItem("meta");
                meta_octubre = parseFloat(meta_octubre);
                $("#tr9").find("input").eq(6).val(total_octubre);
                var pres_octubre = parseFloat(total_octubre * meta_octubre)
                $("#tr9").find("input").eq(7).val(pres_octubre);
            }

            // noviembre
            var input_noviembre = new Date($("#tr10").find("input").eq(1).val());
            if (input_noviembre < fecha_actual) {
                $("#tr10").find("input").eq(2).addClass("red");
            } else {
                var por_noviembre = $("#tr10").find("input").eq(2).val();
                por_noviembre = parseFloat(por_noviembre);
                var val_noviembre = mod_garantias * (por_noviembre / 100);
                val_noviembre = parseInt(val_noviembre);
                $("#tr10").find("input").eq(5).val(val_noviembre);
                var venta_noviembre = $("#tr10").find("input").eq(3).val();
                venta_noviembre = parseInt(venta_noviembre);
                var promos_noviembre = $("#tr10").find("input").eq(4).val();
                promos_noviembre = parseInt(promos_noviembre);
                //Ingreso total
                var total_noviembre = val_noviembre + venta_noviembre + promos_noviembre
                var meta_noviembre = localStorage.getItem("meta");
                meta_noviembre = parseFloat(meta_noviembre);
                $("#tr10").find("input").eq(6).val(total_noviembre);
                var pres_noviembre = parseFloat(total_noviembre * meta_noviembre)
                $("#tr10").find("input").eq(7).val(pres_noviembre);
            }

            // diciembre
            var input_diciembre = new Date($("#tr11").find("input").eq(1).val());
            if (input_diciembre < fecha_actual) {
                $("#tr11").find("input").eq(2).addClass("red");
            } else {
                var por_diciembre = $("#tr11").find("input").eq(2).val();
                por_diciembre = parseFloat(por_diciembre);
                var val_diciembre = mod_garantias * (por_diciembre / 100);
                val_diciembre = parseInt(val_diciembre);
                $("#tr11").find("input").eq(5).val(val_diciembre);
                var venta_diciembre = $("#tr11").find("input").eq(3).val();
                venta_diciembre = parseInt(venta_diciembre);
                var promos_diciembre = $("#tr11").find("input").eq(4).val();
                promos_diciembre = parseInt(promos_diciembre);
                //Ingreso total
                var total_diciembre = val_diciembre + venta_diciembre + promos_diciembre
                var meta_diciembre = localStorage.getItem("meta");
                meta_diciembre = parseFloat(meta_diciembre);
                $("#tr11").find("input").eq(6).val(total_diciembre);
                var pres_diciembre = parseFloat(total_diciembre * meta_diciembre)
                $("#tr11").find("input").eq(7).val(pres_diciembre);
            }

        }

    });


    //BLOQUEAR
    $('.bloquear').attr("readonly", true);

    //Bloquear Enero
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
        console.log(parametros);
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
                $('#mod_ventas_presupuesto').attr("readonly", true);
                $('#mod_promos_presupuesto').attr("readonly", true);
                $('#mod_garantia_presupuesto').attr("readonly", true);
                $("#icono_bloc").removeClass("fas fa-lock-open editar");
                $("#icono_bloc").addClass("fas fa-lock eliminar");
                load(1);
            }
        });
        event.preventDefault();
    })
</script>
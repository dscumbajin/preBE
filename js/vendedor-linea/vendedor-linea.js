$(document).ready(function() {
    load(1);
});
// Cargar informacion pagina principal
function load(page) {
    var q = $("#q").val();
    var codLinea = $("#codLinea").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/vendedor-linea/buscar_vendedor_linea.php?action=ajax&page=' + page + '&q=' + q + '&codLinea=' + codLinea,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

// eliminar registro

function eliminar(id) {
    var q = $("#q").val();
    var codLinea = $("#codLinea").val();
    if (confirm("Realmente deseas eliminar el vendedor")) {
        $.ajax({
            type: "GET",
            url: "./ajax/vendedor-linea/buscar_vendedor_linea.php",
            data: "id=" + id,
            "q": q,
            "codLinea": codLinea,
            beforeSend: function(objeto) {
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#resultados").html(datos);
                load(1);
            }
        });
    }
}

// VALIDACIONES
$('.decimales').on('input', function() {
    this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
});
// Guardar valores en la tabla de presupuestos anuales
$("#guardar_pres_anio").submit(function(event) {
    $('#guardar_datos').attr("disabled", true);
    $('#calcularAnio').attr("disabled", true);
    $("#incremento_anio").attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/vendedor-linea/nuevo_presupuesto_anio.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajax").html(datos);
            load(1);
        }
    });
    event.preventDefault();

    $("#resultados_ajax").show();
    $('#guardar_datos_mes').attr("disabled", false);

    $("#formMes").show();

    // Inicialización meta
    var precioPomedio = $("#precioPromedio").val();
    precioPomedio = parseFloat(precioPomedio);
    $("#precioMeta").val(precioPomedio);

    // Inicialización porcentaje por mes
    var totalPorsentaje = 100 / 12;
    totalPorsentaje = totalPorsentaje.toFixed(4);

    $("#porEnero").val(totalPorsentaje);
    $("#porFebrero").val(totalPorsentaje);
    $("#porMarzo").val(totalPorsentaje);
    $("#porAbril").val(totalPorsentaje);
    $("#porMayo").val(totalPorsentaje);
    $("#porJunio").val(totalPorsentaje);
    $("#porJulio").val(totalPorsentaje);
    $("#porAgosto").val(totalPorsentaje);
    $("#porSeptiembre").val(totalPorsentaje);
    $("#porOctubre").val(totalPorsentaje);
    $("#porNoviembre").val(totalPorsentaje);
    $("#porDiciembre").val(totalPorsentaje);

    if ($("#porEnero").val().length > 0) {
        $("#mesEnero").val($("#anioHist").val() + '-01' + '-01');
        var porEnero = $("#porEnero").val();
        porEnero = parseFloat(porEnero);
        var porcentajeEnero = porEnero / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);
        var totalVenAnio = vendidasAnio * porcentajeEnero;
        totalVenAnio = Math.round(totalVenAnio);
        var totalProAnio = promoAnio * porcentajeEnero;
        totalProAnio = Math.round(totalProAnio);
        var totalGarAnio = garantAnio * porcentajeEnero;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        // Presentamos valores en la panatalla
        $("#venEnero").val(totalVenAnio);
        $("#proEnero").val(totalProAnio);
        $("#garaEnero").val(totalGarAnio);
        $("#totEnero").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presEnero").val(presFacturacion);
    }
    if ($("#porFebrero").val().length > 0) {
        $("#mesFebrero").val($("#anioHist").val() + '-02' + '-01');
        var porFebrero = $("#porFebrero").val();
        porFebrero = parseFloat(porFebrero);
        var porcentajeFebrero = porFebrero / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeFebrero;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeFebrero;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeFebrero;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venFebrero").val(totalVenAnio);
        $("#proFebrero").val(totalProAnio);
        $("#garaFebrero").val(totalGarAnio);
        $("#totFebrero").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presFebrero").val(presFacturacion);

    }
    if ($("#porMarzo").val().length > 0) {
        $("#mesMarzo").val($("#anioHist").val() + '-03' + '-01');
        var porMarzo = $("#porMarzo").val();
        porMarzo = parseFloat(porMarzo);
        var porcentajeMarzo = porMarzo / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeMarzo;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeMarzo;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeMarzo;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venMarzo").val(totalVenAnio);
        $("#proMarzo").val(totalProAnio);
        $("#garaMarzo").val(totalGarAnio);
        $("#totMarzo").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presMarzo").val(presFacturacion);
    }
    if ($("#porAbril").val().length > 0) {
        $("#mesAbril").val($("#anioHist").val() + '-04' + '-01');
        var porAbril = $("#porAbril").val();
        porAbril = parseFloat(porAbril);
        var porcentajeAbril = porAbril / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeAbril;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeAbril;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeAbril;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venAbril").val(totalVenAnio);
        $("#proAbril").val(totalProAnio);
        $("#garaAbril").val(totalGarAnio);
        $("#totAbril").val(sumaVenProGar);
        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presAbril").val(presFacturacion);

    }
    if ($("#porMayo").val().length > 0) {
        $("#mesMayo").val($("#anioHist").val() + '-05' + '-01');
        var porMayo = $("#porMayo").val();
        porMayo = parseFloat(porMayo);
        var porcentajeMayo = porMayo / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeMayo;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeMayo;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeMayo;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venMayo").val(totalVenAnio);
        $("#proMayo").val(totalProAnio);
        $("#garaMayo").val(totalGarAnio);
        $("#totMayo").val(sumaVenProGar);
        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presMayo").val(presFacturacion);
    }
    if ($("#porJunio").val().length > 0) {
        $("#mesJunio").val($("#anioHist").val() + '-06' + '-01');
        var porJunio = $("#porJunio").val();
        porJunio = parseFloat(porJunio);
        var porcentajeJunio = porJunio / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeJunio;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeJunio;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeJunio;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venJunio").val(totalVenAnio);
        $("#proJunio").val(totalProAnio);
        $("#garaJunio").val(totalGarAnio);
        $("#totJunio").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presJunio").val(presFacturacion);

    }
    if ($("#porJulio").val().length > 0) {
        $("#mesJulio").val($("#anioHist").val() + '-07' + '-01');
        var porJulio = $("#porJulio").val();
        porJulio = parseFloat(porJulio);
        var porcentajeJulio = porJulio / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeJulio;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeJulio;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeJulio;
        totalGarAnio = Math.round(totalGarAnio);

        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venJulio").val(totalVenAnio);
        $("#proJulio").val(totalProAnio);
        $("#garaJulio").val(totalGarAnio);
        $("#totJulio").val(sumaVenProGar);
        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presJulio").val(presFacturacion);
    }
    if ($("#porAgosto").val().length > 0) {
        $("#mesAgosto").val($("#anioHist").val() + '-08' + '-01');
        var porAgosto = $("#porAgosto").val();
        porAgosto = parseFloat(porAgosto);
        var porcentajeAgosto = porAgosto / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeAgosto;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeAgosto;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeAgosto;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venAgosto").val(totalVenAnio);
        $("#proAgosto").val(totalProAnio);
        $("#garaAgosto").val(totalGarAnio);
        $("#totAgosto").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presAgosto").val(presFacturacion);
    }
    if ($("#porSeptiembre").val().length > 0) {
        $("#mesSeptiembre").val($("#anioHist").val() + '-09' + '-01');
        var porSeptiembre = $("#porSeptiembre").val();
        porSeptiembre = parseFloat(porSeptiembre);
        var porcentajeSeptiembre = porSeptiembre / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeSeptiembre;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeSeptiembre;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeSeptiembre;
        totalGarAnio = Math.round(totalGarAnio);

        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venSeptiembre").val(totalVenAnio);
        $("#proSeptiembre").val(totalProAnio);
        $("#garaSeptiembre").val(totalGarAnio);
        $("#totSeptiembre").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presSeptiembre").val(presFacturacion);

    }
    if ($("#porOctubre").val().length > 0) {
        $("#mesOctubre").val($("#anioHist").val() + '-10' + '-01');
        var porOctubre = $("#porOctubre").val();
        porOctubre = parseFloat(porOctubre);
        var porcentajeOctubre = porOctubre / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeOctubre;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeOctubre;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeOctubre;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venOctubre").val(totalVenAnio);
        $("#proOctubre").val(totalProAnio);
        $("#garaOctubre").val(totalGarAnio);
        $("#totOctubre").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presOctubre").val(presFacturacion);


    }
    if ($("#porNoviembre").val().length > 0) {
        $("#mesNoviembre").val($("#anioHist").val() + '-11' + '-01');
        var porNoviembre = $("#porNoviembre").val();
        porNoviembre = parseFloat(porNoviembre);
        var porcentajeNoviembre = porNoviembre / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeNoviembre;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeNoviembre;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeNoviembre;
        totalGarAnio = Math.round(totalGarAnio);

        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venNoviembre").val(totalVenAnio);
        $("#proNoviembre").val(totalProAnio);
        $("#garaNoviembre").val(totalGarAnio);
        $("#totNoviembre").val(sumaVenProGar);
        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presNoviembre").val(presFacturacion);
    }
    if ($("#porDiciembre").val().length > 0) {
        $("#mesDiciembre").val($("#anioHist").val() + '-12' + '-01');
        var porDiciembre = $("#porDiciembre").val();
        porDiciembre = parseFloat(porDiciembre);
        var porcentajeDiciembre = porDiciembre / 100;
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeDiciembre;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeDiciembre;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeDiciembre;
        totalGarAnio = Math.round(totalGarAnio);

        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venDiciembre").val(totalVenAnio);
        $("#proDiciembre").val(totalProAnio);
        $("#garaDiciembre").val(totalGarAnio);
        $("#totDiciembre").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presDiciembre").val(presFacturacion);
    }

    tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

});


// Guardar valores en la tabla de presupuestos mesnsuales
$("#guardar_pres_mes").submit(function(event) {
    $('#guardar_datos_mes').attr("disabled", true);
    $("#precioMeta").attr("readonly", true);
    $("#porEnero").attr("readonly", true);
    $("#porFebrero").attr("readonly", true);
    $("#porMarzo").attr("readonly", true);
    $("#porAbril").attr("readonly", true);
    $("#porMayo").attr("readonly", true);
    $("#porJunio").attr("readonly", true);
    $("#porJulio").attr("readonly", true);
    $("#porAgosto").attr("readonly", true);
    $("#porSeptiembre").attr("readonly", true);
    $("#porOctubre").attr("readonly", true);
    $("#porNoviembre").attr("readonly", true);
    $("#porDiciembre").attr("readonly", true);
    var parametros = $(this).serialize();

    console.log(parametros);
    $.ajax({
        type: "POST",
        url: "ajax/vendedor-linea/nuevo_presupuesto_mes.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajaxmes").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajaxmes").html(datos);
            load(1);
        }
    });
    event.preventDefault();
    $("#resultados_ajaxmes").show();

})


/* Campos ocultos */
$("#total_anio").hide();
$("#formMes").hide();
$('#guardar_datos').attr("disabled", true);

$('#close').click(function() {
    // Desabilitar
    $("#incremento_anio").attr("disabled", false);
    $('#guardar_datos').attr("disabled", true);
    $('#guardar_datos_mes').attr("disabled", true);
    $('#calcularAnio').attr("disabled", false);
    $("#precioMeta").attr("readonly", false);
    $("#porEnero").attr("readonly", false);
    $("#porFebrero").attr("readonly", false);
    $("#porMarzo").attr("readonly", false);
    $("#porAbril").attr("readonly", false);
    $("#porMayo").attr("readonly", false);
    $("#porJunio").attr("readonly", false);
    $("#porJulio").attr("readonly", false);
    $("#porAgosto").attr("readonly", false);
    $("#porSeptiembre").attr("readonly", false);
    $("#porOctubre").attr("readonly", false);
    $("#porNoviembre").attr("readonly", false);
    $("#porDiciembre").attr("readonly", false);
    //Ocultar
    $("#total_anio").hide();
    $("#formMes").hide();
    $("#resultados_ajax").hide();
    $("#resultados_ajaxmes").hide();
    //Encerar
    $("#incremento_anio").val("");
    $("#porEnero").val('');
    $("#porFebrero").val('');
    $("#porMarzo").val('');
    $("#porAbril").val('');
    $("#porMayo").val('');
    $("#porJunio").val('');
    $("#porJulio").val('');
    $("#porAgosto").val('');
    $("#porSeptiembre").val('');
    $("#porOctubre").val('');
    $("#porNoviembre").val('');
    $("#porDiciembre").val('');

    $("#venEnero").val('');
    $("#proEnero").val('');
    $("#garaEnero").val('');
    $("#totEnero").val('');

    $("#venFebrero").val('');
    $("#proFebrero").val('');
    $("#garaFebrero").val('');
    $("#totFebrero").val('');

    $("#venMarzo").val('');
    $("#proMarzo").val('');
    $("#garaMarzo").val('');
    $("#totMarzo").val('');

    $("#venAbril").val('');
    $("#proAbril").val('');
    $("#garaAbril").val('');
    $("#totAbril").val('');

    $("#venMayo").val('');
    $("#proMayo").val('');
    $("#garaMayo").val('');
    $("#totMayo").val('');

    $("#venJunio").val('');
    $("#proJunio").val('');
    $("#garaJunio").val('');
    $("#totJunio").val('');

    $("#venJulio").val('');
    $("#proJulio").val('');
    $("#garaJulio").val('');
    $("#totJulio").val('');

    $("#venAgosto").val('');
    $("#proAgosto").val('');
    $("#garaAgosto").val('');
    $("#totAgosto").val('');

    $("#venSeptiembre").val('');
    $("#proSeptiembre").val('');
    $("#garaSeptiembre").val('');
    $("#totSeptiembre").val('');

    $("#venOctubre").val('');
    $("#proOctubre").val('');
    $("#garaOctubre").val('');
    $("#totOctubre").val('');

    $("#venNoviembre").val('');
    $("#proNoviembre").val('');
    $("#garaNoviembre").val('');
    $("#totNoviembre").val('');

    $("#venDiciembre").val('');
    $("#proDiciembre").val('');
    $("#garaDiciembre").val('');
    $("#totDiciembre").val('');


});

function obtener_datos(id) {

    var cod_vendedor = $("#cod_vendedor" + id).val();
    var cod_linea = $("#cod_linea" + id).val();
    var anio_historial = $("#anio_historial" + id).val();
    var vendidas_histroial = $("#vendidas_histroial" + id).val();
    var promocion_historial = $("#promocion_historial" + id).val();
    var garantia_historial = $("#garantia_historial" + id).val();
    var facturado_historial = $("#facturado_historial" + id).val();
    var nombre_vendedor = $("#nombre_vendedor" + id).val();
    var nameLinea = $("#nameLinea").text();

    // Tasformar año a numero
    anio_historial = parseInt(anio_historial);

    $("#anioHist").val(anio_historial + 1);
    $("#codVenHist").val(cod_vendedor);
    $("#codLineaHist").val(cod_linea);

    $("#codVenAnio").val(cod_vendedor);
    $("#codLineaAnio").val(cod_linea);

    $("#vendidas").val(vendidas_histroial);
    $("#promocion").val(promocion_historial);
    $("#garantia").val(garantia_historial);
    $("#facturado").val(facturado_historial);
    $("#vendedor").text('LINEA: ' + nameLinea + ' - ' + 'EJECUTIVO: ' + nombre_vendedor);


    $('#calcularAnio').hide(); // Oculto el boton

    $("#incremento_anio").on('input', function() {
        // $('#calcularAnio').click(function() {

        if ($("#incremento_anio").length < 0) {
            $("#incremento_anio").attr("required", "true");
        }
        $("#resultados_ajax").hide();
        $('#guardar_datos').attr("disabled", false);

        // Asignacion de valores a varibles
        var numeroVendidas = $("#vendidas").val();
        numeroVendidas = parseInt(numeroVendidas);
        var numeroPromocion = $("#promocion").val();
        numeroPromocion = parseInt(numeroPromocion);
        var numeroGarantia = $("#garantia").val();
        numeroGarantia = parseInt(numeroGarantia);
        var facturado = $("#facturado").val();
        facturado = parseFloat(facturado);
        var incremento_anio = $("#incremento_anio").val();
        incremento_anio = parseInt(incremento_anio);
        var porcentaje = incremento_anio / 100;

        // Presupuesto nuevo año vendidos
        var ventasNuevo = numeroVendidas * porcentaje;
        var total_vendidas = numeroVendidas + ventasNuevo;
        total_vendidas = Math.round(total_vendidas);
        $("#vendidasNuevo").val(total_vendidas);

        // Promociones sumar el numero porcentaje
        var promocionesNuevo = numeroPromocion * porcentaje;
        var total_promos = numeroPromocion + promocionesNuevo;
        total_promos = Math.round(total_promos);
        $("#promocionNuevo").val(total_promos);

        // Garantias restar numero porcentaje
        var garantiaNuevo = numeroGarantia * porcentaje;
        var total_garantia = numeroGarantia - garantiaNuevo;
        total_garantia = Math.round(total_garantia);
        $("#garantiaNuevo").val(total_garantia);

        // Total año presu + promo + garant

        var presupuesto_total_anio = total_vendidas + total_promos + total_garantia;
        $("#totalAnio").val(presupuesto_total_anio);

        // Precio Pormedio
        $("#precioPromedio").val(facturado / (presupuesto_total_anio));

        $("#total_anio").show();

    });

}

function tituloPreAnio(enero, febrero, marzo, abril, mayo, junio, julio, agosto, septiembre, octubre, noviembre, diciembre) {

    var totalTitulo = enero + febrero + marzo + abril + mayo + junio + julio + agosto + septiembre + octubre + noviembre + diciembre;

    totalTitulo = parseFloat(totalTitulo);
    totalTitulo = Math.round(totalTitulo);
    if (totalTitulo <= 100) {
        $('#guardar_datos_mes').attr("disabled", false);
        $('#tituloPor').removeClass('filledInputs');

    } else {
        $('#guardar_datos_mes').attr("disabled", true);
        $('#tituloPor').addClass('filledInputs');
    }
    $("#tituloPor").text(totalTitulo);
}


$("#porEnero").on("input", function() {
    // Iicializacion de variables
    $("#mesEnero").val($("#anioHist").val() + '-01' + '-01');
    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porcentajeEnero = porEnero / 100;

    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);

    if (isNaN(porcentajeEnero)) {

        var subPorcentajes = porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);
        $("#porFebrero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);
        // Sumo todos los porcentajes
        $("#porEnero").on("input", function() {
            var porEnero = $("#porEnero").val();
            porEnero = parseFloat(porEnero);
            if (porEnero <= comparacion) {
                porcentajeEnero = porEnero / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porFebrero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);
                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porFebrero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);

            }

            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });

        return;

    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);
        var totalVenAnio = vendidasAnio * porcentajeEnero;
        totalVenAnio = Math.round(totalVenAnio);
        var totalProAnio = promoAnio * porcentajeEnero;
        totalProAnio = Math.round(totalProAnio);
        var totalGarAnio = garantAnio * porcentajeEnero;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        // Presentamos valores en la panatalla
        $("#venEnero").val(totalVenAnio);
        $("#proEnero").val(totalProAnio);
        $("#garaEnero").val(totalGarAnio);
        $("#totEnero").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presEnero").val(presFacturacion);

    }
});


$("#porFebrero").on("input", function() {
    $("#mesFebrero").val($("#anioHist").val() + '-02' + '-01');
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porcentajeFebrero = porFebrero / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);

    if (isNaN(porcentajeFebrero)) {
        var subPorcentajes = porEnero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);

        $("#porEnero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);

        $("#porFebrero").on("input", function() {
            var porFebrero = $("#porFebrero").val();
            porFebrero = parseFloat(porFebrero);
            if (porFebrero <= comparacion) {
                porcentajeFebrero = porFebrero / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porEnero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);
                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);
            }

            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });

        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);
        var totalVenAnio = vendidasAnio * porcentajeFebrero;
        totalVenAnio = Math.round(totalVenAnio);
        var totalProAnio = promoAnio * porcentajeFebrero;
        totalProAnio = Math.round(totalProAnio);
        var totalGarAnio = garantAnio * porcentajeFebrero;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venFebrero").val(totalVenAnio);
        $("#proFebrero").val(totalProAnio);
        $("#garaFebrero").val(totalGarAnio);
        $("#totFebrero").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presFebrero").val(presFacturacion);
    }
});

$("#porMarzo").on("input", function() {
    $("#mesMarzo").val($("#anioHist").val() + '-03' + '-01');
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porcentajeMarzo = porMarzo / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);

    if (isNaN(porcentajeMarzo)) {
        var subPorcentajes = porEnero + porFebrero + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);

        // Sumo todos los porcentajes
        $("#porEnero").attr("readonly", true);
        $("#porFebrero").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);

        $("#porMarzo").on("input", function() {
            var porMarzo = $("#porMarzo").val();
            porMarzo = parseFloat(porMarzo);
            if (porMarzo <= comparacion) {
                porcentajeMarzo = porMarzo / 100;
                $("#porEnero").attr("readonly", false);
                $("#porFebrero").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);
                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porFebrero").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);
            }
            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });
        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);
        var totalVenAnio = vendidasAnio * porcentajeMarzo;
        totalVenAnio = Math.round(totalVenAnio);
        var totalProAnio = promoAnio * porcentajeMarzo;
        totalProAnio = Math.round(totalProAnio);
        var totalGarAnio = garantAnio * porcentajeMarzo;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venMarzo").val(totalVenAnio);
        $("#proMarzo").val(totalProAnio);
        $("#garaMarzo").val(totalGarAnio);
        $("#totMarzo").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presMarzo").val(presFacturacion);
    }
});

$("#porAbril").on("input", function() {
    $("#mesAbril").val($("#anioHist").val() + '-04' + '-01');
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porcentajeAbril = porAbril / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);

    if (isNaN(porcentajeAbril)) {
        var subPorcentajes = porEnero + porFebrero + porMarzo + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);
        $("#porEnero").attr("readonly", true);
        $("#porFebrero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);

        // Sumo todos los porcentajes

        $("#porAbril").on("input", function() {
            var porAbril = $("#porAbril").val();
            porAbril = parseFloat(porAbril);
            if (porAbril <= comparacion) {
                porcentajeAbril = porAbril / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porEnero").attr("readonly", false);
                $("#porFebrero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);
                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porFebrero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);
            }
            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });
        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeAbril;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeAbril;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeAbril;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venAbril").val(totalVenAnio);
        $("#proAbril").val(totalProAnio);
        $("#garaAbril").val(totalGarAnio);
        $("#totAbril").val(sumaVenProGar);
        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presAbril").val(presFacturacion);
    }

});

$("#porMayo").on("input", function() {
    $("#mesMayo").val($("#anioHist").val() + '-05' + '-01');
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porcentajeMayo = porMayo / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);

    if (isNaN(porcentajeMayo)) {

        var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);
        $("#porEnero").attr("readonly", true);
        $("#porFebrero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);


        // Sumo todos los porcentajes

        $("#porMayo").on("input", function() {
            var porMayo = $("#porMayo").val();
            porMayo = parseFloat(porMayo);
            if (porMayo <= comparacion) {
                porcentajeMayo = porMayo / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porEnero").attr("readonly", false);
                $("#porFebrero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);
                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porFebrero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);
            }
            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });
        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeMayo;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeMayo;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeMayo;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venMayo").val(totalVenAnio);
        $("#proMayo").val(totalProAnio);
        $("#garaMayo").val(totalGarAnio);
        $("#totMayo").val(sumaVenProGar);
        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presMayo").val(presFacturacion);
    }
});

$("#porJunio").on("input", function() {
    $("#mesJunio").val($("#anioHist").val() + '-06' + '-01');
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porcentajeJunio = porJunio / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);

    if (isNaN(porcentajeJinio)) {
        var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);
        $("#porEnero").attr("readonly", true);
        $("#porFebrero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);

        // Sumo todos los porcentajes

        $("#porJunio").on("input", function() {
            var porJunio = $("#porJunio").val();
            porJunio = parseFloat(porJunio);
            if (porJunio <= comparacion) {
                porcentajeJunio = porEnero / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porEnero").attr("readonly", false);
                $("#porFebrero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);
                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porFebrero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);
            }
            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });

        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeJunio;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeJunio;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeJunio;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venJunio").val(totalVenAnio);
        $("#proJunio").val(totalProAnio);
        $("#garaJunio").val(totalGarAnio);
        $("#totJunio").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presJunio").val(presFacturacion);
    }

});

$("#porJulio").on("input", function() {
    $("#mesJulio").val($("#anioHist").val() + '-07' + '-01');
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porcentajeJulio = porJulio / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);

    if (isNaN(porcentajeJulio)) {
        var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porAgosto + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);
        $("#porEnero").attr("readonly", true);
        $("#porFebrero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);

        // Sumo todos los porcentajes

        $("#porJulio").on("input", function() {
            var porJulio = $("#porJulio").val();
            porJulio = parseFloat(porJulio);
            if (porJulio <= comparacion) {
                porcentajeJulio = porJulio / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porEnero").attr("readonly", false);
                $("#porFebrero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);
                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porFebrero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);
            }
            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });
        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeJulio;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeJulio;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeJulio;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venJulio").val(totalVenAnio);
        $("#proJulio").val(totalProAnio);
        $("#garaJulio").val(totalGarAnio);
        $("#totJulio").val(sumaVenProGar);
        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presJulio").val(presFacturacion);
    }
});

$("#porAgosto").on("input", function() {
    $("#mesAgosto").val($("#anioHist").val() + '-08' + '-01');
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porcentajeAgosto = porAgosto / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);

    if (isNaN(porcentajeAgosto)) {
        var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porSeptiembre + porOctubre + porNoviembre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);

        $("#porEnero").attr("readonly", true);
        $("#porFebrero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);

        // Sumo todos los porcentajes

        $("#porAgosto").on("input", function() {
            var porAgosto = $("#porAgosto").val();
            porAgosto = parseFloat(porAgosto);
            if (porAgosto <= comparacion) {
                porcentajeAgosto = porAgosto / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porEnero").attr("readonly", false);
                $("#porFebrero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);
                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porFebrero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);
            }
            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });
        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeAgosto;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeAgosto;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeAgosto;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venAgosto").val(totalVenAnio);
        $("#proAgosto").val(totalProAnio);
        $("#garaAgosto").val(totalGarAnio);
        $("#totAgosto").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presAgosto").val(presFacturacion);
    }
});

$("#porSeptiembre").on("input", function() {
    $("#mesSeptiembre").val($("#anioHist").val() + '-09' + '-01');
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porcentajeSeptiembre = porSeptiembre / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);


    if (isNaN(porcentajeSeptiembre)) {
        var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porOctubre + porNoviembre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);
        $("#porEnero").attr("readonly", true);
        $("#porFebrero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);

        // Sumo todos los porcentajes

        $("#porSeptiembre").on("input", function() {
            var porSeptiembre = $("#porSeptiembre").val();
            porSeptiembre = parseFloat(porSeptiembre);
            if (porSeptiembre <= comparacion) {
                porcentajeSeptiembre = porSeptiembre / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porEnero").attr("readonly", false);
                $("#porFebrero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);
                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porFebrero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);
            }
            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });
        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeSeptiembre;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeSeptiembre;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeSeptiembre;
        totalGarAnio = Math.round(totalGarAnio);

        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venSeptiembre").val(totalVenAnio);
        $("#proSeptiembre").val(totalProAnio);
        $("#garaSeptiembre").val(totalGarAnio);
        $("#totSeptiembre").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presSeptiembre").val(presFacturacion);
    }
});

$("#porOctubre").on("input", function() {
    $("#mesOctubre").val($("#anioHist").val() + '-10' + '-01');
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porcentajeOctubre = porOctubre / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);

    if (isNaN(porcentajeOctubre)) {
        var subPorcentajes = porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porNoviembre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);
        $("#porEnero").attr("readonly", true);
        $("#porFebrero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);

        // Sumo todos los porcentajes

        $("#porOctubre").on("input", function() {
            var porOctubre = $("#porOctubre").val();
            porOctubre = parseFloat(porOctubre);
            if (porOctubre <= comparacion) {
                porcentajeOctubre = porOctubre / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porEnero").attr("readonly", false);
                $("#porFebrero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);
                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porFebrero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);
            }
            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });

        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeOctubre;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeOctubre;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeOctubre;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venOctubre").val(totalVenAnio);
        $("#proOctubre").val(totalProAnio);
        $("#garaOctubre").val(totalGarAnio);
        $("#totOctubre").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presOctubre").val(presFacturacion);
    }

});

$("#porNoviembre").on("input", function() {
    $("#mesNoviembre").val($("#anioHist").val() + '-11' + '-01');
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);
    var porcentajeNoviembre = porNoviembre / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);

    if (isNaN(porcentajeNoviembre)) {
        var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porDiciembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);

        $("#porEnero").attr("readonly", true);
        $("#porFebrero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porDiciembre").attr("readonly", true);

        // Sumo todos los porcentajes

        $("#porNoviembre").on("input", function() {
            var porNoviembre = $("#porNoviembre").val();
            porNoviembre = parseFloat(porNoviembre);
            if (porNoviembre <= comparacion) {
                porcentajeNoviembre = porNoviembre / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porEnero").attr("readonly", false);
                $("#porFebrero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);

                $("#porDiciembre").attr("readonly", false);
            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porFebrero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porDiciembre").attr("readonly", true);
            }
            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });
        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeNoviembre;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeNoviembre;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeNoviembre;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venNoviembre").val(totalVenAnio);
        $("#proNoviembre").val(totalProAnio);
        $("#garaNoviembre").val(totalGarAnio);
        $("#totNoviembre").val(sumaVenProGar);
        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presNoviembre").val(presFacturacion);
    }
});

$("#porDiciembre").on("input", function() {
    $("#mesDiciembre").val($("#anioHist").val() + '-12' + '-01');
    var porDiciembre = $("#porDiciembre").val();
    porDiciembre = parseFloat(porDiciembre);
    var porcentajeDiciembre = porDiciembre / 100;

    var porEnero = $("#porEnero").val();
    porEnero = parseFloat(porEnero);
    var porFebrero = $("#porFebrero").val();
    porFebrero = parseFloat(porFebrero);
    var porMarzo = $("#porMarzo").val();
    porMarzo = parseFloat(porMarzo);
    var porAbril = $("#porAbril").val();
    porAbril = parseFloat(porAbril);
    var porMayo = $("#porMayo").val();
    porMayo = parseFloat(porMayo);
    var porJunio = $("#porJunio").val();
    porJunio = parseFloat(porJunio);
    var porJulio = $("#porJulio").val();
    porJulio = parseFloat(porJulio);
    var porAgosto = $("#porAgosto").val();
    porAgosto = parseFloat(porAgosto);
    var porSeptiembre = $("#porSeptiembre").val();
    porSeptiembre = parseFloat(porSeptiembre);
    var porOctubre = $("#porOctubre").val();
    porOctubre = parseFloat(porOctubre);
    var porNoviembre = $("#porNoviembre").val();
    porNoviembre = parseFloat(porNoviembre);


    if (isNaN(porcentajeDiciembre)) {
        var subPorcentajes = porEnero + porFebrero + porMarzo + porAbril + porMayo + porJunio + porJulio + porAgosto + porSeptiembre + porOctubre + porNoviembre;
        var comparacion = 100 - subPorcentajes;
        alert(`Debes ingresar un valor menor o igual a: ${comparacion}`);

        $("#porEnero").attr("readonly", true);
        $("#porFebrero").attr("readonly", true);
        $("#porMarzo").attr("readonly", true);
        $("#porAbril").attr("readonly", true);
        $("#porMayo").attr("readonly", true);
        $("#porJunio").attr("readonly", true);
        $("#porJulio").attr("readonly", true);
        $("#porAgosto").attr("readonly", true);
        $("#porSeptiembre").attr("readonly", true);
        $("#porOctubre").attr("readonly", true);
        $("#porNoviembre").attr("readonly", true);

        // Sumo todos los porcentajes

        $("#porDiciembre").on("input", function() {
            var porDiciembre = $("#porDiciembre").val();
            porDiciembre = parseFloat(porDiciembre);
            if (porDiciembre <= comparacion) {
                porcentajeDiciembre = porDiciembre / 100;
                $('#guardar_datos_mes').attr("disabled", false);
                $("#porEnero").attr("readonly", false);
                $("#porFebrero").attr("readonly", false);
                $("#porMarzo").attr("readonly", false);
                $("#porAbril").attr("readonly", false);
                $("#porMayo").attr("readonly", false);
                $("#porJunio").attr("readonly", false);
                $("#porJulio").attr("readonly", false);
                $("#porAgosto").attr("readonly", false);
                $("#porSeptiembre").attr("readonly", false);
                $("#porOctubre").attr("readonly", false);
                $("#porNoviembre").attr("readonly", false);

            } else {
                $('#guardar_datos_mes').attr("disabled", true);
                $("#porEnero").attr("readonly", true);
                $("#porFebrero").attr("readonly", true);
                $("#porMarzo").attr("readonly", true);
                $("#porAbril").attr("readonly", true);
                $("#porMayo").attr("readonly", true);
                $("#porJunio").attr("readonly", true);
                $("#porJulio").attr("readonly", true);
                $("#porAgosto").attr("readonly", true);
                $("#porSeptiembre").attr("readonly", true);
                $("#porOctubre").attr("readonly", true);
                $("#porNoviembre").attr("readonly", true);
            }
            tituloPreAnio(porEnero, porFebrero, porMarzo, porAbril, porMayo, porJunio, porJulio, porAgosto, porSeptiembre, porOctubre, porNoviembre, porDiciembre);

        });
        return;
    } else {
        var vendidasAnio = $("#vendidasNuevo").val();
        vendidasAnio = parseInt(vendidasAnio);
        var promoAnio = $("#promocionNuevo").val();
        promoAnio = parseInt(promoAnio);
        var garantAnio = $("#garantiaNuevo").val();
        garantAnio = parseInt(garantAnio);

        var totalVenAnio = vendidasAnio * porcentajeDiciembre;
        totalVenAnio = Math.round(totalVenAnio);

        var totalProAnio = promoAnio * porcentajeDiciembre;
        totalProAnio = Math.round(totalProAnio);

        var totalGarAnio = garantAnio * porcentajeDiciembre;
        totalGarAnio = Math.round(totalGarAnio);
        var sumaVenProGar = totalVenAnio + totalProAnio + totalGarAnio;

        $("#venDiciembre").val(totalVenAnio);
        $("#proDiciembre").val(totalProAnio);
        $("#garaDiciembre").val(totalGarAnio);
        $("#totDiciembre").val(sumaVenProGar);

        var precioPromedio = $("#precioMeta").val();
        precioPromedio = parseFloat(precioPromedio);
        var presFacturacion = precioPromedio * sumaVenProGar;
        $("#presDiciembre").val(presFacturacion);
    }
});

// Modificacion del input precio por meta
$("#precioMeta").on("input", function() {


    if (isNaN($("#precioMeta").val())) {
        alert("Debes ingresar el precio por meta");
        return;
    } else {
        var precioMeta = $("#precioMeta").val();
        precioMeta = parseFloat(precioMeta);
        //Enero
        var presEneroV = $("#totEnero").val();
        presEneroV = parseInt(presEneroV);
        var facEnero = precioMeta * presEneroV;
        $("#presEnero").val(facEnero);
        //Febrero
        var presFebreroV = $("#totFebrero").val();
        presFebreroV = parseInt(presFebreroV);
        var facFebrero = precioMeta * presFebreroV;
        $("#presFebrero").val(facFebrero);
        //Marzo
        var presMarzoV = $("#totMarzo").val();
        presMarzoV = parseInt(presMarzoV);
        var facMarzo = precioMeta * presMarzoV;
        $("#presMarzo").val(facMarzo);
        //Abril
        var presAbrilV = $("#totAbril").val();
        presAbrilV = parseInt(presAbrilV);
        var facAbril = precioMeta * presAbrilV;
        $("#presAbril").val(facAbril);
        //Mayo
        var presMayoV = $("#totMayo").val();
        presMayoV = parseInt(presMayoV);
        var facMayo = precioMeta * presMayoV;
        $("#presMayo").val(facMayo);
        //Junio
        var presJunioV = $("#totJunio").val();
        presJunioV = parseInt(presJunioV);
        var facJunio = precioMeta * presJunioV;
        $("#presJunio").val(facJunio);
        //Julio
        var presJulioV = $("#totJulio").val();
        presJulioV = parseInt(presJulioV);
        var facJulio = precioMeta * presJulioV;
        $("#presJulio").val(facJulio);
        //Agosto
        var presAgostoV = $("#totAgosto").val();
        presAgostoV = parseInt(presAgostoV);
        var facAgosto = precioMeta * presAgostoV;
        $("#presAgosto").val(facAgosto);
        //Septiembre
        var presSeptiembreV = $("#totSeptiembre").val();
        presSeptiembreV = parseInt(presSeptiembreV);
        var facSeptiembre = precioMeta * presSeptiembreV;
        $("#presSeptiembre").val(facSeptiembre);
        //Octubre
        var presOctubreV = $("#totOctubre").val();
        presOctubreV = parseInt(presOctubreV);
        var facOctubre = precioMeta * presOctubreV;
        $("#presOctubre").val(facOctubre);
        //Noviembre
        var presNoviembreV = $("#totNoviembre").val();
        presNoviembreV = parseInt(presNoviembreV);
        var facNoviembre = precioMeta * presNoviembreV;
        $("#presNoviembre").val(facNoviembre);
        //Diciembre
        var presDiciembreV = $("#totDiciembre").val();
        presDiciembreV = parseInt(presDiciembreV);
        var facDiciembre = precioMeta * presDiciembreV;
        $("#presDiciembre").val(facDiciembre);
    }
});
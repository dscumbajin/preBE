$(document).ready(function() {
    load(1);
});

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
    $("#formMes").show();
    $("#resultados_ajax").show();
    $('#guardar_datos_mes').attr("disabled", false);
});


$("#guardar_pres_mes").submit(function(event) {
    $('#guardar_datos_mes').attr("disabled", true);

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

/* 	$("#editar_vendedor").submit(function(event) {
    $('#actualizar_datos').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/vendedor/editar_vendedor.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajax2").html(datos);
            $('#actualizar_datos').attr("disabled", false);
            load(1);
        }
    });
    event.preventDefault();
})
*/
/* Campos ocultos */
$("#total_anio").hide();
$("#formMes").hide();
$('#guardar_datos').attr("disabled", true);

$('#close').click(function() {

    $("#incremento_anio").attr("disabled", false);
    $('#guardar_datos').attr("disabled", true);
    $('#guardar_datos_mes').attr("disabled", true);
    $('#calcularAnio').attr("disabled", false);

    $("#total_anio").hide();
    $("#formMes").hide();
    $("#resultados_ajax").hide();
    $("#resultados_ajaxmes").hide();

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
    $("#vendedor").text(nombre_vendedor + ' - ' + nameLinea);


    $('#calcularAnio').hide(); // Oculto el boton

    $("#incremento_anio").on('input', function() {
        // $('#calcularAnio').click(function() {

        if ($("#incremento_anio").length < 0) {
            $("#incremento_anio").attr("required", "true");
        }
        $("#resultados_ajax").hide();
        $('#guardar_datos').attr("disabled", false);

        var numeroVendidas = $("#vendidas").val();
        numeroVendidas = parseInt(numeroVendidas);

        var numeroPromocion = $("#promocion").val();
        numeroPromocion = parseInt(numeroPromocion);

        var numeroGarantia = $("#garantia").val();
        numeroGarantia = parseInt(numeroGarantia);

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

        $("#total_anio").show();

    });

}

/* $("#tituloPor").text(100);
 */
function tituloPreAnio(total, valor) {


    console.log("Inicio");
    console.log(total);
    console.log(valor);
    total = total - valor;

    console.log("Despues");
    console.log(total);
    console.log(valor);


    $("#tituloPor").text(total);
}

// Guardar presupuesto año
/* 	$("#venEnero").attr("disabled", true);
    $("#proEnero").attr("disabled", true);
    $("#garaEnero").attr("disabled", true);
    $("#totEnero").attr("disabled", true); 

    $("#venFebrero").attr("disabled", true);
    $("#proFebrero").attr("disabled", true);
    $("#garaFebrero").attr("disabled", true);
    $("#totFebrero").attr("disabled", true);

    $("#venMarzo").attr("disabled", true);
    $("#proMarzo").attr("disabled", true);
    $("#garaMarzo").attr("disabled", true);
    $("#totMarzo").attr("disabled", true);

    $("#venAbril").attr("disabled", true);
    $("#proAbril").attr("disabled", true);
    $("#garaAbril").attr("disabled", true);
    $("#totAbril").attr("disabled", true);

    $("#venMayo").attr("disabled", true);
    $("#proMayo").attr("disabled", true);
    $("#garaMayo").attr("disabled", true);
    $("#totMayo").attr("disabled", true);

    $("#venJunio").attr("disabled", true);
    $("#proJunio").attr("disabled", true);
    $("#garaJunio").attr("disabled", true);
    $("#totJunio").attr("disabled", true);

    $("#venJulio").attr("disabled", true);
    $("#proJulio").attr("disabled", true);
    $("#garaJulio").attr("disabled", true);
    $("#totJulio").attr("disabled", true);

    $("#venAgosto").attr("disabled", true);
    $("#proAgosto").attr("disabled", true);
    $("#garaAgosto").attr("disabled", true);
    $("#totAgosto").attr("disabled", true);

    $("#venSeptiembre").attr("disabled", true);
    $("#proSeptiembre").attr("disabled", true);
    $("#garaSeptiembre").attr("disabled", true);
    $("#totSeptiembre").attr("disabled", true);

    $("#venOctubre").attr("disabled", true);
    $("#proOctubre").attr("disabled", true);
    $("#garaOctubre").attr("disabled", true);
    $("#totOctubre").attr("disabled", true);

    $("#venNoviembre").attr("disabled", true);
    $("#proNoviembre").attr("disabled", true);
    $("#garaNoviembre").attr("disabled", true);
    $("#totNoviembre").attr("disabled", true);

    $("#venDiciembre").attr("disabled", true);
    $("#proDiciembre").attr("disabled", true);
    $("#garaDiciembre").attr("disabled", true);
    $("#totDiciembre").attr("disabled", true);
    */

$("#porEnero").on("input", function() {

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

    $("#venEnero").val(totalVenAnio);
    $("#proEnero").val(totalProAnio);
    $("#garaEnero").val(totalGarAnio);
    $("#totEnero").val(totalVenAnio + totalProAnio + totalGarAnio);


    /*   if (porEnero > 0) {

          var vTitulo = $("#tituloPor").text();
          vTitulo = parseFloat(vTitulo);

      } else {
          vTitulo = 100;
          porEnero = 0;
      }
      tituloPreAnio(vTitulo, porEnero); */
});

$("#porFebrero").on("input", function() {
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

    $("#venFebrero").val(totalVenAnio);
    $("#proFebrero").val(totalProAnio);
    $("#garaFebrero").val(totalGarAnio);
    $("#totFebrero").val(totalVenAnio + totalProAnio + totalGarAnio);
    /* if (porFebrero > 0) {

        var vTitulo = $("#tituloPor").text();
        vTitulo = parseFloat(vTitulo);

    } else {
        vTitulo = $("#tituloPor").text();
        porFebrero = 0;
    }
    tituloPreAnio(vTitulo, porFebrero); */
});

$("#porMarzo").on("input", function() {
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

    $("#venMarzo").val(totalVenAnio);
    $("#proMarzo").val(totalProAnio);
    $("#garaMarzo").val(totalGarAnio);
    $("#totMarzo").val(totalVenAnio + totalProAnio + totalGarAnio);

    /*   if (porMarzo > 0) {

          var vTitulo = $("#tituloPor").text();
          vTitulo = parseFloat(vTitulo);

      } else {
          vTitulo = 100;
          porMarzo = 0;
      }
      tituloPreAnio(vTitulo, porMarzo); */

});

$("#porAbril").on("input", function() {
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

    $("#venAbril").val(totalVenAnio);
    $("#proAbril").val(totalProAnio);
    $("#garaAbril").val(totalGarAnio);
    $("#totAbril").val(totalVenAnio + totalProAnio + totalGarAnio);

    /*   if (porAbril > 0) {

          var vTitulo = $("#tituloPor").text();
          vTitulo = parseFloat(vTitulo);

      } else {
          vTitulo = 100;
          porAbril = 0;
      }
      tituloPreAnio(vTitulo, porAbril); */

});

$("#porMayo").on("input", function() {
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

    $("#venMayo").val(totalVenAnio);
    $("#proMayo").val(totalProAnio);
    $("#garaMayo").val(totalGarAnio);
    $("#totMayo").val(totalVenAnio + totalProAnio + totalGarAnio);

    /*  if (porMayo > 0) {

         var vTitulo = $("#tituloPor").text();
         vTitulo = parseFloat(vTitulo);

     } else {
         vTitulo = 100;
         porMayo = 0;
     }
     tituloPreAnio(vTitulo, porMayo); */

});

$("#porJunio").on("input", function() {
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

    $("#venJunio").val(totalVenAnio);
    $("#proJunio").val(totalProAnio);
    $("#garaJunio").val(totalGarAnio);
    $("#totJunio").val(totalVenAnio + totalProAnio + totalGarAnio);

    /*  if (porJunio > 0) {

         var vTitulo = $("#tituloPor").text();
         vTitulo = parseFloat(vTitulo);

     } else {
         vTitulo = 100;
         porJunio = 0;
     }
     tituloPreAnio(vTitulo, porJunio); */

});

$("#porJulio").on("input", function() {
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

    $("#venJulio").val(totalVenAnio);
    $("#proJulio").val(totalProAnio);
    $("#garaJulio").val(totalGarAnio);
    $("#totJulio").val(totalVenAnio + totalProAnio + totalGarAnio);
    /* 
        if (porJulio > 0) {

            var vTitulo = $("#tituloPor").text();
            vTitulo = parseFloat(vTitulo);

        } else {
            vTitulo = 100;
            porJulio = 0;
        }
        tituloPreAnio(vTitulo, porJulio); */

});

$("#porAgosto").on("input", function() {
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

    $("#venAgosto").val(totalVenAnio);
    $("#proAgosto").val(totalProAnio);
    $("#garaAgosto").val(totalGarAnio);
    $("#totAgosto").val(totalVenAnio + totalProAnio + totalGarAnio);

    /*  if (porAgosto > 0) {

        var vTitulo = $("#tituloPor").text();
        vTitulo = parseFloat(vTitulo);

    } else {
        vTitulo = 100;
        porAgosto = 0;
    }
    tituloPreAnio(vTitulo, porAgosto);
 */
});

$("#porSeptiembre").on("input", function() {
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

    $("#venSeptiembre").val(totalVenAnio);
    $("#proSeptiembre").val(totalProAnio);
    $("#garaSeptiembre").val(totalGarAnio);
    $("#totSeptiembre").val(totalVenAnio + totalProAnio + totalGarAnio);

    /*   if (porSeptiembre > 0) {

        var vTitulo = $("#tituloPor").text();
        vTitulo = parseFloat(vTitulo);

    } else {
        vTitulo = 100;
        porSeptiembre = 0;
    }
    tituloPreAnio(vTitulo, porSeptiembre);
 */
});

$("#porOctubre").on("input", function() {
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

    $("#venOctubre").val(totalVenAnio);
    $("#proOctubre").val(totalProAnio);
    $("#garaOctubre").val(totalGarAnio);
    $("#totOctubre").val(totalVenAnio + totalProAnio + totalGarAnio);

    /*   if (porOctubre > 0) {

          var vTitulo = $("#tituloPor").text();
          vTitulo = parseFloat(vTitulo);

      } else {
          vTitulo = 100;
          porOctubre = 0;
      }
      tituloPreAnio(vTitulo, porOctubre); */

});

$("#porNoviembre").on("input", function() {
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

    $("#venNoviembre").val(totalVenAnio);
    $("#proNoviembre").val(totalProAnio);
    $("#garaNoviembre").val(totalGarAnio);
    $("#totNoviembre").val(totalVenAnio + totalProAnio + totalGarAnio);
    /* 
        if (porNoviembre > 0) {

            var vTitulo = $("#tituloPor").text();
            vTitulo = parseFloat(vTitulo);

        } else {
            vTitulo = 100;
            porNoviembre = 0;
        }
        tituloPreAnio(vTitulo, porNoviembre);
     */
});

$("#porDiciembre").on("input", function() {
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

    $("#venDiciembre").val(totalVenAnio);
    $("#proDiciembre").val(totalProAnio);
    $("#garaDiciembre").val(totalGarAnio);
    $("#totDiciembre").val(totalVenAnio + totalProAnio + totalGarAnio);

    /* if (porDiciembre > 0) {

        var vTitulo = $("#tituloPor").text();
        vTitulo = parseFloat(vTitulo);

    } else {
        vTitulo = 100;
        porDiciembre = 0;
    }
    tituloPreAnio(vTitulo, porDiciembre);
 */
});


$(function() {
    // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
    $("#adicional").on('click', function() {
        $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
    });

    // Evento que selecciona la fila y la elimina 
    $(document).on("click", ".eliminar", function() {
        var parent = $(this).parents().get(0);
        $(parent).remove();
    });
});
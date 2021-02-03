		$(document).ready(function() {
		    load(1);
		});

		function load(page) {
		    var q = $("#q").val();
		    var codLinea = $("#codLinea").val();
		    console.log(codLinea);
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
		    /* 	    $.ajax({
		    	        type: "POST",
		    	        url: "ajax/vendedor/nuevo_vendedor.php",
		    	        data: parametros,
		    	        beforeSend: function(objeto) {
		    	            $("#resultados_ajax").html("Mensaje: Cargando...");
		    	        },
		    	        success: function(datos) {
		    	            $("#resultados_ajax").html(datos);
		    	            $('#guardar_datos').attr("disabled", false);
		    	            load(1);
		    	        }
		    	    }); */
		    event.preventDefault();
		    $("#formMes").show();
		})

		$("#editar_vendedor").submit(function(event) {
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

		/* Campos ocultos */
		$("#total_anio").hide();
		$("#formMes").hide();

		$('#close').click(function() {
		    $("#total_anio").hide();
		    $("#formMes").hide();
		    $('#guardar_datos').attr("disabled", false);
		    $('#calcularAnio').attr("disabled", false);
		    $("#incremento_anio").attr("disabled", false);
		});

		function obtener_datos(id) {

		    var cod_vendedor = $("#cod_vendedor" + id).val();
		    var cod_linea = $("#estado_vendedor" + id).val();
		    var anio_historial = $("#anio_historial" + id).val();
		    var vendidas_histroial = $("#vendidas_histroial" + id).val();
		    var promocion_historial = $("#promocion_historial" + id).val();
		    var garantia_historial = $("#garantia_historial" + id).val();
		    var facturado_historial = $("#facturado_historial" + id).val();
		    var nombre_vendedor = $("#nombre_vendedor" + id).val();
		    var nameLinea = $("#nameLinea").text();
		    $("#codVen").val(cod_vendedor);
		    $("#codLinea").val(cod_linea);
		    $("#vendidas").val(vendidas_histroial);
		    $("#promocion").val(promocion_historial);
		    $("#garantia").val(garantia_historial);
		    $("#facturado").val(facturado_historial);
		    $("#vendedor").text(nombre_vendedor + ' - ' + nameLinea);

		    // si escribe en el campo habilitar el calcular
		    // si esta habilitado calcular, habilitar guaradar
		    // si no esta habilitado calcular desabilitar guardar
		    $('#calcularAnio').click(function() {

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
		// Guardar presupuesto año




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
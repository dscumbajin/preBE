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

		    if (confirm("Realmente deseas eliminar el vendedor")) {
		        $.ajax({
		            type: "GET",
		            url: "./ajax/vendedor-linea/buscar_vendedor_linea.php",
		            data: "id=" + id,
		            "q": q,
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

		$("#guardar_vendedor").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
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
		    });
		    event.preventDefault();
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

		function obtener_datos(id) {

		    var cod_vendedor = $("#cod_vendedor" + id).val();
		    var cod_linea = $("#estado_vendedor" + id).val();
		    var anio_historial = $("#anio_historial" + id).val();
		    var vendidas_histroial = $("#vendidas_histroial" + id).val();
		    var promocion_historial = $("#promocion_historial" + id).val();
		    var garantia_historial = $("#garantia_historial" + id).val();
		    var facturado_historial = $("#facturado_historial" + id).val();

		    console.log(anio_historial);
		    $("#codVen").val(cod_vendedor);
		    $("#codLinea").val(cod_linea);
		    $("#vendidas").val(vendidas_histroial);
		    $("#promocion").val(promocion_historial);
		    $("#garantia").val(garantia_historial);
		    $("#facturado").val(facturado_historial);


		}
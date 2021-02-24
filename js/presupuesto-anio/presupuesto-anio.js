		$(document).ready(function() {
		    load(1);
		});

		function load(page) {
		    var q = $("#q").val();
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: './ajax/presupuesto-anio/buscar_presupuesto_anio.php?action=ajax&page=' + page + '&q=' + q,
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
		    if (confirm("Realmente deseas eliminar el usuario")) {
		        $.ajax({
		            type: "GET",
		            url: "./ajax/usuario/buscar_usuarios.php",
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

		$("#editar_presupuesto_anio").submit(function(event) {
		        $('#actualizar_datos').attr("disabled", true);

		        var parametros = $(this).serialize();
		        console.log(parametros);
		        $.ajax({
		            type: "POST",
		            url: "ajax/presupuesto-anio/editar_presupuesto_anio.php",
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
		    //VALIDACIONES

		// VALIDACIONES
		$('.numero').on('input', function() {
		    this.value = this.value.replace(/[^0-9]/g, '');
		});

		function obtener_datos(id) {

		    var vendedor_presupuesto = $("#vendedor_presupuesto" + id).val();
		    var linea_presupuesto = $("#linea_presupuesto" + id).val();
		    // Definir titulo del modal
		    $("#vendedor-linea").text(vendedor_presupuesto + ' - ' + linea_presupuesto);
		    // Lectura variables modificacion
		    var cantidad_ventas_presupuesto = $("#cantidad_ventas_presupuesto" + id).val();
		    var cantidad_promos_presupuesto = $("#cantidad_promos_presupuesto" + id).val();
		    var cantidad_garantia_presupuesto = $("#cantidad_garantia_presupuesto" + id).val();
		    var cantidad_total_presupuesto = $("#cantidad_total_presupuesto" + id).val();

		    $("#mod_ventas_presupuesto").val(cantidad_ventas_presupuesto);
		    $("#mod_promos_presupuesto").val(cantidad_promos_presupuesto);
		    $("#mod_garantia_presupuesto").val(cantidad_garantia_presupuesto);
		    $("#mod_total_presupuesto").val(cantidad_total_presupuesto);
		    $("#mod_id").val(id);

		    //Bloqueo campo total
		    $("#mod_total_presupuesto").attr("readonly", true);

		    // CALCULOS CON LOS INPUTS
		    $("#mod_ventas_presupuesto").on('input', function() {
		        var ventas_presupuesto = $('#mod_ventas_presupuesto').val();
		        ventas_presupuesto = parseInt(ventas_presupuesto);
		        // Bloquear los demas imput
		        $("#mod_promos_presupuesto").attr("readonly", true);
		        var promos_presupuesto = $("#mod_promos_presupuesto").val();
		        promos_presupuesto = parseInt(promos_presupuesto);
		        $("#mod_garantia_presupuesto").attr("readonly", true);
		        var garantia_presupuesto = $("#mod_garantia_presupuesto").val();
		        garantia_presupuesto = parseInt(garantia_presupuesto);
		        // Calculo total promos
		        $("#mod_total_presupuesto").val(ventas_presupuesto + promos_presupuesto + garantia_presupuesto);
		    });
		    $("#mod_promos_presupuesto").on('input', function() {
		        var promos_presupuesto = $("#mod_promos_presupuesto").val();
		        promos_presupuesto = parseInt(promos_presupuesto);
		        // Bloquear los demas imput
		        $("#mod_ventas_presupuesto").attr("readonly", true);
		        var ventas_presupuesto = $('#mod_ventas_presupuesto').val();
		        ventas_presupuesto = parseInt(ventas_presupuesto);
		        $("#mod_garantia_presupuesto").attr("readonly", true);
		        var garantia_presupuesto = $("#mod_garantia_presupuesto").val();
		        garantia_presupuesto = parseInt(garantia_presupuesto);
		        // Calculo total promos
		        $("#mod_total_presupuesto").val(ventas_presupuesto + promos_presupuesto + garantia_presupuesto);
		    });

		    $("#mod_garantia_presupuesto").on('input', function() {
		        var garantia_presupuesto = $("#mod_garantia_presupuesto").val();
		        garantia_presupuesto = parseInt(garantia_presupuesto);
		        // Bloquear los demas imput
		        $("#mod_ventas_presupuesto").attr("readonly", true);
		        var ventas_presupuesto = $('#mod_ventas_presupuesto').val();
		        ventas_presupuesto = parseInt(ventas_presupuesto);
		        $("#mod_promos_presupuesto").attr("readonly", true);
		        var promos_presupuesto = $("#mod_promos_presupuesto").val();
		        promos_presupuesto = parseInt(promos_presupuesto);
		        // Calculo total promos
		        $("#mod_total_presupuesto").val(ventas_presupuesto + promos_presupuesto + garantia_presupuesto);
		    });

		}
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

		$("#editar_usuario").submit(function(event) {
		    $('#actualizar_datos').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "ajax/usuario/editar_usuario.php",
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

		    const vendedor_presupuesto = $("#vendedor_presupuesto" + id).val();
		    const linea_presupuesto = $("#linea_presupuesto" + id).val();
		    $("#vendedor-linea").text(vendedor_presupuesto + ' - ' + linea_presupuesto);
		    var cantidad_ventas_presupuesto = $("#cantidad_ventas_presupuesto" + id).val();
		    var cantidad_promos_presupuesto = $("#cantidad_promos_presupuesto" + id).val();
		    var cantidad_garantia_presupuesto = $("#cantidad_garantia_presupuesto" + id).val();
		    var cantidad_total_presupuesto = $("#cantidad_total_presupuesto" + id).val();

		    $("#mod_ventas_presupuesto").val(cantidad_ventas_presupuesto);
		    $("#mod_promos_presupuesto").val(cantidad_promos_presupuesto);
		    $("#mod_garantia_presupuesto").val(cantidad_garantia_presupuesto);
		    $("#mod_total_presupuesto").val(cantidad_total_presupuesto);
		    $("#mod_id").val(id);

		}
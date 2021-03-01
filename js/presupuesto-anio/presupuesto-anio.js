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
		    var vendedor_presupuesto = $("#vendedor_presupuesto" + id).val();
		    var linea_presupuesto = $("#linea_presupuesto" + id).val();
		    var q = $("#q").val();
		    if (confirm(`Realmente deseas eliminar el presupuesto del Vendedor: ${vendedor_presupuesto} con Linea de negocio: ${linea_presupuesto}`)) {
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

		function detalle_presupuesto(id, id_pre) {
		    var vendedor_presupuesto = $("#vendedor_presupuesto" + id_pre).val();
		    $('#titulo_detalle').text(vendedor_presupuesto);
		    console.log(id);
		    //LLAMADO A AJAX
		    var url = './ajax/vendedor/detalle_vendedor_linea.php';
		    $.ajax({
		        tyoe: 'POST',
		        url: url,
		        data: 'codVen=' + id,
		        success: function(datos) {
		            $('#tabla_resultados').html('');
		            $('#tabla_resultados').html(datos);
		        }
		    });

		}

		// VALIDACIONES
		$('.numero').on('input', function() {
		    this.value = this.value.replace(/[^0-9]/g, '');
		});


		function buscar_datos_mes(id) {
		    var anio_presupuesto = $("#anio_presupuesto" + id).val();
		    var vendedor_presupuesto = $("#vendedor_presupuesto" + id).val();
		    var linea_presupuesto = $("#linea_presupuesto" + id).val();
		    // Definir titulo del modal
		    $("#vendedor-linea").text(`PRESUPUESTO: ${anio_presupuesto} / VENDEDOR: ${vendedor_presupuesto} - LINEA: ${linea_presupuesto}`);

		    // VALORES INFORMATIVOS PRESUPUESTO ANIO
		    var cantidad_ventas_presupuesto = $("#cantidad_ventas_presupuesto" + id).val();
		    var cantidad_promos_presupuesto = $("#cantidad_promos_presupuesto" + id).val();
		    var cantidad_garantia_presupuesto = $("#cantidad_garantia_presupuesto" + id).val();
		    var cantidad_total_presupuesto = $("#cantidad_total_presupuesto" + id).val();
		    var precioMeta = $("#precioMeta" + id).val();
		    $("#mod_ventas_presupuesto").val(cantidad_ventas_presupuesto);
		    $("#mod_promos_presupuesto").val(cantidad_promos_presupuesto);
		    $("#mod_garantia_presupuesto").val(cantidad_garantia_presupuesto);
		    $("#mod_total_presupuesto").val(cantidad_total_presupuesto);
		    $("#mod_precioMeta").val(precioMeta);
		    //Bloqueo campo total
		    $("#mod_ventas_presupuesto").attr("readonly", true);
		    $("#mod_promos_presupuesto").attr("readonly", true);
		    $("#mod_garantia_presupuesto").attr("readonly", true);
		    $("#mod_total_presupuesto").attr("readonly", true);

		    //LLAMADO A AJAX
		    var url = './ajax/presupuesto-anio/buscar_presupuesto_mes.php';
		    $.ajax({
		        tyoe: 'POST',
		        url: url,
		        data: 'idPresAnio=' + id,
		        success: function(datos) {
		            $('#tabla_resultados').html('');
		            $('#tabla_resultados').html(datos);
		        }
		    });
		}
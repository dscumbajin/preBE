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

function detalle_presupuesto(id, id_pre) {
    var vendedor_presupuesto = $("#vendedor_presupuesto" + id_pre).val();
    var anio_presupuesto = $("#anio_presupuesto" + id_pre).val();
    $('#titulo_detalle').text(`Año: ${anio_presupuesto} - Vendedor: ${vendedor_presupuesto}`);
    //LLAMADO A AJAX
    var url = './ajax/vendedor/detalle_vendedor_linea.php';
    $.ajax({
        tyoe: 'POST',
        url: url,
        data: 'codVen=' + id + '&anio=' + anio_presupuesto,
        success: function(datos) {
            $('#tabla_resultados_detalle').html('');
            $('#tabla_resultados_detalle').html(datos);
        }
    });

}


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


function eliminar(id) {
    var id_linea = $("#id_linea" + id).val();
    var anio_presupuesto = $("#anio_presupuesto" + id).val();
    var vendedor_presupuesto = $("#vendedor_presupuesto" + id).val();
    var linea_presupuesto = $("#linea_presupuesto" + id).val();
    // Definir titulo del modal
    $("#tituloEliminacion").text(`PRESUPUESTO: ${anio_presupuesto} / VENDEDOR: ${vendedor_presupuesto} - LINEA: ${linea_presupuesto}`);

    // VALORES INFORMATIVOS PRESUPUESTO ANIO
    var cantidad_ventas_presupuesto = $("#cantidad_ventas_presupuesto" + id).val();
    var cantidad_promos_presupuesto = $("#cantidad_promos_presupuesto" + id).val();
    var cantidad_garantia_presupuesto = $("#cantidad_garantia_presupuesto" + id).val();
    var cantidad_total_presupuesto = $("#cantidad_total_presupuesto" + id).val();

    $("#delete_ventas_presupuesto").val(cantidad_ventas_presupuesto);
    $("#delete_promos_presupuesto").val(cantidad_promos_presupuesto);
    $("#delete_garantia_presupuesto").val(cantidad_garantia_presupuesto);
    $("#delete_total_presupuesto").val(cantidad_total_presupuesto);
    $("#codLinea").val(id_linea);
    $("#anio").val(anio_presupuesto);
    //Bloqueo campo total
    $("#delete_ventas_presupuesto").attr("readonly", true);
    $("#delete_promos_presupuesto").attr("readonly", true);
    $("#delete_garantia_presupuesto").attr("readonly", true);
    $("#delete_total_presupuesto").attr("readonly", true);

}


$('#txtBusqueda').on('input', function() {
    var codLinea = $("#codLinea").val();
    var txtBusqueda = $('#txtBusqueda').val();
    var anio = $("#anio").val();
    var url = './ajax/presupuesto-anio/buscar_vendedor_presupuesto.php';

    if (txtBusqueda !== 0) {
        $.ajax({
            tyoe: 'POST',
            url: url,
            data: 'codLinea=' + codLinea + '&anio=' + anio + '&txtBusqueda=' + txtBusqueda,
            beforeSend: function(objeto) {
                $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
            },
            success: function(datos) {
                $('#tabla_resultados_delete').show();
                $('#tabla_resultados_delete').html('');
                $('#tabla_resultados_delete').html(datos);
                $('#loader').html('');
                //Bloqueo de Inputs
                $("#delVentas").attr("readonly", true);
                $("#delPres").attr("readonly", true);
                $("#delGran").attr("readonly", true);
                $("#delTotal").attr("readonly", true);
                // Conversion Inputs int
                var delete_ventas_presupuesto = $("#delete_ventas_presupuesto").val();
                delete_ventas_presupuesto = parseInt(delete_ventas_presupuesto);
                var delete_promos_presupuesto = $("#delete_promos_presupuesto").val();
                delete_promos_presupuesto = parseInt(delete_promos_presupuesto);
                var delete_garantia_presupuesto = $("#delete_garantia_presupuesto").val();
                delete_garantia_presupuesto = parseInt(delete_garantia_presupuesto);
                var delete_total_presupuesto = $("#delete_total_presupuesto").val();
                delete_total_presupuesto = parseInt(delete_total_presupuesto);
                //Calculos de nuevos valores

                var delVentas = $("#delVentas").val();
                delVentas = parseInt(delVentas);
                var delProm = $("#delProm").val();
                delProm = parseInt(delProm);
                var delGran = $("#delGran").val();
                delGran = parseInt(delGran);
                var delTotal = $("#delTotal").val();
                delTotal = parseInt(delTotal);

                $("#delVentas").val(delete_ventas_presupuesto + delVentas);
                $("#delProm").val(delete_promos_presupuesto + delProm);
                $("#delGran").val(delete_garantia_presupuesto + delGran);
                $("#delTotal").val(delete_total_presupuesto + delTotal);

            }

        });

    }
    $('#tabla_resultados_delete').hide();

});

function guardarReasignacion(id) {
    $('#guardar_asignacion').attr("disabled", true);
    var idPre = id;
    var ventas = $("#delVentas").val();
    var promos = $("#delProm").val();
    var garant = $("#delGran").val();
    var total = $("#delTotal").val();
    console.log(idPre + ventas + promos + garant + total);

    $.ajax({
        type: "POST",
        url: "./ajax/presupuesto-anio/eliminar_presupuesto_mes.php",
        data: 'idPre=' + id + '&ventas=' + ventas + '&promos=' + promos + '&garant=' + garant + '&total=' + total,
        beforeSend: function(objeto) {
            $("#resultados_ajax3").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajax3").html(datos);
            $('#guardar_asignacion').attr("disabled", false);
            load(1);
        }
    });

}

// VALIDACIONES
$('.numero').on('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});
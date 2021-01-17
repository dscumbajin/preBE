$(function () {
    $("#registros").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "language": {
            paginate: {
                next: 'Siguiente',
                previous: 'Anterior',
                last: 'Último',
                firts: 'Primero'
            },
            info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
            emptyTable: 'No hay registros',
            infoEmpty: 'Mostrando 0 to 0 of 0 Entradas',
            search: 'Buscar: ',
            lengthMenu: "Mostrar _MENU_ Entradas ",
            infoFiltered: " (Filtrado de un total de _MAX_  entradas)"
        }
    });

    $('#crear_registro_admin').attr('disabled', true);

    $('#repetir_password').on('input', function () {
        var password_nuevo = $('#password').val();
        if ($(this).val() == password_nuevo) {
            $('#resultado_password').text('Passwords iguales');
            $('#resultado_password').parent('.form-group').addClass('has-success').removeClass('has-error');
            $('input#password').parent('.form-group').addClass('has-success').removeClass('has-error');
            $('#crear_registro_admin').attr('disabled', false);
        } else {
            $('#resultado_password').text('Los passwords no son iguales!');
            $('#resultado_password').parent('.form-group').addClass('has-error').removeClass('has-success');
            $('input#password').parent('.form-group').addClass('has-error').removeClass('has-success');
        }
    });

    
    // Validar input tipo date
    $(".anio").focusout(function () {
        s = $(this).val();
        var bits = s.split('/');
        var d = new Date(bits[2] + '/' + bits[0] + '/' + bits[1]);
        alert(d);
    });

    /* $('#crear_registro').click(function() {
        $("#guardar-registro-archivo").validate(); // This is not working and is not validating the form
    }); */


    //Date range picker

    $('#fecha').datetimepicker({
        format: 'L',
        locale: 'es'
    });

    //Initialize Select2 Elements
    $('.seleccionar').select2();


    // DESTALLE-PROYECTO
    $("#myBtn").click(function () {
        $("#exampleModal").modal("hide");
    });

    // Supero presupuesto total vs presupuesto invertido
    $("#boton01").click(function () {
        var proyecto_id = $("#proyecto_id").val();
        var presupuesto_inversion = $("#presupuesto_inversion").text();
        var presupuesto_total = $("#presupuesto_total").text();
        if (parseInt(presupuesto_inversion) < parseInt(presupuesto_total)) {

            setTimeout(function () {
                window.location.href = `crear-cuenta.php?id=${parseInt(proyecto_id)}`;

            }, 500);

        } else {

            Swal.fire({
                title: 'Supera el presupuesto',
                text: "No se puede registrar más inversiones!",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })

        }
    });

    // Clic Guardar cambios

    $('#boton01').click(function () {
        var detalle_cerrado = $('#detalle-cerrado').text();
        console.log(detalle_cerrado);
        if (detalle_cerrado == "Cerrado") {
            $('#boton01').attr("disabled", true);
        } else {
            $('#boton01').attr("disabled", false);
        }
    });

    // Valor año del listado por estado y año

    $('#Cabecera_1').datetimepicker({
        viewMode: 'years',
        format: 'YYYY',
        onClose: function (theDate) {
            $('#valor-query').text = theDate;
        }
    });



    function crearCookie(nombre, valor, dias) {
        var expira;
        if (dias) {
            var date = new Date();
            date.setTime(date.getTime() + (dias * 24 * 60 * 60 * 1000));
            expira = "; expires=" + date.toGMTString();
        } else {
            expira = "";
        }
        document.cookie = escape(nombre) + "=" + escape(valor) + expira + "; path=/";
    }


    // Envio de parametro a url
    $('#valor-query').on('input', function () {
        var query = parseInt($(this).val());

        if (location.search.indexOf('q=') < 0) {

            crearCookie("query", query, 2);
            setTimeout(() => {
                location.reload();
            }, 2000);
        }


    }

    );

    

    $('#presupuesto').on('input', function () {
        var presu = $("#presu").text();
        var presuTotal = $('#presuTotal').text();
        /* console.log(presu);
        console.log(presuTotal); */

        if (parseInt(presuTotal) < parseInt(presu)) {
            var resto = parseInt(presu) - parseInt(presuTotal);
            $('#resultado_resto').text('La inversión puede ser menor o igual a: $ ' + resto);
            $('#presupuesto').on('input', function () {
                var input = $('#presupuesto').val();
                if (input > resto) {
                    $('#guardar-presu').attr("disabled", true);
                } else {
                    $('#guardar-presu').attr("disabled", false);
                }
            })
        } else {
            $('#presupuesto').attr('disabled', true);
            $('#guardar-presu').attr("disabled", true);
            Swal.fire({
                title: 'Supera el presupuesto',
                text: "No se puede registrar una inversión!",
                icon: 'warning',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
            setTimeout(() => {
                location.reload();
            }, 2000);
        }
    });


    // Validacion fecha anterior

    $('#input-fecha').on('input', function () {

        var input_fecha = new Date($("#input-fecha").val());
        var hoy = new Date();
        var tras = hoy.toLocaleDateString('en-US');
        var fecha_actual = new Date(tras);
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };


        if (input_fecha < fecha_actual) {

            /* console.log('no se puede ingresar lla fecha'); */
            $('#guardar-presu').attr("disabled", true);
            $('#mensaje').text('No puede registrar inversiones posteriores a la fecha: ' + fecha_actual.toLocaleDateString("es-Ec", options));
            $('#mensaje').show();
            return false;

        }
        if (input_fecha == fecha_actual) {
            /* console.log('si se puede ingresar el registro'); */
            $('#mensaje').hide();
            $('#guardar-presu').attr("disabled", false);
            return false;
        }


        if (input_fecha > fecha_actual) {
            /* console.log('si se puede ingresar el registro'); */
            $('#mensaje').hide();
            $('#guardar-presu').attr("disabled", false);
            return false;

        }

    });

    $('#cuenta-div').hide();

    $('#estado').on('change', function () {

        var estado = $("#estado option:selected").text();
        /* Elimino todos los espacios en blanco que tenga la cadena delante y detrás */
        var value_without_space = $.trim(estado);
        console.log(value_without_space);
        var number = 1 + Math.floor(Math.random() * 60000);
        var cadena = number.toString();
        var input_cuenta = $('#cuenta').val();
        //Crear nuevo proyecto
        if (value_without_space == "Análisis") {
            // mostar en input
            $('#cuenta-div').show();

            $('#cuenta').attr('placeholder', 'Numero de 1 al 30');

            $('#cuenta').val(cadena);
            console.log(number);
            // poner valor aleatorio tamaño de 8
            $('#cuenta').attr('readonly', true);
            $("#estado_neural option[value=Activar]").attr("selected",true);  
        }

        if (value_without_space == "Aprobado" && input_cuenta.length < 7) {

            // mostar en input
            $('#cuenta-div').show();
            //dejar en blanco para el ingreso
            $('#cuenta').attr('readonly', false);
            $('#cuenta').val('');
            $('#cuenta').attr('placeholder', 'formato: x.xx.xx.xx.xx');
            $('#cuenta')
                .keypress(function (event) {
                    if (this.value.length === 16) {
                        return false;
                    }
                });
            $('#cuenta').attr("pattern", '([0-9]{1,2}\.[0-9]{1,2})*');
            $("#estado_neural option[value=Activo]").attr("selected",true);  


        }
        if (value_without_space == "Proceso") {
            $('#cuenta-div').hide();
            $('#cuenta').val(cadena);
        }
        if (value_without_space == "Entrega") {
            $('#cuenta-div').hide();
            $('#cuenta').val(cadena);
        }
        if (value_without_space == "Cerrado") {
            $('#cuenta-div').hide();
            $('#cuenta').val(cadena);
        }

    });


    $('#estado-editar').on('change', function () {

        var estado = $("#estado-editar option:selected").text();
        /* Elimino todos los espacios en blanco que tenga la cadena delante y detrás */
        var value_without_space = $.trim(estado);
        console.log(value_without_space);
        var input_cuenta = $('#cuenta').val();
        console.log(input_cuenta);
        if (value_without_space == "Aprobado" && input_cuenta.length < 7) {
            // mostar en input
            $('#cuenta-div').show();
            //dejar en blanco para el ingreso
            $('#cuenta').attr('readonly', false);
            $('#cuenta').val('');
            $('#cuenta').attr('placeholder', 'formato: x.xx.xx.xx.xx');
            $('#cuenta')
                .keypress(function (event) {
                    if (this.value.length === 16) {
                        return false;
                    }
                });
            $('#cuenta').attr("pattern", '([0-9]{1,2}\.[0-9]{1,2})*');
            $("#estado_neural option[value=Activo]").attr("selected",true);  

        }
        if (value_without_space == "Aprobado" && input_cuenta.length > 8) {
            // mostar en input
            $('#cuenta-div').show();
            //dejar en blanco para el ingreso
            $('#cuenta').attr('readonly', true);
            $('#cuenta').val(input_cuenta);
            $('#cuenta').attr('placeholder', 'formato: x.xx.xx.xx.xx');
            $("#estado_neural option[value=Activo]").attr("selected",true);  

        }
        if (value_without_space == "Proceso" && input_cuenta.length > 8) {
            // mostar en input
            $('#cuenta-div').hide();
            //dejar en blanco para el ingreso
            $('#cuenta').attr('readonly', true);
            $('#cuenta').val(input_cuenta);
            $('#cuenta').attr('placeholder', 'formato: x.xx.xx.xx.xx');
            $("#estado_neural option[value=Activo]").attr("selected",true);  
        }

        if (value_without_space == "Cerrado" && input_cuenta.length > 8) {
            // mostar en input
            $('#cuenta-div').hide();
            //dejar en blanco para el ingreso
            $('#cuenta').attr('readonly', true);
            $('#cuenta').val(input_cuenta);
            $('#cuenta').attr('placeholder', 'formato: x.xx.xx.xx.xx');
            $("#estado_neural option[value=Cerrado]").attr("selected",true);  
        }
        
        if (value_without_space == "Cerrado") {
            // mostar en input
            $('#cuenta-div').hide();
            //dejar en blanco para el ingreso
            $('#cuenta').attr('readonly', true);
            $('#cuenta').val(input_cuenta);
            $('#cuenta').attr('placeholder', 'formato: x.xx.xx.xx.xx');
            $("#estado_neural option[value=Cerrado]").attr("selected",true);  
        }

        
    });


    $('#lista').click(() => {
        $('#lista').attr('href', 'admin-area.php');
    });
    $('#back').click(() => {
        window.history.back();
    });

});
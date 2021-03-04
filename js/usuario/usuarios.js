		$(document).ready(function() {
		    load(1);
		});

		function load(page) {
		    var q = $("#q").val();
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: './ajax/usuario/buscar_usuarios.php?action=ajax&page=' + page + '&q=' + q,
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

		$("#guardar_usuario").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "ajax/usuario/nuevo_usuario.php",
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

		$("#editar_usuario").submit(function(event) {
		    $('#actualizar_datos').attr("disabled", false);

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
		            $('#actualizar_datos').attr("disabled", true);
		            load(1);
		        }
		    });
		    event.preventDefault();
		})

		function obtener_datos(id) {
		    var usuario_usuario = $("#usuario_usuario" + id).val();
		    var nombre_usuario = $("#nombre_usuario" + id).val();
		    var email_usuario = $("#email_usuario" + id).val();
		    var perfil_usuario = $("#perfil_usuario" + id).val();
		    /* var password_usuario = $("#password_usuario" + id).val(); */

		    $("#mod_usuario").val(usuario_usuario);
		    $("#mod_nombre").val(nombre_usuario);
		    $("#mod_email").val(email_usuario);
		    $("#mod_perfil").val(perfil_usuario);
		    /* $("#mod_password").val(password_usuario); */
		    $("#mod_id").val(id);

		}

		//Cambiar password
		$('#cambio_pass').hide();

		$('#closeEditUsuario').on('click', function() {
		    $('#cambio_pass').hide();
		    $('#mod_password').val('');
		    $('#mod_password_very').val('');
		    $('#btn_cambio_pass').attr("disabled", false);
		    $('#actualizar_datos').attr("disabled", false);

		});

		$('#btn_cambio_pass').on('click', function() {
		    $('#cambio_pass').show();
		    $('#actualizar_datos').attr("disabled", true);

		    $('#mod_password_very').on('input', function() {
		        var password_nuevo = $('#mod_password').val();
		        if ($(this).val() == password_nuevo) {
		            $('#resultado_password').text('Passwords iguales');
		            $('#resultado_password').parent('.form-group').addClass('has-success').removeClass('has-error');
		            $('input#mod_password').parent('.form-group').addClass('has-success').removeClass('has-error');

		            $('#actualizar_datos').attr("disabled", false);
		        } else {
		            $('#resultado_password').text('Los passwords no son iguales!');
		            $('#resultado_password').parent('.form-group').addClass('has-error').removeClass('has-success');
		            $('input#mod_password').parent('.form-group').addClass('has-error').removeClass('has-success');
		            $('#actualizar_datos').attr("disabled", true);
		        }
		    });
		    $('#btn_cambio_pass').attr("disabled", true);
		});
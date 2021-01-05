$(document).ready(function() {
    // Crear un registro SOLO DATOS PLANOS, TEXTO
    $('#guardar-registro').on('submit', function(e) {
        e.preventDefault();
        var datos = $(this).serializeArray();

        // Crear llamado a Ajax
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                var resusltado = data;
                console.log(data);
                if (resusltado.respuesta == 'exito') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Se guardó corectamente',
                    })
                    setTimeout(function() {
                        window.location.href = "admin-area.php";
                    }, 2000);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error',
                    })

                }
            }
        });
    });

    // Crear un registro cuando hay un archivo: foto
    $('#guardar-registro-archivo').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this);

        // Crear llamado a Ajax
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            processData: false,
            contentType: false,
            async: true,
            cache: false,
            success: function(data) {
                console.log(data);
                var resusltado = data;
                if (resusltado.respuesta == 'exito') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Se guardó corectamente',
                    })

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error',
                    })

                }
            }
        });
    });

    //Eliminar un registro
    $('.borrar_registro').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');
        Swal.fire({
            title: 'Estas seguro?',
            text: "Un registro eliminado no se puede recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            $.ajax({
                type: 'post',
                data: {
                    'id': id,
                    'registro': 'eliminar'
                },
                url: 'modelo-' + tipo + '.php',
                success: function(data) {
                    var resultado = JSON.parse(data);
                    console.log(resultado);
                    if (resultado.respuesta === 'exito') {
                        Swal.fire(
                            'Eliminado!',
                            'Registro eliminado.',
                            'success'
                        )

                        jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('tr').remove();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se puedo eliminar!',
                        })
                    }
                }

            });
        })

    });


});
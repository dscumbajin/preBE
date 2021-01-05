$(document).ready(function(){
    // Login Admin
    $('#login-admin').on('submit', function (e) {
        e.preventDefault();
        var datos = $(this).serializeArray();

        // Crear llamado a Ajax
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function (data) {
                var resusltado = data;
                if (resusltado.respuesta == 'exitoso') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login correcto',
                        text: 'Bienvenid@ ' + resusltado.usuario + ' '
                    })
                    setTimeout(() => {
                        window.location.href = 'admin-area.php';

                    }, 2000);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Usuario o Password incorrectos',
                    })

                }
            }
        });
    });
});
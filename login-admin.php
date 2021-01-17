<?php

// Login admin
if (isset($_POST['login-admin'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try {
        include_once('funciones/db.php');
        include_once('funciones/conexion.php');
        $stmt = $con->prepare('SELECT * FROM admins WHERE usuario = ?');
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin, $email_admin, $nivel);
        // Verifica si un usuario existe
        if ($stmt->affected_rows) {
            $existe = $stmt->fetch();
            if ($existe) {
                if (password_verify($password, $password_admin)) {
                    // Manejo de sessiones dentro del programa
                    session_start();
                    $_SESSION['usuario'] = $usuario_admin;
                    $_SESSION['nombre'] = $nombre_admin;
                    $_SESSION['nivel'] = $nivel;
                    $_SESSION['id'] = $id_admin;
                    $respuesta = array(
                        'respuesta' => 'exitoso',
                        'usuario' => $nombre_admin
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
        }
        $stmt->close();
        $con->close();
    } catch (Exception $e) {
        echo 'error' . $e->getMessage();
    }

    die(json_encode(($respuesta)));
}

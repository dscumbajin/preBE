<?php

function usuario_auntenticado()
{
    if (!revisar_usuario()) {
        header('Location:login.php');
        exit();
    }
}

function revisar_usuario()
{
    return isset($_SESSION['usuario']);
}
session_start();
usuario_auntenticado();

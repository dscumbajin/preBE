<?php
 /*-------------------------
    Autor: Darwin Cumbajin N.
    Web: www.dc-dev.com
    E-Mail: cumbajindarwin@hotmail.com
    ---------------------------*/
    # conectare la base de datos
 
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
    
?>

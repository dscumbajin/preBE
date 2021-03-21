<?php
class Modelo_anio{
    function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    function Registrar_Excel($codVen, $codLinea, $anio, $ventasPresU, $promoPresU, $garantPresU, $totalPresU)
    {
        $sql = "call PA_REG_PRES_ANIO('$codVen','$codLinea','$anio','$ventasPresU','$promoPresU','$garantPresU',' $totalPresU')";
        if ($resultado = $this->conexion->conexion->query($sql)) {
            $id_retornado = mysqli_insert_id($this->conexion->conexion);
            return 1;
        } else {
            return 0;
        }
        $this->conexion->cerrar();
    }
}

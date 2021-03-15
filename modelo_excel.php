<?php
class Modelo_excel
{
    function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    function Registrar_Excel($codVen, $codLinea, $anio, $ventasU, $promocionU, $garantiaU, $facturadoV)
    {
        $sql = "call PA_REG('$codVen','$codLinea','$anio','$ventasU','$promocionU','$garantiaU',' $facturadoV')";
        if ($resultado = $this->conexion->conexion->query($sql)) {
            $id_retornado = mysqli_insert_id($this->conexion->conexion);
            return 1;
        } else {
            return 0;
        }
        $this->conexion->cerrar();
    }
}

<?php
class Modelo_mes{
    function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    function Registrar_Excel($idPresAnio, $mes, $numMes,$nomMes, $anioMes, $cantMesU, $cantPromoU, $cantGarantU, $cantTotalU, $presMesV)
    {
        $sql = "call PA_REG_PRES_MES('$idPresAnio','$mes','$numMes','$nomMes','$anioMes','$cantMesU','$cantPromoU','$cantGarantU','$cantTotalU',' $presMesV')";
        if ($resultado = $this->conexion->conexion->query($sql)) {
            $id_retornado = mysqli_insert_id($this->conexion->conexion);
            return 1;
        } else {
            return 0;
        }
        $this->conexion->cerrar();
    }
}

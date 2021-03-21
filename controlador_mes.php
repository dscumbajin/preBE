<?php
require_once('modelo_mes.php');

$ME = new Modelo_mes();

$idPresAnio = htmlspecialchars($_POST['idPresAnio'], ENT_QUOTES, 'UTF-8');
$mes = htmlspecialchars($_POST['mes'], ENT_QUOTES, 'UTF-8');
$cantMesU =htmlspecialchars($_POST['cantMesU'], ENT_QUOTES, 'UTF-8');
$cantPromoU = htmlspecialchars($_POST['cantPromoU'], ENT_QUOTES, 'UTF-8');
$cantGarantU = htmlspecialchars($_POST['cantGarantU'], ENT_QUOTES, 'UTF-8');
$cantTotalU = htmlspecialchars($_POST['cantTotalU'], ENT_QUOTES, 'UTF-8');
$presMesV =htmlspecialchars($_POST['presMesV'], ENT_QUOTES, 'UTF-8');


$arreglo_idPresAnio =  explode(",",$idPresAnio); 
$arreglo_mes  = explode(",",$mes);
$arreglo_cantMesU  = explode(",",$cantMesU);
$arreglo_cantPromoU   = explode(",",$cantPromoU);
$arreglo_cantGarantU = explode(",",$cantGarantU);
$arreglo_cantTotalU  = explode(",",$cantTotalU);
$arreglo_presMesV = explode(",",$presMesV);

for ($i=0; $i < count($arreglo_idPresAnio) ; $i++) { 
    $consulta = $ME -> Registrar_Excel($arreglo_idPresAnio[$i],$arreglo_mes[$i], $arreglo_cantMesU[$i],$arreglo_cantPromoU[$i],$arreglo_cantGarantU[$i],$arreglo_cantTotalU[$i], $arreglo_presMesV[$i]);
}
echo $consulta;
?>
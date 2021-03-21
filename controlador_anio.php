<?php
require_once('modelo_anio.php');

$ME = new Modelo_anio();

$codVen = htmlspecialchars($_POST['codVen'], ENT_QUOTES, 'UTF-8');
$codLinea = htmlspecialchars($_POST['codLinea'], ENT_QUOTES, 'UTF-8');
$anio =htmlspecialchars($_POST['anio'], ENT_QUOTES, 'UTF-8');
$ventasPresU = htmlspecialchars($_POST['ventasPresU'], ENT_QUOTES, 'UTF-8');
$promoPresU = htmlspecialchars($_POST['promoPresU'], ENT_QUOTES, 'UTF-8');
$garantPresU = htmlspecialchars($_POST['garantPresU'], ENT_QUOTES, 'UTF-8');
$totalPresU =htmlspecialchars($_POST['totalPresU'], ENT_QUOTES, 'UTF-8');


$arreglo_codVen =  explode(",",$codVen); 
$arreglo_codLinea  = explode(",",$codLinea);
$arreglo_anio  = explode(",",$anio);
$arreglo_ventasPresU   = explode(",",$ventasPresU);
$arreglo_promoPresU = explode(",",$promoPresU);
$arreglo_garantPresU  = explode(",",$garantPresU);
$arreglo_totalPresU = explode(",",$totalPresU);

for ($i=0; $i < count($arreglo_codVen) ; $i++) { 
    $consulta = $ME -> Registrar_Excel($arreglo_codVen[$i],$arreglo_codLinea[$i], $arreglo_anio[$i],$arreglo_ventasPresU[$i],$arreglo_promoPresU[$i],$arreglo_garantPresU[$i], $arreglo_totalPresU[$i]);
}
echo $consulta;
?>
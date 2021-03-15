<?php
require_once('modelo_excel.php');

$ME = new Modelo_excel();

$codVen = htmlspecialchars($_POST['codVen'], ENT_QUOTES, 'UTF-8');
$codLinea = htmlspecialchars($_POST['codLinea'], ENT_QUOTES, 'UTF-8');
$anio =htmlspecialchars($_POST['anio'], ENT_QUOTES, 'UTF-8');
$ventasU = htmlspecialchars($_POST['ventasU'], ENT_QUOTES, 'UTF-8');
$promocionU = htmlspecialchars($_POST['promocionU'], ENT_QUOTES, 'UTF-8');
$garantiaU = htmlspecialchars($_POST['garantiaU'], ENT_QUOTES, 'UTF-8');
$facturadoV =htmlspecialchars($_POST['facturadoV'], ENT_QUOTES, 'UTF-8');


$arreglo_codVen =  explode(",",$codVen); 
$arreglo_codLinea  = explode(",",$codLinea);
$arreglo_anio  = explode(",",$anio);
$arreglo_ventasU   = explode(",",$ventasU);
$arreglo_promocionU = explode(",",$promocionU);
$arreglo_garantiaU  = explode(",",$garantiaU);
$arreglo_facturadoV = explode(",",$facturadoV);

for ($i=0; $i < count($arreglo_codVen) ; $i++) { 
    $consulta = $ME -> Registrar_Excel($arreglo_codVen[$i],$arreglo_codLinea[$i], $arreglo_anio[$i],$arreglo_ventasU[$i],$arreglo_promocionU[$i],$arreglo_garantiaU[$i], $arreglo_facturadoV[$i]);
}
echo $consulta;
?>
<?php
if (is_array($_FILES['archivoexcel']) && count($_FILES['archivoexcel']) > 0) {
    // Llamamos a libreria PHPExcel
    require_once 'PHPExcel/Classes/PHPExcel.php';
    //Llamamos a la conexion base de datos
    include('./ajax/is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
    /* Connect To Database*/
    require_once("./funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once("./funciones/conexion.php"); //Contiene funcion que conecta a la base de datos

    $tempfname = $_FILES['archivoexcel']['tmp_name'];
    $leerexcel = PHPExcel_IOFactory::createReaderForFile($tempfname);

    // Cargar excel
    $excelobj = $leerexcel->load($tempfname);
    //Cargar en que hoja trabajaremos
    $hoja = $excelobj->getSheet(0);
    $filas = $hoja->getHighestRow();

    echo "<div class='table-responsive'>
    <table id='tabla_detalle' class='table table-bordered table-striped'>
    <thead>    
    <tr bgcolor='black' style='color:#ffffff; font-weight: bold; text-transform: uppercase;' >
    <td> idPresAnio</td>
    <td> mes</td>
    <td> cantMesU</td>
    <td> cantPromoU</td>
    <td> cantGarantU</td>
    <td> cantTotalU</td>
    <td> presMesV</td>
    </tr>
    </thead><tbody id='tbody_tabla_detalle'>
    ";
    for ($row=2; $row<=$filas; $row++) { 
        $idPresAnio = $hoja->getCell('A'. $row)->getValue();
        $mes = $hoja->getCell('B'. $row)->getValue();
        $cantMesU = $hoja->getCell('C'. $row)->getValue();
        $cantPromoU = $hoja->getCell('D'. $row)->getValue();
        $cantGarantU = $hoja->getCell('E'. $row)->getValue();
        $cantTotalU = $hoja->getCell('F'. $row)->getValue();
        $presMesV = $hoja->getCell('G'. $row)->getValue();
        $query = "SELECT COUNT(*) AS contador FROM presupuesto_mes WHERE idPresAnio='".$idPresAnio."'";
        $resultado = $con->query($query);
        $respuesta = $resultado->fetch_assoc();

        if($respuesta['contador']=='0'){
            if ($idPresAnio=="") {
                # code...
            } else {
                echo"<tr>";
                echo "<td>".$idPresAnio."</td>";
                echo "<td>".$mes."</td>";
                echo "<td>".$cantMesU."</td>";
                echo "<td>".$cantPromoU."</td>";
                echo "<td>".$cantGarantU."</td>";
                echo "<td>".$cantTotalU."</td>";
                echo "<td>".$presMesV."</td>";
                echo"</tr>";
            }
        }     
       
    } echo "</tbody></table></div>";
}
?>

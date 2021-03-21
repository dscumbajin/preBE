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
    <td> codVen</td>
    <td> codLinea</td>
    <td> año</td>
    <td> ventasPresU</td>
    <td> promoPresU</td>
    <td> garantPresU</td>
    <td> totalPresU</td>
    </tr>
    </thead><tbody id='tbody_tabla_detalle'>
    ";
    for ($row=2; $row<=$filas; $row++) { 
        $codVen = $hoja->getCell('A'. $row)->getValue();
        $codLinea = $hoja->getCell('B'. $row)->getValue();
        $anio = $hoja->getCell('C'. $row)->getValue();
        $ventasPresU = $hoja->getCell('D'. $row)->getValue();
        $promoPresU = $hoja->getCell('E'. $row)->getValue();
        $garantPresU = $hoja->getCell('F'. $row)->getValue();
        $totalPresU = $hoja->getCell('G'. $row)->getValue();
        $query = "SELECT COUNT(*) AS contador FROM presupuesto_anio WHERE codVen='".$codVen."' AND codLinea='".$codLinea."' AND anio='".$anio."'";
        $resultado = $con->query($query);
        $respuesta = $resultado->fetch_assoc();

        if($respuesta['contador']=='0'){
            if ($codVen=="") {
                # code...
            } else {
                echo"<tr>";
                echo "<td>".$codVen."</td>";
                echo "<td>".$codLinea."</td>";
                echo "<td>".$anio."</td>";
                echo "<td>".$ventasPresU."</td>";
                echo "<td>".$promoPresU."</td>";
                echo "<td>".$garantPresU."</td>";
                echo "<td>".$totalPresU."</td>";
                echo"</tr>";
            }
        }     
       
    } echo "</tbody></table></div>";
}
?>

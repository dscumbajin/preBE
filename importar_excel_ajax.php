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
    <td> ventasU</td>
    <td> promocionU</td>
    <td> garantiaU</td>
    <td> facturadoV</td>
    </tr>
    </thead><tbody id='tbody_tabla_detalle'>
    ";
    for ($row=2; $row<=$filas; $row++) { 
        $codVen = $hoja->getCell('A'. $row)->getValue();
        $codLinea = $hoja->getCell('B'. $row)->getValue();
        $anio = $hoja->getCell('C'. $row)->getValue();
        $ventasU = $hoja->getCell('D'. $row)->getValue();
        $promocionU = $hoja->getCell('E'. $row)->getValue();
        $garantiaU = $hoja->getCell('F'. $row)->getValue();
        $facturadoV = $hoja->getCell('G'. $row)->getValue();
        $query = "SELECT COUNT(*) AS contador FROM historial_ventas WHERE codVen='".$codVen."' AND codLinea='".$codLinea."' AND anio='".$anio."'";
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
                echo "<td>".$ventasU."</td>";
                echo "<td>".$promocionU."</td>";
                echo "<td>".$garantiaU."</td>";
                echo "<td>".$facturadoV."</td>";
                echo"</tr>";
            }
        }     
       
    } echo "</tbody></table></div>";
}
?>

<script>

/* $("#tabla_detalle").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "language": {
            paginate: {
                next: 'Siguiente',
                previous: 'Anterior',
                last: 'Último',
                firts: 'Primero'
            },
            info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
            emptyTable: 'No hay registros',
            infoEmpty: 'Mostrando 0 to 0 of 0 Entradas',
            search: 'Buscar: ',
            lengthMenu: "Mostrar _MENU_ Entradas ",
            infoFiltered: " (Filtrado de un total de _MAX_  entradas)"
        },
        "buttons": ["excel"]
    }).buttons().container().appendTo('#registros_wrapper .col-md-6:eq(0)');
 */
</script>
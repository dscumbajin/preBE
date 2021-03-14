<?php

include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../funciones/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../funciones/conexion.php"); //Contiene funcion que conecta a la base de datos


$fileContacts = $_FILES['fileContacts']; 
$fileContacts = file_get_contents($fileContacts['tmp_name']); 

$fileContacts = explode("\n", $fileContacts);
$fileContacts = array_filter($fileContacts); 

// preparar contactos (convertirlos en array)
foreach ($fileContacts as $contact) 
{
	$contactList[] = explode(";", $contact);
}

// insertar contactos
foreach ($contactList as $contactData) 
{
	$con->query("INSERT INTO historial_ventas 
						(codVen,
						 codLinea,
						 anio,
						 ventasU,
						 promocionU,
                         garantiaU,
                         facturadoV)
						 VALUES

						 ('{$contactData[0]}',
						  '{$contactData[1]}', 
						  '{$contactData[2]}',
						  {$contactData[3]},
						  {$contactData[4]},
                          {$contactData[5]},
                          {$contactData[6]}
						   )

						 "); 
}

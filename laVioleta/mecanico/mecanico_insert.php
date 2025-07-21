<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$especialidad = $_POST["especialidad"];
$codigoContrato = $_POST["codigoContrato"];

if (empty($_POST['codigoContrato'])) {
    // Si está vacío, usamos la palabra literal NULL para la consulta
    $codigoContratoSQL = "NULL";
} else {
    // Si tiene un valor, nos aseguramos que sea un número y le ponemos comillas
    $codigoContratoSQL = "'" . intval($_POST['codigoContrato']) . "'";
}


// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `mecanico`(`codigo`,`nombre`, `telefono`, `especialidad`, `codigoContrato`) VALUES ('$codigo', '$nombre', '$telefono', '$especialidad', $codigoContratoSQL)";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: mecanico.php");
else:
	echo "Ha ocurrido un error al crear el mecánico";
endif;

mysqli_close($conn);
<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$fabricante = $_POST["fabricante"];
$precio = $_POST["precio"];
$fechaAdquisicion = $_POST["fechaAdquisicion"];
$descripcion = $_POST["descripcion"];
$fechaInspeccion = $_POST["fechaInspeccion"];
$fechaUltimaReparacion = $_POST["fechaUltimaReparacion"];
$mecanicoInspeccionId = $_POST["mecanicoInspeccionId"];
$mecanicoReparacionId = $_POST["mecanicoReparacionId"];

if (empty($_POST['mecanicoReparacionId'])) {
    // Si está vacío, usamos la palabra literal NULL para la consulta
    $mecanicoReparacionIdSQL = "NULL";
} else {
    // Si tiene un valor, nos aseguramos que sea un número y le ponemos comillas
    $mecanicoReparacionIdSQL = "'" . intval($_POST['mecanicoReparacionId']) . "'";
}

if (empty($_POST['fechaUltimaReparacion'])) {
    // Si está vacío, usamos la palabra literal NULL para la consulta
    $fechaUltimaReparacionSQL = "NULL";
} else {
    // Si tiene un valor, nos aseguramos que sea un número y le ponemos comillas
    $fechaUltimaReparacionSQL = "'" . mysqli_real_escape_string($conn, $_POST['fechaUltimaReparacion']) . "'";
}

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `maquina`(`codigo`, `nombre`, `fabricante`, `precio`, `fechaAdquisicion`, `descripcion`, `fechaInspeccion`, `fechaUltimaReparacion`, `mecanicoInspeccionId`, `mecanicoReparacionId`) VALUES ('$codigo', '$nombre', '$fabricante', '$precio', '$fechaAdquisicion', '$descripcion', '$fechaInspeccion', $fechaUltimaReparacionSQL, '$mecanicoInspeccionId', $mecanicoReparacionIdSQL)";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: maquina.php");
else:
	echo "Ha ocurrido un error al crear la maquina";
endif;

mysqli_close($conn);

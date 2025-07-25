<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 1</h1>

<p class="mt-3">
    Se muestran las 3 máquinas de mayor valor que aún no han sido asignadas a un mecánico consultor que las repare.
     <p>Por cada consulta se muestra:</p>
     <p>-Referente a la máquina: código, nombre y precio</p> 
     <p>-Referente al mecánico consultor que inspecciona: código, nombre</p>
     <p>-Referente al mecánico consultor que repara: Se muestra que efectivamente no se ha asignado</p> 
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = "SELECT 
    maquina.codigo, 
    maquina.nombre, 
    maquina.precio,
    maquina.mecanicoInspeccionId,
    maquina.mecanicoReparacionId,
    mecanico.nombre AS nombreMecanicoInspeccion
    FROM 
        maquina
    JOIN 
        mecanico ON maquina.mecanicoInspeccionId = mecanico.codigo
    WHERE 
        maquina.mecanicoReparacionId IS NULL
    ORDER BY 
        maquina.precio DESC, 
        maquina.codigo
    LIMIT 3";

// Ejecutar la consulta
$resultadoC1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC1 and $resultadoC1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código Máquina</th>
                <th scope="col" class="text-center">Nombre Máquina</th>
                <th scope="col" class="text-center">Precio</th>
                <th scope="col" class="text-center">Código Mecánico Reparador</th>
                <th scope="col" class="text-center">Código Mecánico Inspeccionador</th>
                <th scope="col" class="text-center">Nombre mecánico Inspeccionador</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["precio"]; ?></td>
                <td class="text-center"><?= $fila["mecanicoReparacionId"]; ?></td>
                <td class="text-center"><?= $fila["mecanicoInspeccionId"]; ?></td>
                <td class="text-center"><?= $fila["nombreMecanicoInspeccion"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php
endif;

include "../includes/footer.php";
?>
<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 2</h1>

<p class="mt-3">
    Se muestran los mecánicos consultores con contrato asociado que han reparado por lo menos dos máquinas y que no han inspeccionado ninguna máquina
     <p>Por cada consulta se muestra:</p>
     <p>-Referente a los datos del mecánico: cédula, nombre y contrato</p> 
     <p>-Cantidad de reparaciones hechas a máquinas -> debe mostras >=2</p>
     <p>-Cantidad de inspecciones hechas a máquinas -> debe mostrar 0 </p> 
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = "SELECT mc.codigo,mc.nombre,mc.codigoContrato,
    COUNT(CASE WHEN mc.codigo=m.mecanicoReparacionId THEN 1 ELSE NULL END) AS maquinas_reparadas,
    COUNT(CASE WHEN mc.codigo=m.mecanicoInspeccionId THEN 1 ELSE NULL END) AS maquinas_inspeccionadas
FROM mecanico AS mc, maquina AS m
WHERE mc.codigoContrato IS NOT NULL
GROUP BY 
    mc.codigo,
    mc.nombre,
    mc.telefono,
    mc.especialidad,
    mc.codigoContrato
HAVING maquinas_reparadas >=2 AND maquinas_inspeccionadas =0;";

// Ejecutar la consulta
$resultadoC2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC2 and $resultadoC2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Cédula mecánico</th>
                <th scope="col" class="text-center">Nombre mecánico</th>
                <th scope="col" class="text-center">Código contrato</th>
                <th scope="col" class="text-center">Cantidad de reparaciones a máquinas</th>
                <th scope="col" class="text-center">Cantidad de inspecciones a máquinas</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["codigoContrato"]; ?></td>
                <td class="text-center"><?= $fila["maquinas_reparadas"]; ?></td>
                <td class="text-center"><?= $fila["maquinas_inspeccionadas"]; ?></td>
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
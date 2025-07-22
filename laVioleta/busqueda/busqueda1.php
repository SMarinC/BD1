<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 1</h1>

<p class="mt-3">
    El código de un contrato. Se debe mostrar todas las maquinas que fueron reparadas
    por el mecánico asociado a dicho contrato pero siempre y cuando la fecha de dichas
    reparaciones esté por fuera del intervalo de fechas de dicho contrato. (Esto significa que
    fueron reparaciones ejecutadas por el mecánico cuando no tenía contrato).
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda1.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigoContrato" class="form-label">Código del contrato</label>
            <select id="codigoContrato" name="codigoContrato" class="form-select" >

                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../contrato/contrato_select.php");
                
                // Verificar si llegan datos
                if($resultadoContrato):

                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoContrato as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["codigo"]; ?>"> codigo <?= $fila["codigo"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $codigoContrato = $_POST["codigoContrato"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía) VIOLETAAAAAAAAAAAAAAAAAAAAAA AQUI VA EL QUERY
    $query = "SELECT contrato.fechaInicio,contrato.fechaLiquidacion,
              mecanico.codigo as codigoMecanico,mecanico.nombre as nombreMecanico,
              maquina.codigo as codigoMaquina,maquina.nombre as nombreMaquina,maquina.fechaUltimaReparacion 
    FROM contrato JOIN mecanico on contrato.codigo=mecanico.codigoContrato
    JOIN maquina on maquina.mecanicoReparacionId=mecanico.codigo
    WHERE contrato.codigo=$codigoContrato 
          AND NOT (maquina.fechaUltimaReparacion BETWEEN contrato.fechaInicio AND contrato.fechaLiquidacion)";

    // Ejecutar la consulta
    $resultadoB1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB1 and $resultadoB1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Fecha Inicio contrato</th>
                <th scope="col" class="text-center">Fecha Liquidación Contrato</th>
                <th scope="col" class="text-center">Código mecanico</th>
                <th scope="col" class="text-center">Nombre Mecánico</th>
                <th scope="col" class="text-center">Código máquina</th>
                <th scope="col" class="text-center">Nombre máquina</th>
                <th scope="col" class="text-center">Fecha reparación máquina</th>
        
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["fechaInicio"]; ?></td>
                <td class="text-center"><?= $fila["fechaLiquidacion"]; ?></td>
                <td class="text-center"><?= $fila["codigoMecanico"]; ?></td>
                <td class="text-center"><?= $fila["nombreMecanico"]; ?></td>
                <td class="text-center"><?= $fila["codigoMaquina"]; ?></td>
                <td class="text-center"><?= $fila["nombreMaquina"]; ?></td>
                <td class="text-center"><?= $fila["fechaUltimaReparacion"]; ?></td>
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
endif;

include "../includes/footer.php";
?>
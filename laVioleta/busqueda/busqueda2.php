<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda 2</h1>

<p class="mt-3">
    El código de una Máquina. Se debe mostrar todos los datos del contrato
    asociado al mecánico que inspecciono (mecánico Inspector) dicha reparación.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigoMaquina" class="form-label">Código de la maquina</label>
            <select id="codigoMaquina" name="codigoMaquina" class="form-select" >

                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../maquina/maquina_select.php");
                
                // Verificar si llegan datos
                if($resultadoMaquina):

                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoMaquina as $fila):
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

    $codigoMaquina = $_POST["codigoMaquina"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía) VIOLETAAAAAAAAAAAAAAAAAAA AQUI EL QUERY
    $query = "SELECT maquina.mecanicoInspeccionId,mecanico.nombre,contrato.codigo, contrato.tipo, 
                     contrato.salario,contrato.fechaInicio,contrato.fechaLiquidacion
     FROM maquina JOIN mecanico on maquina.mecanicoInspeccionId=mecanico.codigo
          JOIN contrato on contrato.codigo=mecanico.codigoContrato
     WHERE maquina.codigo=$codigoMaquina";

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB2 and $resultadoB2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código mecánico Inspector</th>
                <th scope="col" class="text-center">Nombre mecánico Inspector</th>
                <th scope="col" class="text-center">Código contrato</th>
                <th scope="col" class="text-center">Tipo contrato</th>
                <th scope="col" class="text-center">Salario</th>
                <th scope="col" class="text-center">Fecha de inicio</th>
                <th scope="col" class="text-center">Fecha de liquidación</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                 
                <td class="text-center"><?= $fila["mecanicoInspeccionId"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["tipo"]; ?></td>
                <td class="text-center">$<?= $fila["salario"]; ?></td>
                <td class="text-center"> <?= $fila["fechaInicio"]; ?></td>
                <td class="text-center"> <?= $fila["fechaLiquidacion"]; ?></td>
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
<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a CONTRATO (CONTRATO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="contrato_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de contrato</label>
            <input type="text" class="form-control" id="tipo" name="tipo" required>
        </div>

        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" class="form-control" id="salario" name="salario" required>
        </div>

        <div class="mb-3">
            <label for="fechaInicio" class="form-label">Fecha de inicio de la contratación</label>
            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
        </div>

        <div class="mb-3">
            <label for="fechaLiquidacion" class="form-label">Fecha de liquidacion del contrato</label>
            <input type="date" class="form-control" id="fechaLiquidacion" name="fechaLiquidacion" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("contrato_select.php");

// Verificar si llegan datos
if($resultadoContrato and $resultadoContrato->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Tipo</th>
                <th scope="col" class="text-center">Salario</th>
                <th scope="col" class="text-center">Fecha de inicio</th>
                <th scope="col" class="text-center">Fecha de liquidación</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoContrato as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
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

<?php
endif;

mysqli_close($conn);

include "../includes/footer.php";
?>
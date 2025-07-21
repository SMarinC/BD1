<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a MECÁNICO (MECÁNICO CONSULTOR)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="mecanico_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="number" class="form-control" id="telefono" name="telefono" required>
        </div>

        <div class="mb-3">
            <label for="especialidad" class="form-label">Especialidad</label>
            <input type="text" class="form-control" id="especialidad" name="especialidad" required>
        </div>

        <div class="mb-3">
            <label for="codigoContrato" class="form-label">Código del contrato asociado al mecanico</label>
            <select id="codigoContrato" name="codigoContrato" class="form-select" >

                <!-- Option por defecto -->
                <option value="" ></option>

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

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("mecanico_select.php");

// Verificar si llegan datos
if($resultadoMecanico and $resultadoMecanico->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Telefono</th>
                <th scope="col" class="text-center">Especialidad</th>
                <th scope="col" class="text-center">Código del contrato</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoMecanico as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["telefono"]; ?></td>
                <td class="text-center"><?= $fila["especialidad"]; ?></td>
                <td class="text-center"><?= $fila["codigoContrato"]; ?></td>

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
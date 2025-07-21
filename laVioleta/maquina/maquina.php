<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a REPARACIÓN (MÁQUINA)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="maquina_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="fabricante" class="form-label">Fabricante</label>
            <input type="text" class="form-control" id="fabricante" name="fabricante" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" required>
        </div>

        <div class="mb-3">
            <label for="fechaAdquisicion" class="form-label">Fecha en que se adquirio la maquina</label>
            <input type="date" class="form-control" id="fechaAdquisicion" name="fechaAdquisicion" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción de la maquina</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" >
        </div>
        
        <div class="mb-3">
            <label for="fechaInspeccion" class="form-label">Fecha de inspeccion de la maquina</label>
            <input type="date" class="form-control" id="fechaInspeccion" name="fechaInspeccion" required>
        </div>

        <div class="mb-3">
            <label for="fechaUltimaReparacion" class="form-label">Ultima fecha donde fue reparada la maquina</label>
            <input type="date" class="form-control" id="fechaUltimaReparacion" name="fechaUltimaReparacion" >
        </div>

        <!-- Consultar la lista de mecanicos y desplegarlos para seleccionar inspector -->
        <div class="mb-3">
            <label for="mecanicoInspeccionId" class="form-label">Mecanico Inspector</label>
            <select name="mecanicoInspeccionId" id="mecanicoInspeccionId" class="form-select " required>

                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../mecanico/mecanico_select.php");
                
                // Verificar si llegan datos
                if($resultadoMecanico):

                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoMecanico as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["codigo"]; ?>"><?= $fila["nombre"]; ?> - C.C. <?= $fila["codigo"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <!-- Consultar la lista de mecanicos excepto el inspector -->
        <div class="mb-3">
            <label for="mecanicoReparacionId" class="form-label">Mecanico Reparador: por politica debe ser distinto a quien inspecciona, dado caso quieras agregar igual campos presentara un error</label>
            <select name="mecanicoReparacionId" id="mecanicoReparacionId" class="form-select">

                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../mecanico/mecanico_select.php");
                
                // Verificar si llegan datos
                if($resultadoMecanico):

                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoMecanico as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["codigo"]; ?>"><?= $fila["nombre"]; ?> - C.C. <?= $fila["codigo"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("maquina_select.php");
            
// Verificar si llegan datos
if($resultadoMaquina and $resultadoMaquina->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Fabricante</th>
                <th scope="col" class="text-center">Precio</th>
                <th scope="col" class="text-center">Fecha de adquisición</th>
                <th scope="col" class="text-center">Descripción</th>
                <th scope="col" class="text-center">Fecha de inspección</th>
                <th scope="col" class="text-center">fecha de reparación</th>
                <th scope="col" class="text-center">Mecanico inspector ID</th>
                <th scope="col" class="text-center">Mecanico reparador ID</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoMaquina as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["fabricante"]; ?></td>
                <td class="text-center">$<?= $fila["precio"]; ?></td>
                <td class="text-center"><?= $fila["fechaAdquisicion"]; ?></td>
                <td class="text-center"><?= $fila["descripcion"]; ?></td>
                <td class="text-center"><?= $fila["fechaInspeccion"]; ?></td>
                <td class="text-center"><?= $fila["fechaUltimaReparacion"]; ?></td>
                <td class="text-center"><?= $fila["mecanicoInspeccionId"]; ?></td>
                <td class="text-center"><?= $fila["mecanicoReparacionId"]; ?></td>
                
                
                

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
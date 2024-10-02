<?php
use Model\Dependencia;
$dependencia = new Dependencia($_GET);
$dependencias = $dependencia->buscar();
?>

<div class="row justify-content-center">
    <form class="col-lg-5 border rounded shadow p-4" style="background-color: #26252533;" enctype="multipart/form-data" id="formOperacion">
        <h3 class="text-center mb-4" style="font-family: 'Cinzel', serif; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5); font-size: 2.5rem; color: #0056b3;">
            <p>Registro de Operaciones</p>
        </h3>
        <div class="mb-3">
            <input type="hidden" name="operacion_id" id="operacion_id" class="form-control">
        </div>
        <div class="mb-3">
            <label for="operacion_nombre" class="form-label">Ingrese nombre de la Operación realizada</label>
            <input type="text" name="operacion_nombre" id="operacion_nombre" class="form-control" placeholder="Ingresa el nombre de la operacion" style="border: 1px solid #007bff;">
        </div>
        <div class="mb-3">
            <label for="operacion_descripcion" class="form-label">Describa la operacion realizada</label>
            <input type="text" name="operacion_descripcion" id="operacion_descripcion" class="form-control" placeholder="Escriba aquí" style="border: 1px solid #007bff;">
        </div>
        <div class="row mb-3">
                <div class="col">
                    <label for="operacion_dependencia">Seleccione la Dependencia </label>
                    <select name="operacion_dependencia" id="operacion_dependencia" class="form-control" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($dependencias as $dependencia) : ?>
                            <option value="<?= $dependencia['dependencia_id'] ?>">
                                <?= $dependencia['dependencia_nombre'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
        </div>
     
        <div class="mb-3">
            <label for="operacion_direccion" class="form-label">Ingrese la direccion de la dependencia</label>
            <input type="text" name="operacion_direccion" id="operacion_direccion" class="form-control" placeholder="Ingresa el nombre de la dependencia" style="border: 1px solid #007bff;">
        </div>
        <div class="mb-3">
            <label for="operacion_ubicacion" class="form-label">Ingrese la ubicacion de la dependencia</label>
            <input type="text" name="operacion_ubicacion" id="operacion_ubicacion" class="form-control" placeholder="Coordenadas geográficas (ej. 15.783471, -90.230759)" style="border: 1px solid #007bff;">
        </div>
        <div class="mb-3">
            <label for="operacion_cantidad" class="form-label">Ingrese cantidad de operaciones realizadas</label>
            <input type="number" name="operacion_cantidad" id="operacion_cantidad" class="form-control" placeholder="Ingrese cantidad de operaciones aqui" style="border: 1px solid #007bff;">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="operacion_fecha">Fecha de la Operacion</label>
                <input type="datetime-local" name="operacion_fecha" id="operacion_fecha" class="form-control" style="border: 1px solid #007bff;">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaOperaciones">
        </table>
    </div>
</div>
<script src="<?= asset('/build/js/operacion/index.js') ?>"></script>
<script src="<?= asset('/build/js/funciones.js') ?>"></script>
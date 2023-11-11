<h1 class="text-center">Equipos en mantenimiento o Reparacion</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioMantenimiento">
        <!-- <input type="hidden" name="marca_equipo_codigo" id="marca_equipo_codigo"> -->
        <div class="row mb-3">
            <div class="col">
                <label for="equipo_tipo">
                    <i class="fas fa-puzzle-piece"></i> <strong>Tipo de Equipos</strong>
                </label>
                <select name="tipo_equipo_codigo" id="tipo_equipo_codigo" class="form-control">
                    <option value="">Selecione puesto...</option>
                    <?php foreach ($TipoEquipo as $TipoEquipo): ?>
                        <option value="<?= $TipoEquipo['tipo_equipo_codigo'] ?>">
                            <?= $TipoEquipo['tipo_equipo_descripcion'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>
    </form>
</div>

<div class="row justify-content-center">
    <div class="col table-responsive" style="max-width: 80%; padding: 10px;">
        <table id="tablaEquipos" class="table table-bordered table-hover">
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/mantenimiento/index.js') ?>"></script>
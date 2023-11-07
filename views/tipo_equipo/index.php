<h1 class="text-center">Formulario de Tipos de Equipo</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioTipoEquipo"> <!-- Actualiza el ID del formulario -->
        <input type="hidden" name="tipo_equipo_codigo" id="tipo_equipo_codigo"> <!-- Actualiza el nombre del campo -->
        <div class="row mb-3">
            <div class="col">
                <label for="tipo_equipo_descripcion">Descripción del tipo de equipo</label> <!-- Actualiza el nombre del campo -->
                <input type="text" name="tipo_equipo_descripcion" id="tipo_equipo_descripcion" class="form-control"> <!-- Actualiza el nombre del campo -->
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioTipoEquipo" id="btnGuardar" class="btn btn-primary w-100">Guardar</button> <!-- Actualiza el ID del formulario -->
            </div>
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
        <table id="tablaTiposEquipo" class="table table-bordered table-hover"> <!-- Actualiza el ID de la tabla -->
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/tipoequipo/index.js')  ?>"></script>
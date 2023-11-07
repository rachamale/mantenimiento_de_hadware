<h1 class="text-center">Formulario de Estados de Equipos</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioEquipoEstado"> <!-- Actualiza el ID del formulario -->
        <input type="hidden" name="equipo_estado_codigo" id="equipo_estado_codigo"> <!-- Actualiza el nombre del campo -->
        <div class="row mb-3">
            <div class="col">
                <label for="equipo_estado_descripcion">Nombre del estado del equipo</label> <!-- Actualiza el nombre del campo -->
                <input type="text" name="equipo_estado_descripcion" id="equipo_estado_descripcion" class="form-control"> <!-- Actualiza el nombre del campo -->
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioEquipoEstado" id="btnGuardar" class="btn btn-primary w-100">Guardar</button> <!-- Actualiza el ID del formulario -->
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
        <table id="tablaEquipoEstado" class="table table-bordered table-hover"> <!-- Actualiza el ID de la tabla -->
        </table>
    </div>
</div>



<script src="<?= asset('./build/js/equipo_estado/index.js')  ?>"></script>



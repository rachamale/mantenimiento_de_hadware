<h1 class="text-center">Equipos Listos Para Entregar</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioMantenimiento2">
        <input type="hidden" name="marca_equipo_codigo" id="marca_equipo_codigo">
        <div class="row mb-3">
            <div class="col">
                <label for="tipo_equipo_codigo">
                    <i class="fas fa-puzzle-piece"></i> <strong>Equipos Listos</strong>
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
        <table id="tablaEquipos2" class="table table-bordered table-hover">
        </table>
    </div>
</div>


<div class="modal fade" id="asignarOficialModal" name="asignarOficialModal" tabindex="-1" role="dialog"
    aria-labelledby="asignarOficialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow-lg">
            <!-- Agregamos la clase "shadow-lg" para aplicar una sombra más pronunciada -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="asignarOficialModalLabel">SOPORTE TÉCNICO</h5>
                <button type="button" class="close btn btn-info" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Salir de esta ventana</span>
                </button>
            </div>
            <div class="modal-body" id="asignarOficialModalBody">
                <h3 class="text-center mt-4 mb-4 p-3 rounded bg-light">Formulario para Entregar Equipo</h3>

                <form class="col-lg-8 border rounded bg-light p-3 container" id="formularioGuarda">
                    <div class="container">
                        <div class="row justify-content-center mb-5">
                            <input type="input" name="equipo_codigo" id="equipo_codigo" hidden>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="equipo_fecha_entrega">Fecha</label>
                                    <input type="date" name="equipo_fecha_entrega" id="equipo_fecha_entrega"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="equipo_usuario_cat_recibe">Catálogo del Usuario</label>
                                    <input type="number" name="equipo_usuario_cat_recibe" id="equipo_usuario_cat_recibe"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="equipo_usuario_nombre">Nombre del Usuario</label>
                                    <input type="text" name="equipo_usuario_nombre" id="equipo_usuario_nombre"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="equipo_tecnico_entrega">Catálogo del Técnico</label>
                                    <input type="number" name="equipo_tecnico_entrega" id="equipo_tecnico_entrega"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="equipo_tecnico_nombre">Nombres del Técnico</label>
                                    <input type="text" name="equipo_tecnico_nombre" id="equipo_tecnico_nombre"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="equipo_trabajo_realizado">Trabajo Realizado</label>
                                <input type="text" name="equipo_trabajo_realizado" id="equipo_trabajo_realizado"
                                    class="form-control">
                            </div>

                        </div>
                    </div>
                    <div
                        class="container d-flex flex-column align-items-center justify-content-center border rounded bg-white mt-5 shadow">
                        <!-- Agregamos la clase "shadow" para aplicar una sombra suave -->
                        <div class="row justify-content-center">
                            <div class="col">
                                <button type="submit" id="btnGuardar" form="formularioGuarda"
                                    class="btn btn-success w-100">ENTREGAR</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="<?= asset('./build/js/mantenimiento2/index.js') ?>"></script>
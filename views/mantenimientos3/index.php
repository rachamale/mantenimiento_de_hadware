<h1 class="text-center">HISTORIAL DE EQUIPOS ENTREGADOS Y REPARADOS</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioMantenimiento3">
        <div class="row mb-3">
            <div class="col">
                <label for="tipo_equipo">
                    <i class="fas fa-puzzle-piece"></i> <strong>EQUIPOS ENTREGADOS Y REPARADOS</strong>
                </label>
                <select name="tipo_equipo" id="tipo_equipo" class="form-control">
                    <option value="">Selecione tipo de equipo...</option>
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
                <button type="button" id="btnBuscar" class="btn btn-info w-100">BUSCAR</button>
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
                    <span class="sr-only">SALIR DE ESTA VENTANA</span>
                </button>
            </div>
            <div class="modal-body" id="asignarOficialModalBody">
                <h3 class="text-center mt-4 mb-4 p-3 rounded bg-light">FORMULARIO PARA ENTREGAR EQUIPO</h3>

                <form class="col-lg-10 border rounded bg-light p-3 container" id="formularioGuarda">
                    <div class="container">
                        <div class="row justify-content-center ">
                            <input type="input" name="ent_equipo_codigo" id="ent_equipo_codigo" hidden>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="ent_fecha">FECHA</label>
                                    <input type="date" name="ent_fecha" id="ent_fecha" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="ent_usuario_catalogo">CATÁLOGO DEL USUARIO RECIBE</label>
                                    <input type="number" name="ent_usuario_catalogo" id="ent_usuario_catalogo"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="usuario_nombre">NOMBRES DEL USUARIO</label>
                                    <input type="text" name="usuario_nombre" id="usuario_nombre" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="ent_tecnico_catalogo">CATÁLOGO DEL TÉCNICO ENTREGA</label>
                                    <input type="number" name="ent_tecnico_catalogo" id="ent_tecnico_catalogo"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="tecnico_nombre">NOMBRES DEL TÉCNICO</label>
                                    <input type="text" name="tecnico_nombre" id="tecnico_nombre" class="form-control" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="my-3 text-center">
                        <button type="submit" id="btnGuardar" form="formularioGuarda"
                            class="btn btn-warning w-50">ENTREGAR</button>
                    </div>

            </div>
            </form>
        </div>
    </div>
</div>
</div>


<script src="<?= asset('./build/js/mantenimiento3/index.js') ?>"></script>


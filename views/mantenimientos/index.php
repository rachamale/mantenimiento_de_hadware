<h1 class="text-center">EQUIPOS A REPARAR</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioMantenimiento">
        <div class="row mb-3">
            <div class="col">
                <label for="tipo_equipo">
                    <i class="fas fa-puzzle-piece"></i> <strong>EQUIPOS EN REPARACIÓN</strong>
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
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="asignarOficialModalLabel">SOPORTE TÉCNICO</h5>
                <button type="button" class="close btn btn-info" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">SALIR DE ESTA VENTANA</span>
                </button>
            </div>
            <div class="modal-body" id="asignarOficialModalBody">
                <h3 class="text-center mt-4 mb-4 p-3 rounded bg-light">FORMULARIO DE EQUIPO REPARADO</h3>

                <form class="col-lg-10 border rounded bg-light p-3 container" id="formularioGuarda">
                    <div class="container">
                        <div class="row justify-content-center mb-5">
                            <input type="input" name="rep_equipo_codigo" id="rep_equipo_codigo" hidden>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="rep_fecha">FECHA</label>
                                    <input type="date" name="rep_fecha" id="rep_fecha" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="rep_tecnico_catalogo">CATÁLOGO DEL TÉCNICO REPARO</label>
                                    <input type="number" name="rep_tecnico_catalogo" id="rep_tecnico_catalogo" class="form-control">
                                        
                                </div>
                                <div class="col">
                                    <label for="tecnico_nombre">NOMBRES DEL TÉCNICO</label>
                                    <input type="text" name="tecnico_nombre" id="tecnico_nombre" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="rep_descripcion">TRABAJO REALIZADO</label>
                                    <input type="text" name="rep_descripcion" id="rep_descripcion" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="my-3 text-center">
                            <button type="submit" id="btnGuardar" form="formularioGuarda"
                                class="btn btn-warning w-50">REPARADO</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="<?= asset('./build/js/mantenimiento/index.js') ?>"></script>
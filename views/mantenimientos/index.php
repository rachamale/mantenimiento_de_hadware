<style>
    .modal-open {
        overflow: hidden;
    }

    .modal-open::after {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Ajusta la opacidad según sea necesario */
        z-index: 999;
        /* Asegúrate de que el fondo oscuro esté en la parte superior */
    }
</style>


<h1 class="text-center">EQUIPOS A REPARAR</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 p-3 mb-5" id="formularioMantenimiento"
        style="background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 128, 255, 0.3), 0 6px 20px rgba(0, 0, 0, 0.1);">
        <div class="row mb-3">
            <div class="col">
                <label for="tipo_equipo">
                    <i class="fas fa-puzzle-piece"></i> <strong>EQUIPOS EN REPARACIÓN</strong>
                </label>
                <select name="tipo_equipo" id="tipo_equipo" class="form-control"
                    style=" box-shadow: 0 4px 8px rgba(0, 128, 255, 0.3), 0 6px 20px rgba(0, 0, 0, 0.1);">
                    <option value="">Seleccione tipo de equipo...</option>
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
                <button type="button" id="btnBuscar" class="btn btn-info w-100"
                    style="box-shadow:  box-shadow: 0 4px 8px rgba(0, 128, 255, 0.3), 0 6px 20px rgba(0, 0, 0, 0.1);">BUSCAR</button>
            </div>
        </div>
    </form>
</div>


<div class="row justify-content-center">
    <div class="col table-responsive"
        style="max-width: 92%; padding: 20px; background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 128, 255, 0.3), 0 6px 20px rgba(0, 0, 0, 0.1); margin-top: 20px;">
        <table id="tablaEquipos2" class="container p-4 shadow-lg style, table table-bordered table-hover"
            style="width: 100%; border-collapse: collapse;">
        </table>
    </div>
</div>


<div class="modal fade" id="asignarOficialModal" name="asignarOficialModal" tabindex="-1" role="dialog"
    aria-labelledby="asignarOficialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="asignarOficialModalLabel">SOPORTE TÉCNICO</h5>
                <button type="button" class="modal-header .close" data-dismiss="modal" aria-label="Close">
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
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="rep_tecnico_catalogo">CATÁLOGO DEL TÉCNICO REPARO</label>
                                <input type="number" name="rep_tecnico_catalogo" id="rep_tecnico_catalogo"
                                    class="form-control">

                            </div>
                            <div class="col">
                                <label for="tecnico_nombre">NOMBRES DEL TÉCNICO</label>
                                <input type="text" name="tecnico_nombre" id="tecnico_nombre" class="form-control"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="rep_descripcion">TRABAJO REALIZADO</label>
                                <input type="text" name="rep_descripcion" id="rep_descripcion" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="my-3 text-center">
                <button type="submit" id="btnGuardar" form="formularioGuarda"
                    class="btn btn-warning w-50">REPARADO</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalObservaciones" name="modalObservaciones" tabindex="-1" role="dialog"
    aria-labelledby="asignarOficialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalObservacionesLabel">SOPORTE TÉCNICO</h5>
                <button type="button" class="close btn btn-info" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">SALIR DE ESTA VENTANA</span>
                </button>
            </div>
            <div class="modal-body" id="modalObservacionesBody">
                <h3 class="text-center mt-4 mb-4 p-3 rounded bg-light">AGREGAR OBSERVACIÓN</h3>

                <form class="col-lg-10 border rounded bg-light p-3 container" id="formularioObservacion">
                    <div class="container">
                        <div class="row justify-content-center mb-5">
                            <input type="input" name="sol_codigo" id="sol_codigo" hidden>

                            <div class="col mb-3">
                                <label for="sol_observacion">OBSERVACIÓN</label>
                                <textarea name="sol_observacion" id="sol_observacion" class="form-control"
                                    rows="5"></textarea>
                            </div>
                        </div>

                    </div>
                </form>
                <div class="my-3 text-center">
                    <button type="submit" id="btnGuardarObservacion" form="formularioObservacion"
                        class="btn btn-warning w-50">AGREGAR</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="<?= asset('./build/js/mantenimiento/index.js') ?>"></script>
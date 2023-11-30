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

<h1 class="text-center">EQUIPOS REPARADOS</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioMantenimiento"
        style="background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 128, 255, 0.3), 0 6px 20px rgba(0, 0, 0, 0.1);">
        <div class="row mb-3">
            <div class="col">
                <label for="tipo_equipo">
                    <i class="fas fa-puzzle-piece"></i> <strong>EQUIPOS A ENTREGAR</strong>
                </label>
                <select name="tipo_equipo" id="tipo_equipo" class="form-control"
                    style=" box-shadow: 0 4px 8px rgba(0, 128, 255, 0.3), 0 6px 20px rgba(0, 0, 0, 0.1);">
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
                <button type="button" id="btnBuscar" class="btn btn-info w-100"
                    style=" box-shadow: 0 4px 8px rgba(0, 128, 255, 0.3), 0 6px 20px rgba(0, 0, 0, 0.1);">BUSCAR</button>
            </div>
        </div>
    </form>
</div>

<div class="row justify-content-center">
    <div class="col table-responsive"
        style="max-width: 95%; padding: 20px; background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 128, 255, 0.3), 0 6px 20px rgba(0, 0, 0, 0.1); margin-top: 20px;">
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
                <button type="button" class="close btn btn-info" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">SALIR DE ESTA VENTANA</span>
                </button>
            </div>
            <div class="modal-body" id="asignarOficialModalBody">
                <h3 class="text-center mt-4 mb-4 p-3 rounded bg-light">FORMULARIO PARA ENTREGAR EQUIPO</h3>

                <form class="col-lg-10 border rounded bg-light p-3 container" id="formularioGuarda">
                    <div class="container">
                        <div class="row justify-content-center">
                            <input type="input" name="ent_equipo_codigo" id="ent_equipo_codigo" hidden>

                            <!-- Modificación en el input de fecha y hora -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="ent_usuario_catalogo">CATÁLOGO DEL USUARIO RECIBE</label>
                                    <input type="number" name="ent_usuario_catalogo" id="ent_usuario_catalogo"
                                        class="form-control">
                                </div>
                                <div class="col">
                                    <label for="usuario_nombre">NOMBRES DEL USUARIO</label>
                                    <input type="text" name="usuario_nombre" id="usuario_nombre" class="form-control"
                                        readonly>
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
                                    <input type="text" name="tecnico_nombre" id="tecnico_nombre" class="form-control"
                                        readonly>
                                </div>
                            </div>

                            <!-- Mueve el botón dentro del mismo contenedor -->
                        </div>
                    </div>
                </form>
                <div class="my-3 text-center">
                    <button type="submit" id="btnGuardar" form="formularioGuarda"
                        class="btn btn-warning w-50">ENTREGAR</button>
                </div>
                <!-- Agrega este script al final del documento o en la sección head -->
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalNotificaciones" name="modalNotificaciones" tabindex="-1" role="dialog"
    aria-labelledby="asignarOficialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow-lg custom-modal">
            <div class="modal-header bg-dark text-white">
                <!-- Cambié bg-primary a bg-dark -->
                <h5 class="modal-title" id="modalNotificacionesLabel">SOPORTE TÉCNICO</h5>
                <button type="button" class="close btn btn-info" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">SALIR DE ESTA VENTANA</span>
                </button>
            </div>
            <div class="modal-body" id="modalNotificacionesBody">
                <h3 class="text-center mt-4 mb-4 p-3 rounded bg-light">AGREGAR NOTIFICACIÓN</h3>

                <form class="col-lg-10 border rounded bg-light p-3 container" id="formularioNotificaciones">
                    <div class="container">
                        <div class="row justify-content-center mb-5">
                            <input type="input" name="rep_codigo" id="rep_codigo" hidden>

                            <div class="col mb-3">
                                <label for="rep_notificacion">NOTIFICACIÓN</label>
                                <textarea name="rep_notificacion" id="rep_notificacion" class="form-control"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Muevo el botón fuera del contenedor -->
                <div class="my-3 text-center">
                    <button type="submit" id="btnGuardarObservacion" form="formularioNotificaciones"
                        class="btn btn-secondary w-50 custom-btn">AGREGAR</button>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="<?= asset('./build/js/mantenimiento2/index.js') ?>"></script>
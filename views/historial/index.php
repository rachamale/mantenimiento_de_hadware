<h1 class="text-center">HISTORIAL DE EQUIPOS</h1>
<div class="row justify-content-center mb-5"></div>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; background-color: #f8f9fa;">
                <div class="card-body">
                    <h5 class="card-title text-center mb-3" style="color: #007bff;">Ingrese Fechas de Historial</h5>
                    <form id="formularioFiltros" class="text-center">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="fechaInicio" class="form-label">Inicio</label>
                                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" style="border: 1px solid #ced4da; border-radius: 5px;">
                                </div>
                                <div class="col-md-6">
                                    <label for="fechaFin" class="form-label">Fin</label>
                                    <input type="date" class="form-control" id="fechaFin" name="fechaFin" style="border: 1px solid #ced4da; border-radius: 5px;">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <button type="button" id="btnBuscar" class="btn btn-primary" style="background-color: #28a745; border: 1px solid #28a745; color: #fff;">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <button type="button" id="btnPdf" class="btn btn-outline-dark custom-button button-with-shadow" style="display: none; background-color: #6c757d; border: 1px solid #6c757d; color: #fff;">
                                    <img src="./images/imprimir.png" alt="pdf" style="width: 1cm; height: 1cm;">
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                            

<div class="row justify-content-center">
    <div class="col table-responsive"
        style="max-width: 98%; padding: 20px; background-color: #f8f9fa; box-shadow: 0 4px 8px rgba(0, 128, 255, 0.3), 0 6px 20px rgba(0, 0, 0, 0.1); margin-top: 20px;">
        <table id="tablaHistorial" class="container p-4 shadow-lg style, table table-bordered table-hover"
            style="width: 50%; border-collapse: collapse;">
        </table>
    </div>
</div>


<script src="<?= asset('./build/js/historial/index.js')  ?>"></script>

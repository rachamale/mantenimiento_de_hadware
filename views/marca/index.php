<h1 class="text-center">Formulario de Marcas</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioMarca">
        <input type="hidden" name="marca_equipo_codigo" id="marca_equipo_codigo">
        <div class="row mb-3">
            <div class="col">
                <label for="marca_equipo_descripcion">Nombre del equipo</label>
                <input type="text" name="marca_equipo_descripcion" id="marca_equipo_descripcion" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioMarca" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
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
        <table id="tablaMarcas" class="table table-bordered table-hover">
        </table>
    </div>
</div>



<script src="<?= asset('./build/js/marca/index.js')  ?>"></script>


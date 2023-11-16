import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioTipoEquipo');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

let contador = 1;
const datatable = new Datatable('#tablaTiposEquipo', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            render: () => contador++
        },
        {
            title: 'TIPO DE EQUIPO',
            data: 'tipo_equipo_descripcion'
        },
        {
            title: 'MODIFICAR',
            data: 'tipo_equipo_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-codigo='${data}' data-tipo='${row.tipo_equipo_descripcion}'>Modificar</button>`
        },
        {
            title: 'ELIMINAR',
            data: 'tipo_equipo_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-danger" data-codigo='${data}'>Eliminar</button>`
        },
    ]
});

const buscar = async () => {
    const tipoEquipo = formulario.tipo_equipo_descripcion.value; 

    console.log(tipoEquipo)
    const url = `/mantenimiento_de_hardware/API/tipo_equipo/buscar?tipo_equipo_descripcion=${tipoEquipo}`;

    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        datatable.clear().draw();
        console.log(data);
        if (data.length >0) {
            contador = 1;
            datatable.rows.add(data).draw();
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            });
        }
    } catch (error) {
        console.log(error);
    }
};

const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['tipo_equipo_codigo'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }
    const body = new FormData(formulario);
    body.delete('tipo_equipo_codigo')
    const url = '/mantenimiento_de_hardware/API/tipo_equipo/guardar';
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");

    const config = {
        method: 'POST',
        body
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
                buscar();
                break;

            case 0:
                icon = 'error';
                console.log(detalle);
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        });
    } catch (error) {
        console.log(error);
    }
};

const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.codigo;

    if (await confirmacion('warning', 'Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('tipo_equipo_codigo', id);
        const url = '/mantenimiento_de_hardware/API/tipo_equipo/eliminar';
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

        const config = {
            method: 'POST',
            body
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();

            const { codigo, mensaje, detalle } = data;
            let icon = 'info';

            switch (codigo) {
                case 1:
                    icon = 'success';
                    buscar();
                    break;

                case 0:
                    icon = 'error';
                    console.log(detalle);
                    break;

                default:
                    break;
            }

            Toast.fire({
                icon,
                text: mensaje
            });
        } catch (error) {
            console.log(error);
        }
    }
};

const modificar = async () => {
    if (!validarFormulario(formulario, ['tipo_equipo_codigo'])) {
        alert('Debe llenar todos los campos');
        return;
    }

    const body = new FormData(formulario);

    const url = '/mantenimiento_de_hardware/API/tipo_equipo/modificar';
    const config = {
        method: 'POST',
        body
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);
        const { codigo, mensaje, detalle } = data;
        let icon = 'info';

        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
                buscar();
                cancelarAccion();
                break;

            case 0:
                icon = 'error';
                console.log(detalle);
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        });
    } catch (error) {
        console.log(error);
    }
};

const traeDatos = (e) => {
    const button = e.target;
    const codigo = button.dataset.codigo;
    const tipo = button.dataset.tipo;

    const dataset = {
        codigo,
        tipo,
    };

    colocarDatos(dataset);
    const body = new FormData(formulario);
    body.append('tipo_equipo_codigo', codigo);
    body.append('tipo_equipo_descripcion', tipo);
};

const colocarDatos = (dataset) => {
    formulario.querySelector('#tipo_equipo_descripcion').value = dataset.tipo;
    formulario.querySelector('#tipo_equipo_codigo').value = dataset.codigo;

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
};

const cancelarAccion = () => {
    btnGuardar.disabled = false;
    btnGuardar.parentElement.style.display = '';
    btnBuscar.disabled = false;
    btnBuscar.parentElement.style.display = '';
    btnModificar.disabled = true;
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
};

buscar();

formulario.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-danger', eliminar);
btnCancelar.addEventListener('click', cancelarAccion);
btnModificar.addEventListener('click', modificar);

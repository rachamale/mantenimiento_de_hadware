import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioMantenimiento');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

let contador = 1;

const datatable = new DataTable('#tablaEquipos', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            render: () => contador++
        },
        {
            title: 'FECHA',
            data: 'equipo_fecha'
        },
        {
            title: 'NOMBRE USUARIO',
            data: 'equipo_usuario_nombre'
        },
        {
            title: 'NÚMERO USUARIO',
            data: 'equipo_usuario_numero'
        },
        {
            title: 'TÉCNICO RECIBE',
            data: 'equipo_tecnico_recibe'
        },
        {
            title: 'MOTIVO',
            data: 'equipo_motivo'
        },
        {
            title: 'DESCRIPCIÓN',
            data: 'equipo_descripcion'
        },
        {
            title: 'ESTADO',
            data: 'equipo_estado'
        },
        {
            title: 'MODIFICAR',
            data: 'equipo_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-warning" data-codigo='${data}' data-marca='${row.marca_equipo_descripcion}'>Modificar</button>`
        },
        {
            title: 'ELIMINAR',
            data: 'equipo_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => `<button class="btn btn-danger" data-codigo='${data}'>Eliminar</button>`
        },
    ]
});

const buscar = async () => {
    const tipoEquipoCodigoSelect = document.getElementById('tipo_equipo_codigo');
    const tipoEquipoCodigo = tipoEquipoCodigoSelect.value;

    const url = `/mantenimiento_de_hardware/API/equipo/buscar?equipo_tipo=${tipoEquipoCodigo}`; // Aquí también se cambió 'tipo_equipo_codigo' a 'equipo_tipo'

    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        datatable.clear().rows.add(data).draw();
    } catch (error) {
        console.log(error);
    }
};





const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['equipo_codigo', 'equipo_descripcion'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    const url = '/mantenimiento_de_hardware/API/equipo/guardar';
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

    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('equipo_codigo', id);
        const url = '/mantenimiento_de_hardware/API/equipo/eliminar';
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
    if (!validarFormulario(formulario, ['equipo_codigo', 'equipo_descripcion'])) {
        alert('Debe llenar todos los campos');
        return;
    }

    const body = new FormData(formulario);
    const url = '/mantenimiento_de_hardware/API/equipo/modificar';
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
    const marca = button.dataset.marca;

    const dataset = {
        codigo,
        marca,
    };

    colocarDatos(dataset);
};

const colocarDatos = (dataset) => {
    formulario.equipo_codigo.value = dataset.codigo;
    formulario.equipo_descripcion.value = dataset.marca;

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
    formulario.reset();
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

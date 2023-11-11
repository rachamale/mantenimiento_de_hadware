import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioMantenimiento2');


const formularioGuarda = document.getElementById('formularioGuarda');

const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');

const btnCancelar = document.getElementById('btnCancelar');

const tipoEquipo = document.getElementById('tipo_equipo_codigo');

const equipo_codigo = document.getElementById('equipo_codigo');
////const para el modal
const asignarOficialModal = document.getElementById('asignarOficialModal');
const botonCerrarModal = document.querySelector('.modal-header .close');


const tablaEquipos2 = document.getElementById('tablaEquipos2');

tablaEquipos2.addEventListener('click', async function (event) {
    if (event.target.classList.contains('btn-detalle-codigo')) {

        asignarOficialModal.classList.add('show');
        asignarOficialModal.style.display = 'block';
        document.body.classList.add('modal-open');
    } else {
        console.error('El botón "btn-detalle-codigo" no se encontró en el DOM.');
    }
});



btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

let contador = 1;

const datatable = new DataTable('#tablaEquipos2', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            render: () => contador++
        },
        {
            title: 'FECHA',
            data: 'fecha'
        },
        {
            title: 'NOMBRE USUARIO',
            data: 'nombre_usuario'
        },
        {
            title: 'NÚMERO USUARIO',
            data: 'numero_usuario'
        },
        {
            title: 'TECNICO QUE RECIBIO',
            data: 'tecnico_recibe'
        },
        {
            title: 'TIPO DE EQUIPO',
            data: 'tipo_equipo'
        },
        {
            title: 'MOTIVO',
            data: 'motivo'
        },
        {
            title: 'DESCRIPCIÓN',
            data: 'descripcion'
        },
        {
            title: 'ESTADO',
            data: 'estado'
        },
        // {
        //     title: 'MODIFICAR',
        //     data: 'equipo_codigo',
        //     searchable: false,
        //     orderable: false,
        //     render: (data, type, row, meta) => `<button class="btn btn-warning" data-codigo='${data}' data-marca='${row.marca_equipo_descripcion}'>Modificar</button>`
        // },
        // {
        //     title: 'ELIMINAR',
        //     data: 'equipo_codigo',
        //     searchable: false,
        //     orderable: false,
        //     render: (data, type, row, meta) => `<button class="btn btn-danger" data-codigo='${data}'>Eliminar</button>`
        // },
        {
            title: "FORMULARIO DE ENTREGA",
            data: 'equipo_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => { equipo_codigo.value = data
                return `<button class="btn btn-success btn-detalle-codigo" data-codigo='${data}'>ENTREGAR</button>`;
            }
        }
    ]

});

const buscar = async () => {
    const tipo = tipoEquipo.value
    console.log(tipo)
    const url = `/mantenimiento_de_hardware/API/mantenimientos2/buscar?tipo_equipo=${tipo}`;
    console.log(tipo)
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        datatable.clear().draw();
        console.log(data)
        if (data) {
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





const guardar = async (e) => {
    e.preventDefault()
    const button = e.target;

    const id = equipo_codigo.value;
    console.log(id)
    if (await confirmacion('warning', '¿Desea pasar a reparacion este equipo?')) {
        const body = new FormData(formularioGuarda);
        body.append('equipo_codigo', id);
        body.delete('equipo_usuario_nombre')
        body.delete('equipo_tecnico_nombre')

        for (var pair of body.entries()) {
            console.log('*' + pair[0] + '*|*' + pair[1] + '*');
        }
        const url = '/mantenimiento_de_hardware/API/mantenimientos2/guardar';
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


//////////evento para cerrar el modal haciendo clic

botonCerrarModal.addEventListener('click', function () {
    // Cierra el modal
    asignarOficialModal.style.display = 'none';
    document.body.classList.remove('modal-open');
    formulario.reset();
    //cancelarAccionAsignar();
    //actualizarDependencia();

});

////cerrar el modal cuando se hace clic fuera del modal...
asignarOficialModal.addEventListener('click', function (event) {
    if (event.target === asignarOficialModal) {
        asignarOficialModal.style.display = 'none';
        document.body.classList.remove('modal-open');
        formulario.reset();
        //cancelarAccion();
        //actualizarDependencia();
        //buscarDependencia();
    }
});
buscar();
formularioGuarda.addEventListener('submit', guardar);
btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-warning', traeDatos);
btnCancelar.addEventListener('click', cancelarAccion);
btnModificar.addEventListener('click', modificar);

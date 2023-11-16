import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioMantenimiento3');


const formularioGuarda = document.getElementById('formularioGuarda');

const btnBuscar = document.getElementById('btnBuscar');
const btnGuardar = document.getElementById('btnGuardar');

const tipoEquipo = document.getElementById('tipo_equipo');

const equipo_codigo = document.getElementById('ent_equipo_codigo');
////const para el modal
const asignarOficialModal = document.getElementById('asignarOficialModal');
const botonCerrarModal = document.querySelector('.modal-header .close');
const ent_usuario_catalogo = document.getElementById('ent_usuario_catalogo');
const ent_tecnico_catalogo = document.getElementById('ent_tecnico_catalogo');

const nombres = [];

const tablaEquipos2 = document.getElementById('tablaEquipos2');

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
            title: 'FECHA DE INGRESO',
            data: 'fecha_ingreso'
        },
        {
            title: 'USUARIO QUE ENTREGO',
            data: 'usuario_entrega'
        },
        {
            title: 'TECNICO QUE RECIBIO',
            data: 'tecnico_recibe'
        },
        {
            title: 'FECHA DE EGRESO',
            data: 'fecha_egreso'
        },
        {
            title: 'USUARIO QUE RECIBIO',
            data: 'usuario_recibe'
        },
        {
            title: 'TECNICO QUE ENTREGO',
            data: 'tecnico_entrega'
        },
        {
            title: 'TIPO DE EQUIPO',
            data: 'tipo_equipo'
        },
        {
            title: 'DESCRIPCIÓN',
            data: 'descripcion'
        },
        {
            title: 'DEPENDENCIA',
            data: 'dependencia'
        },
        {
            title: 'ESTADO',
            data: 'estado'
        },
        {
            title: "OFICIO DE ENTREGA",
            data: 'equipo_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                equipo_codigo.value = data
                return `<button class="btn btn-success" data-codigo='${data}'>PDF</button>`;
            }
        }
    ]

});

// {
//     title: "OFICIO DE ENTREGA",
//     data: 'equipo_codigo',
//     searchable: false,
//     orderable: false,
//     render: (data, type, row, meta) => {
//         equipo_codigo.value = data;
//         return `<button class="btn btn-success" data-codigo='${data}' style="background-color: #333; color: #fff; border: 1px solid #00f; padding: 10px; border-radius: 10px;">
//                     <img src="./images/imprimir.png" alt="Texto alternativo de la imagen" style="width: 40px; height: 40px; margin-right: 5px;">
//                     PDF
//                 </button>`;
//     }
// }



const buscar = async () => {
    const tipo = tipoEquipo.value
    console.log(tipo)
    const url = `/mantenimiento_de_hardware/API/mantenimiento3/buscar?tipo_equipo=${tipo}`;
    console.log(tipo)
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        datatable.clear().draw();
        console.log(data)

        if (data.length > 0) {
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

const pdf = async (e) => {
    e.preventDefault()
    const button = e.target;
    const id = button.dataset.codigo;
    if (await confirmacion('warning', 'Desea imprimir comprobante?')) {
        const url = `/mantenimiento_de_hardware/pdf?equipo_codigo=${id}`;
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");
        const config = {
            method: 'GET',
            headers,
        };

        try {
            const respuesta = await fetch(url, config)
            if (respuesta.ok) {
                const blob = await respuesta.blob();

                if (blob) {
                    const urlBlob = window.URL.createObjectURL(blob);

                    // Abre el PDF en una nueva ventana o pestaña
                    window.open(urlBlob, '_blank');
                } else {
                    console.error('No se pudo obtener el blob del PDF.');
                }
            } else {
                console.error('Error al generar el PDF.');
            }
        } catch (error) {
            console.error(error);
        }
    };
};


buscar();

btnBuscar.addEventListener('click', buscar);

datatable.on('click', '.btn-success', pdf);

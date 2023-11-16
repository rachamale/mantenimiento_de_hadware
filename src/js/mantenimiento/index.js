import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioMantenimiento');
const formularioGuarda = document.getElementById('formularioGuarda');

const btnBuscar = document.getElementById('btnBuscar');

const tipoEquipo = document.getElementById('tipo_equipo');

const equipo_codigo = document.getElementById('rep_equipo_codigo');

const asignarOficialModal = document.getElementById('asignarOficialModal');

const botonCerrarModal = document.querySelector('.modal-header .close');

const rep_tecnico_catalogo = document.getElementById('rep_tecnico_catalogo');

const nombres = [];


const tablaEquipos2 = document.getElementById('tablaEquipos2');

tablaEquipos2.addEventListener('click', async function (event) {
    if (event.target.classList.contains('btn-detalle-codigo')) {
        asignarOficialModal.classList.add('show');
        asignarOficialModal.style.display = 'block';
        document.body.classList.add('modal-open');
    }
});



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
            title: 'NOMBRE TECNICO',
            data: 'nombre_tecnico'
        },
        {
            title: 'TELEFONO USUARIO',
            data: 'telefono_usuario'
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
        {
            title: "FORMULARIO DE EQUIPO REPARADO",
            data: 'equipo_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                equipo_codigo.value = data
                return `<button class='btn btn-success btn-detalle-codigo' data-codigo='${data}'>FINALIZAR</button>`
            }
        }
    ]

});


const buscar = async () => {
    const tipo = tipoEquipo.value
    const url = `/mantenimiento_de_hardware/API/mantenimientos/buscar?tipo_equipo=${tipo}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        datatable.clear().draw();
        console.log(data)
        if (data.length >0){
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

const buscarCatalogo2 = async () => {
   
    let rep_tecnico_catalogo = formularioGuarda.rep_tecnico_catalogo.value;
    //clearTimeout(typingTimeout); // Limpiar el temporizador anterior (si existe)  

    // Función que se ejecutará después del retraso
 
        const url = `/mantenimiento_de_hardware/API/mantenimientos/buscarCatalogo2?rep_tecnico_catalogo=${rep_tecnico_catalogo}`;
        const config = {
            method: 'GET'
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log(data);

            if (data && data.length > 0) {
                const guardaNombre = data[0].nombres;
                tecnico_nombre.value = guardaNombre;
                Toast.fire({
                    icon: 'success',
                    title: 'El catálogo ingresado es correcto, se muestran los siguientes datos.'
                });
            } else {
                nombres.value = '';
                Toast.fire({
                    icon: 'info',
                    title: 'Ingrese un catálogo válido.'
                });
            }
        } catch (error) {
            console.log(error);
            Toast.fire({
                icon: 'error',
                title: 'Ocurrió un error al buscar los datos.'
            });
        }
    };



const guardar = async (e) => {
    e.preventDefault()
    if (!validarFormulario(formularioGuarda)) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    if (await confirmacion('warning', '¿Estás seguro de que el equipo ha sido reparado?')) {
        const body = new FormData(formularioGuarda);
        body.delete('equipo_tecnico_nombre')

        for (var pair of body.entries()) {
            console.log('*' + pair[0] + '*|*' + pair[1] + '*');
        }
        const url = '/mantenimiento_de_hardware/API/mantenimientos/guardar';
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
                    asignarOficialModal.style.display = 'none';
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
rep_tecnico_catalogo.addEventListener('change', buscarCatalogo2);
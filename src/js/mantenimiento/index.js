import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioMantenimiento');
const formularioGuarda = document.getElementById('formularioGuarda');
const formularioObservacion = document.getElementById('formularioObservacion');

const btnBuscar = document.getElementById('btnBuscar');

const tipoEquipo = document.getElementById('tipo_equipo');

const equipo_codigo = document.getElementById('rep_equipo_codigo');

const asignarOficialModal = document.getElementById('asignarOficialModal');


const botonCerrarModal = document.querySelector('.modal-header .close');


const rep_tecnico_catalogo = document.getElementById('rep_tecnico_catalogo');

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
            title: 'DEPENDENCIA',
            data: 'dependencia'
        },
        {
            title: 'OBSERVACIÓN',
            data: 'observacion'
        },
        {
            title: 'ESTADO',
            data: 'estado',
            render: function (data, type, row) {
                if (type === 'display') {
                    if (data === "EN REPARACION") {
                        const currentDate = new Date(); // Obtener la fecha actual
                        const fechaEquipo = new Date(row.fecha); // Supongamos que 'equi_his_fecha' es la propiedad que contiene la fecha del historial del equipo
                        const diffInDays = Math.floor((currentDate - fechaEquipo) / (1000 * 60 * 60 * 24)); // Diferencia en días

                        // Verificar si el equipo ha estado en el estado 1 por más de un día
                        if (diffInDays > 1) {
                            // Puedes personalizar el mensaje de la alerta según tus necesidades
                            Swal.fire({
                                icon: 'info',
                                text: "¡Alerta! ¿hay equipos en reparacion por más de un día y aún no han sido reparados.",
                                timer: 0,
                                showConfirmButton: true
                            });
                            return `
                    <div>
                        <img src="./images/alerta.png" alt="Ícono Formulario" class="menu-icon" style="width: 1cm; height: 1cm;"> 
                        <span>ALERTA</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 33.33%;" aria-valuenow="33.33" aria-valuemin="0" aria-valuemax="100">33.33%</div>
                    </div>`;
                        } else {
                            return `
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 33.33%;" aria-valuenow="33.33" aria-valuemin="0" aria-valuemax="100">33.33%</div>
                    </div>`;
                        }
                    }
                }


                return data;
            }
        },

        {
            title: "OBSERVACIONES",
            data: 'solicitud_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                return `<button class='btn-outline-info' data-codigo='${data}'data-codigo2='${row.fecha}'>AGREGAR OBSERVACIÓN</button>`
            }
        },
        {
            title: "FORMULARIO DE EQUIPO REPARADO",
            data: 'equipo_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                console.log(data)
                return `<button class='btn btn-success btn-detalle-codigo' data-codigo='${data}'>FINALIZAR</button>`
            }
        }
    ]

});


// if (type === 'display') {
//     if (data === "1") {
//         const currentDate = new Date(); // Obtener la fecha actual
//         const fechaEquipo = new Date(row.equi_his_fecha); // Supongamos que 'equi_his_fecha' es la propiedad que contiene la fecha del historial del equipo
//         const diffInDays = Math.floor((currentDate - fechaEquipo) / (1000 * 60 * 60 * 24)); // Diferencia en días

//         if (diffInDays > 1) { // Verificar si el equipo ha estado en el estado 1 por más de un día
//             // Puedes personalizar el mensaje de la alerta según tus necesidades
//             Swal.fire({
//                 icon: 'info',
//                 text: "¡Alerta! El equipo ha estado en el estado 1 por más de un día.",
//                 timer: 0, // Set timer to 0 for the alert to stay until manually closed
//                 showConfirmButton: true
//             });

//             return `
//                 <img src="./images/marca.png" alt="Ícono Formulario" class="menu-icon" style="width: 1cm; height: 1cm;"> 
//                 <span>EN REPARACIÓN</span>
//                 <div class="progress">


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

    if (await confirmacion('question', '¿Estás seguro de que el equipo ha sido reparado?')) {
        const body = new FormData(formularioGuarda);
        body.delete('equipo_tecnico_nombre')
        for (var pair of body.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
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
                    window.location.reload(true);
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

datatable.on('click', '.btn-success', (event) => {
    const button = event.target;
    console.log(button.dataset.codigo)
    formularioGuarda.rep_equipo_codigo.value = button.dataset.codigo;

    if (event.target.classList.contains('btn-detalle-codigo')) {
        asignarOficialModal.classList.add('show');
        asignarOficialModal.style.display = 'block';
        document.body.classList.add('modal-open');
    }
});


const modalObservaciones = document.getElementById('modalObservaciones');

// Agrega un evento de clic al botón
datatable.on('click', '.btn-outline-info', (e) => {
    const button = e.target;
    console.log(button.dataset.codigo)
    formularioObservacion.sol_codigo.value = button.dataset.codigo;
    // Abre el modal al hacer clic en el botón
    modalObservaciones.classList.add('show');
    modalObservaciones.style.display = 'block';
    document.body.classList.add('modal-open');
});


//////////evento para cerrar el modal haciendo clic

botonCerrarModal.addEventListener('click', function () {
    // Cierra el modal
    modalObservaciones.style.display = 'none';
    document.body.classList.remove('modal-open');
    //formularioGuarda.reset();

});

////cerrar el modal cuando se hace clic fuera del modal...
modalObservaciones.addEventListener('click', function (event) {
    if (event.target === modalObservaciones) {
        modalObservaciones.style.display = 'none';
        document.body.classList.remove('modal-open');
        //buscarDependencia();
    }
});

const agregarObservacion = async (e) => {
    e.preventDefault();
    const button = e.target
    const id = button.dataset.id
    console.log(id)
    if (await confirmacion('question', '¿Desea agregar observación de la reparación?')) {
        formularioObservacion.o
        const body = new FormData(formularioObservacion);

        for (var pair of body.entries()) {
            console.log(pair[0], pair[1]);
        }
        const url = '/mantenimiento_de_hardware/API/mantenimientos/observacion';
        const config = {
            method: 'POST',
            body
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log(data)
            const { codigo, mensaje, detalle } = data;
            let icon = 'info';

            switch (codigo) {
                case 1:
                    icon = 'success';
                    buscar();
                    modalObservaciones.style.display = 'none';

                    window.location.reload(true);
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


buscar();
formularioGuarda.addEventListener('submit', guardar);
formularioObservacion.addEventListener('submit', agregarObservacion);
btnBuscar.addEventListener('click', buscar);
rep_tecnico_catalogo.addEventListener('change', buscarCatalogo2);
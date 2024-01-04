import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioMantenimiento2');


const formularioGuarda = document.getElementById('formularioGuarda');
const formularioNotificaciones = document.getElementById('formularioNotificaciones');

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
            title: 'FECHA',
            data: 'fecha'
        },
        {
            title: 'NOMBRE USUARIO',
            data: 'nombre_usuario'
        },
        {
            title: 'NÚMERO USUARIO',
            data: 'telefono_usuario'
        },
        {
            title: 'TECNICO QUE RECIBIO',
            data: 'tecnico_recibio'
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
            title: 'USUARIO NOTIFICADO',
            data: 'notificacion'
        },
        {
            title: 'ESTADO',
            data: 'estado',
            render: function (data, type, row) {
                if (type === 'display') {
                    if (data === "LISTO PARA ENTREGAR") {
                        const currentDate = new Date(); // Obtener la fecha actual
                        const fechaEquipo = new Date(row.fecha); // Supongamos que 'equi_his_fecha' es la propiedad que contiene la fecha del historial del equipo
                        const diffInDays = Math.floor((currentDate - fechaEquipo) / (1000 * 60 * 60 * 24)); // Diferencia en días

                        // Verificar si el equipo ha estado en el estado 1 por más de un día
                        if (diffInDays > 1) {
                            // Puedes personalizar el mensaje de la alerta según tus necesidades
                            Swal.fire({
                                icon: 'info',
                                text: "¡Alerta! ¿hay equipos listos para entregar que tiene mas de un dia.",
                                timer: 0,
                                showConfirmButton: true
                            });
                            return `
                    <div>
                        <img src="./images/alerta.png" alt="Ícono Formulario" class="menu-icon" style="width: 1cm; height: 1cm;"> 
                        <span>ALERTA</span>
                    </div>
                    <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 66.66%;" aria-valuenow="66.66" aria-valuemin="0" aria-valuemax="100">66.66%</div>
                    </div>`;
                        } else {
                            return `
                            <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 66.66%;" aria-valuenow="66.66" aria-valuemin="0" aria-valuemax="100">66.66%</div>
                        </div>`;
                        }
                    }
                }


                return data;
            }
        },

        {
            title: "NOTIFICACIÓN",
            data: 'reparacion_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                console.log(data)
                return `<button class='btn-outline-primary'  data-codigo='${data}'>NOTIFICACIÓN</button>`
            }
        },
        {
            title: "FORMULARIO DE ENTREGA",
            data: 'equipo_codigo',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                equipo_codigo.value = data
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





const guardar = async (e) => {
    e.preventDefault()
    if (!validarFormulario(formularioGuarda)) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }
    if (await confirmacion('question', '¿Estás seguro de que deseas entregar este equipo?')) {
        const body = new FormData(formularioGuarda);
        body.delete('usuario_nombre')
        body.delete('tecnico_nombre')

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

                    console.log('test2')
                    icon = 'success';
                    buscar();
                    asignarOficialModal.style.display = 'none';
                    window.location.reload(true);
                    break;

                case 0:

                    console.log('test3')
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
};

const cancelarAccion = () => {
    formulario.reset();
    btnGuardar.disabled = false;
    btnGuardar.parentElement.style.display = '';
    btnBuscar.disabled = false;
    btnBuscar.parentElement.style.display = '';
};


const buscarCatalogo2 = async () => {

    let ent_tecnico_catalogo = formularioGuarda.ent_tecnico_catalogo.value;
    //clearTimeout(typingTimeout); // Limpiar el temporizador anterior (si existe)  

    // Función que se ejecutará después del retraso

    const url = `/mantenimiento_de_hardware/API/mantenimientos2/buscarCatalogo2?ent_tecnico_catalogo=${ent_tecnico_catalogo}`;
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

const buscarCatalogo = async () => {

    let ent_usuario_catalogo = formularioGuarda.ent_usuario_catalogo.value;
    //clearTimeout(typingTimeout); // Limpiar el temporizador anterior (si existe)  

    // Función que se ejecutará después del retraso

    const url = `/mantenimiento_de_hardware/API/mantenimientos2/buscarCatalogo?ent_usuario_catalogo=${ent_usuario_catalogo}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);

        if (data && data.length > 0) {
            const guardaNombre = data[0].nombres;
            usuario_nombre.value = guardaNombre;
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
// Establecer un retraso de 500 ms antes de realizar la solicitud a la API
//typingTimeout = setTimeout(fetchData, 1200);


//////////evento para cerrar el modal haciendo clic

botonCerrarModal.addEventListener('click', function () {
    // Cierra el modal
    asignarOficialModal.style.display = 'none';
    document.body.classList.remove('modal-open');
    formulario.reset();
    cancelarAccionAsignar();
    //actualizarDependencia();

});

////cerrar el modal cuando se hace clic fuera del modal...
asignarOficialModal.addEventListener('click', function (event) {
    if (event.target === asignarOficialModal) {
        asignarOficialModal.style.display = 'none';
        document.body.classList.remove('modal-open');
        formulario.reset();
        cancelarAccion();
        //actualizarDependencia();
        //buscarDependencia();
    }
});



const modalNotificaciones = document.getElementById('modalNotificaciones');

datatable.on('click', '.btn-detalle-codigo', (event) => {
    const button = event.target;
    console.log(button.dataset.codigo)
    formularioGuarda.ent_equipo_codigo.value = button.dataset.codigo;

    asignarOficialModal.classList.add('show');
    asignarOficialModal.style.display = 'block';
    document.body.classList.add('modal-open');

});
// Agrega un evento de clic al botón
datatable.on('click', '.btn-outline-primary', (e) => {
    const button = e.target;
    console.log(button.dataset.codigo)
    formularioNotificaciones.rep_codigo.value = button.dataset.codigo;
    // Abre el modal al hacer clic en el botón
    modalNotificaciones.classList.add('show');
    modalNotificaciones.style.display = 'block';
    document.body.classList.add('modal-open');
});


//////////evento para cerrar el modal haciendo clic

botonCerrarModal.addEventListener('click', function () {
    // Cierra el modal
    modalNotificaciones.style.display = 'none';
    document.body.classList.remove('modal-open');
    //formularioGuarda.reset();

});

////cerrar el modal cuando se hace clic fuera del modal...
modalNotificaciones.addEventListener('click', function (event) {
    if (event.target === modalNotificaciones) {
        modalNotificaciones.style.display = 'none';
        document.body.classList.remove('modal-open');
        //buscarDependencia();
    }
});

const agregarNotificaciones = async (e) => {
    e.preventDefault();
    if (await confirmacion('question', '¿Desea agregar notificación?')) {
        const body = new FormData(formularioNotificaciones);
        for (var pair of body.entries()) {
            console.log(pair[0], pair[1]);
        }
        const url = '/mantenimiento_de_hardware/API/mantenimientos2/notificaciones';
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
                    modalNotificaciones.style.display = 'none';

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
formularioNotificaciones.addEventListener('submit', agregarNotificaciones);
btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-warning', traeDatos);
ent_usuario_catalogo.addEventListener('change', buscarCatalogo);
ent_tecnico_catalogo.addEventListener('change', buscarCatalogo2);

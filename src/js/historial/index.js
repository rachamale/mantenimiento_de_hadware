
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const btnBuscar = document.getElementById('btnBuscar');
const fechaInicioInput = document.getElementById('fechaInicio');
const fechaFinInput = document.getElementById('fechaFin');

const btnPdf = document.getElementById('btnPdf');
let contador = 1;
const datatable = new DataTable('#tablaHistorial', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            render: () => contador++
        },
        { title: 'FECHA', data: 'equi_his_fecha' },
        { title: 'OFICIO', data: 'equipo_oficio' },
        { title: 'DESCRIPCION', data: 'equipo_estado_descripcion' },
        { title: 'TIPO_DE_EQUIPO', data: 'tipo_equipo_descripcion' },
        { title: 'DEPENDENCIA', data: 'dep_desc_lg' },
        { title: 'CAT_USU_ENTREGO', data: 'sol_usuario_catalogo' },
        { title: 'CAT_TEC_RECIBE', data: 'sol_tecnico_catalogo' },
        { title: 'CAT_TECNICO_REPARO', data: 'rep_tecnico_catalogo' },
        { title: 'CAT_USU_RECIBE', data: 'ent_usuario_catalogo' },
        { title: 'CAT_TEC_ENTREGA', data: 'ent_tecnico_catalogo' },
        {
            title: "PROGRESO",
            data: 'estado',
            render: function (data, type, row, meta) {
                if (type === 'display') {
                    if (data === "1") {

                        return `<div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>`;
                    } else if (data === "2") {
                        return `<div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                        </div>`;
                    } else if (data === "3") {
                        return `<div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                        </div>`;
                    } else if (data === "4") {
                        return `<div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                        </div>`;
                    }                
                    
                    return data;
                }
                return data;
            }
        }
    ]
});

const buscar = async () => {
    const fechaInicio = fechaInicioInput.value;
    const fechaFin = fechaFinInput.value;

    if (!fechaInicio || !fechaFin) {
        Swal.fire({
            icon: 'info',
            title: 'Bienvenido Por favor, selecciona ambas fechas',
        });
        return;
    }

    const fechaInicioObj = new Date(fechaInicio);
    const fechaFinObj = new Date(fechaFin);

    // Obtener la fecha actual
    const hoy = new Date();

    // Validar que las fechas no sean mayores que la fecha actual
    if (fechaInicioObj > hoy || fechaFinObj > hoy) {
        Swal.fire({
            icon: 'warning',
            title: 'Las fechas no pueden ser mayores que la fecha actual',
        });
        return;
    }

    // Calcular la fecha límite como un mes atrás desde la fecha actual
    const fechaLimite = new Date();
    fechaLimite.setMonth(hoy.getMonth() - 1);

    // Verificar que el rango sea al menos de un día
    if (fechaFinObj - fechaInicioObj < 0) {
        Swal.fire({
            icon: 'warning',
            title: 'La fecha de fin no puede ser anterior a la fecha de inicio',
        });
        return;
    }

    // Verificar que el rango no exceda un mes
    const unMesEnMilisegundos = 30 * 24 * 60 * 60 * 1000; // Aproximadamente 30 días
    if (fechaFinObj - fechaInicioObj > unMesEnMilisegundos) {
        Swal.fire({
            icon: 'danger',
            title: 'El rango de fechas no puede ser mayor a un mes',
        });
        return;
    }

    const url = `/mantenimiento_de_hardware/API/historial/buscar?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;

    const config = {
        method: 'GET',
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        datatable.clear().draw();

        if (data.length > 0) {
            contador = 1;
            datatable.rows.add(data).draw();

            // Display the button when data is found
            btnPdf.style.display = '';

            Swal.fire({
                icon: 'success',
                title: 'Registros encontrados exitosamente',
            });
        } else {
            Swal.fire({
                icon: 'info',
                title: 'No se encontraron registros',
            });
        }
    } catch (error) {
        console.error(error);
        Swal.fire({
            icon: 'error',
            title: 'Error al realizar la búsqueda',
        });
    }
};



const pdf3 = async (e) => {
    const fechaInicio = fechaInicioInput.value;
    const fechaFin = fechaFinInput.value;
    e.preventDefault();

    const button = e.target;
    const id = button.dataset.codigo;

    if (await confirmacion('question', 'Desea imprimir historial de equipos?')) {
        const url = `/mantenimiento_de_hardware/informacion3?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;

        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");
        const config = {
            method: 'GET',
            headers,
        };

        try {
            const respuesta = await fetch(url, config);
            if (respuesta.ok) {
                const blob = await respuesta.blob();

                if (blob) {
                    const urlBlob = window.URL.createObjectURL(blob);

                    // Abre el PDF en una nueva ventana o pestaña
                    window.open(urlBlob, '_blank');
                    Swal.fire({
                        title: "PDF abierto correctamente",
                        icon: "success",
                    });
                } else {
                    console.error('No se pudo obtener el blob del PDF.');
                }
            } else {
                console.error('Error al generar el PDF.');
            }
        } catch (error) {
            console.error(error);
        }
    }
};





buscar();

btnBuscar.addEventListener('click', buscar);


btnPdf.addEventListener('click', pdf3);
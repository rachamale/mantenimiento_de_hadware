import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('form');
const btnBuscar = document.getElementById('btnBuscar');

const buscar = async () => {
    const equipo_codigo = document.getElementById('equipo_codigo').value;

    if (!equipo_codigo) {
        Toast.fire({
            title: 'Por favor, seleccione un equipo.',
            icon: 'error'
        });
        return;
    }

    const url = `/mantenimiento_de_hadware/API/reporte/generar?equipo_codigo=${equipo_codigo}`;  // Ajusta la URL según tu estructura de rutas
    
    try {
        const respuesta = await fetch(url);
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

btnBuscar.addEventListener('click', buscar);

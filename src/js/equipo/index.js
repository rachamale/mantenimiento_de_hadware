import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";


const FormEquipoFull = document.getElementById('formularioEquipo')

const FormOficio = document.getElementById('equipoForm1')
const FormTipo = document.getElementById('equipoForm2');
const FormEquipo = document.getElementById('equipoForm3');
const FormDetalle = document.getElementById('equipoForm4');

const btnSiguiente = document.getElementById('btnSiguiente');
const btnAnterior = document.getElementById('btnAnterior');
const btnMonitor = document.getElementById('btn-monitor');
const btnImpresora = document.getElementById('btn-impresora');
const btnCPU = document.getElementById('btn-cpu');
const btnOtros = document.getElementById('btn-otros');
const btnGuardar = document.getElementById('btnGuardar');


const tipoSelect = document.getElementById('equipo_tipo');

const tituloFormEquipo = document.getElementById('tituloFormEquipo');

const camposCPU1 = document.getElementById('camposCPU1');
const camposCPU2 = document.getElementById('camposCPU2');
const camposOtros = document.getElementById('camposOtros');

const detalleCPU = document.getElementsByClassName('detalleCPU');



const catalogo = document.getElementById('equipo_usuario_catalgo');
//console.log(catalogo)
const nombre = document.getElementById('equipo_usuario_nombre');

const comando = document.getElementById('equipo_nombre_dependencia');

const dependencia = document.getElementById('equipo_dependencia');

const catalogoDelTecnico = document.getElementById('equipo_tecnico_recibe');
const nombreDelTecnico = document.getElementById('equipo_tecnico_nombre');
// const foto = document.getElementById('foto');


FormOficio.style.display = ''
FormTipo.style.display = 'none'
FormEquipo.style.display = 'none'
FormDetalle.style.display = 'none'
btnAnterior.style.display = 'none'
btnGuardar.style.display = 'none'


let posicionForm = 0; // 0 Formulario-1 seleccionar tipo-2 detalles equipo -3 final
let tipoForm; //0 Monitor - 1 Impresora - 2 CPU - 3 Otros
let parametroTitulo = ''

const showOficioForm = (e) => {
    e.preventDefault()
    posicionForm = 0
    FormOficio.style.display = ''
    FormTipo.style.display = 'none'
    FormEquipo.style.display = 'none'
    FormDetalle.style.display = 'none'
    btnAnterior.style.display = 'none'
    btnSiguiente.style.display = ''
    btnGuardar.style.display = 'none'
}

const showTipoForm = (e) => {
    e.preventDefault()
    posicionForm = 1
    FormOficio.style.display = 'none'
    FormTipo.style.display = ''
    FormEquipo.style.display = 'none'
    FormDetalle.style.display = 'none'
    btnAnterior.style.display = ''
    btnSiguiente.style.display = 'none'
    btnGuardar.style.display = 'none'
}

const showEquipoForm = (e) => {
    e.preventDefault()
    posicionForm = 2
    FormOficio.style.display = 'none'
    FormTipo.style.display = 'none'
    FormEquipo.style.display = ''
    FormDetalle.style.display = 'none'
    btnAnterior.style.display = ''
    btnSiguiente.style.display = ''
    btnGuardar.style.display = 'none'

    if (tipoForm !== 3) {
        camposCPU1.style.display = 'none';
        camposCPU2.style.display = 'none';
    } else {
        camposCPU1.style.display = '';
        camposCPU2.style.display = '';
    }

    if (tipoForm !== 4) {
        camposOtros.style.display = 'none';
    } else {
        camposOtros.style.display = '';
    }


    tituloFormEquipo.innerText = 'FORMULARIO DE ' + parametroTitulo


}

const showDetalleForm = (e) => {
    e.preventDefault()
    posicionForm = 3
    FormOficio.style.display = 'none'
    FormTipo.style.display = 'none'
    FormEquipo.style.display = 'none'
    FormDetalle.style.display = ''
    btnSiguiente.style.display = 'none'
    btnAnterior.style.display = ''
    btnGuardar.style.display = ''
    btnGuardar.style.display = ''
    if (tipoForm !== 3) {

        for (const item of detalleCPU) {
            item.style.display = 'none'
        }
    }
    else {
        for (const item of detalleCPU) {
            item.style.display = ''
        }
    }


}

const getFormSecuencial = (e) => {
    e.preventDefault()
    if (posicionForm === 0) {
        showTipoForm(e)
    } else if (posicionForm === 1) {
        showEquipoForm(e)
    } else if (posicionForm === 2) {
        showDetalleForm(e)
    }
}
const getFormSecuencialBack = (e) => {
    e.preventDefault()
    if (posicionForm === 1) {
        showOficioForm(e)
    } else if (posicionForm === 2) {
        showTipoForm(e)
    } else if (posicionForm === 3) {
        showEquipoForm(e)
    }
}

catalogo.addEventListener('change', async (e) => {
    const solicitante = await buscarCatalogo();
    colocarCatalogo(solicitante);
})


const buscarCatalogo = async () => {


    let validarCatalogo = catalogo.value
    let validarCatalogo2 = catalogoDelTecnico.value;
    if (validarCatalogo === validarCatalogo2) {
        Toast.fire({
            icon: 'info',
            text: 'Los catalogos deben de ser distintos'
        });
        return;
    }

    // let per_catalogo = formulario.per_catalogo.value;
    const url = `/mantenimiento_de_hardware/API/equipo/buscarCatalogo?per_catalogo=${validarCatalogo}`;


    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();



        if (data.length > 0) {
            Toast.fire({
                title: 'Catálogo válido',
                icon: 'success'
            });
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            });
            return;
        }

        return data;
    } catch (error) {
        console.log(error);
    }


}

async function colocarCatalogo(datos) {
    const dato = datos[0];
    catalogo.value = dato.per_catalogo;
    nombre.value = dato.nombres;
    comando.value = dato.dep_desc_md;
    dependencia.value = dato.dep_llave;
    const foto = document.getElementById('foto');
    foto.src = `https://sistema.ipm.org.gt/sistema/fotos_afiliados/ACTJUB/${dato.per_catalogo}.jpg`;
}

catalogoDelTecnico.addEventListener('change', async (e) => {
    const autorizador1 = await buscarCatalogo2();
    colocarCatalogo2(autorizador1);

});


const buscarCatalogo2 = async () => {
    let validarCatalogo = catalogo.value
    let validarCatalogo2 = catalogoDelTecnico.value;
    if (validarCatalogo === validarCatalogo2) {
        Toast.fire({
            icon: 'info',
            text: 'Los catalogos deben de ser distintos'
        });
        return;
    }

    const url = `/mantenimiento_de_hardware/API/equipo/buscarCatalogo2?per_catalogo=${validarCatalogo2}`;

    const config = {
        method: 'GET',
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();


        if (data.length > 0) {
            Toast.fire({
                title: 'Catálogo válido',
                icon: 'success'
            });
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            });
            return;
        }

        return data;
    } catch (error) {
        console.log(error);
    }


}


async function colocarCatalogo2(datos) {

    const dato = datos[0]
    catalogoDelTecnico.value = dato.per_catalogo
    nombreDelTecnico.value = dato.nombres;
    const foto2 = document.getElementById('foto2');
    foto2.src = `https://sistema.ipm.org.gt/sistema/fotos_afiliados/ACTJUB/${dato.per_catalogo}.jpg`;



}

const cancelarAccion = () => {
    btnGuardar.disabled = false
    btnGuardar.parentElement.style.display = ''
    btnBuscar.disabled = false
    btnBuscar.parentElement.style.display = ''
    btnModificar.disabled = true
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.disabled = true
    btnCancelar.parentElement.style.display = 'none'
    divTabla.style.display = ''
    formulario.reset(); f
}

const modificar = async (evento) => {

    evento.preventDefault();


    const body = new FormData(formulario)
    const url = '/mantenimiento_de_hardware/API/qeuipos/modificar';
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();


        const { codigo, mensaje, detalle } = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success'
                buscar();
                cancelarAccion();
                break;

            case 0:
                icon = 'error'
                console.log(detalle)
                break;

            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}

const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', 'Desea elminar este registro?')) {
        const body = new FormData()
        body.append('cmv_id', id)
        const url = '/soliciudes_e/API/protocolos/eliminar';
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");
        const config = {
            method: 'POST',
            body
        }
        try {
            const respuesta = await fetch(url, config)
            const data = await respuesta.json();

            const { codigo, mensaje, detalle } = data;
            let icon = 'info'
            switch (codigo) {
                case 1:

                    icon = 'success'

                    break;

                case 0:
                    icon = 'error'
                    console.log(detalle)
                    break;

                default:
                    break;
            }

            Toast.fire({
                icon,
                text: mensaje
            })


        } catch (error) {
            console.log(error);
        }
    }


}



const guardarFormulario = async () => {
    if (await confirmacion('warning', 'Desea guardar los datos del formulario?')) {
        console.log(FormEquipoFull)
        const body = new FormData(FormEquipoFull);
        body.delete('equipo_tecnico_nombre')
        body.delete('equipo_nombre_dependencia')
        if (tipoForm !== 2) {
            body.delete('equipo_almacenamiento')
            body.delete('equipo_lector_cd')
            body.delete('equipo_tarjeta_sonido')
            body.delete('equipo_drivers')
            body.delete('equipo_tarjeta_grafica')
            body.delete('equipo_fuente_poder')
        }

        for (var pair of body.entries()) {
            console.log('*' + pair[0] + '*|*' + pair[1] + '*');
        }


        const url = '/mantenimiento_de_hardware/API/equipo/guardar';
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");

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

        } catch (error) {
            console.log(error);
        }

    }
}

let fechaIngreso = "";
let numeroOficio = "";
let catalogoUsuario = "";
let nombresUsuario = "";
let telefonoUsuario = "";
let dependenciaEquipo = "";
let catalogoTecnico = "";
let nombresTecnico = "";
let motivoIngreso = "";
let modeloEquipo = "";
let serieEquipo = "";
let almacenamientoEquipo = "";
let marcaEquipo = "";
let descripcionEquipo = "";

// Función para avanzar al siguiente formulario
function avanzarAlSiguienteFormulario() {
    // Obtener los valores de los campos del formulario actual
    fechaIngreso = document.getElementById("equipo_fecha").value;
    numeroOficio = document.getElementById("equipo_oficio").value;
    catalogoUsuario = document.getElementById("equipo_usuario_catalgo").value;
    nombresUsuario = document.getElementById("equipo_usuario_nombre").value;
    telefonoUsuario = document.getElementById("equipo_usuario_numero").value;

    // Avanzar al siguiente formulario (código para hacerlo)

    // Actualizar la tabla con los datos ingresados
    actualizarTabla();
}

// Función para actualizar la tabla con los datos ingresados
function actualizarTabla() {
    document.getElementById("equipo_fecha").textContent = fechaIngreso;
    document.getElementById("equipo_oficio").textContent = numeroOficio;
    document.getElementById("equipo_usuario_catalgo").textContent = catalogoUsuario;
    document.getElementById("equipo_usuario_nombre").textContent = nombresUsuario;
    document.getElementById("equipo_usuario_numero").textContent = telefonoUsuario;
    document.getElementById("equipo_dependencia").textContent = dependenciaEquipo;
    document.getElementById("equipo_tecnico_catalogo").textContent = catalogoTecnico;
    document.getElementById("equipo_tecnico_nombre").textContent = nombresTecnico;
    document.getElementById("equipo_motivo").textContent = motivoIngreso;
    document.getElementById("equipo_modelo").textContent = modeloEquipo;
    document.getElementById("equipo_serial").textContent = serieEquipo;
    document.getElementById("equipo_almacenamiento").textContent = almacenamientoEquipo;
    document.getElementById("equipo_marca").textContent = marcaEquipo;
    document.getElementById("equipo_descripcion").textContent = descripcionEquipo;
}




btnSiguiente.addEventListener('click', getFormSecuencial)
btnMonitor.addEventListener('click', (e) => {
    tipoForm = 1;
    tipoSelect.value = 1
    parametroTitulo = 'MONITOR';

    getFormSecuencial(e);
})
btnImpresora.addEventListener('click', (e) => {
    tipoForm = 2;
    tipoSelect.value = 2
    parametroTitulo = 'IMPRESORA';
    getFormSecuencial(e);
})
btnCPU.addEventListener('click', (e) => {
    tipoForm = 3;
    tipoSelect.value = 3
    parametroTitulo = 'CPU';
    getFormSecuencial(e);
})
btnOtros.addEventListener('click', (e) => {
    tipoForm = 4;
    parametroTitulo = 'OTROS';
    getFormSecuencial(e);
})

btnAnterior.addEventListener('click', getFormSecuencialBack)

btnGuardar.addEventListener('click', guardarFormulario)
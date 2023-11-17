import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";


const FormEquipoFull = document.getElementById('formularioEquipo')
const agregarDatos = document.getElementById('subir')
const FormOficio = document.getElementById('equipoForm1')
const FormTipo = document.getElementById('equipoForm2');
const FormEquipo = document.getElementById('equipoForm3');
const FormDetalle = document.getElementById('equipoForm4');
// const  = document.getElementById('equipo_fecha_entrega')

const btnSiguiente = document.getElementById('btnSiguiente');
const btnAnterior = document.getElementById('btnAnterior');
const btnMonitor = document.getElementById('btn-monitor');
const btnImpresora = document.getElementById('btn-impresora');
const btnCPU = document.getElementById('btn-cpu');
const btnOtros = document.getElementById('btn-otros');
const btnGuardar = document.getElementById('btnGuardar');



const tipoSelect = document.getElementById('equipo_tipo');
console.log(tipoSelect)
const tituloFormEquipo = document.getElementById('tituloFormEquipo');

const camposCPU1 = document.getElementById('camposCPU1');
const camposCPU2 = document.getElementById('camposCPU2');
const camposOtros = document.getElementById('camposOtros');

const detalleCPU = document.getElementsByClassName('detalleCPU');



const catalogo = document.getElementById('sol_usuario_catalogo');
//console.log(catalogo)
const nombre = document.getElementById('equipo_usuario_nombre');

const comando = document.getElementById('equipo_nombre_dependencia');

const dependencia = document.getElementById('equipo_dependencia');

const catalogoDelTecnico = document.getElementById('sol_tecnico_catalogo');
const nombreDelTecnico = document.getElementById('equipo_tecnico_nombre');
// const foto = document.getElementById('foto');

const tipoFormDiccionario = {
	1: "Monitor",
	2: "Impresora",
	3: "CPU",
	4: "Otros"
}
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
////pendiente de arreglar 
const getFormSecuencial = (e) => {
    e.preventDefault()
    if (posicionForm === 0) {
        if (!validarFormulario(FormOficio, ['equipo_dependencia'])) {
            Toast.fire({
                icon: 'info',
                text: 'Debe llenar todos los datos'
            });
            return;
        }
        showTipoForm(e)
    } else if (posicionForm === 1) {
        showEquipoForm(e)
    } else if (posicionForm === 2) {
        if (tipoForm === 3) {
            if (!validarFormulario(FormEquipo, ['equipo_tipo'])) {
                Toast.fire({
                    icon: 'info',
                    text: 'Debe llenar todos los datos'
                });
                return;
            }
        }
        else if (tipoForm === 4) {
            if (!validarFormulario(FormEquipo,
                [
                    'equipo_fuente_poder',
                    'equipo_tarjeta_grafica',
                    'equipo_drivers',
                    'equipo_tarjeta_sonido',
                    'equipo_lector_cd',
                    'equipo_almacenamiento'
                ])) {
                Toast.fire({
                    icon: 'info',
                    text: 'Debe llenar todos los datos'
                });
                return;
            }
        }
        else {
            if (!validarFormulario(FormEquipo,
                ['equipo_fuente_poder',
                    'equipo_tarjeta_grafica',
                    'equipo_drivers',
                    'equipo_tarjeta_sonido',
                    'equipo_lector_cd',
                    'equipo_almacenamiento',
                    'equipo_tipo'
                ])) {
                Toast.fire({
                    icon: 'info',
                    text: 'Debe llenar todos los datos'
                });
                return;
            }
        }

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
    const url = `/mantenimiento_de_hardware/API/solicitud/buscarCatalogo?per_catalogo=${validarCatalogo}`;


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

    const url = `/mantenimiento_de_hardware/API/solicitud/buscarCatalogo?per_catalogo=${validarCatalogo2}`;

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
        console.log(tipoSelect.value)
        const body = new FormData(FormEquipoFull);
        body.delete('equipo_tecnico_nombre')
        body.delete('equipo_nombre_dependencia')
        body.delete('equipo_usuario_nombre')
        if (tipoForm !== 3) {
            body.delete('equipo_almacenamiento')
            body.delete('equipo_lector_cd')
            body.delete('equipo_tarjeta_sonido')
            body.delete('equipo_drivers')
            body.delete('equipo_tarjeta_grafica')
            body.delete('equipo_fuente_poder')
        }
        formularioEquipo


        for (var pair of body.entries()) {
            console.log('*' + pair[0] + '*|*' + pair[1] + '*');
        }


        const url = '/mantenimiento_de_hardware/API/solicitud/guardar';
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
            switch (codigo) {
                case 1:
                    formularioEquipo.reset();
                    icon = 'success';
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
}





btnSiguiente.addEventListener('click', getFormSecuencial)

btnImpresora.addEventListener('click', (e) => {
    tipoForm = 2;
    tipoSelect.value = tipoForm

    parametroTitulo = 'IMPRESORA';
    getFormSecuencial(e);
})
btnCPU.addEventListener('click', (e) => {
    tipoForm = 3;
    tipoSelect.value = tipoForm

    parametroTitulo = 'CPU';
    getFormSecuencial(e);
})
btnMonitor.addEventListener('click', (e) => {
    tipoForm = 1;
    tipoSelect.value = tipoForm

    parametroTitulo = 'MONITOR';

    getFormSecuencial(e);
})

btnOtros.addEventListener('click', (e) => {
    tipoForm = 4;
    tipoSelect.value = ""
    for (const item of tipoSelect.children) {
        if (item.value === '1' || item.value === '2' || item.value === '3') {
            item.style.display = 'none'
        }
    }

    parametroTitulo = 'OTROS';
    getFormSecuencial(e);
})

function onFormSubmit(e) {
    e.preventDefault();
    const data = new FormData(FormEquipoFull)
    const verDatos = Object.fromEntries(data.entries());
    console.log(verDatos)

    FormEquipoFull.equipo_fecha_entrega.value = verDatos.sol_fecha;

    FormEquipoFull.equipo_oficio1.value = verDatos.equipo_oficio;

    FormEquipoFull.equipo_usuario_cat_entrega.value = verDatos.sol_usuario_catalogo;

    FormEquipoFull.equipo_almacenamiento1.value = verDatos.equipo_almacenamiento

    FormEquipoFull.equipo_usuario_numero.value = verDatos.sol_usuario_telefono;

    FormEquipoFull.equipo_usuario_nombre1.value = verDatos.equipo_usuario_nombre;

    FormEquipoFull.equipo_dependencia1.value = verDatos.equipo_nombre_dependencia;

    FormEquipoFull.equipo_tecnico_catalogo.value = verDatos.sol_tecnico_catalogo;

    FormEquipoFull.equipo_tecnico_nombre1.value = verDatos.equipo_tecnico_nombre;

    FormEquipoFull.equipo_modelo1.value = verDatos.equipo_modelo;

    FormEquipoFull.equipo_serial1.value = verDatos.equipo_serial;

    FormEquipoFull.equipo_motivo1.value = verDatos.equipo_motivo;

    FormEquipoFull.equipo_descripcion1.value = verDatos.equipo_descripcion;

    FormEquipoFull.equipo_marca1.value = verDatos.equipo_marca;

    FormEquipoFull.equipo_lector_cd1.value = verDatos.equipo_lector_cd;

    FormEquipoFull.equipo_tarjeta_sonido1.value = verDatos.equipo_tarjeta_sonido;

    FormEquipoFull.equipo_drivers1.value = verDatos.equipo_drivers;

    FormEquipoFull.equipo_tarjeta_grafica1.value = verDatos.equipo_tarjeta_grafica;

    FormEquipoFull.equipo_fuente_poder1.value = verDatos.equipo_fuente_poder;

    FormEquipoFull.equipo_con_cable1.value = verDatos.equipo_con_cable;


}

btnAnterior.addEventListener('click', getFormSecuencialBack)

btnGuardar.addEventListener('click', guardarFormulario)


agregarDatos.addEventListener("click", onFormSubmit);
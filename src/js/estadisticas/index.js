import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import Chart from "chart.js/auto";
import { Toast } from "../funciones";

/* Canvas para las divisiones de los gráficos y evitar conflictos */
const canvas = document.getElementById("chartEquipo");
const canvasEquiposDependencia = document.getElementById("chartEquiposDependencia");
const canvasReparaciones = document.getElementById("chartReparaciones");
const canvasSolicitudes = document.getElementById("chartSolicitudes");
const canvasEntregas = document.getElementById("chartEntregas");
const canvasMarcasEquipos = document.getElementById("chartMarcasEquipos");
const canvasEntregasGeneral = document.getElementById("chartEntregasGeneral");
const canvasBuscarDatosEquiposPorEstado = document.getElementById("chartBuscarDatosEquiposPorEstado");
const canvasBuscarDatosEquiposPorTipo = document.getElementById("chartBuscarDatosEquiposPorTipo");



const btnActualizar = document.getElementById("btnActualizar");

const inputFechaInicio = document.getElementById('fechaInicio')
const inputFechaFin = document.getElementById('fechaFin')


const context = canvas.getContext("2d");
const contextEquiposDependencia = canvasEquiposDependencia.getContext("2d");
const contextReparaciones = canvasReparaciones.getContext("2d");
const contextSolicitudes = canvasSolicitudes.getContext("2d");
const contextEntregas = canvasEntregas.getContext("2d");
const contextMarcasEquipos = canvasMarcasEquipos.getContext("2d");
const contextEntregasGeneral = canvasEntregasGeneral.getContext("2d");
const contextBuscarDatosEquiposPorEstado = canvasBuscarDatosEquiposPorEstado.getContext("2d");
const contextBuscarDatosEquiposPorTipo = canvasBuscarDatosEquiposPorTipo.getContext("2d");


const chartEquipo = new Chart(context, {
  type: "bar",
  data: {
    labels: [],
    datasets: [
      {
        label: "Estadísticas de Equipos",
        data: [],
        backgroundColor: [],
      },
    ],
  },
  options: {
    indexAxis: "x",
    scales: {
      x: {
        beginAtZero: true,
      },
      y: {
        beginAtZero: true,
      },
    },
  },
});


// dependencia

const chartEquiposDependencia = new Chart(contextEquiposDependencia, {
  type: "bar",
  data: {
    labels: [],
    datasets: [
      {
        label: "Equipos por Dependencia",
        data: [],
        backgroundColor: [],
      },
    ],
  },
  options: {
    indexAxis: "x",
    scales: {
      x: {
        beginAtZero: true,
      },
      y: {
        beginAtZero: true,
      },
    },
  },
});

const chartReparaciones = new Chart(contextReparaciones, {
  type: "pie",
  data: {
    labels: [],
    datasets: [
      {
        label: "Cantidad de Reparaciones por Técnico",
        data: [],
        backgroundColor: [],
      },
    ],
  },
  options: {
    indexAxis: "x",
    scales: {
      x: {
        beginAtZero: true,
      },
      y: {
        beginAtZero: true,
      },
    },
  },
});

const chartSolicitudes = new Chart(contextSolicitudes, {
  type: "pie",
  data: {
    labels: [],
    datasets: [
      {
        label: "Cantidad de Solicitudes por Usuario",
        data: [],
        backgroundColor: [],
      },
    ],
  },
  options: {
    indexAxis: "y",
  },
});

const chartEntregas = new Chart(contextEntregas, {
  type: "bar",
  data: {
    labels: [],
    datasets: [
      {
        label: "Equipos Entregados a Usurios",
        data: [],
        backgroundColor: [],
      },
    ],
  },
  options: {
    indexAxis: "x",
    scales: {
      x: {
        beginAtZero: true,
      },
      y: {
        beginAtZero: true,
      },
    },
  },
});

const chartMarcasEquipos = new Chart(contextMarcasEquipos, {
  type: "pie",
  data: {
    labels: [],
    datasets: [
      {
        label: "Marcas de Equipos",
        data: [],
        backgroundColor: [],
      },
    ],
  },
  options: {
    indexAxis: "y",
  },
});

const chartEntregasGeneral = new Chart(contextEntregasGeneral, {
  type: "pie",
  data: {
    labels: [],
    datasets: [
      {
        label: "Entregas Generales",
        data: [],
        backgroundColor: [],
      },
    ],
  },
  options: {
    indexAxis: "y",
  },
});


const chartBuscarDatosEquiposPorEstado = new Chart(contextBuscarDatosEquiposPorEstado, {
  type: "pie",
  data: {
    labels: [],
    datasets: [
      {
        label: "Equipos por Estado",
        data: [],
        backgroundColor: [],
      },
    ],
  },
  options: {
    indexAxis: "y",
  },
});

const chartBuscarDatosEquiposPorTipo = new Chart(contextBuscarDatosEquiposPorTipo, {
type: "pie",
data: {
  labels: [],
  datasets: [
    {
      label: "Equipos por Tipo",
      data: [],
      backgroundColor: [],
    },
  ],
},
options: {
  indexAxis: "x",
  scales: {
    x: {
      beginAtZero: true,
    },
    y: {
      beginAtZero: true,
    },
  },
},
});

const getRandomColor = () => {
  const r = Math.floor(Math.random() * 256);
  const g = Math.floor(Math.random() * 256);
  const b = Math.floor(Math.random() * 256);

  const rgbColor = `rgba(${r},${g},${b},0.5)`;
  return rgbColor;
};

const getEstadisticas = async () => {
  const fechaInicio=inputFechaInicio.value
  const fechaFin=inputFechaFin.value
  const url = `/mantenimiento_de_hardware/API/estadisticas/getEstadisticas?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
  const config = {
    method: "GET",
  };

  try {
    const request = await fetch(url, config);
    const data = await request.json();

    console.log("Datos recibidos:", data);

    chartEquipo.data.labels = [];
    chartEquipo.data.datasets[0].data = [];
    chartEquipo.data.datasets[0].backgroundColor = [];

    if (data && Object.keys(data).length > 0) {
      data.forEach((registro) => {
        chartEquipo.data.labels.push(registro.estado);
        chartEquipo.data.datasets[0].data.push(registro.total_equipos);
        chartEquipo.data.datasets[0].backgroundColor.push(getRandomColor());
      })


      chartEquipo.update();
    } else {
      Toast.fire({
        title: "No se encontraron registros",
        icon: "info",
      });
    }
  } catch (error) {
    console.error("Error al obtener estadísticas:", error);
    Toast.fire({
      title: "Error al obtener estadísticas",
      icon: "error",
    });
  }
};



// const getbuscarDatosEquipoDependencia = async (event) => {
//   event.preventDefault();  // Evita el comportamiento predeterminado del botón
const getbuscarDatosEquiposDependencia = async () => {
  const fechaInicio=inputFechaInicio.value
  const fechaFin=inputFechaFin.value
  const url = `/mantenimiento_de_hardware/API/estadisticas/buscarDatosEquiposDependencia?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
  const config = {
    method: "GET",
  };

  try {
    console.log("Antes de realizar la solicitud fetch");

    const request = await fetch(url, config);
    const response = await request.json();
    console.log("Datos obtenidos:", response);

    chartEquiposDependencia.data.labels = [];
    chartEquiposDependencia.data.datasets[0].data = [];
    chartEquiposDependencia.data.datasets[0].backgroundColor = [];

    if (response) {
      response.forEach((registro) => {
        chartEquiposDependencia.data.labels.push(registro.nombre_dependencia);
        chartEquiposDependencia.data.datasets[0].data.push(registro.cantidad_equipos);
        chartEquiposDependencia.data.datasets[0].backgroundColor.push(getRandomColor());
      });
    } else {
      Toast.fire({
        title: "No se encontraron registros",
        icon: "info",
      });
    }

    chartEquiposDependencia.update();
  } catch (error) {
    console.log(error);
  }
  };


// Función para obtener estadísticas de solicitudes
const getEstadisticasReparaciones = async () => {
  const fechaInicio = inputFechaInicio.value;
  const fechaFin = inputFechaFin.value;
  const url = `/mantenimiento_de_hardware/API/estadisticas/buscarDatosReparaciones?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
  const config = {
    method: "GET",
  };

  try {
    const request = await fetch(url, config);
    const response = await request.json();

    chartReparaciones.data.labels = [];
    chartReparaciones.data.datasets[0].data = [];
    chartReparaciones.data.datasets[0].backgroundColor = [];

    if (response && response.length > 0) {
      response.forEach((registro) => {
        chartReparaciones.data.labels.push(registro.nombre_tecnico);
        chartReparaciones.data.datasets[0].data.push(registro.cantidad_reparaciones);
        chartReparaciones.data.datasets[0].backgroundColor.push(getRandomColor());

        // Agrega la fecha de la última reparación a la etiqueta de la barra
        const ultimaReparacion = registro.ultima_reparacion || "No disponible";
        chartReparaciones.data.labels[chartReparaciones.data.labels.length - 1] += `\nÚltima Reparación: ${ultimaReparacion}`;
      });

      chartReparaciones.update();
    } else {
      Swal.fire({
        icon: 'info',
        title: 'No se encontraron datos',
        text: 'No hay registros para las fechas seleccionadas.',
      });
    }
  } catch (error) {
    console.log(error);
    Toast.fire({
      title: "Error al obtener estadísticas de reparaciones",
      icon: "error",
    });
  }
};


const getEstadisticasSolicitudes = async () => {
  const fechaInicio=inputFechaInicio.value
  const fechaFin=inputFechaFin.value
  const url = `/mantenimiento_de_hardware/API/estadisticas/buscarDatosSolicitudes?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
  const config = {
    method: "GET",
  };

  const request = await fetch(url, config);
  const response = await request.json();

  try {
    chartSolicitudes.data.labels = [];
    chartSolicitudes.data.datasets[0].data = [];
    chartSolicitudes.data.datasets[0].backgroundColor = [];

    if (response) {
      response.forEach((registro) => {
        chartSolicitudes.data.labels.push(registro.nombre_usuario);
        chartSolicitudes.data.datasets[0].data.push(registro.cantidad_solicitudes);
        chartSolicitudes.data.datasets[0].backgroundColor.push(getRandomColor());
      });
    } else {
      Toast.fire({
        title: "No se encontraron registros de solicitudes",
        icon: "info",
      });
    }

    chartSolicitudes.update();
  } catch (error) {
    console.log(error);
  }
};

const getEstadisticasEntregas = async () => {
  const fechaInicio=inputFechaInicio.value
  const fechaFin=inputFechaFin.value
  const url = `/mantenimiento_de_hardware/API/estadisticas/buscarDatosEntregas?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
  const config = {
    method: "GET",
  };

  const request = await fetch(url, config);
  const response = await request.json();

  try {
    chartEntregas.data.labels = [];
    chartEntregas.data.datasets[0].data = [];
    chartEntregas.data.datasets[0].backgroundColor = [];

    if (response) {
      response.forEach((registro) => {
        chartEntregas.data.labels.push(registro.nombre_usuario);
        chartEntregas.data.datasets[0].data.push(registro.cantidad_entregas);
        chartEntregas.data.datasets[0].backgroundColor.push(getRandomColor());
      });
    } else {
      Toast.fire({
        title: "No se encontraron registros de entregas",
        icon: "info",
      });
    }

    chartEntregas.update();
  } catch (error) {
    console.log(error);
  }
};
const getEstadisticasMarcasEquipos = async () => {
  const fechaInicio = inputFechaInicio.value;
  const fechaFin = inputFechaFin.value;
  const url = `/mantenimiento_de_hardware/API/estadisticas/buscarDatosMarcasEquipos?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
  const config = {
    method: "GET",
  };

  try {
    const request = await fetch(url, config);
    const response = await request.json();

    chartMarcasEquipos.data.labels = [];
    chartMarcasEquipos.data.datasets[0].data = [];
    chartMarcasEquipos.data.datasets[0].backgroundColor = [];

    if (response && response.length > 0) {
      response.forEach((registro) => {
        chartMarcasEquipos.data.labels.push(registro.marca_equipo);
        chartMarcasEquipos.data.datasets[0].data.push(registro.cantidad);
        chartMarcasEquipos.data.datasets[0].backgroundColor.push(getRandomColor());
      });

      chartMarcasEquipos.update();
    } else {
      Swal.fire({
        icon: 'info',
        title: 'No se encontraron datos',
        text: 'No hay registros para las fechas seleccionadas.',
      });
    }
  } catch (error) {
    console.log(error);
    Toast.fire({
      title: "Error al obtener estadísticas de marcas de equipos",
      icon: "error",
    });
  }
};


const getEstadisticaEntregasGeneral = async () => {
  const fechaInicio = inputFechaInicio.value;
  const fechaFin = inputFechaFin.value;
  const url = `/mantenimiento_de_hardware/API/estadisticas/EstadisticaEntregasGeneral?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
  const config = {
    method: "GET",
  };

  try {
    const request = await fetch(url, config);
    const data = await request.json();

    // Lógica para la gráfica de Entregas Generales
    chartEntregasGeneral.data.labels = [];
    chartEntregasGeneral.data.datasets[0].data = [];
    chartEntregasGeneral.data.datasets[0].backgroundColor = [];

    if (!data || Object.keys(data).length === 0) {
      Swal.fire({
        icon: 'info',
        title: 'No se encontraron datos',
        text: 'No hay registros para las fechas seleccionadas.',
      });
    } else {
      if (data) {
        data.forEach((registro) => {
          chartEntregasGeneral.data.labels.push(`${registro.nombre_dependencia} - ${registro.estado}`);
          chartEntregasGeneral.data.datasets[0].data.push(registro.cantidad_equipos);
          chartEntregasGeneral.data.datasets[0].backgroundColor.push(getRandomColor());
        });

        chartEntregasGeneral.update();
      } else {
        Toast.fire({
          title: "No se encontraron registros",
          icon: "info",
        });
      }
    }
  } catch (error) {
    console.log(error);
  }
};


const getbuscarDatosEquiposPorEstado = async () => {
  const fechaInicio = inputFechaInicio.value;
  const fechaFin = inputFechaFin.value;
  const url = `/mantenimiento_de_hardware/API/estadisticas/buscarDatosEquiposPorEstado?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;
  const config = {
    method: "GET",
  };

  try {
    const request = await fetch(url, config);
    const data = await request.json();

    // Lógica para la gráfica de Equipos por Estado
    chartBuscarDatosEquiposPorEstado.data.labels = [];
    chartBuscarDatosEquiposPorEstado.data.datasets[0].data = [];
    chartBuscarDatosEquiposPorEstado.data.datasets[0].backgroundColor = [];
    
    if (!data || Object.keys(data).length === 0) {
      Swal.fire({
        icon: 'info',
        title: 'No se encontraron datos',
        text: 'No hay registros para las fechas seleccionadas.',
      });
    } else {
      data.forEach((registro) => {
        chartBuscarDatosEquiposPorEstado.data.labels.push(registro.estado_entrega);
        chartBuscarDatosEquiposPorEstado.data.datasets[0].data.push(registro.cantidad);
        chartBuscarDatosEquiposPorEstado.data.datasets[0].backgroundColor.push(getRandomColor());
      });

      chartBuscarDatosEquiposPorEstado.update();
    }
  } catch (error) {
    console.log(error);
  }
};

const getBuscarDatosEquiposPorTipo = async () => {
  const url = `/mantenimiento_de_hardware/API/estadisticas/buscarDatosEquiposPorTipo?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;

  try {
    const request = await fetch(url);
    const data = await request.json();

    // Lógica para la gráfica de Equipos por Tipo
    chartBuscarDatosEquiposPorTipo.data.labels = [];
    chartBuscarDatosEquiposPorTipo.data.datasets[0].data = [];
    chartBuscarDatosEquiposPorTipo.data.datasets[0].backgroundColor = [];

    if (!data || Object.keys(data).length === 0) {
      Swal.fire({
        icon: 'info',
        title: 'No se encontraron datos',
        text: 'No hay registros para las fechas seleccionadas.',
      });
    } else {
      data.forEach((registro) => {
        chartBuscarDatosEquiposPorTipo.data.labels.push(`${registro.nombre_dependencia} - ${registro.tipo_equipo}`);
        chartBuscarDatosEquiposPorTipo.data.datasets[0].data.push(registro.cantidad_equipos);
        chartBuscarDatosEquiposPorTipo.data.datasets[0].backgroundColor.push(getRandomColor());
      });

      chartBuscarDatosEquiposPorTipo.update();
    }
  } catch (error) {
    console.log(error);
  }
};




btnActualizar.addEventListener("click", async (event) => {
  event.preventDefault(); // Evitar recarga de la página

  // Obtener la fecha actual
  const fechaActual = new Date();

  // Validar fechas
  const fechaInicio = inputFechaInicio.value;
  const fechaFin = inputFechaFin.value;

  if (!fechaInicio || !fechaFin) {
    Swal.fire({
      icon: 'error',
      title: 'Fechas vacías',
      text: 'Por favor, ingresa ambas fechas.',
    });
    return;
  }

  const startDate = new Date(fechaInicio);
  const endDate = new Date(fechaFin);

  // Verificar que ambas fechas estén definidas
  if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
    Swal.fire({
      icon: 'error',
      title: 'Rango de fechas inválido',
      text: 'Por favor, selecciona un rango de fechas válido.',
    });
    return;
  }

  // Verificar que la fecha de inicio no sea mayor a la fecha actual
  if (startDate > fechaActual) {
    Swal.fire({
      icon: 'error',
      title: 'Fecha de inicio inválida',
      text: 'La fecha de inicio no puede ser mayor a la fecha actual.',
    });
    return;
  }

  // Verificar que la fecha de fin no sea mayor a la fecha actual
  if (endDate > fechaActual) {
    Swal.fire({
      icon: 'error',
      title: 'Fecha de fin inválida',
      text: 'La fecha de fin no puede ser mayor a la fecha actual.',
    });
    return;
  }

  // Verificar que el rango de fechas no sea mayor ni menor a 1 mes
  const diferenciaMeses = (endDate.getFullYear() - startDate.getFullYear()) * 12 +
    endDate.getMonth() - startDate.getMonth();

  if (diferenciaMeses !== 1) {
    Swal.fire({
      icon: 'error',
      title: 'Rango de fechas inválido',
      text: 'El rango de fechas debe ser exactamente de 1 mes.',
    });
    return;
  }

  try {
    // Obtener y actualizar estadísticas
    await Promise.all([
      getEstadisticasReparaciones(),
      getEstadisticasSolicitudes(),
      getEstadisticasEntregas(),
      getEstadisticas(),
      getbuscarDatosEquiposDependencia(),
      getEstadisticasMarcasEquipos(),
      getEstadisticaEntregasGeneral(),
      getbuscarDatosEquiposPorEstado(),
      getBuscarDatosEquiposPorTipo(),
    ]);

    const totalCharts = 8; // Número total de gráficos

    // Verificar si algún gráfico tiene datos
    const chartsWithData = [
      chartReparaciones,
      chartSolicitudes,
      chartEntregas,
      chartEquipo,
      chartEquiposDependencia,
      chartMarcasEquipos,
      chartEntregasGeneral,
      chartBuscarDatosEquiposPorEstado,
      chartBuscarDatosEquiposPorTipo,
    ].filter(chart => chart.data.labels.length > 0);

    if (chartsWithData.length === 0) {
      Swal.fire({
        icon: 'info',
        title: 'No hay registros',
        text: 'No existen registros para el rango de fechas seleccionado.',
      });
    } else {
      Toast.fire({
        title: "Estadísticas actualizadas",
        icon: "success",
      });
    }
  } catch (error) {
    console.error("Error al actualizar estadísticas", error);

    Toast.fire({
      title: "Error al actualizar estadísticas",
      icon: "error",
    });
  }
});

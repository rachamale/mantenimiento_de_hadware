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




const btnActualizar = document.getElementById("btnActualizar");



const context = canvas.getContext("2d");
const contextEquiposDependencia = canvasEquiposDependencia.getContext("2d");
const contextReparaciones = canvasReparaciones.getContext("2d");
const contextSolicitudes = canvasSolicitudes.getContext("2d");
const contextEntregas = canvasEntregas.getContext("2d");
const contextMarcasEquipos = canvasMarcasEquipos.getContext("2d");
const contextEntregasGeneral = canvasEntregasGeneral.getContext("2d");


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
    indexAxis: "y",
  },
});

const chartReparaciones = new Chart(contextReparaciones, {
  type: "bar",
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
    indexAxis: "y",
  },
});

const chartSolicitudes = new Chart(contextSolicitudes, {
  type: "bar",
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
        label: "Cantidad de Entregas por Usuario",
        data: [],
        backgroundColor: [],
      },
    ],
  },
  options: {
    indexAxis: "y",
  },
});

const chartMarcasEquipos = new Chart(contextMarcasEquipos, {
  type: "bar",
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
  type: "bar",
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




const getRandomColor = () => {
  const r = Math.floor(Math.random() * 256);
  const g = Math.floor(Math.random() * 256);
  const b = Math.floor(Math.random() * 256);

  const rgbColor = `rgba(${r},${g},${b},0.5)`;
  return rgbColor;
};

const getEstadisticas = async () => {
  const url = "/mantenimiento_de_hardware/API/estadisticas/getEstadisticas";
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
  const url = "/mantenimiento_de_hardware/API/estadisticas/buscarDatosEquiposDependencia";
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
        chartEquiposDependencia.data.labels.push(registro.equipo_dependencia);
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
  const url = "/mantenimiento_de_hardware/API/estadisticas/buscarDatosReparaciones";
  const config = {
    method: "GET",
  };

  const request = await fetch(url, config);
  const response = await request.json();

  try {
    chartReparaciones.data.labels = [];
    chartReparaciones.data.datasets[0].data = [];
    chartReparaciones.data.datasets[0].backgroundColor = [];

    if (response) {
      response.forEach((registro) => {
        chartReparaciones.data.labels.push(registro.rep_tecnico_catalogo);
        chartReparaciones.data.datasets[0].data.push(registro.cantidad_reparaciones);
        chartReparaciones.data.datasets[0].backgroundColor.push(getRandomColor());
      });
    } else {
      Toast.fire({
        title: "No se encontraron registros de reparaciones",
        icon: "info",
      });
    }

    chartReparaciones.update();
  } catch (error) {
    console.log(error);
  }
};

const getEstadisticasSolicitudes = async () => {
  const url = "/mantenimiento_de_hardware/API/estadisticas/buscarDatosSolicitudes";
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
        chartSolicitudes.data.labels.push(registro.sol_usuario_catalogo);
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
  const url = "/mantenimiento_de_hardware/API/estadisticas/buscarDatosEntregas";
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
        chartEntregas.data.labels.push(registro.ent_usuario_catalogo);
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
  const url = "/mantenimiento_de_hardware/API/estadisticas/buscarDatosMarcasEquipos";
  const config = {
    method: "GET",
  };

  const request = await fetch(url, config);
  const response = await request.json();

  try {
    chartMarcasEquipos.data.labels = [];
    chartMarcasEquipos.data.datasets[0].data = [];
    chartMarcasEquipos.data.datasets[0].backgroundColor = [];

    if (response) {
      response.forEach((registro) => {
        chartMarcasEquipos.data.labels.push(registro.marca_equipo_codigo);
        chartMarcasEquipos.data.datasets[0].data.push(registro.cantidad);
        chartMarcasEquipos.data.datasets[0].backgroundColor.push(getRandomColor());
      });
    } else {
      Toast.fire({
        title: "No se encontraron registros",
        icon: "info",
      });
    }

    chartMarcasEquipos.update();
  } catch (error) {
    console.log(error);
  }
};


const getEstadisticaEntregasGeneral = async () => {
  const url = "/mantenimiento_de_hardware/API/estadisticas/EstadisticaEntregasGeneral";
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

    if (data) {
      data.forEach((registro) => {
        chartEntregasGeneral.data.labels.push(registro.fecha_entrega);
        chartEntregasGeneral.data.datasets[0].data.push(registro.numero_usuario); // Cambia esto según tus datos
        chartEntregasGeneral.data.datasets[0].backgroundColor.push(getRandomColor());
      });

      chartEntregasGeneral.update();
    } else {
      Toast.fire({
        title: "No se encontraron registros",
        icon: "info",
      });
    }
  } catch (error) {
    console.log(error);
  }
};


btnActualizar.addEventListener("click", () => {
  getEstadisticasReparaciones();
  getEstadisticasSolicitudes();
  getEstadisticasEntregas();
  getEstadisticas();
  getbuscarDatosEquiposDependencia();
  getEstadisticasMarcasEquipos();
  getEstadisticaEntregasGeneral();
});




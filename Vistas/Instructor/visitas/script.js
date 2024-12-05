const diasElemento = document.getElementById("dias");
const nombreMesElemento = document.getElementById("nombre-mes");

let fechaActual = new Date();

function cargarMes(mes, año) {
    diasElemento.innerHTML = "";
    nombreMesElemento.textContent = fechaActual.toLocaleString('default', { month: 'long', year: 'numeric' });

    const primerDia = new Date(año, mes, 1).getDay();
    const ultimoDia = new Date(año, mes + 1, 0).getDate();

    for (let i = 0; i < primerDia; i++) {
        diasElemento.innerHTML += "<div class='dia'></div>";
    }

    for (let dia = 1; dia <= ultimoDia; dia++) {
        diasElemento.innerHTML += `<div class='dia' onclick="mostrarCitas(${dia})">${dia}</div>`;
    }
}

function mostrarCitas(dia) {
    const fechaSeleccionada = new Date(fechaActual.getFullYear(), fechaActual.getMonth(), dia);
    document.getElementById("citas").innerHTML = `<h3>Citas del ${dia}/${fechaActual.getMonth() + 1}/${fechaActual.getFullYear()}</h3>`;
    // Aquí puedes hacer una llamada AJAX para cargar las citas
}

// Cargar el mes actual al inicio
cargarMes(fechaActual.getMonth(), fechaActual.getFullYear());

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Tres en Raya</title>
<style>
body { font-family: Arial; text-align: center; }
.tablero {
    display: grid;
    grid-template-columns: repeat(3, 100px);
    gap: 5px;
    justify-content: center;
}
.celda {
    width: 100px;
    height: 100px;
    font-size: 40px;
    cursor: pointer;
}
</style>
</head>
<body>

<h2>Tres en Raya</h2>
<div class="tablero" id="tablero"></div>
<p id="mensaje"></p>
<button onclick="reiniciar()">Reiniciar</button>

<script>
let turno = "X";
let tablero = Array(9).fill("");

const ganar = [
    [0,1,2],[3,4,5],[6,7,8],
    [0,3,6],[1,4,7],[2,5,8],
    [0,4,8],[2,4,6]
];

const contenedor = document.getElementById("tablero");

function dibujar() {
    contenedor.innerHTML = "";
    tablero.forEach((v, i) => {
        let btn = document.createElement("button");
        btn.className = "celda";
        btn.innerText = v;
        btn.onclick = () => jugar(i);
        contenedor.appendChild(btn);
    });
}

function jugar(i) {
    if (tablero[i] !== "") return;
    tablero[i] = turno;
    if (verificar()) return;
    turno = turno === "X" ? "O" : "X";
    dibujar();
}

function verificar() {
    for (let c of ganar) {
        let [a,b,c2] = c;
        if (tablero[a] && tablero[a] === tablero[b] && tablero[a] === tablero[c2]) {
            document.getElementById("mensaje").innerText = "Ganó " + turno;
            guardar(turno);
            return true;
        }
    }
    if (!tablero.includes("")) {
        document.getElementById("mensaje").innerText = "Empate";
        guardar("Empate");
        return true;
    }
    return false;
}

function guardar(ganador) {
    fetch("guardar.php", {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: "ganador=" + ganador
    });
}

function reiniciar() {
    tablero = Array(9).fill("");
    turno = "X";
    document.getElementById("mensaje").innerText = "";
    dibujar();
}

dibujar();
</script>

</body>
</html>

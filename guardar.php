<?php
include "conexion.php";

$ganador = $_POST['ganador'];

$stmt = $conn->prepare("INSERT INTO partidas (ganador) VALUES (?)");
$stmt->bind_param("s", $ganador);
$stmt->execute();

echo "OK";

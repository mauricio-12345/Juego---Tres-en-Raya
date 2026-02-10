<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "tres_en_raya";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión");
}
?>

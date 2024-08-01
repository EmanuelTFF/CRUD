<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trabalho_sora";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
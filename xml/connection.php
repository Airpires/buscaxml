<?php
$servername = "localhost";
$username = "root";
$password = "34125580";
$dbname = "xmlnf";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Falha ao Conectar: " . $conn->connect_error);
}

?>
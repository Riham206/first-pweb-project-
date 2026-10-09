<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "fragrance";

$conn = new mysqli($host, $user, $password,$dbname);

if (!$conn) {
    die("Erreur failed: " .$conn->connect_error);
}
?>
<?php
require "mysql.php";
 // recuperation du nom a partir du formulair 
if (isset($_POST["name"])) {
    $username = $_POST["name"];
} else {
    $username = "";
}
// recuperation du password a partir du formulair
if (isset($_POST["password"])) {
    $password = $_POST["password"];
} else {
    $password = "";
}
//voir si les champs son vide ou non 
if ($username == "" || $password == "") {
    echo "Please fill in the fields.";
    exit;
}
$sql    = "SELECT * FROM user WHERE name = '$username' AND password = '$password'";
$result = $conn->query($sql);
 //redirection si le lignes >0 
if ($result->num_rows > 0) {
    header("Location: index.php?user=$username");
    exit;
} else {
    echo "Invalid credentials.";
}
$conn->close();
?>
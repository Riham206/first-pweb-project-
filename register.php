<?php
require "mysql.php";
//recuperation du nom
if (isset($_POST["name"])) {
    $Name = $_POST["name"];
} else {
    $Name = "";
}
// recuperation d'adress
if (isset($_POST["adress"])) {
    $Adress = $_POST["adress"];
} else {
    $Adress = "";
}
//recuperation de phone number
if (isset($_POST["phone"])) {
    $Phone = $_POST["phone"];
} else {
    $Phone = "";
}
//recuperation de mot de pass
if (isset($_POST["password"])) {
    $Password = $_POST["password"];
} else {
    $Password = "";
}
//recuperation du credit 
if (isset($_POST["credit"])) {
    $Credit = $_POST["credit"];
} else {
    $Credit = 0;
}
if ($Name == "") {
    echo "Name is required.";
    exit;
}
// Check if username already taken
$sql    = "SELECT * FROM user WHERE name = '$Name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Username already taken.";
    exit;
}
$sql = "INSERT INTO user (name, adress, phone, password, credit)
        VALUES ('$Name', '$Adress', '$Phone', '$Password', '$Credit')";
// voir si la requete a ete bien executer ou nonnon 
if ($conn->query($sql) === TRUE) {
    header("Location: index.php?user=$Name");
    exit;
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
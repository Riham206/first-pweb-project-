<?php
require "mysql.php";
//recuperation de id de produit 
if (isset($_POST["id_p"])) {
    $id = $_POST["id_p"];
} else {
    $id = "";
}
// recuperation de la quantite de produits 
if (isset($_POST["quantity"])) {
    $quantity = $_POST["quantity"];
} else {
    $quantity = 0;
}
//recuperation de prix de produit
if (isset($_POST["price"])) {
    $price = (float)$_POST["price"];
} else {
    $price = 0;
}
// recuperation de nom d'utilisateur 
if (isset($_POST["name"])) {
    $name = $_POST["name"];
} else {
    $name = "";
}
//check name 
if ($name == "") {
    echo "<h3 style='font-family:sans-serif;color:red;text-align:center'>You must login or register first!</h3>";
    echo "<p style='text-align:center;font-family:sans-serif'><a href='index.php'>Go back</a></p>";
    exit;
}
//check id
if ($id == "") {
    echo "Invalid product<a href='index.php?user=$name'>Go back</a>";
    exit;
}
//check quantity
if ($quantity <= 0) {
    echo "Invalid quantity<a href='index.php?user=$name'>Go back</a>";
    exit;
}
// Check stock
$sql    = "SELECT * FROM products WHERE id_p = '$id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Perfume not found <a href='index.php?user=$name'>Go back</a>";
    exit;
}
$row = $result->fetch_assoc();
$current_stock = $row["stock"];
if ($quantity > $current_stock) {
    echo "<h3 style='font-family:sans-serif;color:red;text-align:center'>Not enough stock only $current_stock bottles left</h3>";
    echo "<p style='text-align:center;font-family:sans-serif'><a href='index.php?user=$name'>Go back</a></p>";
    exit;
}
// Check credit
$sql    = "SELECT * FROM user WHERE name = '$name'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "user not found.<a href='index.php'>Go back</a>";
    exit;
}
$user_row   = $result->fetch_assoc();
$credit = $user_row["credit"];
$total_cost = $price * $quantity;
if ($credit < $total_cost) {
    echo "<h3 style='font-family:sans-serif;color:red;text-align:center'>Not enough credit </h3>";
    echo "<p style='text-align:center;font-family:sans-serif'>You have <strong>$credit</strong> but this costs <strong>$total_cost</strong> </p>";
    echo "<p style='text-align:center;font-family:sans-serif'><a href='index.php?user=$name'>Go back</a></p>";
    exit;
}
$conn->query("UPDATE products SET stock = stock - $quantity WHERE id_p = '$id'");
$conn->query("UPDATE user SET credit = credit - $total_cost WHERE name = '$name'");
$conn->close();
header("Location: index.php?user=$name");
exit;
?>
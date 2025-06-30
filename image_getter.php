<?php

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "product_db";

//Connection to db
$connect = mysqli_connect($username, $username, $password, $dbname);
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//Query to get image
$sql = "SELECT image FROM product WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    header("Content-Type: " . $row["image_type"]);
    echo $row["image"];
} else {
    echo "No image found.";
}

?>


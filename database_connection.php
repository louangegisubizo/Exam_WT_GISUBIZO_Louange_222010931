<?php 
$servername = "localhost";
$username = "gisubizo";
$password = "222010931";
$dbname = "eta";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}

 ?>
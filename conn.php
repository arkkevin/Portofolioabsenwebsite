<?php
$servername = "localhost";
$username = "u0202642_pklkoja";
$password = "Koja2023";
$dbname = "u0202642_pklkoja";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<?php
// Create connection
$conn = mysqli_connect("localhost","root","","mydb");

// Check connection
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>
<?php

$servername = "guy.durhamruski.club";
$username = "guyguy";
$password = "guyGUYguyFier1865";
$dbname = "durhamruskiclub";

  // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

?>

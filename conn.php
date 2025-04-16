<?php
$servername = "localhost";
$username = "u636906265_shal";
$password = "Zama2025?!$";

// Create connection
$conn = new mysqli($servername, $username, $password,"u636906265_shal");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
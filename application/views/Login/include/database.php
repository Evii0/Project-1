<?php
$servername = "localhost";
$username = "skillsint";
$password = "cNmXSYqhtSkXrxTyHknb";
$dbname = "nzprint_skillsint";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
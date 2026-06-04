<?php
// db_connect.php - Standard Production Database Switchboard
$server_domain = "localhost"; 
$database_user = "root";       
$database_pass = "";           
$schema_name   = "kasiconnect_db"; 

$conn = new mysqli($server_domain, $database_user, $database_pass, $schema_name);

if ($conn->connect_error) {
    die("Critical data layer failure: " . $conn->connect_error);
}
?>

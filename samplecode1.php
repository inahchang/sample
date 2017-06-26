<?php
$servername = getenv('IP');
$username = getenv('C9_USER');
$password = "";
$database = "c9";
$dbport = 3306;

// Create connection
$db = new mysqli($servername, $username, $password, $database, $dbport);
$sql = "INSERT INTO user (username, email, password, create_time, iduser, vip, manager)
";
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 
$db -> close();
?>
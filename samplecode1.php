<?php
echo 'hello!!';

$servername = getenv('IP');
$username = getenv('C9_USER');
$password = "";
$database = "c9";
$dbport = 3306;

// Create connection
$db = new mysqli($servername, $username, $password, $database, $dbport);
$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 
$db -> close();
?>
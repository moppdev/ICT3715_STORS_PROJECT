<?php 

$dsn = "mysql:host=localhost;dbname=stors";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include("../view/database_error.php");
    exit();
}

?>
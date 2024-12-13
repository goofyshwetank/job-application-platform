<?php
$host = 'localhost';
$dbname = 'job_application_db';
$username = 'root'; // Default username in XAMPP
$password = ''; // Default password is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>

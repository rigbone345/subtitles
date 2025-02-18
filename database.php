<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$host = 'localhost';  
$dbname = 'subtitles_db';  
$username = 'root';  
$password = '';  


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    
    die("Грешка при връзката с базата данни: " . $e->getMessage());
}
?>

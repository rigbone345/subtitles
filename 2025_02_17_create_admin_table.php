<?php


require_once 'database.php';

$query = "CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

try {
    $pdo->exec($query);
    echo "Таблицата admins беше успешно създадена.";
} catch (PDOException $e) {
    echo "Грешка при създаването на таблицата: " . $e->getMessage();
}
?>

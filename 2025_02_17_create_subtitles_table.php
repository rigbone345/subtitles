<?php


require_once 'database.php';

$query = "CREATE TABLE IF NOT EXISTS subtitles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

try {
    $pdo->exec($query);
    echo "Таблицата subtitles беше успешно създадена.";
} catch (PDOException $e) {
    echo "Грешка при създаването на таблицата: " . $e->getMessage();
}
?>

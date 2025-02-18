<?php


require_once 'database.php';

$username = "admin";
$password = password_hash("adminpassword", PASSWORD_DEFAULT);

$query = "INSERT INTO admins (username, password) VALUES (:username, :password)";
$stmt = $pdo->prepare($query);

try {
    $stmt->execute(['username' => $username, 'password' => $password]);
    echo "Администраторът беше успешно добавен.";
} catch (PDOException $e) {
    echo "Грешка при добавянето на администратора: " . $e->getMessage();
}
?>

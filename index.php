<?php

require_once('database.php');


try {
    $stmt = $pdo->query("SELECT * FROM subtitles");
    $subtitles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Грешка при извличането на файловете: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сайт за субтитри</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

    <header>
        <h1>Добре дошли в сайта за субтитри!</h1>
        <ul>
    <li><a href="uploads/login.php">Вход</a></li>
    <li><a href="uploads/upload.php">Качване на файл</a></li>
    <li><a href="uploads/admin.php">Админ панел</a></li>
</ul>

        <p>Това е основната страница на нашия сайт, успешна връзка с база данни.</p>
    </header>

    <section>
        <h2>За нас:</h2>
        <p>Тук можете да добавяте и гледате субтитри за различни филми и сериали.</p>
        
        <h3>Изберете категория:</h3>
        <ul>
            <li><a href="#">Филми</a></li>
            <li><a href="#">Сериали</a></li>
            <li><a href="#">Документални</a></li>
        </ul>
    </section>

    <section>
        <h2>Списък с добавени файлове</h2>

        <?php
        
        if (count($subtitles) > 0) {
            foreach ($subtitles as $subtitle) {
                echo "<p><strong>Име на файл:</strong> " . htmlspecialchars($subtitle['filename']) . "</p>";
                echo "<p><strong>Път до файл:</strong> " . htmlspecialchars($subtitle['file_path']) . "</p><br>";
            }
        } else {
            echo "<p>Няма налични файлове.</p>";
        }
        ?>
    </section>

    <footer>
        <p>&copy; 2025 Сайт за субтитри. Всички права запазени.</p>
    </footer>

</body>
</html>

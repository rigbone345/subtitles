<?php
require_once('../database.php');

try {
    $stmt = $pdo->query("SELECT * FROM subtitles");
    $subtitles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Грешка при извличането на файловете: " . $e->getMessage());
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM subtitles WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Административен панел</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            background-color: #4CAF50;
            padding: 20px;
        }
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        td a {
            color: red;
            text-decoration: none;
        }
        td a:hover {
            text-decoration: underline;
        }
        p {
            text-align: center;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
        }
    </style>
    
</head>
<body>
    <h1>Административен панел</h1>
    <h2 style="text-align:center;">Списък с качени файлове</h2>
    <table>
        <tr>
            <th>Име на файл</th>
            <th>Път до файл</th>
            <th>Дата на качване</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($subtitles as $subtitle): ?>
        <tr>
            <td><?php echo htmlspecialchars($subtitle['filename']); ?></td>
            <td><?php echo htmlspecialchars($subtitle['file_path']); ?></td>
            <td><?php echo $subtitle['uploaded_at']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $subtitle['id']; ?>">Редактирай</a> |
                <a href="admin.php?delete=<?php echo $subtitle['id']; ?>" onclick="return confirm('Сигурни ли сте, че искате да изтриете този файл?')">Изтрий</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="../index.php">Обратно към началната страница</a></p>
    <footer>&copy; 2025 Сайт за субтитри. Всички права запазени.</footer>
</body>
</html>

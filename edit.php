<?php
require_once('../database.php');

if (isset($_GET['id'])) {
    $file_id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM subtitles WHERE id = ?");
        $stmt->execute([$file_id]);
        $file = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Грешка при извличане на файла: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_filename = $_POST['filename'];
    $new_filepath = $_POST['file_path'];

    try {
        $stmt = $pdo->prepare("UPDATE subtitles SET filename = ?, file_path = ? WHERE id = ?");
        $stmt->execute([$new_filename, $new_filepath, $file_id]);
    } catch (PDOException $e) {
        die("Грешка при актуализиране на файла: " . $e->getMessage());
    }

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактиране на файл</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            font-size: 2em;
            color: #4CAF50;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        label {
            font-size: 1.1em;
            margin-bottom: 10px;
            display: block;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div>
        <h1>Редактиране на файл</h1>

        <form method="POST" action="edit.php?id=<?php echo $file['id']; ?>">
            <label for="filename">Име на файл:</label>
            <input type="text" name="filename" value="<?php echo htmlspecialchars($file['filename']); ?>" required><br><br>

            <label for="file_path">Път до файл:</label>
            <input type="text" name="file_path" value="<?php echo htmlspecialchars($file['file_path']); ?>" required><br><br>

            <button type="submit">Запази промените</button>
        </form>

        <p><a href="admin.php">Обратно към административния панел</a></p>
    </div>
</body>
</html

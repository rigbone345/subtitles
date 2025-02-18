<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Качване на файл</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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
        }

        input[type="file"] {
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Изберете файл:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <button type="submit" name="submit">Качи файл</button>
    </form>

    <?php
    if (isset($_POST["submit"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . uniqid() . "_" . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
        if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_NO_FILE) {
            echo "<div class='message error'>Моля, изберете файл за качване.</div>";
            $uploadOk = 0;
        }

        
        if ($uploadOk && isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "<div class='message success'>Файлът е изображение - " . $check["mime"] . ".</div>";
                $uploadOk = 1;
            } else {
                echo "<div class='message error'>Файлът не е изображение.</div>";
                $uploadOk = 0;
            }
        }

        
        if ($uploadOk && file_exists($target_file)) {
            echo "<div class='message error'>Съжаляваме, файлът вече съществува.</div>";
            $uploadOk = 0;
        }

        
        if ($uploadOk && $_FILES["fileToUpload"]["size"] > 500000) {
            echo "<div class='message error'>Съжаляваме, файлът е твърде голям.</div>";
            $uploadOk = 0;
        }

        
        if ($uploadOk && !in_array($imageFileType, array("jpg", "jpeg", "png", "gif"))) {
            echo "<div class='message error'>Съжаляваме, само JPG, JPEG, PNG и GIF файлове са разрешени.</div>";
            $uploadOk = 0;
        }

        
        if ($uploadOk == 0) {
            echo "<div class='message error'>Вашият файл не беше качен.</div>";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "<div class='message success'>Файлът ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " беше качен успешно.</div>";
            } else {
                echo "<div class='message error'>Съжаляваме, възникна грешка при качването на файла.</div>";
            }
        }
    }
    ?>
</body>
</html>

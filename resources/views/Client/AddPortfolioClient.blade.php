<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма добавления проекта</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1>Добавить проект</h1>
    <form id="projectForm" enctype="multipart/form-data" method="post" action="{{route('PostNewPortfolio')}}">
        @csrf
        <div class="form-group">
            <label for="projectName">Название проекта:</label>
            <input type="text" id="projectName" name="projectName" required>
        </div>

        <div class="form-group">
            <label for="projectDescription">Описание проекта:</label>
            <textarea id="projectDescription" name="projectDescription" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="projectPhotos">Фотографии проекта:</label>
            <input type="file" id="projectPhotos" name="projectPhotos" multiple accept="image/*">
        </div>

        <div class="form-group">
            <button type="submit">Отправить проект</button>
        </div>
    </form>
</div>
</body>
</html>

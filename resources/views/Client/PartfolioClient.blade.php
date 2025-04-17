<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Портфолио</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .portfolio-item {
            margin-bottom: 30px;
            max-width: 300px; /* Ограничение максимальной ширины карточки */
            overflow: hidden; /* Скрытие переполнения */
            border: 1px solid #ddd; /* Добавление рамки для карточки */
            border-radius: 5px; /* Закругление углов */
        }
        .portfolio-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .add-portfolio-btn {
            margin: 20px 0;
        }
        .card-img-top {
            max-height: 200px; /* Ограничение максимальной высоты изображения */
            object-fit: cover; /* Обеспечение правильного отображения изображения */
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mt-5">Мое Портфолио</h1>

    <a href="{{route('NewPortfolio')}}" class="btn btn-primary add-portfolio-btn">Добавить портфолио</a>
    <div class="row">
        @foreach($date as $element)
            <div class="col-md-4 portfolio-item">
                <div class="card">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Проект 1">
                    <div class="card-body">
                        <h5 class="portfolio-title">{{$element->title}}</h5>
                        <p class="card-text">{{$element->description}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование Профиля</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        input[type="file"] {
            margin-bottom: 15px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Редактирование Профиля</h2>



    <form method="post" action="{{route('ProfileEditingClient')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" id="photo" name="imag" accept="image/*">

        <label for="firstName">Имя:</label>
        <input type="text" id="firstName" name="firstName" value="{{Auth::guard('clients')->user()->firstName ?: Request::old('firstName') }}">

        <label for="lastName">Фамилия:</label>
        <input type="text" id="lastName" name="lastName" value="{{Auth::guard('clients')->user()->lastName ?: Request::old('lastName') }}">

        <label for="description">Описание:</label>
        <textarea id="description" name="text" rows="4" cols="50" placeholder="Введите описание">{{ Auth::guard('clients')->user()->text ?: Request::old('text') }}</textarea>

        <label for="education">Образование:</label>
        <input type="text" id="education" name="textEducation" value="{{Auth::guard('clients')->user()->textEducation ?: Request::old('textEducation') }}" placeholder="Введите ваше образование">

        <label for="phone">Телефон:</label>
        <input type="text" id="phone" name="phone" value="{{Auth::guard('clients')->user()->phone ?: Request::old('phone') }}" placeholder="Введите номер телефона (+7 (999) 999-99-99)">

        <label for="telegram">Telegram:</label>
        <input type="text" id="telegram" name="telegram" value="{{Auth::guard('clients')->user()->telegram ?: Request::old('telegram') }}" placeholder="Ваш ник в Telegram(без @ )">

        <label for="vk">ВКонтакте:</label>
        <input type="text" id="vk" name="vk" value="{{Auth::guard('clients')->user()->vk ?: Request::old('vk') }}" placeholder="Ваш VK ID">

        <button type="submit">Сохранить изменения</button>
    </form>
</div>
@if ($errors->any())
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
        <div class="toast show align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

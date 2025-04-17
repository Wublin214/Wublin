<?php
//страница входа для мастера





ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//require ("../../core/connect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход фрилансера</title>
    <link rel="stylesheet" href="{{ asset('/css/LoginMaster.css') }}" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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
    <div class="login-page">
        <div class="form">
         <form class="login-form" action="{{route("LoginMaster")}}" method="POST">
             @csrf

            <label for="first">Вход:</label>
            <input type="text" placeholder="Email" id="first" name="email"  required/>
            <input type="password" placeholder="пароль" name="password" required minlength="6" title="Пароль должен содержать минимум 6 символов." />
            <button type="submit">Войти</button>
            <p class="message">Не зарегистрирован? <a href="{{route("RegisterMaster")}}">Создай аккаунт</a></p>
        </form>
        </div>
      </div>
      <script>

      </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

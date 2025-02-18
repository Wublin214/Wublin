<?php
//страница входа для фрилансера








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
    <link rel="stylesheet" href="{{ asset('/css/LoginClient.css') }}" media="screen">
</head>
<body>
    <div class="login-page">
        <div class="form">
         <form class="login-form" action="{{route("LoginClient")}}" method="POST">
             @csrf
            <label for="first">Вход:</label>
            <input type="text" placeholder="Email" id="first" name="email"  />
            <input type="password" placeholder="пароль" name="password" required minlength="6" title="Пароль должен содержать минимум 6 символов." />
            <button type="submit">Войти</button>
            <p class="message">Не зарегистрирован? <a href="{{route("RegisterClient")}}">Создай аккаунт</a></p>
        </form>
        </div>
      </div>
      <script>

      </script>

</body>
</html>

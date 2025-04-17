<?php
//страница регистрации для мастера





ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//require ("../../core/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport"  content="width=device-width, initial-scale=1.0">
        <link rel="icon" url="{{ asset('images/favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('/css/RegisterMaster.css') }}" media="screen">
        <title>регистрация фрилансера</title>
        <style>

        </style>
    </head>

    <body>
        <div class="main">
            <h2>Регистрация</h2>
            <form action="{{route('RegisterMaster')}}" method="POST">
                @csrf
    <label for="first">Имя:</label>
    <input type="text" id="first" name="MasterFirstName" pattern="[A-Za-z]{3,60}" title="Имя должно содержать от 3 до 60 латинских букв" required />

    <label for="last">Фамилия:</label>
    <input type="text" id="last" name="MasterLastName" pattern="[A-Za-z]{3,60}" title="Фамилия должна содержать от 3 до 60 латинских букв" required />

    <label for="email">Email:</label>
    <input type="email" id="ClientEmail" name="MasterEmail" required />

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="MasterPassword" pattern="^(?=.*\d)(?=.*[a-zA-Z])\S{8,}$" title="Пароль должен содержать по крайней мере одну цифру, латиницу и быть длиной не менее 8 символов" required />

    <label for="repassword">Повторите пароль:</label>
    <input type="password" id="repassword" name="MasterRepassword" required />

    <label for="gender">Пол:</label>
    <select id="gender" name="MasterGender" required>
        <option value="male">Мужчина</option>
        <option value="female">Женщина</option>
    </select>

    <button type="submit">Регистрация</button>
</form>
        </div>


    </body>
</html>

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
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

if (isset($_POST["ClientFirstName"]) && isset($_POST["ClientLastName"]) && isset($_POST["ClientEmail"]) && isset($_POST["ClientPassword"]) && isset($_POST["ClientGender"])) {

    if ($_POST["ClientPassword"] !== $_POST["Clientrepassword"]) {
        die("Пароли не совпадают");
    }

    $ClientFirstName = mysqli_real_escape_string($conn, $_POST["ClientFirstName"]);
    $ClientLastName = mysqli_real_escape_string($conn, $_POST["ClientLastName"]);
    $ClientEmail = mysqli_real_escape_string($conn, $_POST["ClientEmail"]);
    $ClientPassword = mysqli_real_escape_string($conn, $_POST["ClientPassword"]);
    $ClientGender = mysqli_real_escape_string($conn, $_POST["ClientGender"]);

    // Проверка существования пользователя
    $check = $conn->prepare("SELECT * FROM client WHERE ClientEmail = ?");
    $check->bind_param("s", $ClientEmail);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Пользователь найден
        echo '<script>alert("Пользователь с таким email уже существует")</script>';
    } else {
        // Пользователь не найден, выполняем регистрацию
        $stmt = $conn->prepare("INSERT INTO client (ClientFirstName, ClientLastName, ClientEmail, ClientPassword, ClientGender) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $ClientFirstName, $ClientLastName, $ClientEmail, $ClientPassword, $ClientGender);

        if ($stmt->execute()) {
            // Сохранение данных в сессии
            $_SESSION['id'] = $conn->insert_id;


            echo '<script>alert("Данные успешно добавлены")</script>';
            header('Location: ../../main/mainClient.php');
            exit();
        } else {
            error_log("Ошибка базы данных: " . $stmt->error);
            echo '<script>alert("Ошибка регистрации")</script>';
        }

        $stmt->close();
    }

    $check->close();
    mysqli_close($conn);
}
?>

    </body>
</html>

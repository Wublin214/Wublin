<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WublinWork - Заявки</title>
    <style>
        /* Обновленные стили */
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #4caf50;
            --accent-color: #8bc34a;
            --dark-color: #1b5e20;
            --light-color: #f1f8e9;
            --text-color: #333;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: var(--light-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Улучшенная шапка */
        header {
            background-color: var(--white);
            padding: 15px 30px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-weight: 700;
            color: var(--dark-color);
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 30px;
            height: 30px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 25px;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 20px;
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--primary-color);
            background-color: rgba(46, 125, 50, 0.1);
        }

        .nav-link.active {
            color: var(--white);
            background-color: var(--primary-color);
            box-shadow: var(--shadow);
        }

        /* Улучшенный разделитель */
        .divider {
            height: 8px;
            background: linear-gradient(90deg, var(--dark-color), var(--primary-color), var(--accent-color));
            width: 100%;
            margin-bottom: 20px;
        }

        /* Стильный контент */
        main {
            flex: 1;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .content-block {
            background-color: var(--white);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
            border-left: 5px solid var(--primary-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .content-block:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .OrderName h1 {
            color: var(--dark-color);
            margin-bottom: 15px;
            font-size: 1.8rem;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 10px;
        }

        .FreelanserInfo {
            margin: 20px 0;
        }

        .FName {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .Fdescription {
            background-color: var(--light-color);
            padding: 15px;
            border-radius: 8px;
            border-left: 3px solid var(--secondary-color);
        }

        /* Стильные кнопки */
        .button {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .accept, .reject {
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            text-align: center;
            flex: 1;
            box-shadow: var(--shadow);
        }

        .accept {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .accept:hover {
            background-color: var(--dark-color);
            transform: translateY(-2px);
        }

        .reject {
            background-color: #f44336;
            color: var(--white);
        }

        .reject:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        /* Сообщение об отсутствии данных */
        .no-data {
            text-align: center;
            padding: 40px;
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .no-data h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        /* Улучшенный футер */
        footer {
            background: linear-gradient(to right, var(--dark-color), var(--primary-color));
            color: var(--white);
            text-align: center;
            padding: 25px;
            margin-top: 50px;
        }

        footer p {
            font-size: 1rem;
            letter-spacing: 1px;
        }

        /* Адаптация для мобильных */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                width: 100%;
                justify-content: space-around;
                gap: 10px;
            }

            .nav-link {
                padding: 8px;
                font-size: 0.9rem;
            }

            .content-block {
                padding: 20px;
            }

            .button {
                flex-direction: column;
                gap: 10px;
            }

            .accept, .reject {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<!-- Шапка с навигацией -->
<header>
    <div class="header-container">
        <a href="{{route('MainMaster')}}" class="logo">
            <div class="logo-icon">W</div>
            <span>WublinWork</span>
        </a>
        <nav class="nav-links">
            <a href="{{route('MainMaster')}}" class="nav-link active">Главная</a>
            <a href="{{route('MasterProfile')}}" class="nav-link">Назад</a>
        </nav>
    </div>
</header>

<!-- Цветовой разделитель -->
<div class="divider"></div>

<!-- Основной контент -->
<main>
    @if(isset($date) && count($date) > 0)
        @foreach($date as $Application)
            <div class="content-block">
                <div class="OrderName">
                    <h1>{{$Application->ProjectTitle}}</h1>
                </div>
                <div class="FreelanserInfo">
                    <div class="FName">
                        {{$Application->firstName }} {{$Application->lastName}}
                    </div>
                    <div class="Fdescription">
                        {{$Application->text }}
                    </div>
                </div>
                <div class="button">
                    <form action="{{route('AcceptApplication')}}" method="post">
                        @csrf
                        <input type="hidden" name="IdOrderAccept" value="{{$Application->IdOrder}}">
                        <input class="accept" type="submit" value="Принять" />
                    </form>
                    <form action="{{route('RejectApplication')}}" method="post">
                        @csrf
                        <input type="hidden" name="IdApplication" value="{{$Application->IdApplication}}">
                        <input class="reject" type="submit" value="Отклонить" />
                    </form>

                </div>
            </div>
        @endforeach
    @else
        <div class="content-block no-data">
            <h2>Нет данных для отображения</h2>
            <p>В базе данных пока нет записей.</p>
        </div>
    @endif
</main>

<!-- Футер -->
<footer>
    <p>© {{ date('Y') }} WublinWork. Все права защищены.</p>
</footer>
</body>
</html>

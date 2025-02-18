<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Регистрация и вход </title>
</head>
<body>
<nav>



    <div class="container text-center" style="padding-top: 100px ;">

        <div class="row">
            <div class="col" style=""><img src="{{asset('images/Desktop_240603_1728.png')}}"  alt="Логотип" style="height: 270px;width: 290px;"></div>

            <div class="conteiner text-center" style="margin-top: 260px;margin-right: 250px;margin-left: 0; background-color: rgb(232, 228, 228);text-align: center; ">
                <p style="font-size: 50px;">Регистрация и вход </p>
                <div class="container text-center">
                    <div class="row">
                        <div class="col-sm" style="max-width: 650px;word-wrap: break-word;">
                            <p style="font-size: 25px;text-align: center;">Вход для фрилансера</p>
                            <p>вы получаете возможность брать любые заказы, которые соответствуют вашим навыкам и интересам. Мы предоставляем широкий выбор проектов, от краткосрочных задач до долгосрочных проектов, так что вы сможете найти что-то подходящее именно для вас. Регистрируйтесь и начинайте зарабатывать, делая то, что вам нравится!</p>
                            <div>
                                <div class="col" style="margin-top: 35px;"><a href="{{route('LoginClient')}}" type="button" class="btn btn-dark">Перейти</a></div>
                            </div>
                        </div>

                        <div class="col-sm" style="max-width: 650px;word-wrap: break-word;">
                            <p style="font-size: 25px;text-align: center;">Вход для мастера</p>
                            <p>вы получаете возможность оставить свои заказы, чтобы другие пользователи могли выполнить их за вас. Выложите свой заказ и найдите опытных специалистов, готовых помочь вам в реализации ваших проектов. Регистрируйтесь и начинайте делегировать задачи!</p>
                            <div>
                                <div class="col" style="margin-top: 60px;"><a href="{{route('LoginMaster')}}" type="button" class="btn btn-dark">Перейти</a></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
</body>
</html>

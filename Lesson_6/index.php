<?php
session_start();
?>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Авторизация пользователя</title>
    <style>
        body {
            width: 1200px;
            margin: auto;
            border: 1px solid #ccc;
            text-align: center;
        }
        input {
            min-width: 300px;
            min-height: 25px;
            display: block;
            margin: 10px auto;
        }
        a, h1, h2 {
            margin: auto 10px;
            text-align: center;
            display: ;
        }
    </style>
</head>

<body>
<h1>Необходима авторизация</h1>
<h2>Введите имя пользователя и пароль</h2>
<form action="authorise.php" method="POST">
    <input type="text" name="login" placeholder="USERNAME">
    <input type="password" name="password" placeholder="PASSWORD">
    <input type="submit" value="ОТПРАВИТЬ">
</form>
<a href="">Зарегистрироваться</a>
</body>

</html>
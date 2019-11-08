<?php
session_start();
ob_start();
if (!isset($_POST['login'])) {//Если не задано имя, то 403
    http_response_code(403);
    exit('Не задано имя пользователя');
}
if ($_POST['login'] == '') {//Если не задано имя, то 403
    http_response_code(403);
    exit('Не задано имя пользователя');
}
if (!isset($_POST['password'])) {//Если задано имя, но не задан пароль, то ты гость
    echo 'Вы вошли как Гость';
    $_SESSION['user'] = 'GUEST';
    header('Location: L5list.php');//отправляем на страницу загрузки тестов
    exit();
}
if ($_POST['password'] == '') {
    echo 'Вы вошли как Гость';
    $_SESSION['user'] = 'GUEST';
    header('Location: L5list.php');//отправляем на страницу загрузки тестов
    exit();
}
//var_dump($_POST['login']);
//echo '<br />';
//var_dump($_POST['password']);
//echo '<br />';

if (isset($_POST['login'])) {//Если задан логин
    if (isset($_POST['password'])) {//Если задан пароль
        if (is_file('users.json')) {
            $json = file_get_contents("users.json");
            $base = json_decode($json, true);
            //var_dump($base);
            for ($i = 0; $i < count($base); $i++) {//Прогоняем users.json на проверку
                if ($base[$i][0] == $_POST['login']) {//Если есть совпадение логина, то
                    if ($base[$i][1] == $_POST['password']) {// проверяем пароль и если есть совпадение пароля, то
                        $_SESSION['user'] = $base[$i][2];// присваиваем статус пользователя
                        echo '<br /> Добро пожаловать, ' . $_SESSION['user'] . '<br />';
                        header('Location: L5admin.php');//Отправляем на страницу загрузки тестов
                        exit();
                    }
                }
            }
        }
        echo '<a href="mainBoard.php">Назад на страницу авторизации</a>';
        exit('Имя пользователя, или пароль заданы неверно');
    }
}

<?php
//session_start();
require_once 'functions.php';
ob_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//var_dump($_SESSION['user']);
if (!isAuthorized()) {
    showError403();
}
if (isAdmin()) {
    echo '<br />Вы вошли как АДМИНИСТРАТОР<br />';
} elseif (isGuest()) {
    echo '<br />Вы вошли как ГОСТЬ<br />';
} else {
    showError403();
}
/*
if ($_SESSION['user'] == 'GUEST') {
    echo '<br />Добро пожаловать ' . $_SESSION['user'] . '<br />';
} elseif ($_SESSION['user'] == 'ADMINISTRATOR') {
    echo '<br />Добро пожаловать ' . $_SESSION['user'] . '<br />';
}*/

//session_start();

/*
if (isset($_SESSION['user'])) {
    if ($_SESSION['user'] == 'GUEST') {
        echo '<br />Добро пожаловать ' . $_SESSION['user'] . '<br />';
    } elseif ($_SESSION['user'] == 'ADMINISTRATOR') {
        echo '<br />Добро пожаловать ' . $_SESSION['user'] . '<br />';
    } else {
        http_response_code(403);
        exit('<h1>403 Forbidden</h1><p>Перейти к <a href="mainBoard.php">форме авторизации</a></p>');
    }
} else {
    http_response_code(403);
    exit('<h1>403 Forbidden</h1><p>Перейти к <a href="mainBoard.php">форме авторизации</a></p>');
}*/
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 5. Админка.<</title>

</head>
<body>

<form action="L5admin.php" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
    Отправить этот файл: <input name="<?php echo $name = "uploadedTest" ?>" type="file"/>
    <?php
    if (!isAdmin()) {
        echo '<br /> Чтобы иметь возможность загружать тесты, войдите как ADMINISTRATOR <br />';
    }
    if (isAdmin()) {
        echo '<input type="submit" value="Отправить файл"/>';
    }
    ?>
</form>
<form action="logout.php" method="POST">
    <input type="submit" value="Выход"/>
</form>
<br/>
<a href="L5list.php">Перейти к списку тестов</a>
<br>
<br>
</body>
</html>
<?php

if (is_dir('tests') == FALSE) {
    mkdir('tests');
    echo 'Каталог /tests создан <br />';
} else {
    echo 'Каталог /tests существует <br />';
}
//var_dump(is_dir('tests'));
//var_dump($_FILES[$name]);
if (!empty($_FILES) && array_key_exists('uploadedTest', $_FILES)) {
    if ($_FILES[$name]['type'] === 'application/json') {
        $counter = scandir('tests', 1);
        $count = count($counter) - 1;
        while (file_exists('tests/' . $count . '.json')) {
            $count++;
        }
        $directoryTest = "tests/" . $count . '.json';
        move_uploaded_file($_FILES[$name]["tmp_name"], $directoryTest);
        echo 'Загрузка успешна';
        header('Location: L5list.php');
        exit;
    } else {
        echo 'Неверный формат файла';
    }
}
?>

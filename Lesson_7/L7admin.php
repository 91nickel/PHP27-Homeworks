<?php
session_start();
var_dump($_SESSION['roles']);
if ($_SESSION['roles'] == 'admin') {
    echo 'Вы вошли как администратор' . '<br />';
} elseif ($_SESSION['roles'] == 'guest') {
    echo 'Вы вошли как гость' . '<br />';
} else {
    echo 'http_response_code(403)';
    exit;
};
$i = $_SESSION['roles'];
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 7. Админка.<</title>
</head>
<body>
<?php
if ($_SESSION['roles'] == 'admin') {
    echo '<br>';
    echo '<form action="check.php" enctype="multipart/form-data" method="POST">';
    //<!--Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла-->
    echo '<input type="hidden" name="MAX_FILE_SIZE" value="30000"/>';
    //<!--Название элемента input определяет имя в массиве $_FILES-- >
    echo 'Отправить этот файл: <input name="uploadedTest" type="file"/>';
    echo '<input type="submit" value="Отправить файл"/>';
    echo '</form >';
} else {
    echo 'Войдите как администратор, чтобы иметь возможность загружать тесты';
} ?>
<br/>
<a href="L7list.php"> Перейти к списку тестов </a>
<br>
<br>
</body>
</html>
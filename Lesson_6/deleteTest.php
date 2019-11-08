<?php
ob_start();
session_start();
//var_dump($_POST['delete']);
//var_dump($_SESSION['user']);

if ($_SESSION['user'] !== 'ADMINISTRATOR') {
    if ($_SESSION['user'] !== 'GUEST') {
        http_response_code(403);
        exit('ПОЛЬЗОВАТЕЛЬ НЕ АВТОРИЗОВАН');
    }
}
if (is_dir('tests') == FALSE) {
    echo '<a href="L5admin.php">Вернуться назад</a>';
    exit('Отсутствует каталог с тестами');
}
$filePath = 'tests/' . $_POST['delete'];
var_dump($filePath);
if (is_dir('tests') == TRUE) {
    if (is_file($filePath)) {
        unlink($filePath);
        header('Location: L5admin.php');
        exit('Файл удалён успешно');
    }
}
?>
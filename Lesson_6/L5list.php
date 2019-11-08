<?php
//session_start();
require_once 'functions.php';
ob_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (!isAuthorized()) {
    showError403();
}
if (isAdmin()) {
    echo '<br />Добро пожаловать ' . $_SESSION['user'] . '<br />';
} elseif (isGuest()) {
    echo '<br />Добро пожаловать ' . $_SESSION['user'] . '<br />';
} else {
    showError403();
}

if (is_dir('tests') == FALSE) {
    echo '<a href="L5admin.php">Вернуться назад</a>';
    exit('Отсутствует каталог с тестами');
}
//var_dump($files2);
echo 'ВЫБЕРИТЕ ДОСТУПНЫЙ ТЕСТ' . "<br />";
$dir = 'tests';
$files1 = scandir($dir);
$files2 = scandir($dir, 1);
$i = 0;
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список загруженных тестов. Задание 5.</title>
</head>
<body>
<?php foreach ($files2 as $item) : ?>
    <?php $i++;
    if ($i > count($files2) - 2) {
        break;
    } ?>
    <a style="display: block; margin-top: 20px;"
       href="<?php echo 'L5test.php?y=' . $i; ?>"><?php echo 'Тест №' . $i; ?></a><br>
    <?php if (isAdmin()) {
        echo '<p style="display: inline;">Удалить</p><form style="display: inline; margin: 5px;" action="deleteTest.php" method="post"><input type="submit" name="delete" value="' . $i . '.json"></form>';
    } ?>
<?php endforeach; ?>
<br>
<a href="L5admin.php">Загрузить еще один тест</a>
<form action="logout.php" method="POST">
    <input type="submit" value="Выход"/>
</form>
</body>
</html>
<?php
ob_start();
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 5. Админка.<</title>

</head>
<body>

<form action="L5admin.php" enctype="multipart/form-data" method="POST">
    <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
    <!-- Название элемента input определяет имя в массиве $_FILES -->
    Отправить этот файл: <input name="<?php echo $name = "uploadedTest" ?>" type="file"/>
    <input type="submit" value="Отправить файл"/>
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

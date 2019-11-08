<?php
header("Location: L7list.php");
if (!empty($_FILES) && array_key_exists('uploadedTest', $_FILES)) {
    $counter = scandir('tests', 1);
    //var_dump($counter);
    $count = count($counter) - 2 + 1;
    //$filename = "$count".'.json '."\n";
    //var_dump($filename);
    move_uploaded_file($_FILES['uploadedTest']['tmp_name'], 'tests/' . "$count" . '.json');
    echo "Тест успешно загружен в файл $count.json ";
}
?>
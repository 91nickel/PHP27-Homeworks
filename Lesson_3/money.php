<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (!empty($argv[1]) && $argv[1] == '-today') {
    if (is_file('money.csv') == TRUE) {
        echo 'Сумма трат за сегодня = ';
        $sum = 0;
        $money = fopen("money.csv", "r");
        while (($data1 = fgetcsv($money, 1000, ",")) !== FALSE) {
            $sum = $sum + $data1[1];
        };
        fclose($money);
        echo $sum;
        die();
    } else {
        echo 'Нет трат сегодня';
    }
}
if (count($argv) < 3) {
    die('Ошибка! Недостаточно аргументов!');
}
$product = '';
for ($i = 2; $i <= count($argv) - 1; $i++) {
    $product = trim($product . " $argv[$i]");
}
if ($product == "") {
    die('Ошибка! Не задано наименование продукта!');
}
$today = date("d.m.y");
$price = $argv[1];
if ((int)$price == 0) {
    die('Ошибка! Цена указана в неверном формате!');
}
$content = [$today, $price, $product];
file_put_contents("./money.csv", implode(",", $content) . "\n", FILE_APPEND);
echo 'Добавлена строка ' . implode(",", $content);
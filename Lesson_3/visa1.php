<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if (!empty($argv[1])) {
    $text2 = 'Указанное значение не найдено';
    $table = fopen('https://raw.githubusercontent.com/netology-code/php-2-homeworks/master/files/countries/opendata.csv', "r");
    while (($data = fgetcsv($table, 1000, ",")) !== FALSE) {
        if ($argv[1] == $data[1]) {
            $text2 = $data[3];
        } elseif ($argv[1] == "list") {
            echo "$data[1] \n";
        };
    };
    fclose($table);
    if ($argv[1] <> "list") {
        echo "$argv[1] : $text2";
    }
} else {
    exit('Задайте аргумент');
}
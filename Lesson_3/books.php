<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$bookName = NULL;
$i = 0;
if (!empty($argv[1])) {
    if (count($argv) > 2) {
        foreach ($argv as $arg) {
            $i++;
            if ($i == 1) {
                continue;
            }
            if ($bookName == NULL) {
                $bookName = $arg;
            } else {
                $bookName = $bookName . '%20' . $arg;
            }
        }
    } else {
        $bookName = $argv[1];
    }
    $searchRequest = 'https://www.googleapis.com/books/v1/volumes?q={' . $bookName . '}';
    $bookArray = file_get_contents($searchRequest);
    //echo $bookArray;
} else {
    exit('Не заданы аргументы');
}

$base = json_decode($bookArray, TRUE);
//var_dump(count(($base)['items']));

foreach ($base as $string) {
    echo 'Декодируем: ' . $string;
    json_decode($string);

    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - Ошибок нет';
            break;
        case JSON_ERROR_DEPTH:
            echo ' - Достигнута максимальная глубина стека';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Некорректные разряды или несоответствие режимов';
            break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Некорректный управляющий символ';
            break;
        case JSON_ERROR_SYNTAX:
            echo ' - Синтаксическая ошибка, некорректный JSON';
            break;
        case JSON_ERROR_UTF8:
            echo ' - Некорректные символы UTF-8, возможно неверно закодирован';
            break;
        default:
            echo ' - Неизвестная ошибка';
            break;
    }

    echo PHP_EOL;
}

if (!function_exists('json_last_error_msg')) {
    function json_last_error_msg()
    {
        static $ERRORS = array(
            JSON_ERROR_NONE => 'No error',
            JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
            JSON_ERROR_SYNTAX => 'Syntax error',
            JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded'
        );

        $error = json_last_error();
        return isset($ERRORS[$error]) ? $ERRORS[$error] : 'Unknown error';
    }
}
for ($i = 0; $i < count(($base)['items']); $i++) {
    $var1 = $base['items'][$i]['id'];
    $var2 = $base['items'][$i]['volumeInfo']['title'];
    if (!isset($base['items'][$i]['volumeInfo']['authors'])){
        continue;
    }
    if (is_array($base['items'][$i]['volumeInfo']['authors'])) {
        $var3 = implode($base['items'][$i]['volumeInfo']['authors']);
    } else {
        $var3 = $base['items'][$i]['volumeInfo']['authors'];
    }
    $csvString = $var1 . ',' . $var2 . ',' . $var3;
    echo $csvString . "\n";
    file_put_contents("./books.csv", $csvString . "\n", FILE_APPEND);
    echo 'Добавлена строка ' . $csvString;
}
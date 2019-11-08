<?php
session_start();
ob_start();
if (!isset($_POST['login'])) {
    http_response_code(403);
    exit('Не задано имя пользователя');
}
if (!isset($_POST['password'])) {
    http_response_code(403);
    exit('Не задан пароль');
}
var_dump($_POST['login']);
echo '<br />';
var_dump($_POST['password']);
echo '<br />';

$pdo = new pdo("mysql:host=localhost;dbname=nkuznetsov", "nkuznetsov", "neto1907");

$sql = 'SELECT * FROM user';
// WHERE name LIKE "' . $_POST['login'] . '" AND password LIKE "' . $_POST['password'].'"
//echo '<br />' . $sql . '<br />';
$counter = 0;

//echo 'Переменная запроса <br />';
//print_r($req);
//echo '<br />';

foreach ($pdo->query($sql) as $loginRow) {
    if ($login_row['login'] = $_POST['login']) {
        if ($login_row['password'] = $_POST['password']) {
            $counter++;
            $_SESSION['userId'] = $loginRow['id'];
        }
    }
    //var_dump($loginRow);
    //echo '<br />';
}
//var_dump($counter);
if ($counter == 1) {
    $new_url = 'todo.php';
    var_dump($_SESSION['userId']);
    header('Location: ' . $new_url);
    ob_end_flush();
    echo 'Вы авторизованы';
} else {
    http_response_code(403);
    exit('Имя пользователя, или пароль заданы неверно');
}
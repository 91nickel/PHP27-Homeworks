<?php
session_start();
if (!isset($_SERVER['PHP_AUTH_USER']) == 1) {
    header('WWW-Authenticate: Basic realm="My realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Введите имя пользователя';
};
if ($_SERVER['PHP_AUTH_USER'] == '') {
    header('WWW-Authenticate: Basic realm="My realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Введите имя пользователя';
}
$users = file_get_contents("login.json");
$users = json_decode($users, true);

//var_dump($users);
//var_dump($_SERVER['PHP_AUTH_USER']);
//var_dump($_SERVER['PHP_AUTH_PW']);
//print_r(count($_SERVER['PHP_AUTH_USER']));
//print_r(count($_SERVER['PHP_AUTH_PW']));

if ($_SERVER['PHP_AUTH_PW'] == '') {
    header("Location: L7admin.php");
    $_SESSION['roles'] = 'guest';
    echo 'Вы вошли как гость' . '<br />';
    echo $_SESSION['roles'];


} elseif ($_SERVER['PHP_AUTH_PW'] == $users[$_SERVER['PHP_AUTH_USER']]['password']) {
    header("Location: L7admin.php");
    $_SESSION['user'] = $_SERVER['PHP_AUTH_USER'];
    $_SESSION['password'] = $users[$_SERVER['PHP_AUTH_USER']]['password'];
    $_SESSION['roles'] = $users[$_SERVER['PHP_AUTH_USER']]['roles'];
    echo '<br />' . 'Добро пожаловать, ' . $_SERVER['PHP_AUTH_USER'] . '<br />';
    echo '<br />' . 'Ваш уровень доступа - ' . $_SESSION['roles'] . '<br />';
    echo '<br />' . 'Ваш пароль - ' . $_SESSION['password'] . '<br />';

} else {

    exit('Неверное имя пользователя, или пароль');

};
?>

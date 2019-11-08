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

if (isset($_GET['y'])) {
    $y = $_GET['y'];
} else {
    exit('Задайте номер теста через параметр "$y=[номер теста]"');
}
$dir = scandir('tests');
//var_dump($dir);
$testName = $dir[($y + 1)];
//var_dump($testName);
if (is_file("tests/$testName")){
    $json = file_get_contents("tests/$testName");
    $base = json_decode($json, true);
} else {
    exit('<p>Указанный файл не найден. Перейти к <a href="L5list.php">списку тестов</a></p>');
}

$i = 0;
//print_r($base);
echo '<br />';

?>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Задание 5. Тест.<</title>

    </head>
    <body>
    <a href="L5list.php">Назад к списку тестов</a>
    <form action="" method="POST">

        <?php for ($i = 0; $i < count($base); $i++) {
            echo '<fieldset>';
            echo '<legend>' . $base[$i][0] . '</legend>';
            for ($c = 0; $c < count($base[$i][1]); $c++) {
                echo '<label><input type="radio" name="q' . $i . '" value="' . $base[$i][1][$c] . '">' . $base[$i][1][$c] . '</label>';
            }
            echo '</fieldset>';
        }
        ?>
        <input type="submit" value="Отправить">
    </form>
    <form action="logout.php" method="POST">
        <input type="submit" value="Выход"/>
    </form>
    </body>
    </html>

<?php
//print_r($_GET);
$i = 0;
if (!empty($_POST)) {
    $answers = $_POST;
    if (count($answers) < count($base)) {
        echo "Заполните тест полностью";
        exit;
    }
    echo '<br />Результат пользователя ' . $_SESSION['user'] . '<br />';
    $results[] = 'Результат пользователя ' . $_SESSION['user'];
    for ($z = 0; $z < count($base); $z++) {
        $countAnswerText = $z + 1;
        $countAnswerReal = 'q' . $z;
        if ($answers[$countAnswerReal] == $base[$z][1][$base[$z][2]]) {
            $results[] = 'Ответ ' . $countAnswerText . ' - верный';
            echo 'Ответ ' . $countAnswerText . ' - верный' . '<br />';
        } else {
            $results[] = 'Ответ ' . $countAnswerText . ' - не верный';
            echo 'Ответ ' . $countAnswerText . ' - не верный' . '<br />';
        }
    }
}
if (isset($results)) {
    echo '<form action="sertificate.php" method="POST">';
    $i = -1;
    foreach ($results as $result) {
        $i++;
        echo '<label><input type="hidden" name ="' . $i . '" value="' . $result . '"></label>';
    }
    echo '<input type="submit" value="Сформировать сертификат">';
    echo '</form>';
}
//var_dump($results);

//var_dump($base[0][2]);
//var_dump($base[1][2]);
//var_dump($_POST['q0']);
//var_dump($_POST['q1']);
//var_dump($base[0][$base[0][2]]);
//var_dump($base[1][$base[1][2]]);
//print_r($answers);
//print_r($base[0][2]);
//print_r($base[0][2]);
?>
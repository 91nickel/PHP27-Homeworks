<?php
if (isset($_GET['y'])) {
    $y = $_GET['y'];
} else {
    exit('Задайте номер теста через параметр "$y=[номер теста]"');
}
$json = file_get_contents("tests/$y.json");
$base = json_decode($json, true);
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
    for ($z = 0; $z < count($base); $z++) {
        $countAnswerText = $z + 1;
        $countAnswerReal = 'q' . $z;
        if ($answers[$countAnswerReal] == $base[$z][1][$base[$z][2]]) {
            echo 'Ответ ' . $countAnswerText . ' - верный' . '<br />';
        } else {
            echo 'Ответ ' . $countAnswerText . ' - не верный' . '<br />';
        }
    }
}
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
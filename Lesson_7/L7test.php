<?php
session_start();
if (isset($_GET['y'])) {
    $y = $_GET['y'];
    $filename = 'tests/' . $y . '.json';
    if (!file_exists($filename)) {
        http_response_code(404);
        exit;
    }
} else {
    http_response_code(404);
    $y = 'Задайте номер теста через параметр "$y=[номер теста]"';
    echo $y;
    exit;
}
$json = file_get_contents("tests/$y.json");
$base = json_decode($json, true);
$i = 0;

?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание 7. Тест модифицированный.<</title>

</head>
<body>
<form action="" method="POST">
    <?php foreach ($base as $data) : ?>
        <?php $i++ ?>
        <fieldset>
            <legend><?php echo $data['q'] ?></legend>
            <label><input type="radio" name="<?php echo 'q' . $i ?>"
                          value="<?php echo $data['wa1'] ?>"> <?php echo $data['wa1'] ?> </label>
            <label><input type="radio" name="<?php echo 'q' . $i ?>"
                          value="<?php echo $data['wa2'] ?>"> <?php echo $data['wa2'] ?> </label>
            <label><input type="radio" name="<?php echo 'q' . $i ?>"
                          value="<?php echo $data['wa3'] ?>"> <?php echo $data['wa3'] ?> </label>
            <label><input type="radio" name="<?php echo 'q' . $i ?>"
                          value="<?php echo $data['ra'] ?>"> <?php echo $data['ra'] ?> </label>
        </fieldset>
    <?php endforeach; ?>
    <input type="submit" value="Отправить">
</form>

<?php
//print_r($_GET);
$i = 0;
$results[] = $_SESSION['role'];
if (!empty($_POST)) {
    if (empty($_SESSION['role'])) {
        $answers = $_POST;
        if (count($answers) < count($base)) {
            echo "Заполните тест полностью";
            exit;
        }
        echo 'Результат пользователя ' . $_SESSION['role'] . "<br />";
        foreach ($base as $answer) {
            //print_r($answer['ra']);
            $i++;
            if ($answer['ra'] == $answers['q' . $i]) {
                $results[] = $i . '_ответ_верный';
                echo "Ответ $i - верный" . '<br />';
            } else {
                $results[] = $i . '_ответ_не_верный';
                echo "Ответ $i - не верный" . '<br />';
            };
        };
    } else {
        echo 'Не задано имя пользователя';
    };
};
//var_dump($_GET['role']);
//print_r($results);

echo '<form action="sertificate.php" method="POST">';
$i = -1;
foreach ($results as $result) {
    $i++;
    echo "<label><input type='hidden' name =$i value=$result></label>";
    //echo $result;
};
echo "<input type='submit' value='Сформировать сертификат'>";
echo "</form>";
?>
</body>
</html>
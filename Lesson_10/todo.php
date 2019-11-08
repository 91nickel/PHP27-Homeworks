<?php
session_start();
ob_start();
//var_dump($_SESSION['userId']);
$s = $_SESSION['userId'];
$today = date("Y-m-d");
//echo $s;
?>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>TODO List</title>
    <style>
        body {
            width: 1200px;
            margin: auto;
            border: 1px solid #ccc;
            text-align: center;
        }
        p {
            display: inline;
        }
        form {
            display: inline-block;
        }

        .addtask {
            width: 300px;
            min-height: 25px;
            display: inline-block;
            margin: 10px auto;
        }

        .execute {
            width: 25px;
            height: 25px;
            display: inline-block;
            margin: 0;
            font-size: 0px;
            padding: 0;
        }

        a, h1, h2 {
            margin: auto 10px;
            text-align: center;
            display: ;
        }

        table {
            border: 1px solid #ccc;
            border-spacing: 0;
            border-collapse: collapse;
            margin: auto;
        }

        table td, table th {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: center;
        }
        td {
            min-width: 150px;
        }

        .bold {
            text-align: center;
            font-weight: bold;
        }

        .left {
            text-align: left;
        }
    </style>
</head>

<body>
<h1>ДОБРО ПОЖАЛОВАТЬ В TODO LIST</h1>
<table>
    <tr>
        <td class="bold">ID</td>
        <td class="bold">Пользователь</td>
        <td class="bold">Задача</td>
        <td class="bold">Выполнена</td>
        <td class="bold">Добавлена</td>
    </tr>

    <?php
    $pdo = new pdo("mysql:host=localhost;charset=utf8;dbname=nkuznetsov", "nkuznetsov", "neto1907");
    $table = 'SELECT * FROM task WHERE user_id LIKE "' . $_SESSION['userId'] . '" ORDER BY `task`.`date_added` DESC';
    echo '<br />';
    echo '<br />';
    foreach ($pdo->query($table) as $tableRow) {
        echo '<tr>';
        echo '<td>' . $tableRow['id'] . '</td>';
        echo '<td>' . $tableRow['assigned_user_id'] . '</td>';
        echo '<td class = "left">' . $tableRow['description'] . '</td>';
        if ($tableRow['is_done'] == 0) {
            echo '<td><p>Выполнить: </p> ' . '<form action="" method="POST"><input class="execute" type="submit" name="execute" value="' . $tableRow['id'] . '"></form>' . '</td>';
        } elseif ($tableRow['is_done'] == 1) {
            echo '<td>Выполнено</td>';
        } else {
            echo '<td>' . $tableRow['is_done'] . '</td>';
        }
        echo '<td>' . $tableRow['date_added'] . '</td>';
        echo '</tr>';
    }
    ?>
</table>
<form action="" method="POST">
    <input class="addtask" type="text" name="description" placeholder="Описание дела">
    <input class="addtask" type="submit" value="Добавить" name="send">
</form>
<?php
var_dump($_POST);
//echo isset($_POST['description']);
if (isset($_POST['description']) == 1) {
    if ($_POST['description'] !== '') {
        $insertTask = 'INSERT INTO `task`(user_id,description,is_done,date_added) VALUES (' . $_SESSION['userId'] . ',' . '"' . $_POST['description'] . '",' . '0' . ',"' . $today . '")';
        print_r($insertTask);
        $pdo->exec($insertTask);
        header('Location: todo.php');
        unset($_POST);
    }
}
if (isset($_POST['execute'])) {
    //var_dump($_POST['execute']);
    $execute = 'UPDATE `task` SET `is_done` = \'1\' WHERE `task`.`id` =' . $_POST['execute'];
    $pdo->exec($execute);
    header('Location: todo.php');
    unset($_POST);
}

?>


</body>

</html>

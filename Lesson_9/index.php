<html>
<head>
    <meta charset="UTF-8">
    <style>
        input {
            display: inline-block;
            margin: 10px;
            width: 250px;
        }

        table {
            border: 1px solid #ccc;
            border-spacing: 0;
            border-collapse: collapse;
        }

        table td, table th {
            border: 1px solid #ccc;
            padding: 5px;
        }

        .bold {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
<h1>Библиотека успешного человека</h1>
<form action="" method="GET">
    <input type="text" name="name" placeholder="Название книги">
    <input type="text" name="author" placeholder="Автор">
    <input type="text" name="isbn" placeholder="ISBN">
    <input type="submit" value="Поиск">
</form>

    <table>
        <tr>
            <td class="bold">Название</td>
            <td class="bold">Автор</td>
            <td class="bold">Год выпуска</td>
            <td class="bold">Жанр</td>
            <td class="bold">ISBN</td>
        </tr>

        <?php
        // /*WHERE author LIKE "%$_GET['author']%"*/
        $pdo = new pdo("mysql:host=localhost;charset=utf8;dbname=global", "nkuznetsov", "neto1907");
        //$sql = 'SELECT * FROM books';
        if(!isset($_GET['name'])) {
            $_GET['name']='';
        }
        if(!isset($_GET['author'])) {
            $_GET['author']='';
        }
        if(!isset($_GET['isbn'])) {
            $_GET['isbn']='';
        }

        $sql = 'SELECT * FROM books WHERE name LIKE "%' . $_GET['name'] . '%" AND author LIKE "%' . $_GET['author'] . '%" AND isbn LIKE "%' . $_GET['isbn'] . '%"';
        echo '<br />';
        print_r($sql);
        echo '<br />';

        //var_dump($sql);
        // print_r($_GET);
        //var_dump($_GET[0]);

        foreach ($pdo->query($sql) as $row1) {
            echo '<tr>';
            echo '<td>' . $row1['name'] . '</td>';
            echo '<td>' . $row1['author'] . '</td>';
            echo '<td>' . $row1['year'] . '</td>';
            echo '<td>' . $row1['genre'] . '</td>';
            echo '<td>' . $row1['isbn'] . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>



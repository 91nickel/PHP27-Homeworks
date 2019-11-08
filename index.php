<?= 'Hello world'; ?>
<?php

$array = [0, 1, 2, 3, 4, 5]

?>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <title>Test PHP</title>
</head>

<body>
    <?php foreach ($array as $key => $value) : ?>
        <?php if ($value % 2 != 0) : ?>
            <?= '<h1>' . $key . ' ' . $value * 2 . '</h1>'; ?>
        <?php endif ?>
    <?php endforeach ?>

    <?php

    class Base
    {
        public function __construct($first)
        {
            $this->first = $first;
        }
        public function getSecond()
        {
            return $this->second;
        }
    }

    class BaseExtend extends Base
    {
        public function __construct($first, $second)
        {
            parent::__construct($first);
            $this->second = $second;
        }
    }

    $obj = new BaseExtend('first', 'second');
    echo $obj->first . ' ', $obj->second;
    echo '</br>' . $obj->getSecond();
    ?>

</body>

</html>
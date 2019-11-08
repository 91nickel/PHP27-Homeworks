<?php
session_start();
$i = -1;
if (!empty($_POST)) {
    $results = 'Результат теста. Пользователь ' . implode(' | ', $_POST);
};
$y = 26;
header ("Content-type: image/png");
$im = ImageCreate (800, 200)
or die ("Ошибка при создании изображения");
$couleur_fond = ImageColorAllocate ($im, 230, 230, 230);
$colorCross = imageColorAllocate($im, 0, 0, 0);
$textColor = imageColorAllocate($im, 0, 0, 0);
$font = './font.ttf';
imagettftext($im, 12, 0, 50, 50, $textColor, $font, $results);

ImagePng ($im);
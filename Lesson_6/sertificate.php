<?php
ob_start();
session_start();
//var_dump($_POST);
$i = -1;
if (!empty($_POST)) {
    foreach ($_POST as $post) {
        $results = $results.' | '.$post.' | ';
    }
}
//var_dump($results);

$y = 26;
header ("Content-type: image/png");
$im = ImageCreate (1200, 200)
or die ("Ошибка при создании изображения");
$couleur_fond = ImageColorAllocate ($im, 230, 230, 230);
$colorCross = imageColorAllocate($im, 0, 0, 0);
$textColor = imageColorAllocate($im, 0, 0, 0);
$font = './font.ttf';
imagettftext($im, 12, 0, 50, 50, $textColor, $font, $results);

ImagePng ($im);
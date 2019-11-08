<?php
$bookArray = file_get_contents('./books.json', TRUE);
$base = json_decode($bookArray, true);
//var_dump($base['items']);
//var_dump($base['items'][0]);
var_dump($base['items'][0]['id']);
var_dump($base['items'][0]['volumeInfo']['title']);
var_dump($base['items'][0]['volumeInfo']['authors']);
//var_dump($base['title']);
//var_dump($base['authors']);
?>
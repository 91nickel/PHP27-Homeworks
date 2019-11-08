<?php
$pdo = new pdo("mysql:host=localhost;charset=utf8;dbname=nkuznetsov", "nkuznetsov", "neto1907");
$createTable1 = 'CREATE TABLE task (
id int(11) NOT NULL AUTO_INCREMENT,
user_id int(11) NOT NULL,
assigned_user_id int(11) DEFAULT NULL,
description varchar(500) NOT NULL,
is_done tinyint(1) NOT NULL DEFAULT \'0\',
date_added timestamp NULL DEFAULT NULL,
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
$exec1 = $pdo->exec($createTable1);

$createTable2 = 'CREATE TABLE user (
id int(11) NOT NULL AUTO_INCREMENT,
login varchar(50) NOT NULL,
password varchar(255) NOT NULL,
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
$exec2 = $pdo->exec($createTable2);

$addToUser = 'INSERT INTO `user` (`id`, `login`, `password`) VALUES (NULL, \'admin\', \'admin\');';
$exec3 = $pdo->exec($addToUser);

var_dump($exec1);
var_dump($exec2);
var_dump($exec3);
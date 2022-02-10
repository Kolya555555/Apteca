<?php

//Зміна інформації про вже наявну в базі магазину позиції

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$id = $_POST['id'];
$title = $_POST['title'];
$vendor_code = $_POST['vendor_code'];
$Description = $_POST['Description'];
$prise = $_POST['prise'];
$count = $_POST['count'];

/* Делаем запрос на изменение строки в таблице medicine */
mysqli_query($connect,"UPDATE `medicine` SET `title` = '$title', `vendor_code` = '$vendor_code', `Description` = '$Description', `prise` = '$prise', `count` = '$count' WHERE `medicine`.`id` = '$id'");

/* Переадресация на сторінку "Склад"*/
header('Location: /sclad.php');
?>
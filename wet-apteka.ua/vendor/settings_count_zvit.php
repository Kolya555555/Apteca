<?php

//Оновлення інформації про кількість позиції вибраного товару в корзині, файл який змінює кількість товару прямо з корзини.

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$id = $_POST['id'];
$count = $_POST['count'];
$name = $_POST['name'];

$medicine = mysqli_query($connect, "SELECT * FROM `medicine`");
/* Преобразовывем полученные данные в нормальный массив */
 $medicine = mysqli_fetch_all($medicine);

/* Делаем запрос на изменение строки в таблице medicine, тобто заміни кількості товару */
foreach ($medicine as $medicine) {
         if($medicine[3] == $name){
         mysqli_query($connect, "UPDATE `medicine` SET `count` = `medicine`.`count`+ $count  WHERE `medicine`.`vendor_code` = $name ");}
    }

mysqli_query($connect,"DELETE FROM `prodano` WHERE `prodano`.`id` = '$id'");
/* Переадресация на  страницу "Звіт" */
header('Location:/zvit.php');
?>

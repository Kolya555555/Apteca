<?php

//Очищиння корзини, видалення всих позиції потрібного користувача.

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

//Точка входу
session_start();


/* Делаем выборку строки  */
$zakaz_ok = mysqli_query($connect, "SELECT * FROM `zakaz_ok`");

/* Преобразовывем полученные данные в нормальный массив */
$zakaz_ok = mysqli_fetch_all($zakaz_ok);

/* Делаем запрос на удаление все записів из таблицы zakaz_ok */
    foreach ($zakaz_ok as $zakaz_ok) {
         mysqli_query($connect,"DELETE FROM `zakaz_ok`");
    }

/* Переадресация на  страницу "Головна" */
header('Location:/index.php');

?>
<?php

//Очищиння корзини, видалення всих позиції потрібного користувача.

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

//Точка входу
session_start();

//Шукаємо користувача в сесії
$username = $_SESSION['username'];

/* Получаем ID продукта из адресной строки */
$username = $_GET['id'];

/* Делаем выборку строки с полученным username */
$order = mysqli_query($connect, "SELECT * FROM `order` WHERE `user` = '$username'");

/* Преобразовывем полученные данные в нормальный массив */
$order = mysqli_fetch_all($order);

/* Делаем запрос на удаление все записів из таблицы order */

    foreach ($order as $order) {
         if($order[6] = $username)
         mysqli_query($connect,"DELETE FROM `order` WHERE `order`.`user` = '$username'");
    }

/* Переадресация на  страницу "Чек" */
header('Location:/cat.php');

?>
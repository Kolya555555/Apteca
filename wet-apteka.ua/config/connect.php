<?php

/* Делаем константи для хранения данных о базhbJJ0090@@е данных
 * HOST - адрес для подключения к БД
 * USER - логин для доступа к БД
 * PASSWORD - пароль для доступа к БД
 * DATABASE - название базы данных, к которой мы подключаемся */
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'hbJJ0090@@');
define('DATABASE', 'wet-apteka');

/*Подключаемся к базе данных с помощью функции mysqli_connect()*/
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

/* Делаем проверку соединения
 * Если есть ошибки, останавливаем код и выводим сообщение с ошибкой */
if (!$connect) {
    die('Error connect to database!!!');
}
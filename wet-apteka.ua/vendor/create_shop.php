<?php
//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];

//Додавання товара до корзини

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$id = $_POST['id'];
$title = $_POST['title'];
$vendor_code = $_POST['vendor_code'];
$prise = $_POST['prise'];
$count = $_POST['count'];
$image = $_POST['image'];
$newcount = $count;

/* Делаем запрос на добавление новой строки в таблицу order
 Делаем выборку строки с полученным username */
    $order = mysqli_query($connect, "SELECT * FROM `order` WHERE `user` = '$username'");

/* Преобразовывем полученные данные в нормальный массив */
    $order = mysqli_fetch_all($order);
    $a = '0';
    $b = '0';

/* Перебираємо масив */
    foreach ($order as $order) {
    $b = $b + 1 ; //Рахуємо всі записи в чеку користувача "username"

/* Робимо перевірку товар який буде записуватися в чек вже є в ній, чи буде вперше */
    if ($order[2] == $vendor_code)
    {/*Змінюємо кількість товару в чеку*/
        mysqli_query($connect, "UPDATE `order` SET `count` = $order[4] + $count WHERE `user` = '$username' and `title` = '$title' ");}
    else
    {$a = $a + 1 ;} /*Рахуємо позиції яких немає в чек*/ }

/* Якщо товар який додає користувач в чек ще відсутнії додаємо його туди */
if($a == $b)
{/* додаємо нову позицію в чек*/
    mysqli_query($connect,"INSERT INTO `order` (`id`, `title`, `ventor_code`, `price`, `count`, `image`, `user`) VALUES (NULL, '$title', '$vendor_code', '$prise', '$count', '$image', '$username')");}

/* Переадресация на страницу product.php */
    header('Location: /product.php?id=' . $id);
?>

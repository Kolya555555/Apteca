<?php
require_once '../config/connect.php';

session_start();

$username = $_SESSION['username'];
$date = date("y:m:d");

/* Создаем переменные со значениями, которые были получены с $_POST */
$suma = $_POST['suma'];

//Делаем выборку строки с полученным username
$order = mysqli_query($connect, "SELECT * FROM `order` WHERE `user` = '$username'");
// Преобразовывем полученные данные в нормальный массив
$order = mysqli_fetch_all($order);

/* Записуємо позиції замовлення в переменну zakaz_o */
    foreach ($order as $order) {
        $zakaz_ok = "Артикул: $order[2] - $order[4] шт";
        $zakaz_o = "$zakaz_o <br> $zakaz_ok";
    }

/* Додавання нового запису в таблицю zakaz_ok*/
 mysqli_query($connect,"INSERT INTO `zakaz_ok` (`id`, `user`, `zakaz`, `suma`, `Date`) VALUES (NULL, '$username', '$zakaz_o', '$suma', '$date')");


    $order = mysqli_query($connect, "SELECT * FROM `order`");
    $order = mysqli_fetch_all($order);

/* Делаем запрос на удаление все записів из таблицы order */
    foreach ($order as $order) {
    if($order[6] = $username){
        //echo($order[2]); echo('+');
        $medicine = mysqli_query($connect, "SELECT * FROM `medicine`");
        $medicine = mysqli_fetch_all($medicine);
        foreach ($medicine as $medicine) {
        if($medicine[3] == $order[2]){
        $cot = $medicine[6]-$order[4];
        mysqli_query($connect,"UPDATE `medicine` SET `count` = '$cot' WHERE `medicine`.`vendor_code` = '$order[2]'");
        }

    }
//Добавляємо позиції у @prodano@
    $prodano = mysqli_query($connect, "SELECT * FROM `prodano`");
    $prodano = mysqli_fetch_all($prodano);
    $k = '0'; // ті яких немає в системі
    $l = '0'; // ті які є  в системі

/* Перебираємо масив */
    foreach ($prodano as $prodano) {
    $l = $l + 1 ; //Рахуємо всі записи в prodano
/* Робимо перевірку товар який буде записуватися в корзині вже є в ній, чи буде вперше */
    if ($prodano[1] == $order[2])
    {/*Змінюємо кількість товару в корзині*/
        $s = $s + 1 ;
        mysqli_query($connect, "UPDATE `prodano` SET `count` = $prodano[3] + $order[4] WHERE `prodano`.`ventor_code` = '$order[2]'");
    }
    else
    {$k = $k + 1 ;} /*Рахуємо позиції яких немає в корзині*/
}

/* Якщо товар який додає користувач в корзині ще відсутнії додаємо його туди */
if($k == $l)
{/* додаємо нову позицію в корзину*/
    mysqli_query($connect,"INSERT INTO `prodano` (`id`, `ventor_code`, `price`, `count`) VALUES (NULL, '$order[2]', '$order[3]', '$order[4]')");}

//Видаляємо позиції з чеку
    mysqli_query($connect,"DELETE FROM `order` WHERE `order`.`user` = '$username'");
    }
    }

/* Переадресация на стрінку "Чек"*/
  header('Location:/cat.php');

?>
<?php

//Добавление нового товара

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$title = $_POST['title'];
$vendor_code = $_POST['vendor_code'];
$Description = $_POST['Description'];
$price = $_POST['price'];
$count = $_POST['count'];

//Запис у систему файлу
move_uploaded_file($_FILES['file']['tmp_name'], "medicine/" .$_FILES['file']['name']);
$photo = $_FILES['file']['name'];

/* Делаем запрос на добавление новой строки в таблицу medicine */
/* Делаем выборку строки с полученным username */
    $medicine = mysqli_query($connect, "SELECT * FROM `medicine`");
/* Преобразовывем полученные данные в нормальный массив */
    $medicine = mysqli_fetch_all($medicine);
    $a = '0';
    $b = '0';

/* Перебираємо масив */
    foreach ($medicine as $medicine) {
    $b = $b + 1 ; //Рахуємо всі записи

/* Робимо перевірку товар який буде записуватися в чек вже є в ній, чи буде вперше */
    if ($medicine[3] == $vendor_code)
    { echo "Товар з артикулем: $medicine[3] вже наявний в базі, поверніться назад і виправте дане поле.";
		exit;}
    else
    {$a = $a + 1 ;} /*Рахуємо позиції яких немає в чеку*/
}

/* Якщо товар який додає користувач в чек ще відсутнії додаємо його туди */
if($a == $b)
    mysqli_query($connect,"INSERT INTO `medicine` (`id`, `title`, `image`, `vendor_code`, `Description`, `prise`, `count`) VALUES (NULL, '$title', '$photo', '$vendor_code', '$Description', '$price', '$count')");
echo('dvdvd');
header('Location: /sclad.php');
?>


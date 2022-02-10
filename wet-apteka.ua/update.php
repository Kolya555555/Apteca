<?php

    /* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
    require_once 'config/connect.php';

    /* Получаем ID продукта из адресной строки */
    $electronics_id = $_GET['id'];

    /* Делаем выборку строки с полученным ID выше */
    $medicine = mysqli_query($connect, "SELECT * FROM `medicine` WHERE `id` = '$electronics_id'");

    /* Преобразовывем полученные данные в нормальный массив
     * Используя функцию mysqli_fetch_assoc массив будет иметь ключи равные названиям столбцов в таблице */
    $medicine = mysqli_fetch_assoc($medicine);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Зміни</title>
</head>
<style>
/*Налаштування таблички*/
th, td {padding: 10px; }

th { background: #606060;
        color: #fff;}

td { background: #b5b5b5; }

nav{
    width: 980px;
    margin: 0 auto;} /*отступа от каждого края элемента*/
/*використовується для відображення бажаного контенту до вмісту елемента nav*/
nav:before {
    content: ''; /*позволяет вставлять генерируемое содержание в текст веб-страницы*/
    display: block; /*властивість, яка визначає, як елемент повинен бути показаний у документі*/
    height: 50px;
    width: 100%;
    background: #000;
    position: absolute;
    left: 0;
    z-index: -1;} /*Любые позиционированные элементы на веб-странице*/

ul{ margin: 0;
    padding: 0; /*Встановлює значення полів довкола вмісту елемента*/
    list-style: none; /*Універсальна властивість, що дозволяє одночасно встановити стиль маркера, його положення, а також зображення, яке буде використовуватися як маркера*/
    height: 50px;}

ul li{float: Left;} /*Визначає, з якого боку вирівнюватиметься елемент*/

ul li a { color: #fff;
    display: block; /*властивість, яка визначає, як елемент повинен бути показаний у документі*/
    padding:0 30px; /*Встановлює значення полів довкола вмісту елемента*/
    text-transform: uppercase; /*Керує перетворенням тексту елемента, усі символи тексту стають великими (верхній регістр). */
    text-decoration: none; /*Отменяет все эффекты, в том числе и подчеркивания у ссылок, которое задано по умолчанию*/
    line-height: 50px;} /*Встановлює інтерліньяж (міжрядковий інтервал) тексту*/

ul li a:hover{background: #d34d43;}
/*Фон*/
body { background: url(img/fonn.jpg); }

/*клас для логотипу сайту - зображення*/
.product_img{
    height: avto;
    width: 50px;}

/*Оформлення тексту*/
.text{
     font-size: 20px;
    color: black;}

/*Вікно для введення інформації №1*/
.vindo{
    background: wheat;
    width: 40%;
    height: 25px;
    border-radius: 5px;
    font-size: 16px;}

/*Вікно для введення інформації №2*/
.vindo_text{
    background: wheat;
    width: 40%;
    height: 100px;
    border-radius: 10px;
    font-size: 16px;}

/*Кнопка*/
.btn-buy{
    background: black;
    color: white;
    font-size: 15px;
    padding: 0 30px;
    height: 25px;
    outline: none;
    border-radius: 10px;
    cursor: pointer;}
</style>


<body>
    <p class='product_text' align="center" > <img  class = "product_img" src='img/111.png'> Мій Миколай - до нас завітай</p>
    <p>Ви ввійшли як Адміністратор | <a href="index.php">Вихід</a></p>
    <nav>
       <ul>
            <li><a href="index.php">Робота</a></li>
            <li><a href="sclad.php">Склад</a></li>
            <li><a href="zvit.php">Звіт</a></li>
            <li><a href="catalog.php">Каталог</a></li>
        </ul>
    </nav>
    <div class="text" align= "center">
    <h3>Корегування даних товару</h3>
    <form action="vendor/update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $medicine['id'] ?>">
        <p>Назва</p>
        <input type="text" name="title"  class="vindo" value="<?= $medicine['title'] ?>">
        <p>Артикул</p>
        <input type="number" name="vendor_code"  class="vindo" value="<?= $medicine['vendor_code'] ?>">
        <p>Oпис</p>
        <textarea name="Description"  class="vindo_text"> <?= $medicine['Description'] ?></textarea>
        <p>Ціна</p>
        <input type="number" name="prise" class="vindo" value="<?= $medicine['prise'] ?>">
        <p>Кількість</p>
        <input type="number" name="count" class="vindo" value="<?= $medicine['count'] ?>"><br><br>
        <button type="submit" class="btn-buy">Змінити</button>
    </form>
    </div>

</body>
</html>

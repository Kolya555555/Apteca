<?php
    /* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
    require_once 'config/connect.php';
    /*Делаем выборку строк і преобразовывем полученные данные в нормальный массив*/
    $medicine = mysqli_query($connect, "SELECT * FROM `medicine`");
    $medicine = mysqli_fetch_all($medicine);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Новий товар</title>
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
    <h3>Введення в облік нового товару</h3>
    <form action="vendor/create.php" method="post" enctype="multipart/form-data">
        <p>Назва</p>
        <input type="text" name="title" class="vindo">
        <p>Забраження</p>
        <input type="file" name="file" multiple accept="image/*">
        <p>Артикул</p>
        <input type="text" name="vendor_code" class="vindo">
        <p>Опис</p>
        <textarea name="Description" class="vindo_text"></textarea></p>
        <p>Ціна</p>
        <input type="number" name="price" class="vindo">
        <p>Кількість</p>
        <input type="number" class="vindo" name="count">
        <br><br>
        <button type="submit" class="btn-buy">Добавити новий товар
    </form>
    </div>


</body>
</html>

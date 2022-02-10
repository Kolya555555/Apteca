<?php
//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];

//Неавторизованх користувачів відправляємо на страницу авторизації
if ($username == "")
{   header("Location: open.php");
    exit();}

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once 'config/connect.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Склад</title>
</head>
<style>
/*Налаштування таблички*/
    th, td {padding: 10px;}

    th {background: #608970;
        color: black;}

    td { background: #ccc670;}

/*Налаштовуємо меню*/
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

/*Клас для контейнеру*/

img {
    width: 100px;
    height: 100px;}

/*Кнопка*/
.btn-buy{
    background: yellow;
    color: green;
    font-size: 15px;
    padding: 0 30px;
    height: 40px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/
    margin-left: 80px;}


/*клас для логотипу сайту - зображення*/
.product_img{
    height: avto;
    width: 150px;}


.topNubex {
    position: fixed;
    left: 15px;
    bottom: 15px;
    background: wheat ;
    color:  red;
    text-decoration-color: blue;
    font-size: 18pt;
   }
.topNubexq {
    position: fixed;
    left: 15px;
    bottom: 45px;
    background: wheat ;
    color:  red;
    text-decoration-color: blue;
    font-size: 18pt;
   }
</style>


<body>
    <!-- Виведення шапки сайту -->
     <div align="center"> <img  class = "product_img" src='img/1111.png' ></div>
     <p >Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
    <!-- Виведення меню сайту  -->
    <nav>
       <ul>
            <li><a href="index.php">Робота</a></li>
            <li><a href="sclad.php">Склад</a></li>
            <li><a href="zvit.php">Звіт</a></li>
            <li><a href="catalog.php">Каталог</a></li>
        </ul>
    </nav>
<!-- Виведення головного вмісту сторінки -->
<h3 align="center">Введіть Артикул - тавару (в результаті пошуку будуть видані також подібні товари) </h3>
        <form align="center" action="" method="post">
                <input  type="number" name="id" min="1" value="">
                <button type="submit" class="btn-buy">Знайти</button>
        </form>
    <?php $id = $_POST['id'];
        $b = $id; ?>
<h1 align="center"> Склад </h1>
<a href="#" class="topNubexq">Вверх</a>
<a href="#top" class="topNubex">Вниз</a>
<div align="center">
    <table>
        <tr>
            <th>Id</th>
            <th>Назва</th>
            <th>Зображення</th>
            <th>Артикул</th>
            <th>Опис</th>
            <th>Ціна</th>
            <th>Кількість</th>
        </tr>

        <?php
           /*Делаем выборку строк і преобразовывем полученные данные в нормальный массив*/
            $medicine = mysqli_query($connect, "SELECT * FROM `medicine` WHERE `medicine`.`vendor_code` LIKE '$b%'");
            $medicine = mysqli_fetch_all($medicine);

            /*Виводимо всі позиції в БД інтернет-магазину*/
            foreach ($medicine as $medicine) {
                ?>
                    <tr">
                        <td><?= $medicine[0] ?></td>
                        <td><div style="overflow: auto; width:500px;height:50px;"><?= $medicine[1] ?></div></td>
                        <td><img src='vendor/medicine/<?= $medicine[2] ?>' ></td>
                        <td><?= $medicine[3] ?></td>
                        <td><div style="overflow: auto; height:100px;width:350px;"><?= $medicine[4] ?></div></td>
                        <td><div style="overflow: auto; width:auto;height:50px;"><?= $medicine[5] ?></div></td>
                        <td><?= $medicine[6] ?></td>
                        <?php if($username == 'Саша') { ?><td><a style="color: green;"href="update.php?id=<?= $medicine[0] ?>">Змінити</a></td>
                        <td><a style="color: red;" href="vendor/delete.php?id=<?= $medicine[0] ?>">Видалити</a></td><?php } ?>
                    </tr>
                <?php
            }
        ?>
    </table>
    <a style="color: red;" href="new.php"><button class="btn-buy" type="submit">Додати товар</button></a>
    </div>
<a name="top"></a>
</body>
</html>

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
$date = date("y:m:d");
?>

<!doctype html>
<html lang="en">
<style media="print" type='text/css'>
    #navbar-iframe {display: none; height: 0px; visibility: hidden;}
    .noprint{display: none;}
    body{background: #FFF; color: #000;}
    a {text-decoration: underline; color: #00F;}
</style>
<head>
    <meta charset="UTF-8">
    <title>Робота</title>
</head>
<style>
/*Налаштування таблички*/
    th, td {padding: 10px;}

    th {background: #606060;
        color: #fff;}

    td { background: #b5b5b5;}

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
     <span class="noprint">
     <p >Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
    <!-- Виведення меню сайту  -->
    <nav>
       <ul>
            <li><a href="index.php">Робота</a></li>
            <li><a href="sclad.php">Склад</a></li>
            <li><a href="zvit.php">Звіт</a></li>
            <li><a href="catalog.php">Каталог</a></li>
        </ul>
    </nav><br></span>
<div align="center">
<span class="noprint">
<h1 >Сьогодні <?= $date ?> Приступим до роботи !</h1>
<a style="color: red;" href="cat.php"><button class="btn-buy" type="submit">Почати формувати чек</button></a></span>

<h1 >Сформовані заявки за весь час</h1></div>
<span class="noprint">
<a href="#" class="topNubexq">Вверх</a>
<a href="#top" class="topNubex">Вниз</a>
</span>
<?php
$zakaz_ok = mysqli_query($connect, "SELECT * FROM `zakaz_ok` WHERE `zakaz_ok`.`user` = '$username'");
$zakaz_ok = mysqli_fetch_all($zakaz_ok);
if($zakaz_ok != null){ ?>
<div align="center">
    <table>
        <tr>
            <th>ID</th>
            <th>Заказ</th>
            <th>Сума</th>
            <th>Дата</th>
        </tr>

        <?php
           /*Делаем выборку строк і преобразовывем полученные данные в нормальный массив*/
            $a=0;
            /*Виводимо всі позиції в БД інтернет-магазину*/
            foreach ($zakaz_ok as $zakaz_ok) {
                ?>
                    <tr>
                        <td><?= $zakaz_ok[0] ?></td>
                        <td><div style="overflow: auto; height:auto;width:250px;"><?= $zakaz_ok[2] ?></div></td>
                        <td><?= $zakaz_ok[3]*1.2 ?></td>

                        <td><?= $zakaz_ok[4] ?></td>
                        <td><span class="noprint"><a style="color: red;" href="vendor/delete_zakaz.php?id=<?= $zakaz_ok[0] ?>">Видалити</a></span></td>
                    </tr>
                <?php $a=$a+$zakaz_ok[3];
            }
        ?>
    </table>
    <h3> Всього продано на : <?php echo $a*1.2 ?> грн</h3>
    <span class="noprint">
     <a href=""><button class="btn-buy" type="submit" onclick="print()">Друк </button></a>
      <a href="vendor/delete_zavki.php"><button class="btn-buy" type="submit" >Видалити все</button></a>
       <?php }
        else { ?> <h2 align="center">Заявок не знайдено </h2>
         <?php } ?>

 </span>
    <a name="top"></a>
</body>
</html>

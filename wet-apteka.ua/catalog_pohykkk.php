<?php
//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];

//Неавторизованх користувачів підписувати як Гість
if ($username == Null) {
    $_SESSION['username'] = Гість;}

require_once 'config/connect.php';

$array = $_POST['code'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Каталог_Пошук</title>
</head>
<style>
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
.container {
    max-width: 1400px;
    margin: auto;}

.product-container {
    display: flex; /*Багатоцільова властивість, яка визначає, як елемент повинен бути показаний у документі.*/
    flex-wrap: wrap; /*Властивість Вказує, слід розташовуватися в один рядок або можна зайняти кілька рядків. */
    justify-content: space-around;} /*Властивість  визначає, як браузер розподіляє простір навколо елементів уздовж головної осі контейнера*/

.product {
    max-width: 350px;
    border: 1px solid black; /*дозволяє одночасно встановити товщину, стиль та колір навколо елемента*/
    border-radius: 10px; /*Встановлює радіус заокруглення куточків рамки*/
    margin: 10px; /*отступа от каждого края элемента*/
    padding: 20px; /*Встановлює значення полів довкола вмісту елемента*/
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;} /*Додає тінь до елемента*/

.product img {
    width: 100%;}

.product-bottom p {
    font-size: 18px; /*Розмір шришта*/
    font-family: 'Arial';  /*Вид шришта*/
    font-weight: 600; /*Встановлює насиченість шрифту*/
    font-variant: all-petite-caps;} /*Визначає, як потрібно представляти букви*/

.product-price {
    color: brown;}

.product-text-title {
    color: black;}

/*Кнопка №1*/
.btn-buy{
    background: yellow;
    color: green;
    font-size: 15px;
    padding: 0 30px;
    height: 40px;
    outline: none;
    border-radius: 7px;
    cursor: pointer;
    margin-left: 80px;}

/*Кнопка №2*/
.btn{
    background: yellow;
    color: green;
    font-size: 15px;
    padding: 0 30px;
    height: 25px;
    outline: none;
    border-radius: 10px;
    cursor: pointer;}

/*клас для логотипу сайту - зображення*/
.product_img{
    height: avto;
    width: 150px;}

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
            <li><a href="cat.php">Чек</a></li>
        </ul>
    </nav>

    <div align="right">  <form action="catalog_pohyk.php" method="post">
                    <input class = "pole" type="text" name="text" placeholder="Найменування позиції">
                        <button class = "btn" type="submit">Пошук на сайті </button>
            </form> </div>
<div align="right">  <form action="catalog_pohykkk.php" method="post">
                    <input class = "pole" type="number" name="code" placeholder="Код позиції">
                        <button class = "btn" type="submit">Пошук на сайті </button>
            </form> </div>
<!-- Результати пошуку користувача -->
      <h1 align="center" >Рузультати пошуку "<?php echo $array; ?>"</h1>


<div class="container">
    <div class="product-container">
        <?php
            /*Делаем выборку строк і преобразовывем полученные данные в нормальный массив*/
            $medicine = mysqli_query($connect, "SELECT * FROM `medicine` WHERE `medicine`.`vendor_code` LIKE '%$array%'");
            $medicine = mysqli_fetch_all($medicine);
        if($medicine != null){
            foreach ($medicine as $medicine) {
                echo "
                    <div class='product'>
                        <img src='vendor/medicine/".$medicine[2]."'>
                        <div class='product-bottom'>
                            <p>".$medicine[1]."</p>
                            <p class='product-price'><span class='product-text-title'>Код: </span>".$medicine[3]."</p>
                            <p class='product-price'><span class='product-text-title'>Ціна: </span>".$medicine[5]." грн<a href='/product.php?id=".$medicine[0]."'><button class='btn-buy'>Детальніше</button></a></p>
                        </div>
                    </div>
                ";
            }}
        else { ?> <h2>Товар в магазині відсунній, або його найменування було введено не правильно</h2> <?php }
        ?>

    </div>
</div>
</body>
</html>

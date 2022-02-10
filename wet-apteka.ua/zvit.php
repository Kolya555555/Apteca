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
<style media="print" type='text/css'>
    #navbar-iframe {display: none; height: 0px; visibility: hidden;}
    .noprint{display: none;}
    body{background: #FFF; color: #000;}
    a {text-decoration: underline; color: #00F;}
</style>
<head>
    <meta charset="UTF-8">
    <title>Звіт</title>
</head>
<style>
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
    padding: 0 10px;
    height: 40px;
    /*outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/}


/*клас для логотипу сайту - зображення*/
.product_img{
    height: avto;
    width: 150px;}

/*Зображення товару*/
.product{
    height: 150px;
    width: 150px;}

.pole{
    width: 35px;
    background: wheat;
    height: 20px;
    border-radius: 6px;}

    /*Налаштування таблички*/
    th, td {padding: 10px;}

    th {background: #606060;
        color: #fff;}

    td { background: #b5b5b5;}
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
     <span class="noprint"><p >Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
    <!-- Виведення меню сайту  -->
    <nav>
       <ul>
            <li><a href="index.php">Робота</a></li>
            <li><a href="sclad.php">Склад</a></li>
            <li><a href="zvit.php">Звіт</a></li>
            <li><a href="zvit_dey.php">Звіт за день</a></li>
        </ul>
    </nav>
</span>
    <h2 align="center" >Продані пропозиції</h2>
    <span class="noprint"><a href="#" class="topNubexq">Вверх</a>
<a href="#top" class="topNubex">Вниз</a></span>
<?php
$prodano = mysqli_query($connect, "SELECT * FROM `prodano`");
$prodano = mysqli_fetch_all($prodano);
if($prodano != null){ //Перевірка  ?>
        <table align="center">
            <tr>
            <th>Назва</th>
            <th><span class="noprint">Зображення</span></th>
            <th><span class="noprint">Артикул</span></th>
            <th>Ціна</th>
            <th>Кількість</th>
            <th>Разом</th>
        </tr>
       <?php
            /*Виводимо всі позиції в БД інтернет-магазину*/
            foreach ($prodano as $prodano) {

                $medicine = mysqli_query($connect, "SELECT * FROM `medicine`");
                $medicine = mysqli_fetch_all($medicine);
                foreach ($medicine as $medicine) {
                     if ($medicine[3] == $prodano[1]){ ?>

                    <tr>
                        <td><div style="overflow: auto; width:auto;height:50px;"><?= $medicine[1] ?></div></td>
                        <td><span class="noprint"><img class = "product" src='vendor/medicine/<?= $medicine[2] ?>'></span></td>
                        <td><span class="noprint"><?= $prodano[1] ?></span></td>
                        <td><?= $prodano[2] ?> грн</td>
                        <td><?= $prodano[3] ?> шт</td>
                        <?
                            $r=$prodano[2]*$prodano[3];
                            $s=$s+$r;
                            ?>
                        <td><?= $r?> грн</td>
                         <?php if($username == 'Саша') { ?><td>
                            <form action="vendor/settings_count_zvit.php" method="post">
                                 <input type="hidden" name="id" value="<?= $prodano[0] ?>">
                                 <input type="hidden" name="name" value="<?= $prodano[1] ?>">
                                 <input class = "pole" type="number" name="count" min = "1" value="<?= $prodano[3] ?>">
                                 <span class="noprint"><button class="btn-buy" type="submit">В склад</button>
                                </span>
                             </form>
                         </td> <?php } ?>
                    </tr>

<?php
            }
            }
            }
        ?>
         </table>
         <div align="center"><h2>Всього замовити потрібно на : <?= $s?> грн</h2><span class="noprint"><a href=""><button class="btn-buy" type="submit" onclick="print()">Друк </button></a></span></div>
        <?php }
        else { ?> <h2 align="center"> Товару вдосталь </h2>
         <?php } ?>
         <a name="top"></a>
    </div>
</div>
</body>
</html>

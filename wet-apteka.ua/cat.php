<?php
//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];

//Не авторизованих користувачів підписувати як гість
if ($username == Null) {
    $_SESSION['username'] = Гість;}
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
    <title>Чек</title>
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

/*Зображення товару*/
.product{
    height: 150px;
    width: 150px;}

/*Поле для введення кількості товару*/
.pole{
    width: 35px;
    background: wheat;
    height: 20px;
    border-radius: 7px;}

/*Оформлення тексту*/
.text{
    color: #000;
    font-size: 16px;
    font-family: cursive;
    width: 30px;}

/*Оформлення тексту*/
.textt{
    color: #000;
    font-size: 18px;
    font-family: cursive;
    width: 300px;}

/*клас для логотипу сайту - зображення*/
.product_img{
    height: avto;
    width: 150px;}

/*Кнопка*/
.btn-buy{
    background: wheat;
    color: green;
    font-size: 17px;
    padding: 0 30px;
    height: 25px;
    outline: none;
    border-radius: 7px;
    cursor: pointer;}

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
            <li><a href="catalog.php">Каталог</a></li>
        </ul>
    </nav></span>
<!-- Виведення головного вмісту сторінки -->
<h1 align="center">Чек</h1>
    <table align="center" >
<?php
    /* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL)*/
    require_once 'config/connect.php';
    /*Делаем выборку строк і преобразовывем полученные данные в нормальный массив*/
    $order = mysqli_query($connect, "SELECT * FROM `order` WHERE `user` = '$username'");
    $order = mysqli_fetch_all($order);
    $a = '0';
        if($order != null){ //Перевірка чи корзина не пуста
        ?> <tr>
            <th>Зображення</th>
            <th>Назва</th>
            <th>Артикул</th>
            <th>Ціна</th>
            <th>Кількість</th>
          </tr>
                <?php
                foreach ($order as $order) {
    $medicine = mysqli_query($connect, "SELECT * FROM `medicine`");
    $medicine = mysqli_fetch_all($medicine);
        foreach ($medicine as $medicine) {
        if($medicine[3] == $order[2]){
        $k = $medicine[6];
        } }
                ?>

                    <tr align="center">
                        <td><img class = "product" src='vendor/medicine/<?= $order[5] ?>'></td>
                        <td class = "textt"><?= $order[1] ?></td>
                        <td class = "text"><?= $order[2] ?></td>
                        <td class = "text"><?= $order[3] ?>_грн</td>
                        <td>
                           <form action="vendor/settings_count.php" method="post">
                                  <input type="hidden" name="id" value="<?= $order[0] ?>">
                                  <input class = "pole" type="number" name="count" min = "1" max = "<?= $k ?>" value="<?= $order[4] ?>">
                                   <span class="noprint"><button class="btn-buy" type="submit">Порахувати</button></span>
                             </form>
                        </td>
                        <td><span class="noprint"><a style="color: red;" href="vendor/delete_shop.php?id=<?= $order[0] ?>">Видалити товар</a></span></td>
                    <tr>
                        <!-- Підрахунок всих товарув -->
                       <?php  $a = $a + ($order[3]*$order[4]); ?>
                    </tr>
                <?php
            }
        ?>
    </table>



    <table align="center"> <tr>
        <td>
            <!-- Виведення суми замовлення -->
            <span class="noprint"><h3> Cума замовлення: <?php echo $a ?> грн</h3></span>
        </td>
        <td><span class="noprint">
            <a style="color: red;" href="catalog.php"><button class="btn-buy" type="submit">Добавити товар</button></a>
        </span></td>
        <td><span class="noprint">
            <a style="color: red;" href="vendor/delete_cat.php?id=<?= $order[6] ?>"><button class="btn-buy" type="submit">Очистити чек</button></a>
        </span></td>
        <td><span class="noprint">
        <a href=""><button class="btn-buy" type="submit" onclick="print()">Друк </button></a>
         </span></td>
         <td><span class="noprint">
            <form action="vendor/ok_zakaz.php" method="post">
                                    <input type="hidden" name="suma" value="<?= $a ?>">
                                    <button class="btn-buy"  type="submit">Чек сформований</button>
                            </form>

        </span></td>
</table>
<span class="noprint"><h3 align="center">Замовлення на <?php echo $a ?> + ПДВ 20%</h3></span> <h2 align="center"> До сплати: <?php echo $a*1.2 ?> грн</h2>
    <?php }
        else { ?> <h2 class="product_text" align="center">Пустий </h2>
        <div align="center"><a style="color: red;" href="catalog.php"><button class="btn-buy" type="submit">Добавити товар</button></a><br>
            </div>
         <?php }
      ?>

</body>
</html>


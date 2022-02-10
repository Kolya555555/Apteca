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

    /* Получаем ID продукта из адресной строки - /medicine.php?id=1 */
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
    <title>Товар</title>
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
    color: black;
    padding: 0 30px;
    height: 25px;
    outline: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;}
/*Поле лоя введення інформації №1*/
.pole{
    width: 35px;
    background: yellow;
    height: 20px;
    border-radius: 10px;}

/*Текст*/
.text{
    height: avto;
    width: 1000px;}

</style>

<body>
    <!-- Виведення шапки сайту -->
<h2 align="center" ><?= $medicine['title'] ?></h2>
<p>Ви ввійшли як <b><?php echo $username; ?></b> | <a href="open.php">Вихід</a></p>
<!-- Виведення меню сайту  -->
    <nav>
       <ul>
            <li><a href="index.php">Робота</a></li>
            <li><a href="sclad.php">Склад</a></li>
            <li><a href="zvit.php">Звіт</a></li>
            <li><a href="cat.php">Чек</a></li>
        </ul>
    </nav>
<!-- Виведення головного вмісту сторінки -->
<div>
    <div >
        <table align="center">
            <tr >
                <td >
                    <h2><div style="overflow: auto; width:250px;height:avto;"><?= $medicine['title'] ?></div></h2>
                    <h3>Артикул: <?= $medicine['vendor_code'] ?></h3>
                    <h3>На складі: <?= $medicine['count'] ?></h3>
                    <h3>Ціна: <?= $medicine['prise'] ?> грн.</h3>
                            <form action="vendor/create_shop.php" method="post">
                                    <input type="hidden" name="id" value="<?= $medicine['id'] ?>">
                                    <input type="hidden" name="title" value="<?= $medicine['title'] ?>">
                                    <input type="hidden" name="vendor_code" value="<?= $medicine['vendor_code'] ?>">
                                    <input type="hidden" name="prise" value="<?= $medicine['prise'] ?>">
                                    <input type="hidden" name="image" value="<?= $medicine['image'] ?>">
                                    <input class = "pole" type="number" name="count" min = "1" max = "<?= $medicine['count'] ?>"value="1">
                                    <button class = "btn-buy" type="submit">В Чек</button>
                            </form>
                </td>
                <td >
                    <img src='vendor/medicine/<?= $medicine['image'] ?>' >
                </td>
             </tr>
        </table>
        <div align="center">
            <h3 class="text"> Опис:<br> <?= $medicine['Description'] ?></h3>
        </div>
    </div>
    
</div>
    <hr> <!-- Ліній -->
</div>
</body>
</html>

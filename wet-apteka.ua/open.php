
<?php
require_once 'config/connect.php';
$user = mysqli_query($connect, "SELECT * FROM `user`");
$user = mysqli_fetch_all($user);

function Login($username, $remember)
{//імя користувача не повинно бути пустим
    if ($username == '')
        return false;
//Запоминаємо імя сесії
    $_SESSION['username'] = $username;
//і в куки, якщо користував обрав галочку
    if ($remember)
        setcookie('username', $username, time() + 3600 * 24 * 7);
//Успішна авторизація
    return true;}

//Сброс авторизації
function Logout()
{//Робимо куки устарівшими
    setcookie('username' , '', time() - 1);
//сброс сесії
    unset($_SESSION['username']);}

//Точка входу в сесію
session_start();
$enter_site = false;
//коли попадаємо на страницу open.php авторизація сброшується
Logout();
//якщо масив POST не пустий, то, обробляємо обробку форми
if(count($_POST) > 0)
    $enter_site = Login($_POST['username'], $_POST['remember'] == 'on');

//Коли авторизація пройдена, перекидаєм пользователя на головну сторінку сайта
if($enter_site)
{

$user = mysqli_query($connect, "SELECT * FROM `user`");
$user = mysqli_fetch_all($user);
    foreach ($user as $user) {
        if ($user[1] == $_POST['username'] && $user[2] == $_POST['password']){
                header('Location: /index.php');
                exit();
            }
        }
    //header('Location: /open.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизація</title>
</head>
<style>

body { background: url(img/fonn.jpg); }


 /*Оформлення текста*/
.product_text1{
     font-size: 20px;
     color: black;}

/*Кнопка*/
.btn-buy{
    background: yellow;
    font-size: 15px;
    padding: 0 30px;
    height: 30px;
    outline: none;
    border-radius: 7px;
    cursor: pointer;}

/*Поле для введення інформації*/
.pole3{
    background: yellow;
    border-radius: 7px;
    font-size: 20px;
    height: 30px;
}
</style>
<body>
    <!-- Виведення логотипу сайту -->

<!-- Виведення головного вмісту сторінки -->
    <h2 align="center">Авторизація у системі</h2>

    <form action="" method="post">
        <div align = "center">
            <p class="product_text1">Введіть Логін</p>
            <input class = "pole3" type="text" name="username" required/><br>
            <p class="product_text1">Введіть Пароль</p>
            <input class = "pole3" type="int" name="password" required/><br>
            <p class="product_text1"> <input type="checkbox" name="remember" />Запам'ятати мене(поставте галочку)</p>
            <button class="btn-buy" type="submit">Ввійти в систему</button>
        </div>
    </form>
</body>
</html>
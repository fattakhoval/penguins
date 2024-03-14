<?php 
session_start();
require "connect.php";


$UserId = $_SESSION['user_id'];

include "header.php";

$query_users = mysqli_fetch_all(mysqli_query($con, "SELECT*FROM `users` WHERE `user_id` = $UserId" ));

var_dump("SELECT*FROM `users` WHERE `user_id` = $UserId");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<h1>Личный кабинет</h1>
	<h2>Пользователь:</h2>

	<!-- <p>Имя: <?=$query_users["name"]?></p>
	<p>Логин: <?=$query_users["login"]?></p> -->

	<div class="account_main">
            <form action="edit-db.php" method='post'>
                <?php foreach($query_users as $item):?>
                    <label for="login">Логин</label>
                    <input type="login" value="<?=$item[3]?>"  id="login" name="login" required>
                    <label for="password">Пароль</label>
                    <input type="password" value="<?=$item[2]?>"  id="pass" name="pass" required>
                    <label for="name">Имя</label>
                    <input type="text" value="<?=$item[1]?>"  id="name" name="name" required>
                
                    <button>Изменить</button> 
                <?endforeach;?>
            </form>
        </div>


	<a href="exit.php">Что бы выйти нажмите по ссылке.</a>

</body>
</html>

<?php

$login = strip_tags(trim($_POST['login']));
$pass = strip_tags(trim($_POST['pass']));

require "connect.php";

    $result = "SELECT*FROM `users` WHERE `login`='$login' and `pass` = '$pass'";
    $result1 = mysqli_query($con, $result);
    $user = mysqli_fetch_assoc($result1); // Конвертируем в массив


if(count($user) == 0){
	echo "Такой пользователь не найден.";
	exit();
}
else if(count($user) == 1){
	echo "Логин или праоль введены неверно";
	exit();
}else{
    setcookie('user', $user['login'], time() + 3600, "/");

    header('Location: page.php');
}




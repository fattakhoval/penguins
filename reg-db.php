<?php 
session_start();
$login =strip_tags(trim($_POST['login'])); // Удаляет все лишнее и записываем значение в переменную //$login
$name =strip_tags(trim($_POST['name']));
$pass =strip_tags(trim($_POST['pass'])); 

if(mb_strlen($login) < 5 || mb_strlen($login) > 100){
	echo "Недопустимая длина логина";
	exit();
}

require "connect.php";

$result1 = mysqli_query($con,"SELECT * FROM `users` WHERE `login` = '$login'");
$user1 = mysqli_fetch_assoc($result1); // Конвертируем в массив
if(!empty($user1)){
	echo "Данный логин уже используется!";
	exit();
}else {

    mysqli_query($con,"INSERT INTO `users` (`login`, `pass`,`name`)VALUES('$login', '$pass', '$name')");
    // setcookie('user', $user1['user_id'], time() + 3600, "/");

	$_SESSION["user_id"] = mysqli_insert_id($con);

    header('Location: page.php');
}

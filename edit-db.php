<?php 
session_start();
require "connect.php";

$user_id = $_SESSION['user_id'];
$Newlogin = trim($_POST['login']);
$Newpass = trim($_POST['pass']);
$Newname = trim($_POST['name']);

$changeUser = mysqli_query($con , "UPDATE `users` SET `name`='$Newname',`pass`='$Newpass',`login`='$Newlogin' WHERE `user_id`=$user_id");


if($changeUser){
    echo "<script>
    alert(\"Данные успешно изменены\");
    location.href='page.php';
    </script>";
}
?>
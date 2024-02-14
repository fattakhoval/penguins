<?php 
var_dump($_COOKIE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>Привет! <?=$_COOKIE["user"]?></h1>

	<a href="exit.php">Что бы выйти нажмите по ссылке.</a>

</body>
</html>

<?php


require "connect.php";

$newImage = $_FILES["newImage"];
$newTitle = $_POST["newTitle"];
$newContent = $_POST["newContent"];
$newCategory = $_POST["newCategory"];

$types = ['image/jpeg', 'image/png'];

if (mb_strlen($newTitle) > 20) {
    echo "<p>слишком много букв в заголовке</p>";
} elseif (!in_array($newImage['type'], $types)) {
    echo 'загрузите файл в формате JPEG или PNG<br>';
} elseif (!is_string($newTitle) || !is_string($newContent) || !is_string($newCategory)) {
    echo 'некорректные данные';
} else {

    $targetFile =  basename($newImage["name"]);

    $quary_info_news = "INSERT INTO news (image, title, content, category_id) VALUES ('$targetFile', '$newTitle', '$newContent', 1)";

    if (mysqli_query($con, $quary_info_news)) {
        echo "новая запись добавлена";
    } else {
        echo "ошибка " . $quary_info_news . "<br>" . mysqli_error($con);
    }
}

?>



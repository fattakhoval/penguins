<?php

include "connect.php";
$news_id = isset( $_GET["new"])?$_GET["new"]:false;



$query_getNew = "SELECT news.*, categories.name FROM news inner join categories on news.category_id = categories.category_id WHERE news_id = $news_id";

$new_info = mysqli_fetch_assoc(mysqli_query($con, $query_getNew));



// $date= date("d.m.Y h:i", strtotime($new_info["publish_date"]));

// var_dump($date);

$month =[
"01"=> "Января",
"02"=> "Февраля",
"03"=> "Марта",
"04"=> "Апреля",
"05"=> "Мая",
"06"=> "Июня",
"07"=> "Июля",
"08"=> "Августа",
"09"=> "Сентярбря",
"10"=> "Октября",
"11"=> "Ноября",
"12"=> "Декабря"
];

// $m_text = $month[substr($date, 3,2)];

// echo($m_text);

function date_new($date_old) {
    global $month;
    $date = date("d.m.Y h:i", strtotime($date_old));
    return substr($date,0,2)." ".$month[substr($date, 3, 2)] . " " . substr($date, 6);
}

$publish_date = date_new($new_info['publish_date']);

$commQuery = mysqli_query($con, "SELECT * FROM comments INNER JOIN users ON users.user_id = comments.user_id WHERE news_id = $news_id");
$comments = mysqli_fetch_all($commQuery);

var_dump("SELECT * FROM Comments INNER JOIN Users ON users.user_id = comments.user_id WHERE news_id = $news_id");
var_dump($commQuery);


// $publish_date = substr($date,0,2)." ".$m_text." ".substr($date,6);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    $news_id = $new_info['news_id'];
    echo "<div class='img'><img src='images/news/" . $new_info['image']. "'>";
    echo "<h1>". $new_info['title']. "</h1>";
    echo "<p>". $new_info['content']. "</p>";
    echo "<i>". $publish_date. "</i>";
    echo "</div>";
        
    
    ?>

<h3 class="mb-3">Комментарии <?=mysqli_num_rows($commQuery)?> <img src="/images/icons/comm.png" alt="" width="20px" height="20px"></h3>




<?php if($news_id){?>

<form action="comment-DB.php" method="POST" style="display:flex; flex-direction:column;">
    <input type="hidden" name="id_new" value="<?=$news_id?>">
    <div class="idk" style="display:flex; flex-direction:column;">
        <label for="comm_txt">Напишите комментарий</label>
        <input type="text" id="comment_text" name="comment_text">
    </div>
    <button type="submit">Отправить</button>
</form>
<?php }?>



<?php if(mysqli_num_rows($commQuery)) {
    foreach ($comments as $comment) { ?>
    <div class="card_comms">
        <div class="card-body">
            <h2><?=$comment[6]?></h2>
            <p><?=date_new($comment[4]);?></p>
            <?=$comment[3]?>
        </div>

    <?php }

} else echo "<i>комментариев нема!</i>";
?>
</body>
</html>
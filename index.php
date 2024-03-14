<?php
include "connect.php"; //вырадение incide включает и выполняет указанный файл

$query_get_category = "select * from categories";

$categories = mysqli_fetch_all(mysqli_query($con, $query_get_category)); //получаем резульатт запроса из переменной guery_get_category и 
//преобращем его в  двуменый массив с построчным получением кортежей из таблицы рещудьтата запроса


include "header.php";


$id_cat = isset($_GET['cat']) ?($_GET['cat']) :false;
$sort= isset($_GET["sort"]) ? $_GET["sort"] :false;


$params= "";

$query= "SELECT * FROM news";

if($id_cat){
    $params.="cat=$id_cat";
    $query = "SELECT * FROM news WHERE category_id=$id_cat";
}

if($sort){
    // $params.="sort=$sort";
    $query="SELECT * FROM news ORDER BY publish_date $sort";
}

if($sort && $id_cat){
    $query = "SELECT * FROM news WHERE category_id=$id_cat ORDER BY publish_date $sort";
}

if($search_res){
    $query = "SELECT * FROM news WHERE title LIKE '%$search_res%'";
};


$paginate_count= 3; // limit n

$page = isset($_GET['page'])?$_GET['page']:1;

$count_news= mysqli_num_rows(mysqli_query($con, $query));

$offset = $page *$paginate_count - $paginate_count; // offset m

$news = mysqli_query($con,$query . " LIMIT $paginate_count OFFSET $offset");

var_dump($params);


?>


        <main>
            <section class="last-news">
                <section class="sort">
                    <h2>Сортировка по дате:</h2>

                <ul class="list-group list-group-horizontal mt-5 mb-3">
                    <li class="list-group-item">
                        <a href="/?sort=ASC<?=($params!='')?'&'.$params:''?>"><img width="20" src="/images/icons/asc-sort.png" alt=""></a>
                    </li>
                    <li class="list-group-item">
                        <a href="/?sort=DESC<?=($params!='')?'&'.$params:''?>"><img width="20" src="/images/icons/desc-sort.png" alt=""></a>
                    </li>
                </ul>

                </section>
                <div class="container-index">
                    <?php

                    

                    if(mysqli_num_rows($news)==0){
                        echo "нет новостей";
                    }else{
                    while($new = mysqli_fetch_assoc($news)){
                    echo "<div class='card'>";
                    $new_id = $new['news_id'];
                    
                    echo "<img src='images/news/" . $new['image']. "'>";
                    echo "<a href = 'oneNew.php?new=$new_id'>". $new['title']."</a>";
                    echo "<p>".$new['content']."</p>";
                    
                    echo  "</div>";
                    }
                  }
                ?>
                </div>
                
            </section>
        </main>

        <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    
    <?php 
    for($i=1; $i <= ceil($count_news/$paginate_count); $i++){?>
        <li class="page-item"><a class="page-link" href="?page=<?=$i?><?=$id_cat?'&id_cat='.$id_cat:''?><?=$sort?'&sort='.$sort:''?>">
            <?=$i?>
        </a></li>
     <?php }?>

    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>


    </header>


</body>

</html>
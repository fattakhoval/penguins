<?php
include "connect.php"; //вырадение incide включает и выполняет указанный файл

$query_get_category = "select * from categories";

$categories = mysqli_fetch_all(mysqli_query($con, $query_get_category)); //получаем резульатт запроса из переменной guery_get_category и 
//преобращем его в  двуменый массив с построчным получением кортежей из таблицы рещудьтата запроса


include "header.php";


$id_cat = isset($_GET['cat']) ?($_GET['cat']) :false;

$query_newcategory = "";

if($id_cat){
    $query_newcategory = "SELECT * FROM news WHERE category_id=$id_cat";
}else{
    $query_newcategory = "select * from news";
    
}


$news = mysqli_query($con,$query_newcategory);


?>


        <main>
            <section class="last-news">
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


    </header>
    <!-- <nav>
        <div class="n_title">
            <h1 class="title">Пингвины</h1>
        </div>

        <div class="n_nav">

        </div>
    </nav> -->

</body>

</html>
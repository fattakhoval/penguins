<?php

include "connect.php";

$queery_category = "SELECT * FROM categories";

$categories = mysqli_fetch_all(mysqli_query($con, $queery_category));

include "header.php";
?>


    <section class="addNews">
        <h1>Добавить новость</h1>

        <form action="createNewValid.php" method="POST" enctype="multipart/form-data" class="newsForm">
            <label for="newImage">Загрузите изображение новости:</label>
            <input type="file" id="newImage" name="newImage" accept="image/*">

            <br>

            <label for="newTitle">Заголовок новости:</label>
            <input type="text" id="newTitle" name="newTitle">

            <br>

            <label for="newContent">Текст новости:</label>
            <input type="text" id="newContent" name="newContent">

            <br>
            <label for="newCategory">Категории:</label>
            <select name="newCategory" id="newCategory">
              <?php
                foreach ($categories as $category)  {
                    $id_cat = $category[0];
                    $name = $category[1];
                    echo "<option value='$id_cat'>$name</option>";
                }
              
              ?>
            </select>

            <br>

            <input type="submit" value="Отправить" class="submit-btn">


        </form>
    </section>

    

    <?php
    
    
    ?>
</body>
</html>
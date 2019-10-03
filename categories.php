<?php include "includes/header.php"; ?>
<?php
    $categories_query = $conn->query("SELECT * FROM book_category");
?>
<div class="container categories">
    <h1 class="text-center mt-5 mb-3">Categories</h1>
    
    <div class="row">
        <?php 
            if ($categories_query->num_rows > 0) {
                        // output data of each row
                        while($row = $categories_query->fetch_assoc()) {
                            echo "<div class='cats col-lg-2 bg-custom-green m-2' style='height:200px;'>";
                                echo "<h3 class='text-center' style='line-height:200px;'><a class='text-white' href='category.php?id=".$row['id']."'>".$row['cat_name']."</a></h3>";
                            echo "</div>";
                        }
            }
        ?>
    </div>

</div>
<?php include "includes/footer.php"; ?>

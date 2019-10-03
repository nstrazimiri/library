<?php include "includes/header.php"; ?>

<?php 

if(isset($_GET['id'])){
    $category_id=$_GET['id'];
        
       $category_name_query= $conn->query("SELECT cat_name FROM book_category WHERE id =".$category_id."");
       $category = $category_name_query->fetch_assoc(); 
    
    $category_query = $conn->query("SELECT * FROM books WHERE category =".$category_id."");
                    
    }else{
        header("Location: index.php");
        exit;
    }

?>

<div class="container"> 
<h1 class="text-center mt-5 mb-3"><?php echo $category['cat_name'];?></h1>
<div class="row">
    <?php 
        if ($category_query->num_rows > 0) {
                        // output data of each row
                        while($row = $category_query->fetch_assoc()) {
                           echo "<div class='col-lg-3'>";
                            echo "<div style='height:400px; background-image:url(images/".$row['cover']."); background-size:cover;'>";
                            echo "</div>";
                            echo "<h3><a href='book.php?id=".$row['id']."'>".$row['title']."</a></h3>";
                            echo "</div>";
                        }
        }else{
           echo "<p class='text-info'>This Category has no books.Turn to <a href='index.php'>Home Page</a></p>";
        }
    ?>
    
</div>



</div>

<?php include "includes/footer.php"; ?>
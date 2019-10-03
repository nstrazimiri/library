<?php include "includes/header.php"; ?>
<?php 
if(isset($_GET['id'])){
    $author_id=$_GET['id'];
       $author_query = $conn->query("SELECT * FROM authors WHERE id=".$author_id."");
        $row = $author_query->fetch_assoc(); 
                    
    }else{
        header("Location: index.php");
        exit;
    }
?>
<div class="container single-author">
    <h1 class="text-center"><?php echo $row['fname'].' '.$row['lname'];?></h1>
    <div class="row">
        <div class="author-image col-lg-6 mx-auto">
            <img class="img-fluid mx-auto d-block" src="images/<?php echo $row['photo'];?>" alt="<?php echo $row['fname'].' '.$row['lname'];?>"/>
        </div>
        <div class="col-lg-8 mx-auto mt-5">
            <p><?php echo $row['bio'];?></p>
        </div>
        <div class="col-lg-8 mx-auto">
            <p>Contact the author</p>
            <p class="h3">
                <?php
                    if(!empty($row['email'])){
                        echo "<a href='mailto:".$row['email']."'><span class='fa fa-envelope'></span></a>";
                    }
                    if(!empty($row['facebook'])){
                            echo "<a class='ml-3' target='_blank' href='".$row['facebook']."'><span class='fab fa-facebook'></span></a>";
                        }
                    if(!empty($row['website'])){
                            echo "<a class='ml-3' target='_blank' href='".$row['website']."'><span class='fa fa-globe'></span></a>";
                        }
                ?>
            </p>
        </div>
    
    </div>
    <hr class="hr"> 
    <h2 class="text-center mt-5 mb-3"> Books from this author</h2>
    <div class="row">
        
    <?php
        $books_query = $conn->query("SELECT * FROM books WHERE author=".$author_id."");
                if ($books_query->num_rows > 0) {
                        // output data of each row
                        while($roww = $books_query->fetch_assoc()) {
                            echo "<div class='col-lg-3'>";
                            echo "<div style='height:400px; background-image:url(images/".$roww['cover']."); background-size:cover;'>";
                            echo "</div>";
                            echo "<h3><a href='book.php?id=".$roww['id']."'>".$roww['title']."</a></h3>";
                            echo "</div>";
                        }
                    }
        
        ?>
    
    
    
    
    </div>
</div>
<?php include "includes/footer.php"; ?>
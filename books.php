<?php include "includes/header.php"; ?>
<?php
    $books_query = $conn->query("SELECT * FROM books");
?>
<div class="container">
    <h1 class="text-center mt-5 mb-3">Books</h1>
    
    <div class="row">
        <?php 
            if ($books_query->num_rows > 0) {
                        // output data of each row
                        while($row = $books_query->fetch_assoc()) {
                            ?>
                                <div class="col-lg-3 mt-3">
                            <div style="width:100%;height:350px; background-image:url(images/<?php echo $row['cover'];?>);background-size:cover;"></div>
                            <h3 class="h4 text-center"><a href="author.php?id=<?php echo $row['id'];?>"><?php echo $row['title']; ?></a></h3>
                        </div>
        <?php
                        }
            }
        ?>
    </div>

</div>
<?php include "includes/footer.php"; ?>

<?php include "includes/header.php"; ?>
<?php
    $authors_query = $conn->query("SELECT * FROM authors");
?>
<div class="container">
    <h1 class="text-center mt-5 mb-3">Authors</h1>
    
    <div class="row">
        <?php 
            if ($authors_query->num_rows > 0) {
                        // output data of each row
                        while($row = $authors_query->fetch_assoc()) {
                            ?>
                                <div class="col-lg-3">
                            <div  style="width:100%;height:350px; background-image:url(images/<?php echo $row['photo'];?>);background-size:cover;"></div>
                            <h3 class="h4 text-center"><a href="author.php?id=<?php echo $row['id'];?>"><?php echo $row['fname'].' '.$row['lname']; ?></a></h3>
                        </div>
        <?php
                        }
            }
        ?>
    </div>

</div>
<?php include "includes/footer.php"; ?>

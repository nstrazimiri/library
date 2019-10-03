<?php include "includes/header.php"?>
<?php 
    if(isset($_GET['id'])){
        $book_id=$_GET['id'];
        $book_query = $conn->query("SELECT 
                            B.title,B.cover,B.author,B.category,
                            A.id AS AID, A.fname,A.lname,A.bio,C.cat_name,C.id AS CID, B.id AS BID 
                            FROM `books` AS B 
	                        JOIN authors AS A on B.author=A.id
                            JOIN book_category C on B.category=C.id 
                            WHERE B.id=".$book_id."");
        $row = $book_query->fetch_assoc(); 
                    
    }else{
        header("Location: index.php");
        exit;
    }
?>
<div class="container single-book">
    <?php
        if($row){                    
    ?>
    <h1 class="text-center"><?php echo $row['title'] ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <img class="book-image float-right" src="images/<?php echo $row['cover']; ?>" alt="<?php echo $row['title'];?>">
        </div>
        <div class="col-lg-6">
            <p class="h3 book-category">Category: <strong><a href="category.php?id=<?php echo $row['CID'];?>"><?php echo $row['cat_name']; ?></a></strong></p>
            <p class="h3 book-author">Author: <strong><a href="author.php?id=<?php echo $row['AID'];?>"><?php echo $row['fname'].' '.$row['lname']; ?></a></strong></p>

            <p class="book-description"><?php
                echo $row['bio'];
            ?></p>
            <p><a class="btn btn-success" href="borrow.php?id=<?php echo $row['BID'];?>">Borrow</a></p>
        </div>'
    
    </div>
        <?php
            
        }else{
            echo "<p class='text-danger'>Book not found. <a href='index.php'>Home Page</a></p>";
        }
    ?>
    <hr class="hr">
    <h2 class="h2 text-center mb-5 mt-5">Suggested Books</h2>
    <div class="row">
    <?php
             $suggested_book = $conn->query("SELECT * FROM books WHERE id<>".$book_id." ORDER BY RAND() LIMIT 4");
                    if ($suggested_book->num_rows > 0) {
                        // output data of each row
                        while($roww = $suggested_book->fetch_assoc()) {
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

<?php include "includes/footer.php"?>
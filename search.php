<?php include "includes/header.php"?>
<?php 
$q='';
 if(isset($_GET['q'])){ 
    $q=$_GET['q'];
  }

  
        $authors_search_query = $conn->query("
          SELECT * FROM `authors` 
          WHERE fname LIKE '%".$q."%' 
          OR lname LIKE '%".$q."%'
          OR bio LIKE '%".$q."%'
          ");

        $books_search_query = $conn->query("
          SELECT * FROM `books` AS B 
            JOIN book_category AS BC
            ON B.category=BC.id
            WHERE B.title LIKE '%".$q."%'
            OR BC.cat_name LIKE '%".$q."%'
          ");
         
 
                    

?>
<div class="container about mt-3">
    <h1 class="text-center">Search Result for <?php echo $q;?></h1>
    <hr>
    <div class="row">
      <?php
        if ($authors_search_query->num_rows > 0) {
      ?>
      <h2 class="col-lg-12 h3 text-center">Authors</h2>
      <?php 

      while($row = $authors_search_query->fetch_assoc()){
        ?>
       <div class="col-lg-2">
          <a href="author.php?id=<?php echo $row['id'];?>">
              <div style="width:100%;height:200px; background-image:url(images/<?php echo $row['photo'];?>);background-size:cover;"></div>
          </a>
          <h3 class="h5 text-center"><a href="author.php?id=<?php echo $row['id'];?>"><?php echo $row['fname'].' '.$row['lname']; ?></a></h3>
        </div>
      <?php 
        }
      }
      ?>
    </div>
    <div class="row mt-2">
      <?php
        if ($books_search_query->num_rows > 0) {
      ?>
      <h2 class="col-lg-12 h3 text-center">Books</h2>
      <?php 

      while($row = $books_search_query->fetch_assoc()){
        ?>
       <div class="col-lg-2">
          <a href="book.php?id=<?php echo $row['id'];?>">
              <div style="width:100%;height:200px; background-image:url(images/<?php echo $row['cover'];?>);background-size:cover;"></div>
          </a>
          <h3 class="h5 text-center"><a href="book.php?id=<?php echo $row['id'];?>"><?php echo $row['title']; ?></a></h3>
        </div>
      <?php 
        }
      }
      ?>
    </div>
</div>

<?php include "includes/footer.php"?>
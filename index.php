<?php
    include "includes/header.php";
?>
        <section id="slider">
            <div id="homeSlider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#homeSlider" data-slide-to="0" class="active"></li>
                    <li data-target="#homeSlider" data-slide-to="1"></li>
                    <li data-target="#homeSlider" data-slide-to="2"></li>
                </ol>
              <div class="carousel-inner">
                <?php 
                    $slides = $conn->query("SELECT * FROM slides");
                    $nr=0;
                        while($slide = $slides->fetch_assoc()) {
                        $class='';
                        if($nr==0){
                            $class='active';
                        }          
                ?>
                <div class="carousel-item <?php  echo $class;?>">
                  <img class="d-block w-100" src="images/<?php echo $slide['photo'];?>" alt="<?php echo $slide['title'];?>">
                  <?php if(!empty($slide['title'])){ ?>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><a href="<?php echo $slide['link'];?>"><?php echo $slide['title']; ?></a></h5>
                    <p><?php echo $slide['content']; ?></p>
                  </div>
                  <?php
                    }
                  ?>
                </div>
                <?php
                $nr++; 
                    }
                ?>
              </div>
              <a class="carousel-control-prev" href="#homeSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#homeSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </section>
        <section id="about-home" class="mt-5">
            <div class="container">
                   <?php
                $home_content_query = $conn->query("SELECT * FROM website_content");
                $home_h2;
                $home_content;
                while($row = $home_content_query->fetch_assoc()){
                  if($row['name']=='home_h2'){
                    $home_h2=$row['content'];
                  }elseif($row['name']=='home_content'){
                    $home_content=$row['content'];
                  }
                }
                
                ?>
                <h1 class="text-center"><?php echo $home_h2; ?></h1>
                <p class="text-center w-75 mx-auto"><?php
                    echo $home_content;
                ?></p>
            </div>
        </section>
        <section id="newest-books" class="mt-5">
            <div class="container">
            <h2 class="text-center">Newest Books</h2>
       
              <div class="newest-books">
                  <?php
                    $newest_books = $conn->query("SELECT *,B.id AS BID FROM books as B JOIN authors as A ON B.author=A.id WHERE B.quantity >0 ORDER BY B.id DESC LIMIT  6");
                    if ($newest_books->num_rows > 0) {
                        // output data of each row
                        while($row = $newest_books->fetch_assoc()) {
                  ?>
                    <div class="card" style="width: 18rem;">
                        <a href="book.php?id=<?php echo $row['BID'];?>">
                             <div style="width:270px;height:400px; background:url(images/<?php echo $row['cover'];?>);background-size:cover;">
                            </div>
                        </a>
<!--                      <img class="card-img-top" src="images/<?php echo $row['cover'];?>" alt="Card image cap">-->
                      <div class="card-body pb-3">
                          <h5 class="card-title text-center"><a href="book.php?id=<?php echo $row['BID'];?>"><?php echo $row['title'];?></a></h5>
                        <p class="card-text text-center">Author: <span><?php echo $row['fname'].' '.$row['lname'];?></span></p>
                        <a href="borrow.php?id=<?php echo $row['BID'];?>" class="btn bg-white btn-sm d-table mx-auto mb-4">Borrow</a>
                      </div>
                    </div>

                  <?php
                        }
                    }
                    ?>
              </div>
            </div>
        </section>
        <section id="popular-books" class="mt-5">
            <div class="container">
            <h2 class="text-center">Most Popular Books</h2>
              <div class="popular-books row">
                 <?php
                $popular_books_query= $conn->query("SELECT Count(*) AS Total, BO.book_id,B.title,B.cover 
                                            FROM `book_orders` AS BO
                                            LEFT JOIN books AS B 
                                                ON BO.book_id=B.id
                                            GROUP BY BO.book_id
                                            ORDER By Total DESC");
                while($row = $popular_books_query->fetch_assoc()) {
                   ?>
                <div class="col-md-4">
                    <div style="height:360px;width:100%;" class="bg-white brdr-green">
                        <a style="max-height: 270px;overflow: hidden;display: block;" href="book.php?id=<?php echo $row['book_id'];?>">
                            <img style="width:100%;" src="images/<?php echo $row['cover'];?>" class="img-fluid img-hover-zoom">
                        </a>
                        <p class="text-center h4 mt-3"><a href="book.php?id=<?php echo $row['book_id'];?>"><?php echo $row['title'];?></a></p>
                    </div>
                </div>
                <?php
                    }
                ?>
              </div>
            </div>
        </section>
        <section id="top-cat-top-auth" class="mt-5">
            <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="text-center text-danger">Top Categories</h2>
                    <div class="row">
                           <?php
                            
                        $top_3_cats= $conn->query("SELECT COUNT(B.category) AS Total,B.category,BC.cat_name 
                                FROM books AS B 
                                JOIN book_category AS BC 
                                on B.category=BC.id 
                                GROUP BY B.category 
                                ORDER BY Total 
                                DESC LIMIT 3");
                        while($row = $top_3_cats->fetch_assoc()) {
                           ?>
                           
                        <div class="col-lg-4">
                            <div class="bg-custom-green cats" style="height: 220px;width:100%;">
                                <h3 class="text-center"><a class="text-white" href="category.php?id=<?php echo $row['category'];?>"><?php echo $row['cat_name'];?></a></h3>
                            </div>
                        </div>

                        <?php 
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="text-center text-danger">Top Authors</h2>
                    <div class="row">
                        <?php
                            
                        $top_3_authors= $conn->query("SELECT COUNT(B.author) AS Total,B.author,A.fname, A.lname,A.photo FROM books AS B JOIN authors AS A on B.author=A.id GROUP BY author ORDER BY Total DESC LIMIT 3");
                            if ($top_3_authors->num_rows > 0) {
                                // output data of each row
                                while($row = $top_3_authors->fetch_assoc()) {
                        ?>
                        <div class="col-lg-4">
                            <a href="author.php?id=<?php echo $row['author'];?>">
                                <div class="authors-img brdr-green" style="width:100%;height:200px; background-image:url(images/<?php echo $row['photo'];?>);background-size:cover;background-position: center;"></div>
                            </a>
                            <h3 class="h5 text-center"><a href="author.php?id=<?php echo $row['author'];?>"><?php echo $row['fname'].' '.$row['lname']; ?></a></h3>
                        </div>
                        <?php }
                            }
                        ?>
                    </div>
                </div>
                </div>
            </div>
        </section>
     <?php
    include "includes/footer.php";
    ?>
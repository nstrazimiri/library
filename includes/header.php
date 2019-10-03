<?php
    session_start(); 
    include "connect.php";
    $categories_query = $conn->query("SELECT * FROM book_category");
    $authors_query = $conn->query("SELECT * FROM authors");
    $template_name=pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Prata|Ubuntu&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" href="css/custom.css" v="<?php echo date('Y i s h');?>">
    <link rel="icon" href="images/logo-b.png">

    <title>MyLibrary | <?php echo ucfirst($template_name); ?></title>
  </head>
  <body class="<?php echo $template_name; ?>">
    <div class="container-fluid">
        <header class="pt-3 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <a href="index.php"><img class="logo" src="images/logo-b.png" alt="library logo"></a>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                            <form class="form-inline md-form form-sm seach-form" action="search.php" method="get">
                                <input class="form-control form-control-sm w-100 p-3" type="text" placeholder="Search" name="q" 
                                  aria-label="Search">
                                <button type="submit"  value=""><i class="fas fa-search" aria-hidden="true"></i></button>
                              </form>
                            </div>
                            <div class="col-lg-3 offset-lg-2">
                              <?php 
                                  if(isset($_SESSION['user_id'])){
                              ?>
                                <a class="text-primary" href="profile.php"><span class="fa fa-user-circle"></span> My Profile</a>
                              <?php }else{
                                ?>
                                <a class=" text-primary" href="login.php"><span class="fa fa-user"></span> Login</a>
                                <?php
                                } 
                              ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <nav class="navbar navbar-expand-sm navbar-light pl-0">
                                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                  </button>

                                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav nav mr-auto">
                                      <li class="nav-item active">
                                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                      </li>
                                      <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="categories.php" id="navbarDropdown" role="button">
                                          Categories
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php 
                                                if ($categories_query->num_rows > 0) {
                                                    // output data of each row
                                                    while($row = $categories_query->fetch_assoc()) {
                                                ?>
                                          <a class="dropdown-item" href="category.php?id=<?php echo $row['id'];?>"><?php echo $row['cat_name']; ?></a>
                                             <?php
                                                    }
                                                }
                                                ?>
                                        </div>
                                      </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="authors.php" id="navbarDropdown" role="button">
                                          Authors
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <?php 
                                                if ($authors_query->num_rows > 0) {
                                                    // output data of each row
                                                    while($row = $authors_query->fetch_assoc()) {
                                                ?>
                                          <a class="dropdown-item" href="author.php?id=<?php echo $row['id'];?>"><?php echo $row['fname'].' '.$row['lname']; ?></a>
                                             <?php
                                                    }
                                                }
                                                ?>
                                        </div>
                                      </li>
                                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a>
                                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a>
                                      </li>
                                    </ul>
                                  </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            <!--row-->
            </div>
        </header>
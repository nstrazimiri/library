<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
include "../includes/connect.php";
if(isset($_SESSION['user_id'])){
    $user_id=$_SESSION['user_id'];
      $user_query = $conn->query("SELECT * FROM users WHERE id=".$user_id."");
      $user = $user_query->fetch_assoc();
      $user_role=$user['role'];
        
        //if logged in user is student or teacher, send them outside of admin
        if($user_role==3 || $user_role==4){
            header("Location: ../index.php");
            exit();
        }

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Library Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        
        <div class="sidebar-brand-text mx-3">Library Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">
          <i class="fas fa-fw fa-arrow-circle-left"></i>
          <span>Website</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>
     <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#content" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-book"></i>
          <span>Content</span>
        </a>
        <div id="content" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Content</h6>
            <a class="collapse-item" href="authors.php">Authors</a>
            <a class="collapse-item" href="books.php">Books</a>
            <a class="collapse-item" href="categories.php">Categories</a>
          </div>
        </div>
      </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contentUser" aria-expanded="true" aria-controls="collapseUsers">
          <i class="fas fa-fw fa-user"></i>
          <span>Users</span>
        </a>
        <div id="contentUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users</h6>
            <a class="collapse-item" href="users.php?r=2">Manager</a>
            <a class="collapse-item" href="users.php?r=3">Teachers</a>
            <a class="collapse-item" href="users.php?r=4">Students</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="orders.php">
          <i class="fas fa-fw fa-atlas"></i>
          <span>Orders</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contentStats" aria-expanded="true" aria-controls="collapseUsers">
          <i class="fas fa-fw fa-chart-bar"></i>
          <span>Stats</span>
        </a>
        <div id="contentStats" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Stats</h6>
            <a class="collapse-item" href="categories-stats.php">Categories Stats</a>
            <a class="collapse-item" href="authors-stats.php">Authors Stats</a>
            <a class="collapse-item" href="orders-stats.php">Orders Stats</a>
          </div>
        </div>
      </li>
      <?php
        if($user_role==1){

       ?>
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item bg-danger">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-calculator"></i>
          <span>Website Content</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Website Content</h6>
            <a class="collapse-item" href="slides.php">Slides</a>
            <a class="collapse-item" href="home-content.php">Home Text</a>
            <a class="collapse-item" href="about-content.php">About Us</a>
            <a class="collapse-item" href="contact-content.php">Contact</a>
          </div>
        </div>
      </li>
      <?php 
        }
      ?>



      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

       <div class="text-center">
          <a href="../logout.php" class="text-white"><span class="fa fa-sign-out-alt text-white"></span> Logout</a>
        </div>
    </ul>
    <!-- End of Sidebar -->
          <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" class="pt-5">


<?php 
  }else{
   header("Location: ../index.php");
    exit();
}


?>
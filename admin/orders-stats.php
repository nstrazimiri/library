<?php include "includes/header.php";

?>
 <?php

$orders_status_query = $conn->query("SELECT COUNT(*) AS Total,order_status.status_name 
FROM `book_orders` 
LEFT JOIN order_status
ON book_orders.status=order_status.status_id
GROUP BY status");

       $all_role_names=array();
                $all_roles_ids=array();
                while($row = $orders_status_query->fetch_assoc()) {
        
                  array_push($all_role_names, ucfirst($row['status_name']));
                  array_push($all_roles_ids, $row['Total']);
                 } 
                 echo "<script>
                 var roles_names = ".json_encode($all_role_names).";
                 var roles_ids=".json_encode($all_roles_ids).";

                 </script>";
 ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

              <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center mb-4">Orders Stats</h1>
             <!-- Bar Chart -->
              <div class="card shadow mb-4 col-md-8 mx-auto">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary text-center">Orders status stats</h6>
                </div>
                <div class="card-body">
                  <div class="chart-bar">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <hr>
                </div>
              </div>
          <!-- Area Chart -->
            <div class="col-md-8 mx-auto">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Orders on each month</h6>
                </div>
                <?php 
                  
                $orders_months_query = $conn->query("SELECT COUNT(*) AS Total, MONTH(borrow_date) AS Month,YEAR(borrow_date) AS Year FROM `book_orders` 
                  GROUP BY YEAR(borrow_date), MONTH(borrow_date)");

                $all_months_names=array();
                $all_months_ids=array();
                while($row = $orders_months_query->fetch_assoc()) {
                
                $monthNum  = $row['Month'];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                $monthName = $dateObj->format('F');
                  array_push($all_months_names, $monthName);
                  array_push($all_months_ids, $row['Total']);
                 } 
                 echo "<script>
                 var months_names = ".json_encode($all_months_names).";
                 var months_totals=".json_encode($all_months_ids).";

                 </script>";

                ?>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Area Chart -->
            <div class="col-md-8 mx-auto">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Orders of each book</h6>
                </div>
                <?php 
                  
                $book_orders_query = $conn->query("SELECT COUNT(BO.book_id) AS Total,B.title
                                                    FROM `book_orders` AS BO
                                                    LEFT JOIN books AS B ON BO.book_id=B.id
                                                    GROUP BY BO.book_id");

                $all_cats=array();
                $all_cats_ids=array();
                $max=0;
                $nr_of_cats=0;
                while($row = $book_orders_query->fetch_assoc()) {
                  if($row['Total']>$max){
                    $max=$row['Total']; 
                  }
                  array_push($all_cats, $row['title']);
                  array_push($all_cats_ids, $row['Total']);
                  $nr_of_cats++;
                 } 
                 echo "<script>var cat_names = ".json_encode($all_cats).";
                 var cat_ids=".json_encode($all_cats_ids).";
                 var max_cat=".$max.";
                 var nr_of_cats=".$nr_of_cats.";

                 </script>";

                ?>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myBarChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
       
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include "includes/footer.php"; ?>
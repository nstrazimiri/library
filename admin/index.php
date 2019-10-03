<?php include "includes/header.php";?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>
          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
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

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> Orders by user roles</h6>
                </div>
                <?php
                $roles_stats_query = $conn->query("SELECT COUNT(*) AS Total,UR.role_name 
                  FROM `book_orders` BO 
                  LEFT JOIN users U
                  ON BO.user_id=U.id
                  LEFT JOIN user_role UR 
                  ON U.role=UR.id
                  GROUP BY U.role ");

                $all_role_names=array();
                $all_roles_ids=array();
                while($row = $roles_stats_query->fetch_assoc()) {
        
                  array_push($all_role_names, ucfirst($row['role_name']).'s');
                  array_push($all_roles_ids, $row['Total']);
                 } 
                 echo "<script>
                 var roles_names = ".json_encode($all_role_names).";
                 var roles_ids=".json_encode($all_roles_ids).";

                 </script>";

                ?>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Teachers
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Students
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include "includes/footer.php"; ?>
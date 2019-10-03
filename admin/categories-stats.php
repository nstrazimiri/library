<?php include "includes/header.php";

?>
 <?php
// $categories_query = $conn->query("SELECT COUNT(B.category) AS Total,B.category,BC.cat_name
//   FROM books AS B 
//   JOIN book_category AS BC 
//   on B.category=BC.id 
//   GROUP BY category ORDER BY Total");
$categories_query = $conn->query("SELECT
    book_category.id,
    book_category.cat_name,
    COUNT(books.category) AS Total
FROM
    book_category LEFT JOIN books
        ON books.category = book_category.id
GROUP BY
    book_category.id, book_category.cat_name");

$all_cats=array();
$all_cats_ids=array();
$max=0;
$nr_of_cats=0;
while($row = $categories_query->fetch_assoc()) {
  if($row['Total']>$max){
    $max=$row['Total']; 
  }
  array_push($all_cats, $row['cat_name']);
  array_push($all_cats_ids, $row['Total']);
  $nr_of_cats++;
 } 
 echo "<script>var cat_names = ".json_encode($all_cats).";
 var cat_ids=".json_encode($all_cats_ids).";
 var max_cat=".$max.";
 var nr_of_cats=".$nr_of_cats.";

 </script>";
 ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

              <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Book Categories Stats</h1>
        
            

                

          <p class="mb-4">The graph below shows home many books are on each category</p>
                  <!-- Bar Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Number of books per category</h6>
                </div>
                <div class="card-body">
                  <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                  </div>
                  <hr>
                </div>
              </div>
       
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include "includes/footer.php"; ?>
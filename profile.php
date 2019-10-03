<?php include "includes/header.php"; 
?>
<div class="container profile pt-4">
	<?php 
		if(isset($_SESSION['user_id'])){
			$user_id=$_SESSION['user_id'];
          $user_query = $conn->query("SELECT * FROM users WHERE id=".$user_id."");
          $user = $user_query->fetch_assoc();
			?>
			<a href="logout.php" class="float-right text-danger"><span class="fa fa-sign-out-alt"></span> Logout</a>
			<h2 class="text-center h2">Welcome <?php echo $user['fname'];?></h2>
			
			<?php
				if($user['role']==1||$user['role']==2){
					?>
					<div class="col-md-6 mx-auto">
						<p class='h2 text-primary'><a href='admin/index.php'><span class='fa fa-tachometer-alt'></span> Admin Area</a></p>
					</div>
					<?php
				}

				//if user is suspended
				if($user['suspended']==1){
					echo "<p class='text-danger col-md-6 mx-auto'>Your account is suspended. Contact our administrator for more.</p>";
				}
			 ?>
			<?php
				$orders_query = $conn->query("SELECT BO.*,B.title,OS.status_name FROM `book_orders` AS BO 
												JOIN books B ON BO.book_id=B.id
											    JOIN order_status OS ON BO.status=OS.status_id 
											    WHERE user_id=".$user_id."");
				if($orders_query->num_rows>0){
					echo "<h3 class='h3 text-primary'>Your ordered books</h3>";
					
					echo "<table class='table table-bordered'>";
					echo "
						<thead>
	                    <tr>
	                      <th>Nr</th>
	                      <th>Title</th>
	                      <th>Borrow Date</th>
	                      <th>Return Date</th>
	                      <th>Status</th>
	                    </tr>
	                  </thead>
	                  <tbody>";

					while($orders = $orders_query->fetch_assoc()){
          				echo "<tr>";
	          				echo "<td>".$orders['id']."</td>";
	          				echo "<td>".$orders['title']."</td>";
	          				echo "<td>".$orders['borrow_date']."</td>";
	          				echo "<td>".$orders['return_date']."</td>";
	          				echo "<td class='text-";
	          				if($orders['status']==1){
	          					echo "warning";
	          				}elseif ($orders['status']==2) {
	          					echo "primary";
	          				}elseif ($orders['status']==3) {
	          					echo "success";
	          				}elseif ($orders['status']==4) {
	          					echo "danger";
	          				}

	          				echo "'>".$orders['status_name']."</td>";
          				echo "</tr>";
          			}
          			echo "</tbody></table>";
				}
          		
				

			?>
	<?php
		}else{
	?>
	<div class="col-md-6 mx-auto">
		<p class="text-danger">You should be logged in to access this page</p>
		<p class="text-primary h2"><a href="login.php"> <span class="fa fa-user"></span> Login</a></p>
	</div>
	<?php
		}
	?>
</div>
<?php include "includes/footer.php"; ?>
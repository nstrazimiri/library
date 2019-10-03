<?php include "includes/header.php"; 
?>
<div class="container profile">
	<?php 
		if(isset($_SESSION['user_id'])){
			$user_id=$_SESSION['user_id'];
          $user_query = $conn->query("SELECT *,U.id AS UID FROM `users` AS U JOIN user_role AS UR on U.role=UR.id WHERE U.id=".$user_id."");
          $user = $user_query->fetch_assoc();
          $book_id=$_GET['id'];
          $book_query = $conn->query("SELECT * FROM books WHERE id=".$book_id."");
          $book = $book_query->fetch_assoc();
          $days=0;
          $suspended=$user['suspended'];
          $str='';
          if($user['role']==4){
          	$days=30;
          	$str='after '.$days.' days';
          	echo "<script>
          		var days=31;
          	</script>";
          }elseif($user['role']==3){
          	$days=120;
          	$str='after '.$days.' days';
          	echo "<script>
          		var days=121;
          	</script>";
          }
			?>
			<div class="col-md-6 mx-auto">
			<?php 
				if(isset($_POST['borrowBook'])){
					$book_quantity=$book['quantity'];
					if($book_quantity>0){
						$book_id=$_POST['book_id'];
						$pickup_date=$_POST['pickup_date'];
						$return_date=$_POST['return_date'];

						$check_query_ordered=$conn->query("SELECT * FROM `book_orders` WHERE user_id='".$user_id."' AND book_id='".$book_id."' AND status=1");

						$check_query_borrow=$conn->query("SELECT * FROM `book_orders` WHERE user_id='".$user_id."' AND book_id='".$book_id."' AND (status=2 OR status=4)");

						$check_query_total=$conn->query("SELECT * FROM `book_orders` WHERE user_id='".$user_id."' AND (status=1 OR status=2 OR status=4)");

						if($check_query_ordered->num_rows>0){
							echo "<p class='text-danger'> You have ordered this book already.Come to the office to borrow it.</p>";
						}elseif($check_query_borrow->num_rows>0){
							echo "<p class='text-danger'> You have borrowed this book already.</p>";
						}elseif($check_query_total->num_rows>4){
							echo "<p class='text-danger'> You can't borrow more than 5 book. Return those you have borrowed, to take more books.</p>";
						}else{
							$order_query = $conn->query("INSERT INTO `book_orders`(`user_id`, `book_id`, `borrow_date`, `return_date`, `status`) VALUES ('".$user_id."','".$book_id."','".$pickup_date."','".$return_date."','1')");
	          				if($order_query){
	          					          $book_query = $conn->query("UPDATE `books` SET `quantity`='".($book_quantity-1)."' WHERE `id`=".$book_id."");

	          					echo "<p class='text-success'>Book ordered successfully.</p>";
	          					echo "<p class='text-success'>Please come to our officess on ".$pickup_date.", to get the book.</p>";
	          					echo "<p class='h2 text-primary'><a href='profile.php'><span class='fa fa-user-circle'></span> My Profile</a></p>";
	                        	echo "<p class='h2 text-primary'><span class='fa fa-home></span>Home</p>";
	          				}
						}
						

					}else{
						echo "<p class='text-danger'>Sorry we don't have this book anymore in our library.<br> Please check again later.</p>";
					}

				}else{
			?>
		</div>
		<?php if($suspended==0){?>
		<div class="col-md-6 mx-auto mt-3">
			<p class="">Hi <i><?php echo $user['fname'];?></i>, you're about to borrow the book "<strong><?php echo $book['title'];?></strong>".</p>
			<p> Since you are <strong><i><?php echo $user['role_name'];?></i></strong> you need to return the book <?php echo $str;?>.</p>
			<p>When are you coming to pickup the book ? </p>
			<form class="form" action="borrow.php?id=<?php echo $book_id; ?>" method="post">
				<div class="form-group">
					<label for="pickup_date"><strong>Pickup date</strong></label> 
					<input type="hidden" name="book_id" value="<?php echo $book_id;?>">
					<input  required type="date" name="pickup_date" id="pickup_date" class="form-control" onchange="display_date()">
					<input type="hidden" name="return_date" id="return_date">
				</div>
				<p id="return-date"> </p>
				<input type="submit" name="borrowBook" value="Borrow" class="btn btn-primary">
			</form>
		</div>
		<?php
			}else{
			?>
			<div class="col-md-6 mx-auto mt-3">
				<p class="text-danger">Your account is suspended. You cant borrow any book.</p>
			</div>
			<?php
			}
		 ?>
	<?php
			}
		}else{
	?>
	<div class="col-md-6 mx-auto">
		<p class="text-danger">You need to be logged in in order to borrow a book.</p>
		<p class="text-primary h2"><a href="login.php"> <span class="fa fa-user"></span> Login</a></p>
	</div>
	<?php
		}
	?>
</div>
<?php include "includes/footer.php"; ?>
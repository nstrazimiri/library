<?php include "includes/header.php" ?>
<div class="container login text-white">
    <?php
        if(isset($_POST['login'])){
        	echo "<div class='col-md-6 mx-auto mt-4'>";
            $errors=array();
            $email=$_POST['email'];
            $password=$_POST['password'];
            
             $user_exists = $conn->query("SELECT * FROM users WHERE email='".$email."'");
                    if ($user_exists->num_rows > 0) {
                        $user= $user_exists->fetch_assoc();
                        $strong_pass=md5("1&jM/".$password."12Gh.");
                        if($strong_pass==$user['password']){
                            
                            $_SESSION["user_id"] = $user['id'];


                            echo "<p class='h3 text-success'>Logged in successfully</p>";
                            if($user['role']==2||$user['role']==1){
                            	echo "<p class='h2 text-primary'><a href='admin/index.php'><span class='fa fa-tachometer-alt'></span> Admin Area</a></p>";
                            }
                        	echo "<p class='h2 text-primary'><a href='profile.php'><span class='fa fa-user-circle'></span> My Profile</a></p>";
                        	echo "<p class='h2 text-primary'><span class='fa fa-home></span>Home</p>";

                            
                        }else{
                            echo "
                        <p class='h3 text-danger'>Incorrect Password </p>";
                        }
                        
                    }else{
                        echo "
                        <p class='h3 text-danger'>Username doesn't exist. </p>
                        <p class='h4 text-info'><a href='register.php'>Register ?</a></p>";
                    }
                    echo "</div>";
        }elseif(isset($_SESSION['user_id'])){
        	?>
        	<div class="col-md-6 mx-auto mt-4">
        		<p class="h4 text-danger">You are already logged in</p>
        		<?php
        		 if($user['role']==2||$user['role']==1){
                            	echo "<p class='h2 text-primary'><a href='admin/index.php'><span class='fa fa-tachometer-alt'></span> Admin Area</a></p>";
                            }
                ?>
        		<p class="h4 text-success"><a href="profile.php"><span class="fa fa-user-circle"></span> Profile</a></p>
        		<p class="h4 text-success"><a href="index.php"><span class="fa fa-home"></span> Home</a></p>

        	</div>
        	<?php

        }else{

    ?>
	<div class="d-flex justify-content-center h-100">
		<div class="card mt-5">
			<div class="card-header">
				<h3>Sign In</h3>
			</div>
			<div class="card-body">
				<form method="post" action="login.php">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" name="email" class="form-control" placeholder="email">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="password">
					</div>
					<div class="form-group">
						<input type="submit" name="login" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="register.php">Sign Up</a>
				</div>

			</div>
		</div>
	</div>
	<?php 
	}
	?>
</div>
<?php include "includes/footer.php"; ?>
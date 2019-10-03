<?php include "includes/header.php" ?>
<div class="container login text-white">
    <?php 
        $register_ok=false;
        if(isset($_POST['register'])){
            $errors=array();
            
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $repassword=$_POST['password2'];
            
            if(empty($fname)){
                array_push($errors,"Please enter your first name");
            }
            if(empty($lname)){
                array_push($errors,"Please enter your last name");
            }
            if(empty($email)){
                array_push($errors,"Please enter your email");
            }
            if(strlen($password)<5){
                array_push($errors,"Please enter a password with more than 5 characters");
            }else{
                 if(strlen($password!=$repassword)){
                array_push($errors,"Please re enter the same password");
            }
            }
           
            
            if(!empty($errors)){
                echo "<ul class='text-danger mt-5 w-50 mx-auto'>";
                    foreach($errors as $error){
                        echo "<li>".$error."</li>";
                    }
                echo "</ul>";
            }else{
                //check if user exists
                 $check_query=$conn->query("SELECT * FROM users WHERE email='".$email."'");
                if ($check_query->num_rows > 0) {
                    echo "
                    <p class='text-center h3 text-danger'>Username with E-mail: ".$email."  already exists. </p>
                    <p class='text-center h4 text-info'><a href='login.php'>Login</a> or <a href='reset_password.php'>Rest password?</a></p>";
                }else{//if not, proceed inserting the user to the database
                    
                     $strong_pass=md5("1&jM/".$password."12Gh.");
                
                    $insert_query=$conn->query("INSERT INTO `users`(`fname`, `lname`, `email`, `password`, `role`) VALUES ('".$fname."','".$lname."','".$email."','".$strong_pass."',4)");
                    echo "<div class='col-md-6 mx-auto'>";
                    if($insert_query){
                        echo "
                        <p class=' h2 mt-5 text-success'>User created successfully.</>
                        <p class='h3'> <a href='login.php'>Login ?</a></p>";
                        $register_ok=true;
                    }else{
                        echo "<p class='text-danger text-center'>We could'nt create a user. Please check your data or try again later.</p>";

                    }
                    echo "</div>";
                }

               
            }
        }
    ?>
    <?php if(!isset($_POST['register'])&&!($register_ok)){ ?>
	<div class="d-flex justify-content-center h-100">
		<div class="card mt-5">
			<div class="card-header">
				<h3>Register</h3>
			</div>
			<div class="card-body">
				<form action="register.php" method="POST">
					<div class="form-group">
						<label for="fname">First Name</label>
						<input id="fname" type="text" class="form-control" name="fname" placeholder="First Name">
					</div>
                    <div class="form-group">
						<label for="lname">Last Name</label>
						<input id="lname" type="text" class="form-control" name="lname" placeholder="Last Name">
					</div>
                    <div class="form-group">
						<label for="email">E-mail</label>
						<input id="email" type="email" class="form-control" name="email" placeholder="E-mail">
					</div>
					<div class=" form-group">
						<label for="1password">Password</label>
						<input id="1password" type="password" name="password" class="form-control" placeholder="Password">
					</div>
                    <div class=" form-group">
						<label for="2password">Re enter Password</label>
						<input id="2password" type="password" name="password2" class="form-control" placeholder="Re enter Password">
					</div>
					<div class="form-group">
						<input type="submit" name="register" value="Register" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Already have an account?<a href="login.php">Login</a>
				</div>
			</div>
		</div>
	</div>
        <?php } ?>
</div>
<?php include "includes/footer.php"; ?>
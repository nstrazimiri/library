<?php include "includes/header.php"; 

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

?>
<div class="container logout pt-5">
	<div class="col-md-6 mx-auto">
		<p class="h4 text-success">You are logged out successfully.</p>
		<p class="h4 text-success"><a href="index.php"><span class="fa fa-home"></span> Home</a></p>
</div>
</div>
<?php include "includes/footer.php"; ?>
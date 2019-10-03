<?php 
if(isset($_SESSION['user_id'])){
    $user_id=$_SESSION['user_id'];
      $user_query = $conn->query("SELECT * FROM users WHERE id=".$user_id."");
      $user = $user_query->fetch_assoc();
      $user_role=$user['role'];
        
        if($user_role!=1){
            echo "<script>
            	window.location.replace('index.php');
            </script>";
        }
}

?>
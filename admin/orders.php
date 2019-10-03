<?php include "includes/header.php";

?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          
            <?php 

            
             //if user updates an order
                if(isset($_POST['editorder'])){
                    $status=$_POST['status'];
                    $edit_id=$_POST['editid'];
                    
                    $update_query=$conn->query("UPDATE `book_orders` SET `status`='".$status."' WHERE `id`=".$edit_id."");
                    
                    if($update_query){
                        echo "<p class='text-success'>Order Updated.</p>";
                        echo "<p class='text-primary'><a href='orders.php'>View All Orders</a></p>";
                    }
                }
                
            
                if(isset($_GET['edit'])){
                    $edit_id=$_GET['edit'];
                    $edit_order_query = $conn->query("
                      SELECT BO.*,B.title,OS.status_name,U.fname,U.lname,U.role
                        FROM `book_orders` AS BO 
                        JOIN books B ON BO.book_id=B.id
                        JOIN order_status OS ON BO.status=OS.status_id 
                        JOIN users U ON BO.user_id=U.id 
                         WHERE BO.id=".$edit_id."");
                    $row = $edit_order_query->fetch_assoc();
                    $role_query=$conn->query("
                          SELECT * FROM user_role WHERE id=".$row['role']."
                        ");
                      $role_name=$role_query->fetch_assoc();

                    ?>
                    <h1 class="h3 mb-2 text-gray-800 text-center text-capitalize">Editing Order</h1>
                    <form class="edit-orders" action="orders.php" method="post">
                        <div class="form-group row">
                          <div class="col-md-6">
                              <label for="fullname">User Name</label>
                                <input disabled type="text" class="form-control form-control-user" name="fullname" id="fullname" value="<?php echo $row['fname'].' '.$row['lname'];?>">
                              <input type="hidden" name="editid" value="<?php echo $edit_id;?>"/>
                          </div>
                        </div>
                        <div class="form-group row">
                         <div class="col-md-6">
                              <label for="title">Book Title</label>
                            <input disabled type="text" class="form-control form-control-user" name="title" id="title" value="<?php echo $row['title'];?>">
                          </div>
                        </div>
                        <div class="form-group row">
                         <div class="col-md-6">
                              <label for="user_role">User Role</label>
                            <input disabled type="text" class="form-control form-control-user" name="user_role" id="user_role" value="<?php echo $role_name['role_name'];?>">
                          </div>
                        </div>
                        <div class="form-group row">
                         <div class="col-md-6">
                              <label for="borrow_date">Borrow Date</label>
                            <input disabled type="text" class="form-control form-control-user" name="borrow_date" id="borrow_date" value="<?php echo $row['borrow_date'];?>">
                          </div>
                          <div class="col-md-6">
                              <label for="return_date">Return Date</label>
                            <input disabled type="text" class="form-control form-control-user" name="return_date" id="return_date" value="<?php echo $row['return_date'];?>">
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 mt-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <?php 
                                    $status_query = $conn->query("SELECT * FROM order_status");
                                    
                                    while($status = $status_query->fetch_assoc()){
                                    echo "<option class='text-capitalize' value=".$status['status_id']."";
                                        if($row['status']==$status['status_id']){
                                            echo " selected";
                                        }
                                    echo ">".ucfirst($status['status_name']);
                                    echo "</option>";    
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-2">
                            <input type="submit" class="form-control btn-primary" value="Update" name="editorder">
                          </div>
                        </div>
                      </form>
            <?php
                }else{
            ?>
                <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center text-capitalize">Orders</h1>
          <p class="mb-4">Below are listed all orders.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th>Nr</th>
                        <th>User Name</th>
                        <th>Book Title</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>User Role</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                  <tbody>
                      <?php
                    $orders_query = $conn->query("
                        SELECT BO.*,B.title,OS.status_name,U.fname,U.lname,U.role
                        FROM `book_orders` AS BO 
                        JOIN books B ON BO.book_id=B.id
                        JOIN order_status OS ON BO.status=OS.status_id 
                        JOIN users U ON BO.user_id=U.id 
                          ");
                    while($row = $orders_query->fetch_assoc()) { 
                      $role_query=$conn->query("
                          SELECT * FROM user_role WHERE id=".$row['role']."
                        ");
                      $role_name=$role_query->fetch_assoc();

                      ?>
                    <tr>
                      <td><?php echo  $row['id'];?></td>
                      <td><?php echo  $row['fname'].' '.$row['lname'];?></td>
                      <td><?php echo  $row['title'];?></td>
                      <td><?php echo  $row['borrow_date'];?></td>
                      <td><?php echo  $row['return_date'];?></td>
                      <td class="text-capitalize text-<?php 
                          if($row['status']==1){
                            echo "warning";
                          }elseif ($row['status']==2) {
                            echo "primary";
                          }elseif ($row['status']==3) {
                            echo "success";
                          }elseif ($row['status']==4) {
                            echo "danger";
                          }

                      ?>

                      "><?php echo  $row['status_name'];?></td>
                      <td><?php echo  $role_name['role_name'];?></td>
                      <td>
                          <span><a class="text-primary" href="orders.php?edit=<?php echo $row['id'];?>">Edit</a></span>
          
                        </td>
                    </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
            <?php }
            ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include "includes/footer.php"; ?>
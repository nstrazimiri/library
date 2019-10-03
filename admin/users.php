<?php include "includes/header.php";
$role='4';
if(isset($_GET['r'])){
    $role=$_GET['r'];
}
$role_query = $conn->query("SELECT * FROM user_role WHERE id=".$role."");
            $roww = $role_query->fetch_assoc();
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          
            <?php 

            
             //if user updates a category
                if(isset($_POST['edituser'])){
                    $role=$_POST['role'];
                    $suspended=$_POST['suspended'];
                    $edit_id=$_POST['editid'];
                    
                    $update_role_query=$conn->query("UPDATE `users` SET `role`='".$role."' WHERE `id`=".$edit_id."");

                    $update_suspended_query=$conn->query("UPDATE `users` SET `suspended`='".$suspended."' WHERE `id`=".$edit_id."");
                    
                    if($update_role_query&&$update_suspended_query){
                        echo "<p class='text-success'>User Updated.</p>";
                        echo "<p class='text-primary'><a href='users.php?r=".$role."'>View All Users</a></p>";
                    }
                }
                
            
                if(isset($_GET['edit'])){
                    $edit_id=$_GET['edit'];
                    $edit_user_query = $conn->query("SELECT * FROM users WHERE id=".$edit_id."");
                    $row = $edit_user_query->fetch_assoc();
                    ?>
                    <h1 class="h3 mb-2 text-gray-800 text-center text-capitalize">Editing User</h1>
                    <form class="edit-category" action="users.php?r=<?php echo $role;?>" method="post">
                        <div class="form-group row">
                          <div class="col-md-6">
                              <label for="fullname">Full Name</label>
                                <input disabled type="text" class="form-control form-control-user" name="fullname" id="fullname" value="<?php echo $row['fname'].' '.$row['lname'];?>">
                              <input type="hidden" name="editid" value="<?php echo $edit_id;?>"/>
                          </div>
                        <div class="col-md-6">
                              <label for="email">Email</label>
                            <input disabled type="text" class="form-control form-control-user" name="fullname" id="fullname" value="<?php echo $row['email'];?>">
                              <input type="hidden" name="editid" value="<?php echo $edit_id;?>"/>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 mt-3">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <?php 
                                    $role_query = $conn->query("SELECT * FROM user_role WHERE id<>1");
                                    
                                    while($role = $role_query->fetch_assoc()){
                                    echo "<option value=".$role['id']."";
                                        if($row['role']==$role['id']){
                                            echo " selected";
                                        }
                                    echo ">".ucfirst($role['role_name']);
                                    echo "</option>";    
                                    }
                                    ?>
                                </select>
                            </div>
                                <div class="col-md-3 mt-3">
                                <label for="suspended">Suspended</label>
                                <select name="suspended" id="suspended" class="form-control">
                                      <option
                                        <?<?php 
                                          if($row['suspended']==1){
                                            echo " selected";
                                          }
                                         ?>
                                       value="1">Yes</option>
                                      <option 
                                        <?<?php 
                                          if($row['suspended']==0){
                                            echo " selected";
                                          }
                                         ?>
                                      value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-2">
                            <input type="submit" class="form-control btn-primary" value="Update" name="edituser">
                          </div>
                        </div>
                      </form>
            <?php
                }else{
            ?>
                <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center text-capitalize"><?php echo $roww['role_name'];?>s</h1>
          <p class="mb-4">Below are listed all <?php echo $roww['role_name'];?>s.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nr</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>E-mail</th>
                      <th>Role</th>
                      <th>Is Suspended</th>
                        <th>Edit / Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                    $categories_query = $conn->query("SELECT *,U.id AS UID FROM `users` AS U JOIN user_role AS UR on U.role=UR.id WHERE role=".$role."");
                    while($row = $categories_query->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo  $row['id'];?></td>
                      <td><?php echo  $row['fname'];?></td>
                      <td><?php echo  $row['lname'];?></td>
                      <td><?php echo  $row['email'];?></td>
                      <td><?php echo  $row['role_name'];?></td>
                      <td><?php if($row['suspended']==0){echo "No";}else {echo "Yes";};?></td>
                      <td>
                          <span><a class="text-primary" href="users.php?edit=<?php echo $row['UID'];?>">Edit</a></span> /
                        <span><a class="text-danger" href="users.php?delete=<?php echo $row['UID'];?>">Delete</a></span>
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
<?php include "includes/header.php";

?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

              <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Authors</h1>
            <?php 
                //if user adds an author
                if(isset($_POST['addauthor'])){
                    $fname=mysqli_real_escape_string($conn,$_POST['fname']);
                    $lname=mysqli_real_escape_string($conn,$_POST['lname']);
                    $bio=mysqli_real_escape_string($conn,$_POST['bio']);
                    $email=mysqli_real_escape_string($conn,$_POST['email']);
                    $facebook=mysqli_real_escape_string($conn,$_POST['facebook']);
                    $website=mysqli_real_escape_string($conn,$_POST['website']);

                    
                    $target_dir = "../images/";
                     $target_file = $target_dir .basename($_FILES['photo']['name']);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $full_name=$fname.'_'.$lname;
                    $fname_modified= str_replace(' ', '_', $full_name);

                    $file_name=$fname_modified.'_'.rand(0, 30).'.'.$imageFileType;
                    $target_file = $target_dir .$file_name ;
                    // Check if image file is a actual image or fake image
                    
                        $check = getimagesize($_FILES["photo"]["tmp_name"]);
                        if($check !== false) {
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
                    // Check file size
                    if ($_FILES["photo"]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                             $insert_query=$conn->query("INSERT INTO `authors`(`fname`,`lname`,`bio`,`email`,`photo`,`facebook`,`website`) VALUES ('".$fname."','".$lname."','".$bio."','".$email."','".$file_name."','".$facebook."','".$website."')");
                            if($insert_query){
                                echo "<p class='text-success'>Author added.</p>";
                                echo "<p class='text-primary'><a href='authors.php'>View All Authors</a></p>";
                            }
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }


                    
                   
                }
                //if user deletes one of the cateogires
                if(isset($_GET['delete'])){
                    
                    $delete_id=$_GET['delete'];
                    $delete_query=$conn->query("DELETE FROM authors WHERE id=".$delete_id."");
                    if($delete_query){
                        echo "<p class='text-success'>Author deleted.</p>";
                        echo "<p class='text-primary'><a href='authors.php'>View All Authors</a></p>";
                    }
                }
            
             //if user updates a author
                if(isset($_POST['editauthor'])){
                    $edit_id=$_POST['editid'];
                    $fname=mysqli_real_escape_string($conn,$_POST['fname']);
                    $lname=mysqli_real_escape_string($conn,$_POST['lname']);
                    $bio=mysqli_real_escape_string($conn,$_POST['bio']);
                    $email=mysqli_real_escape_string($conn,$_POST['email']);
                    $facebook=mysqli_real_escape_string($conn,$_POST['facebook']);
                    $website=mysqli_real_escape_string($conn,$_POST['website']);
                    
                    $new_photo=false;
                    if(isset($_FILES['photo']['name'])){
                        $new_photo=$_FILES['photo']['name'];
                    }
                    $placeholderImg=$_POST['placeholderImg'];
                    
                    if($new_photo){
                    $target_dir = "../images/";
                     $target_file = $target_dir .basename($_FILES['photo']['name']);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $file_name=$fname.'_'.$lname.'_'.rand(0, 30).'.'.$imageFileType;
                    $target_file = $target_dir .$file_name ;
                    // Check if image file is a actual image or fake image
                    
                        $check = getimagesize($_FILES["photo"]["tmp_name"]);
                        if($check !== false) {
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }
                    // Check file size
                    if ($_FILES["photo"]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                       if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                             
                           $update_query=$conn->query("UPDATE `authors` SET `fname`='".$fname."',`lname`='".$lname."',`bio`='".$bio."',`email`='".$website."',`photo`='".$file_name."',`facebook`='".$facebook."',`website`='".$website."' WHERE `id`=".$edit_id."");
                           
                            if($update_query){
                                echo "<p class='text-success'>Author Updated.</p>";
                                echo "<p class='text-primary'><a href='authors.php'>View All Authors</a></p>";
                            }
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                        
                    }
                    }else{
                    $update_query=$conn->query("UPDATE `authors` SET `fname`='".$fname."',`lname`='".$lname."',`bio`='".$bio."',`email`='".$email."',`photo`='".$placeholderImg."',`facebook`='".$facebook."',`website`='".$website."' WHERE `id`=".$edit_id."");
                    
                    if($update_query){
                        echo "<p class='text-success'>Author Updated.</p>";
                        echo "<p class='text-primary'><a href='authors.php'>View All Authors</a></p>";
                    }else{
                        echo("Error description: " . mysqli_error($conn));
                    }
                    }

                 
                   

                }
                
                //if the user clicked add button
                if(isset($_GET['add'])){
                    ?>
                    <form class="add-author" action="authors.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="fname">First Name</label>
                            <input type="text" class="form-control form-control-user" name="fname" id="fname" placeholder="First  Name">
                          </div>
                            <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="lname">Last Name</label>
                            <input type="text" class="form-control form-control-user" name="lname" id="lname" placeholder="Last  Name">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" class="form-control" cols="6" rows="4">
                            
                            </textarea>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4 mb-4 mb-sm-4">
                              <label for="email">E-mail</label>
                              <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="E-mail">
                          </div>
                            <div class="col-sm-4 mb-4 mb-sm-4">
                              <label for="facebook">Facebook</label>
                              <input type="url" class="form-control form-control-user" name="facebook" id="facebook" placeholder="Facebook">
                          </div>
                            <div class="col-sm-4 mb-4 mb-sm-4">
                              <label for="website">Website</label>
                              <input type="url" class="form-control form-control-user" name="website" id="website" placeholder="Website">
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control">
                            </div>
                        </div>
                        <div class="form-group-row">
                          <div class="col-md-2">
                            <input type="submit" class="form-control btn-primary" value="Add" name="addauthor">
                          </div>
                        </div>
                      </form>
            
            <?php
                    
                }else if(isset($_GET['edit'])){
                    $edit_id=$_GET['edit'];
                    $edit_author_query = $conn->query("SELECT * FROM authors WHERE id=".$edit_id."");
                    $row = $edit_author_query->fetch_assoc();
                    ?>
                    <form class="add-author" action="authors.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="editid" value="<?php echo $edit_id;?>">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="fname">First Name</label>
                            <input required type="text" class="form-control form-control-user" name="fname" id="fname" value="<?php echo $row['fname'];?>">
                          </div>
                            <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="lname">Last Name</label>
                            <input required type="text" class="form-control form-control-user" name="lname" id="lname" value="<?php echo $row['lname'];?>">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="bio">Bio</label>
                            <textarea required id="bio" name="bio" class="form-control" cols="6" rows="4"><?php echo $row['bio'];?>
                            </textarea>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4 mb-4 mb-sm-4">
                              <label for="email">E-mail</label>
                              <input required type="email" class="form-control form-control-user" name="email" id="email" value="<?php echo $row['email'];?>">
                          </div>
                            <div class="col-sm-4 mb-4 mb-sm-4">
                              <label for="facebook">Facebook</label>
                              <input required type="url" class="form-control form-control-user" name="facebook" id="facebook" value="<?php echo $row['facebook'];?>">
                          </div>
                            <div class="col-sm-4 mb-4 mb-sm-4">
                              <label for="website">Website</label>
                              <input required type="url" class="form-control form-control-user" name="website" id="website" value="<?php echo $row['website'];?>">
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 pos-relative">
                                <span id="rmvx" class="pos-absolute img-auth-delete" onclick="removeImage()">x</span>
                            <label for="photo">Photo</label>
                                <img id="alreadyImg" class="img-fluid" src="../images/<?php echo $row['photo'];?>"/>
                            <input id="placeholderImg" class="form-control" type="text" disabled value="<?php echo $row['photo'];?>"/><br>
                                <input name="placeholderImg" type="hidden" value="<?php echo $row['photo'];?>"/>
                            <input type="file" name="photo" id="photo" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group-row">
                          <div class="col-md-2">
                            <input type="submit" class="form-control btn-primary" value="Update" name="editauthor">
                          </div>
                        </div>
                      </form>
            <?php
                }else{
            ?>
            <a class="btn bg-primary text-white float-right" href="authors.php?add=1">[+]Add Author</a>
          <p class="mb-4">Below are listed all authors.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nr</th>
                      <th>Full Name</th>
                      <th>Bio</th>
                      <th>Email</th>
                      <th>Photo</th>
                      <th>Facebook</th>
                      <th>Website</th>
                      <th>Edit / Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                    $authors_query = $conn->query("SELECT * FROM authors");
                    while($row = $authors_query->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo  $row['id'];?></td>
                      <td><?php echo  $row['fname'].' '.$row['lname'];?></td>
                      <td><?php echo  substr($row['bio'],0,60);?></td>
                      <td><?php echo  $row['email'];?></td>
                      <td><img src="../images/<?php echo  $row['photo'];?>" class="img-fluid"></td>
                      <td><?php echo  $row['facebook'];?></td>
                      <td><?php echo  $row['website'];?></td>
                      <td>
                          <span><a class="text-primary" href="authors.php?edit=<?php echo $row['id'];?>">Edit</a></span> /
                        <span><a class="text-danger" href="authors.php?delete=<?php echo $row['id'];?>">Delete</a></span>
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
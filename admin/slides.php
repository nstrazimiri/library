<?php include "includes/header.php";
      include 'includes/superadmin.php';

?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

              <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">slides</h1>
            <?php 

            function clean($string) {
                 $string = str_replace(' ', '_', $string); // Replaces all spaces with underscores.
                 return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
              }
                //if user adds an author
                if(isset($_POST['addslide'])){
                    $title=mysqli_real_escape_string($conn,$_POST['title']);
                    $link=mysqli_real_escape_string($conn,$_POST['link']);
                    $content=mysqli_real_escape_string($conn,$_POST['content']);
                    
                    $target_dir = "../images/";
                     $target_file = $target_dir .basename($_FILES['photo']['name']);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $title_modified= clean($title);
                    if(empty($title_modified)){
                      $title_modified='no_title';
                    }
                    $file_name=$title_modified.'_slide_'.rand(0, 30).'.'.$imageFileType;
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
                             $insert_query=$conn->query("INSERT INTO `slides`(`title`,`link`,`content`,`photo`) VALUES ('".$title."','".$link."','".$content."','".$file_name."')");
                            if($insert_query){
                                echo "<p class='text-success'>Slide added.</p>";
                                echo "<p class='text-primary'><a href='slides.php'>View All Slides</a></p>";
                            }
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }


                    
                   
                }
                //if user deletes one of the cateogires
                if(isset($_GET['delete'])){
                    
                    $delete_id=$_GET['delete'];
                    $delete_query=$conn->query("DELETE FROM slides WHERE id=".$delete_id."");
                    if($delete_query){
                        echo "<p class='text-success'>Slide deleted.</p>";
                        echo "<p class='text-primary'><a href='slides.php'>View All Slides</a></p>";
                    }
                }
            
             //if user updates a author
                if(isset($_POST['editslide'])){
                    $edit_id=$_POST['editid'];
                    $title=mysqli_real_escape_string($conn,$_POST['title']);
                    $link=mysqli_real_escape_string($conn,$_POST['link']);
                    $content=mysqli_real_escape_string($conn,$_POST['content']);
                    
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
                    $title_modified= clean($title);
                    if(empty($title_modified)){
                      $title_modified='no_title';
                    }
                    $file_name=$title_modified.'_slide_'.rand(0, 30).'.'.$imageFileType;
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
                             
                           $update_query=$conn->query("UPDATE `slides` SET `title`='".$title."',`link`='".$link."',`content`='".$content."',`photo`='".$file_name."' WHERE `id`=".$edit_id."");
                           
                            if($update_query){
                                echo "<p class='text-success'>Slide Updated.</p>";
                                echo "<p class='text-primary'><a href='slides.php'>View All Slides</a></p>";
                            }
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                        
                    }
                    }else{
                      $update_query=$conn->query("UPDATE `slides` SET `title`='".$title."',`link`='".$link."',`content`='".$content."',`photo`='".$placeholderImg."' WHERE `id`=".$edit_id."");             
                    if($update_query){
                        echo "<p class='text-success'>Slide Updated.</p>";
                        echo "<p class='text-primary'><a href='slides.php'>View All Slides</a></p>";
                    }else{
                        echo("Error description: " . mysqli_error($conn));
                    }
                    }

                 
                   

                }
                
                //if the user clicked add button
                if(isset($_GET['add'])){
                    ?>
                    <form class="add-author" action="slides.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="title">Title</label>
                            <input type="text" class="form-control form-control-user" name="title" id="title" placeholder="Slid Title">
                          </div>
                            <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="link">Link</label>
                            <input type="text" class="form-control form-control-user" name="link" id="link" placeholder="Slide Link">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="content">Slide content</label>
                            <textarea id="content" name="content" class="form-control" cols="4" rows="2">
                            
                            </textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                            <label for="photo"> Slide Image</label>
                            <input type="file" name="photo" id="photo" class="form-control">
                            </div>
                        </div>
                        <div class="form-group-row">
                          <div class="col-md-2">
                            <input type="submit" class="form-control btn-primary" value="Add" name="addslide">
                          </div>
                        </div>
                      </form>
            
            <?php
                    
                }else if(isset($_GET['edit'])){
                    $edit_id=$_GET['edit'];
                    $edit_slide_query = $conn->query("SELECT * FROM slides WHERE id=".$edit_id."");
                    $row = $edit_slide_query->fetch_assoc();
                    ?>
                    <form class="add-author" action="slides.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="editid" value="<?php echo $edit_id;?>">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="title">Title</label>
                            <input type="text" class="form-control form-control-user" name="title" id="title" value="<?php echo $row['title'];?>">
                          </div>
                            <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="link">Link</label>
                            <input type="text" class="form-control form-control-user" name="link" id="link" value="<?php echo $row['link'];?>">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="content">Content</label>
                            <textarea id="content" name="content" class="form-control" cols="6" rows="4"><?php echo $row['content'];?>
                            </textarea>
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
                            <input type="submit" class="form-control btn-primary" value="Update" name="editslide">
                          </div>
                        </div>
                      </form>
            <?php
                }else{
            ?>
            <a class="btn bg-primary text-white float-right" href="slides.php?add=1">[+]Add Slide</a>
          <p class="mb-4">Below are listed all slides that are shown on the frontend in the homepage.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nr</th>
                      <th>Title</th>
                      <th>Link</th>
                      <th>Content</th>
                      <th>Photo</th>
                      <th>Edit / Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                    $slides_query = $conn->query("SELECT * FROM slides");
                    while($row = $slides_query->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo  $row['id'];?></td>
                      <td><?php echo  $row['title'];?></td>
                      <td><?php echo  $row['link'];?></td>
                      <td><?php echo  substr($row['content'],0,60);?></td>
                      <td><img src="../images/<?php echo  $row['photo'];?>" class="img-fluid"></td>
                      <td>
                          <span><a class="text-primary" href="slides.php?edit=<?php echo $row['id'];?>">Edit</a></span> /
                        <span><a class="text-danger" href="slides.php?delete=<?php echo $row['id'];?>">Delete</a></span>
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
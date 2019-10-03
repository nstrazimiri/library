<?php include "includes/header.php";

?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

              <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Books</h1>
            <?php 
                //if user adds an author
                if(isset($_POST['addbook'])){
                    $title=mysqli_real_escape_string($conn,$_POST['title']);
                    $year_published=mysqli_real_escape_string($conn,$_POST['year_published']);
                    $author=mysqli_real_escape_string($conn,$_POST['author']);
                    $category=mysqli_real_escape_string($conn,$_POST['category']);
    

                    
                    $target_dir = "../images/";
                     $target_file = $target_dir .basename($_FILES['photo']['name']);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $title_modified= str_replace(' ', '_', $title);
                    $file_name=$title_modified.'_'.$year_published.'_'.rand(0, 30).'.'.$imageFileType;
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
                             $insert_query=$conn->query("INSERT INTO `books`(`title`,`cover`,`year_published`,`author`,`category`) VALUES ('".$title."','".$file_name."','".$year_published."','".$author."','".$category."')");
                            if($insert_query){
                                echo "<p class='text-success'>Book added.</p>";
                                echo "<p class='text-primary'><a href='books.php'>View All Books</a></p>";
                            }
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }


                    
                   
                }
                //if user deletes one of the cateogires
                if(isset($_GET['delete'])){
                    
                    $delete_id=$_GET['delete'];
                    $delete_query=$conn->query("DELETE FROM books WHERE id=".$delete_id."");
                    if($delete_query){
                        echo "<p class='text-success'>Book deleted.</p>";
                        echo "<p class='text-primary'><a href='books.php'>View All Books</a></p>";
                    }
                }
            
             //if user updates a author
                if(isset($_POST['editbook'])){
                    $edit_id=$_POST['editid'];
                    $title=mysqli_real_escape_string($conn,$_POST['title']);                    $year_published=mysqli_real_escape_string($conn,$_POST['year_published']);
                    $author=mysqli_real_escape_string($conn,$_POST['author']);
                    $category=mysqli_real_escape_string($conn,$_POST['category']);
                    
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
                    $title_modified= str_replace(' ', '_', $title);
                    $file_name=$title_modified.'_'.$year_published.'_'.rand(0, 30).'.'.$imageFileType;
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
                             
                           $update_query=$conn->query("UPDATE `books` SET `title`='".$title."',`cover`='".$file_name."',`year_published`='".$year_published."',`author`='".$author."',`category`='".$category."' WHERE `id`=".$edit_id."");
                           
                            if($update_query){
                                echo "<p class='text-success'>Book Updated.</p>";
                                echo "<p class='text-primary'><a href='books.php'>View All Books</a></p>";
                            }
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                        
                    }
                    }else{
                    $update_query=$conn->query("UPDATE `books` SET `title`='".$title."',`cover`='".$placeholderImg."',`year_published`='".$year_published."',`author`='".$author."',`category`='".$category."' WHERE `id`=".$edit_id."");
                    
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
                    <form class="add-author" action="books.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="title">Title</label>
                            <input type="text" class="form-control form-control-user" name="title" id="title" placeholder="Title">
                          </div>
                        </div>
    
                        <div class="form-group row">
                          <div class="col-sm-4 mb-4 mb-sm-4">
                              <label for="year_published">Year Published</label>
                              <input type="number" class="form-control form-control-user" name="year_published" id="year_published" placeholder="Year Published">
                          </div>
                            <div class="col-sm-4 mb-4 mb-sm-4">
                                <label for="author">Author</label>
                             <select id="author" name="author" class="form-control">
                                 <option>Select an author</option>
                                <?php 
                                 $author_query = $conn->query("SELECT * FROM authors");

                                 while($row = $author_query->fetch_assoc()){
                                     echo "<option value=".$row['id'].">".$row['fname'].' '.$row['lname']."</option>";
                                 }
                                 ?>
                             </select>
                                
                          </div>
                            <div class="col-sm-4 mb-4 mb-sm-4">
                              <label for="category">Category</label>
                               <select id="category" name="category" class="form-control">
                                   <option>Select a category</option>
                                <?php 
                                    $categories_query = $conn->query("SELECT * FROM book_category");
                                 while($row = $categories_query->fetch_assoc()){
                                     echo "<option value=".$row['id'].">".$row['cat_name']."</option>";
                                 }
                                 ?>
                             </select>
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
                            <input type="submit" class="form-control btn-primary" value="Add" name="addbook">
                          </div>
                        </div>
                      </form>
            
            <?php
                    
                }else if(isset($_GET['edit'])){
                    $edit_id=$_GET['edit'];
                    $edit_book_query = $conn->query("
                    SELECT B.title,B.cover,B.author,B.category,B.year_published,
                            A.id AS AID, A.fname,A.lname,C.cat_name,C.id AS CID, B.id AS BID 
                            FROM `books` AS B 
	                        JOIN authors AS A on B.author=A.id
                            JOIN book_category C on B.category=C.id
                            WHERE B.id=".$edit_id."");
                    
                    $row = $edit_book_query->fetch_assoc();
                    ?>
                    <form class="add-author" action="books.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="editid" value="<?php echo $edit_id;?>">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="title">Title</label>
                            <input required type="text" class="form-control form-control-user" name="title" id="title" value="<?php echo $row['title'];?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4 mb-4 mb-sm-4">
                              <label for="year_published">Year Published</label>
                              <input required type="number" class="form-control form-control-user" name="year_published" id="year_published" value="<?php echo $row['year_published'];?>">
                          </div>
                            <div class="col-sm-4 mb-4 mb-sm-4">
                            <label for="author">Author</label>
                                <?php
                                    ?>
                             <select id="author" name="author" class="form-control">
                                <?php 
                                 $author_query = $conn->query("SELECT * FROM authors");
                                    
                                 while($roww = $author_query->fetch_assoc()){
                                     echo "<option ";
                                     if($row['AID']==$roww['id']){
                                         echo "selected";
                                     }
                                     echo " value=".$roww['id'].">".$roww['fname'].' '.$roww['lname']."</option>";
                                 }
                                 ?>
                             </select>
                          </div>
                            <div class="col-sm-4 mb-4 mb-sm-4">
                              <label for="category">Category</label>
                               <select id="category" name="category" class="form-control">
                                   <option>Select a category</option>
                                <?php 
                                    $categories_query = $conn->query("SELECT * FROM book_category");
                                 while($roww = $categories_query->fetch_assoc()){
                                     echo "<option ";
                                     if($row['CID']==$roww['id']){
                                         echo "selected";
                                     }
                                     echo " value=".$roww['id'].">".$roww['cat_name']."</option>";
                                 }
                                 ?>
                             </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 pos-relative">
                                <span id="rmvx" class="pos-absolute img-auth-delete" onclick="removeImage()">x</span>
                            <label for="photo">Photo</label>
                                <img id="alreadyImg" class="img-fluid" src="../images/<?php echo $row['cover'];?>"/>
                            <input id="placeholderImg" class="form-control" type="text" disabled value="<?php echo $row['cover'];?>"/><br>
                                <input name="placeholderImg" type="hidden" value="<?php echo $row['cover'];?>"/>
                            <input type="file" name="photo" id="photo" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group-row">
                          <div class="col-md-2">
                            <input type="submit" class="form-control btn-primary" value="Update" name="editbook">
                          </div>
                        </div>
                      </form>
            <?php
                }else{
            ?>
            <a class="btn bg-primary text-white float-right" href="books.php?add=1">[+]Add Book</a>
          <p class="mb-4">Below are listed all books.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nr</th>
                      <th>Title</th>
                      <th>Cover</th>
                      <th>Year Published</th>
                      <th>Author</th>
                      <th>Category</th>
                      <th>Edit / Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                    $authors_query = $conn->query("SELECT B.title,B.cover,B.author,B.category,B.year_published,
                            A.id AS AID, A.fname,A.lname,C.cat_name,C.id AS CID, B.id AS BID 
                            FROM `books` AS B 
	                        JOIN authors AS A on B.author=A.id
                            JOIN book_category C on B.category=C.id ORDER BY BID ASC");
                    while($row = $authors_query->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo  $row['BID'];?></td>
                      <td><?php echo  $row['title'];?></td>
                      <td><img src="../images/<?php echo  $row['cover'];?>" class="img-fluid"></td>
                      <td><?php echo  $row['year_published'];?></td>
                      <td><?php echo  $row['fname'].' '.$row['lname'];?></td>
                      <td><?php echo  $row['cat_name'];?></td>
                      <td>
                          <span><a class="text-primary" href="books.php?edit=<?php echo $row['BID'];?>">Edit</a></span> /
                        <span><a class="text-danger" href="books.php?delete=<?php echo $row['BID'];?>">Delete</a></span>
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
<?php include "includes/header.php";

?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

              <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Book Categories</h1>
            <?php 
                //if user adds a category
                if(isset($_POST['addcategory'])){
                    $cat_name=$_POST['catname'];
                    $insert_query=$conn->query("INSERT INTO `book_category`(`cat_name`) VALUES ('".$cat_name."')");
                    if($insert_query){
                        echo "<p class='text-success'>Category added.</p>";
                        echo "<p class='text-primary'><a href='categories.php'>View All Categories</a></p>";
                    }
                }
                //if user deletes one of the cateogires
                if(isset($_GET['delete'])){
                    
                    $delete_id=$_GET['delete'];
                    $delete_query=$conn->query("DELETE FROM book_category WHERE id=".$delete_id."");
                    if($delete_query){
                        echo "<p class='text-success'>Category deleted.</p>";
                        echo "<p class='text-primary'><a href='categories.php'>View All Categories</a></p>";
                    }
                }
            
             //if user updates a category
                if(isset($_POST['editcategory'])){
                    $cat_name=$_POST['catname'];
                    $edit_id=$_POST['editid'];
                    $update_query=$conn->query("UPDATE `book_category` SET `cat_name`='".$cat_name."' WHERE `id`=".$edit_id."");
                    
                    if($update_query){
                        echo "<p class='text-success'>Category Updated.</p>";
                        echo "<p class='text-primary'><a href='categories.php'>View All Categories</a></p>";
                    }
                }
                
                //if the user clicked add button
                if(isset($_GET['add'])){
                    ?>
                    <form class="add-category" action="categories.php" method="post">
                        <div class="form-group row">
                          <div class="col-sm-10 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="catname" id="catName" placeholder="Category Name">
                          </div>
                          <div class="col-sm-2">
                            <input type="submit" class="form-control btn-primary" value="Add" name="addcategory">
                          </div>
                        </div>
                      </form>
            
            <?php
                    
                }else if(isset($_GET['edit'])){
                    $edit_id=$_GET['edit'];
                    $edit_category_query = $conn->query("SELECT * FROM book_category WHERE id=".$edit_id."");
                    $row = $edit_category_query->fetch_assoc()
                    ?>
                    <form class="edit-category" action="categories.php" method="post">
                        <div class="form-group row">
                          <div class="col-sm-10 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="catname" id="catName" value="<?php echo $row['cat_name'];?>">
                              <input type="hidden" name="editid" value="<?php echo $edit_id;?>"/>
                          </div>
                          <div class="col-sm-2">
                            <input type="submit" class="form-control btn-primary" value="Edit" name="editcategory">
                          </div>
                        </div>
                      </form>
            <?php
                }else{
            ?>
            <a class="btn bg-primary text-white float-right" href="categories.php?add=1">[+]Add Category</a>
          <p class="mb-4">Below are listed all book categories.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nr</th>
                      <th>Category Name</th>
                        <th>Edit / Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                    $categories_query = $conn->query("SELECT * FROM book_category");
                    while($row = $categories_query->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo  $row['id'];?></td>
                      <td><?php echo  $row['cat_name'];?></td>
                      <td>
                          <span><a class="text-primary" href="categories.php?edit=<?php echo $row['id'];?>">Edit</a></span> /
                        <span><a class="text-danger" href="categories.php?delete=<?php echo $row['id'];?>">Delete</a></span>
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
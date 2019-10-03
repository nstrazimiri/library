<?php include "includes/header.php";
      include 'includes/superadmin.php';

?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

              <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">About Content</h1>
            <?php 
            
             //if user updates a author
                if(isset($_POST['editcontent'])){
                    $about_h2=mysqli_real_escape_string($conn,$_POST['about_h2']);
                    $about_content=mysqli_real_escape_string($conn,$_POST['about_content']);
                             
              $update_h2=$conn->query("UPDATE `website_content` SET `content`='".$about_h2."' WHERE `name`='about_h2'");
              $update_content=$conn->query("UPDATE `website_content` SET `content`='".$about_content."' WHERE `name`='about_content'");
                   
                    if($update_h2&&$update_content){
                        echo "<p class='text-success'>About Us Page Updated.</p>";
                    }else{
                          echo mysqli_error($update_h2);
                          echo mysqli_error($update_content);
                    }
                }
  
          ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <?php
                $about_content_query = $conn->query("SELECT * FROM website_content");
                $about_h2;
                $about_content;
                while($row = $about_content_query->fetch_assoc()){
                  if($row['name']=='about_h2'){
                    $about_h2=$row['content'];
                  }elseif($row['name']=='about_content'){
                    $about_content=$row['content'];
                  }
                }
                
                ?>
                     <form class="add-author" action="about-content.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="about_h2">Home H2</label>
                            <input type="text" class="form-control form-control-user" name="about_h2" id="about_h2" value="<?php echo $about_h2;?>">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="about_content">Home Content</label>
                            <textarea id="about_content" name="about_content" class="form-control" cols="5" rows="4"><?php echo $about_content;?>
                            </textarea>
                        </div>
                        <div class="form-group-row">
                          <div class="col-md-2">
                            <input type="submit" class="form-control btn-primary" value="Update" name="editcontent">
                          </div>
                        </div>
                      </form>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include "includes/footer.php"; ?>
<?php include "includes/header.php";
      include 'includes/superadmin.php';

?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

              <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Home Content</h1>
            <?php 
            
             //if user updates a author
                if(isset($_POST['editcontent'])){
                    $home_h2=mysqli_real_escape_string($conn,$_POST['home_h2']);
                    $home_content=mysqli_real_escape_string($conn,$_POST['home_content']);
                             
                   $update_h2=$conn->query("UPDATE `website_content` SET `content`='".$home_h2."' WHERE `name`='home_h2'");
              $update_content=$conn->query("UPDATE `website_content` SET `content`='".$home_content."' WHERE `name`='home_content'");
                   
                    if($update_h2&&$update_content){
                        echo "<p class='text-success'>Homepage Updated.</p>";
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
                $home_content_query = $conn->query("SELECT * FROM website_content");
                $home_h2;
                $home_content;
                while($row = $home_content_query->fetch_assoc()){
                  if($row['name']=='home_h2'){
                    $home_h2=$row['content'];
                  }elseif($row['name']=='home_content'){
                    $home_content=$row['content'];
                  }
                }
                
                ?>
                     <form class="add-author" action="home-content.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="home_h2">Home H2</label>
                            <input type="text" class="form-control form-control-user" name="home_h2" id="home_h2" value="<?php echo $home_h2;?>">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="home_content">Home Content</label>
                            <textarea id="home_content" name="home_content" class="form-control" cols="5" rows="4"><?php echo $home_content;?>
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
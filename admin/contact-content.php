<?php include "includes/header.php";
      include 'includes/superadmin.php';

?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

              <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800 text-center">Contact Content</h1>
            <?php 
            
             //if user updates a author
                if(isset($_POST['editcontent'])){

                    $contact_email=mysqli_real_escape_string($conn,$_POST['contact_email']);
                    $contact_phone=mysqli_real_escape_string($conn,$_POST['contact_phone']);
                    $contact_facebook=mysqli_real_escape_string($conn,$_POST['contact_facebook']);
                    $contact_twitter=mysqli_real_escape_string($conn,$_POST['contact_twitter']);
                    $contact_instagram=mysqli_real_escape_string($conn,$_POST['contact_instagram']);
                             
                   $update_c_email=$conn->query("UPDATE `website_content` SET `content`='".$contact_email."' WHERE `name`='contact_email'");
                  $update_c_phone=$conn->query("UPDATE `website_content` SET `content`='".$contact_phone."' WHERE `name`='contact_phone'");
                  $update_c_facebook=$conn->query("UPDATE `website_content` SET `content`='".$contact_facebook."' WHERE `name`='contact_facebook'");
                  $update_c_twitter=$conn->query("UPDATE `website_content` SET `content`='".$contact_twitter."' WHERE `name`='contact_twitter'");
                  $update_c_instagram=$conn->query("UPDATE `website_content` SET `content`='".$contact_instagram."' WHERE `name`='contact_instagram'");
                   
                    if($update_c_email&&$update_c_phone&&$update_c_facebook&&$update_c_twitter&&$update_c_instagram){
                        echo "<p class='text-success'>Contacts Updated.</p>";
                    }
                }
  
          ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <?php
                    $home_content_query = $conn->query("SELECT * FROM website_content");
                            $contact_email;
                            $contact_phone;
                            $contact_facebook;
                            $contact_twitter;
                            $contact_instagram;
                            while($row = $home_content_query->fetch_assoc()){
                              if($row['name']=='contact_email'){
                                $contact_email=$row['content'];
                              }elseif($row['name']=='contact_phone'){
                                $contact_phone=$row['content'];
                              }elseif($row['name']=='contact_facebook'){
                                $contact_facebook=$row['content'];
                              }elseif($row['name']=='contact_instagram'){
                                $contact_instagram=$row['content'];
                              }elseif($row['name']=='contact_twitter'){
                                $contact_twitter=$row['content'];
                              }
                            }
                
                ?>
                     <form class="add-author" action="contact-content.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                          <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="contact_email">Contact E-mail</label>
                            <input type="text" class="form-control form-control-user" name="contact_email" id="contact_email" value="<?php echo $contact_email;?>">
                          </div>
                          <div class="col-sm-6 mb-6 mb-sm-6">
                              <label for="contact_phone">Contact Phone</label>
                            <input type="text" class="form-control form-control-user" name="contact_phone" id="contact_phone" value="<?php echo $contact_phone;?>">
                          </div>
                        </div>
                        <hr class="divider">
                        <div class="form-group row">
                          <div class="col-sm-4 mb-6 mb-sm-6">
                              <label for="contact_facebook">Contact Facebook</label>
                            <input type="text" class="form-control form-control-user" name="contact_facebook" id="contact_facebook" value="<?php echo $contact_facebook;?>">
                          </div>
                          <div class="col-sm-4 mb-6 mb-sm-6">
                              <label for="contact_twitter">Contact Twitter</label>
                            <input type="text" class="form-control form-control-user" name="contact_twitter" id="contact_twitter" value="<?php echo $contact_twitter;?>">
                          </div>
                          <div class="col-sm-4 mb-6 mb-sm-6">
                              <label for="contact_instagram">Contact Intagram</label>
                            <input type="text" class="form-control form-control-user" name="contact_instagram" id="contact_instagram" value="<?php echo $contact_instagram;?>">
                          </div>
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
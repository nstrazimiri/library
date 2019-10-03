   <footer class="bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h3>Contact</h3>
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
                        <p><a href="mailto:<?php echo $contact_email;?>"><?php echo $contact_email; ?></a></p>
                        <p><a href="tel:<?php echo $contact_phone;  ?>"><?php echo $contact_phone; ?></a></p>
                        <p>
                            <a class="h4" target="_blank" href="<?php echo $contact_facebook; ?>"><span class="fab fa-facebook"></span></a>
                            <a class="ml-2 h4" target="_blank" href="<?php echo $contact_twitter; ?>"><span class="fab fa-twitter"></span></a>
                            <a class="ml-2 h4" target="_blank" href="<?php echo $contact_instagram; ?>"><span class="fab fa-instagram"></span></a></p>
                    </div>
                    <div class="col-lg-4">
                        <h3>My Account</h3>
                        <p><a href="login.php">Login</a></p>
                        <p><a href="register.php">Register</a></p>
                    </div>
                    <div class="col-lg-4">
                        <h3>Top Links</h3>
                        <p><a href="authors.php">Authors</a></p>
                        <p><a href="categories.php">Categories</a></p>
                        <p><a href="books.php">Books</a></p>
                    </div>
                    <div class="col-lg-12">
                        <p class="text-center"><?php echo date("Y");?> &copy; Library</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/slick.min.js"></script>
    <script type="text/javascript" src="js/regular.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
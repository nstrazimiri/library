<?php include "includes/header.php"?>
<?php 

  
        $contact_query = $conn->query("SELECT * FROM `website_content` WHERE name like 'contact%' ");
               $contact_email;
                $contact_phone;
                $contact_facebook;
                $contact_twitter;
                $contact_instagram;
                while($row = $contact_query->fetch_assoc()){
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
<div class="container about">
    <h1 class="text-center">Contact Us</h1>
    <div class="row">
        <div class="col-lg-6">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4172.846300185526!2d-83.06536800804567!3d42.30737755005118!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x883b2d70afe10dff%3A0x82c72851583ffbdc!2sLeddy+Library!5e0!3m2!1sen!2sca!4v1565401302939!5m2!1sen!2sca" height="450" frameborder="0" style="border:0;width: 100%;" allowfullscreen></iframe>
        </div>
        <div class="col-lg-4 ml-4 pl-4">
            <p class="text-primary h5 mt-5"><span class="fa fa-envelope"></span><a class="ml-2" href="mailto:<?php echo $contact_email;?>"><?php echo $contact_email; ?></a></p>
            <p class="text-primary h5"><span class="fa fa-phone-square-alt"></span><a class="ml-2" href="tel:<?php echo $contact_phone;?>"><?php echo $contact_phone; ?></a></p>
            <hr>
            <p class="text-primary h5"><span class="fab fa-facebook-square"></span><a class="ml-2" href="<?php echo $contact_facebook;?>">Facebook</a></p>
            <p class="text-primary h5"><span class="fab fa-twitter-square"></span><a class="ml-2" href="<?php echo $contact_facebook;?>">Twitter</a></p>
            <p class="text-primary h5"><span class="fab fa-instagram"></span><a class="ml-2" href="<?php echo $contact_instagram;?>">Instagram</a></p>

        </div>
    
    </div>
</div>

<?php include "includes/footer.php"?>
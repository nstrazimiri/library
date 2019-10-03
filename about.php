<?php include "includes/header.php"?>
<?php 

  
        $about_query = $conn->query("SELECT * FROM `website_content` WHERE name like 'about%' ");
        $about_h2='';
        $about_content='';

        while($row = $about_query->fetch_assoc()){
                if($row['name']=='about_h2'){
                    $about_h2=$row['content'];
                }elseif ($row['name']=='about_content') {
                    $about_content=$row['content'];
                }
        }
                    

?>
<div class="container about">
    <h1 class="text-center"><?php echo $about_h2; ?></h1>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <p class="text-justify">
                <?php
                    echo $about_content;
                ?>
            </p>
        </div>'
    
    </div>
</div>

<?php include "includes/footer.php"?>
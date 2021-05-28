<?php 
  $currentWebPage = 'gallery';
  include "../templates/header.php";
  //Connect to database
  require_once('../../db/connection.php');
?>

  <!-- ##### Breadcrumb Area Start ##### -->
  <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url('../img/bg-img/farm.jpg');">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <div class="breadcrumb-text">
            <h2>Gallery</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="famie-breadcrumb">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Gallery</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- ##### Breadcrumb Area End ##### -->

  <!-- ##### Gallery Area Start ##### -->
  <section class="farming-practice-area bg-gray section-padding-100-50">
    <div class="container">
      <div class="row">
          <?php   
            $result = mysqli_query($conn, "SELECT * FROM gallery");
            while($row = mysqli_fetch_array($result)){             
          ?>
              <!-- Single Gallery Image Area -->
              <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-farming-practice-area mb-50 wow fadeInUp" data-wow-delay="100ms">
                  <!-- Thumbnail -->
                  <div class="farming-practice-thumbnail">
                    <img src="<?php echo $row['image']; ?>" alt="">
                  </div>
                </div>
              </div>
            <?php
              }
            ?>
      </div>
    </div>
  </section>
  <!-- ##### Farming Practice Area End ##### -->

  <?php include "../templates/footer.php"; ?>
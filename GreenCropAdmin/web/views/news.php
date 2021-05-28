<?php 
  $currentWebPage = 'news';
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
            <h2>News</h2>
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
          <li class="breadcrumb-item active" aria-current="page">News</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- ##### Breadcrumb Area End ##### -->

  <!-- ##### Blog Area Start ##### -->
  <section class="famie-blog-area">
    <div class="container">
      <div class="row">
        <!-- Posts Area -->
        <div class="col-12 col-md-8">
          <div class="posts-area">
            <?php   
              $result = mysqli_query($conn, "SELECT * FROM news_and_promo ORDER BY created_date_time DESC");
              while($row = mysqli_fetch_array($result)){
            ?>
                <!-- Single Blog Post Area -->
                <div class="single-blog-post-area mb-50 wow fadeInUp" data-wow-delay="100ms">
                  <h6>Post on <a href="#" class="post-date"><?php echo date("Y-m-d h:i A", strtotime($row['created_date_time'])) ?></a> / <a href="#" class="post-author"><?php echo $row['category']; ?></h6>
                  <a href="#" class="post-title"><?php echo $row['title']; ?></a>
                  <img src="<?php echo $row['image']; ?>" alt="" class="post-thumb">
                  <p class="post-excerpt">
                    <?php echo $row['description']; ?>
                  </p>
                </div>
            <?php
              }
            ?>
          </div>
        </div>

        <!-- Sidebar Area -->
        <div class="col-12 col-md-4">
          <div class="sidebar-area">

            <!-- Single Widget Area -->
            <div class="single-widget-area">
              <!-- Title -->
              <h5 class="widget-title">Catagories</h5>
              <!-- Cata List -->
              <ul class="cata-list">
                <li><a href="#">News</a></li>
                <li><a href="#">Promotions</a></li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ##### Blog Area End ##### -->

  <?php include "../templates/footer.php"; ?>
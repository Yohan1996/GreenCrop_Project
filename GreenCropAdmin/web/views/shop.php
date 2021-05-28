<?php 
  $currentWebPage = 'shop';
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
            <h2>Shop</h2>
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
          <li class="breadcrumb-item active" aria-current="page">Shop</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- ##### Breadcrumb Area End ##### -->

  <!-- ##### Shop Area Start ##### -->
  <section class="shop-area section-padding-0-100">
    <div class="container">

      <div class="row">
        <!-- Shop Sidebar Area -->
        <div class="col-12 col-md-4 col-lg-3">

          <!-- Single Widget Area -->
          <div class="single-widget-area">
            <!-- Title -->
            <h5 class="widget-title">Catagories</h5>
            <!-- Cata List -->
            <ul class="cata-list shop-page">
              <li><a href="#">Fruits</a></li>
              <li><a href="#">Cut Flowers</a></li>
              <li><a href="#">Plants for Landscaping</a></li>
              <li><a href="#">Plants for Rent</a></li>
            </ul>
          </div>
        </div>

        <div class="col-12 col-md-8 col-lg-9">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom_tabs_fruits_tab" data-toggle="pill" href="#custom_tabs_fruits" role="tab" aria-controls="custom_tabs_fruits" aria-selected="true">Fruits</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom_tabs_flowers_tab" data-toggle="pill" href="#custom_tabs_flowers" role="tab" aria-controls="custom_tabs_flowers" aria-selected="false">Cut Flowers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom_tabs_landscaping_tab" data-toggle="pill" href="#custom_tabs_landscaping" role="tab" aria-controls="custom_tabs_landscaping" aria-selected="false">Plants or Landscaping</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom_tabs_rent_tab" data-toggle="pill" href="#custom_tabs_rent" role="tab" aria-controls="custom_tabs_rent" aria-selected="false">Plants for Rent</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom_tabs_tab_content">
                  <div class="tab-pane fade show active" id="custom_tabs_fruits" role="tabpanel" aria-labelledby="custom_tabs_fruits_tab">

                      <!-- Shop Products Area -->
                      <div class="row">
                        <?php   
                          $result1 = mysqli_query($conn, "SELECT * FROM products WHERE category='Fruits' AND is_deleted = 0");
                          if($result1->num_rows > 0){
                            while($row1 = mysqli_fetch_array($result1)){
                        ?>
                            <!-- Single Product Area -->
                            <div class="col-12 col-sm-6 col-lg-4">
                              <div class="single-product-area mb-50">
                                <!-- Product Thumbnail -->
                                <div class="product-thumbnail">
                                  <img src="<?php echo $row1['image']; ?>" alt="">
                                </div>
                                <!-- Product Description -->
                                <div class="product-desc text-center pt-4">
                                  <a href="#" class="product-title"><?php echo $row1['name']; ?></a>
                                  <h6 class="price"><?php echo $row1['currency'].' '.number_format($row1['price'], 2, '.', ''); ?>/-</h6>
                                  <br>
                                  <p><?php echo $row1['description']; ?></p>
                                </div>
                              </div>
                            </div>
                        <?php
                            }
                          }
                        ?>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="custom_tabs_flowers" role="tabpanel" aria-labelledby="custom_tabs_flowers_tab">

                      <!-- Shop Products Area -->
                      <div class="row">
                        <?php   
                          $result2 = mysqli_query($conn, "SELECT * FROM products WHERE category='Cut Flowers' AND is_deleted = 0");
                          if($result2->num_rows > 0){
                            while($row2 = mysqli_fetch_array($result2)){
                        ?>
                            <!-- Single Product Area -->
                            <div class="col-12 col-sm-6 col-lg-4">
                              <div class="single-product-area mb-50">
                                <!-- Product Thumbnail -->
                                <div class="product-thumbnail">
                                  <img src="<?php echo $row2['image']; ?>" alt="">
                                </div>
                                <!-- Product Description -->
                                <div class="product-desc text-center pt-4">
                                  <a href="#" class="product-title"><?php echo $row2['name']; ?></a>
                                  <h6 class="price"><?php echo $row2['currency'].' '.number_format($row2['price'], 2, '.', ''); ?>/-</h6>
                                  <br>
                                  <p><?php echo $row2['description']; ?></p>
                                </div>
                              </div>
                            </div>
                        <?php
                            }
                          }
                        ?>
                      </div>

                </div>
                  <div class="tab-pane fade" id="custom_tabs_landscaping" role="tabpanel" aria-labelledby="custom_tabs_landscaping_tab">
                  
                      <!-- Shop Products Area -->
                      <div class="row">
                          <?php   
                            $result3 = mysqli_query($conn, "SELECT * FROM products WHERE category='Plants for Landscaping' AND is_deleted = 0");
                            if($result3->num_rows > 0){
                              while($row3 = mysqli_fetch_array($result3)){
                          ?>
                              <!-- Single Product Area -->
                              <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-area mb-50">
                                  <!-- Product Thumbnail -->
                                  <div class="product-thumbnail">
                                    <img src="<?php echo $row3['image']; ?>" alt="">
                                  </div>
                                  <!-- Product Description -->
                                  <div class="product-desc text-center pt-4">
                                    <a href="#" class="product-title"><?php echo $row3['name']; ?></a>
                                    <h6 class="price"><?php echo $row3['currency'].' '.number_format($row3['price'], 2, '.', ''); ?>/-</h6>
                                    <br>
                                    <p><?php echo $row3['description']; ?></p>
                                  </div>
                                </div>
                              </div>
                          <?php
                              }
                            }
                          ?>
                        </div>
                
                  </div>
                  <div class="tab-pane fade" id="custom_tabs_rent" role="tabpanel" aria-labelledby="custom_tabs_rent_tab">

                      <!-- Shop Products Area -->
                      <div class="row">
                        <?php   
                          $result4 = mysqli_query($conn, "SELECT * FROM products WHERE category='Plants for Rent' AND is_deleted = 0");
                          if($result4->num_rows > 0){
                            while($row4 = mysqli_fetch_array($result4)){
                        ?>
                            <!-- Single Product Area -->
                            <div class="col-12 col-sm-6 col-lg-4">
                              <div class="single-product-area mb-50">
                                <!-- Product Thumbnail -->
                                <div class="product-thumbnail">
                                  <img src="<?php echo $row4['image']; ?>" alt="">
                                </div>
                                <!-- Product Description -->
                                <div class="product-desc text-center pt-4">
                                  <a href="#" class="product-title"><?php echo $row4['name']; ?></a>
                                  <h6 class="price"><?php echo $row['currency'].' '.number_format($row4['price'], 2, '.', ''); ?>/-</h6>
                                  <br>
                                  <p><?php echo $row4['description']; ?></p>
                                </div>
                              </div>
                            </div>
                        <?php
                            }
                          }
                        ?>
                      </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>  
      </div>

    </div>
  </section>
  <!-- ##### Shop Area End ##### -->

  <?php include "../templates/footer.php"; ?>
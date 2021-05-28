<?php 
  $currentPage = 'home';
  //Connect to Database
  include "../templates/home/header.php"; 
  //Connect to Database
  require_once('../db/connection.php'); 
  // Initialize the session
  session_start();
?>

<!-- Site wrapper -->
<div class="wrapper">
  <?php include "../templates/home/navbar.php"; ?>
  <?php include "../templates/home/sidebar.php"; ?>
    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Welcome to Green Crop Admin</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #77b122;color: #ffffff;">
              <div class="inner">
                <?php   
                  $result=mysqli_query($conn, "SELECT count(*) as product_total from products WHERE is_deleted=0");
                  $data=mysqli_fetch_assoc($result);
                ?>
                <h3><?php echo $data['product_total']; ?></h3>
                <h3>Products to <span style = "display: block;">Manage</h3>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Manage Products</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #77b122;color: #ffffff;">
              <div class="inner">
                <?php   
                  $result=mysqli_query($conn, "SELECT count(*) as message_total from site_user_messages");
                  $data=mysqli_fetch_assoc($result);
                ?>
                <h3><?php echo $data['message_total']; ?></h3>
                <h3>Customer <span style = "display: block;"></span>Messages</h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">View Customer Messages</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #77b122;color: #ffffff;">
              <div class="inner">
                <?php   
                  $result=mysqli_query($conn, "SELECT count(*) news_total from news_and_promo");
                  $data=mysqli_fetch_assoc($result);
                ?>
                <h3><?php echo $data['news_total']; ?></h3>
                <h3>News and <span style = "display: block;"></span>Promotions</h3>
              </div>
              <div class="icon">
                <i class="ion ion-ios-paper"></i>
              </div>
              <a href="#" class="small-box-footer">Manage News and Promotions</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #77b122;color: #ffffff;">
              <div class="inner">
                <?php   
                  $result=mysqli_query($conn, "SELECT count(*) gallery_total from gallery");
                  $data=mysqli_fetch_assoc($result);
                ?>
                <h3><?php echo $data['gallery_total']; ?></h3>
                <h3>Gallery <span style = "display: block;">Images</h3>
              </div>
              <div class="icon">
                <i class="ion ion-images"></i>
              </div>
              <a href="#" class="small-box-footer">Manage Gallery</a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->    
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include "../templates/footer.php"; ?>


<?php 
  $currentPage = 'messages';
  include "../templates/header.php";
  //Connect to Database
  require_once('../db/connection.php'); 
  // Initialize the session
  session_start();
?>

<!-- Site wrapper -->
<div class="wrapper">  
  <?php include "../templates/navbar.php"; ?>
  <?php include "../templates/sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Site Users Messages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Site Users Messages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12">
                  <?php
                    $result = mysqli_query($conn, "SELECT * FROM site_user_messages ORDER BY created_date_time DESC");
                    while($row = mysqli_fetch_array($result)){
                  ?>
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../dist/img/user-img.jpg" alt="user image">
                        <span class="username">
                          <a href="#"><?php echo $row['name']; ?></a>
                        </span>
                        <span class="description"><?php echo $row['email'].' - '.date("Y/m/d h:i A", strtotime($row['created_date_time'])); ?></span>
                      </div>
                      <!-- /.user-block -->
                      <p><?php echo $row['message']; ?></p>
                    </div>
                    <?php 
                      } 
                    ?> 
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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




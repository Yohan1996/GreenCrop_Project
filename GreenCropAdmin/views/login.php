<?php 
  $currentPage = 'login';
  include "../templates/header.php";
  // Initialize the session
  session_start();
  //Destroy session
  session_destroy();
?>


<div class="login-box">
  <div class="login-logo">
     
    <a href="#"><b style="color: brown"> Admin</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login to start your session</p>

      <form role="form" id="login_form">
        <div class="form-group input-group mb-3">
          <input type="email" class="form-control" id="email" name ="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <input type="password" class="form-control" id="password" name ="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" style="background-color: brown; border-color: brown;" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register User</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<?php include "../templates/footer.php"; ?>



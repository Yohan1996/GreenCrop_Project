<?php 
  $currentPage = 'register';
  include "../templates/header.php";
?>


<div class="register-box">
  <div class="register-logo">
 
    <a href="#"><b style="color: brown;"> Admin</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register to login</p>

      <form role="form" id="register_form">
        <div class="form-group input-group mb-3">
          <input type="text" class="form-control" id="name" name ="name" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group input-group mb-3">
          <input type="email" class="form-control" id="email" name ="email"  placeholder="Email">
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
        <div class="form-group input-group mb-3">
          <input type="password" class="form-control" id="confirm_password" name ="confirm_password" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" style="background-color: brown; border-color: brown;" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<?php include "../templates/footer.php"; ?>


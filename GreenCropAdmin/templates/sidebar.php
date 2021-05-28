

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="../dist/img/gca.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-high">Green Crop Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            
            <li class="nav-item">
              <a href="products.php" class="nav-link <?php if($currentPage =='products'){echo 'active';}?> ">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                  Products
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="site-user-messages.php" class="nav-link <?php if($currentPage =='messages'){echo 'active';}?>">
                <i class="nav-icon fas fa-comment-alt"></i>
                <p>
                  Site Users Messages
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="news-and-promotions.php" class="nav-link <?php if($currentPage =='news'){echo 'active';}?>">
                <i class="nav-icon far fa-newspaper"></i>
                <p>
                  News and Promotions
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="gallery.php" class="nav-link <?php if($currentPage =='gallery'){echo 'active';}?>">
                <i class="nav-icon far fa-images"></i>
                <p>
                  Gallery
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="login.php" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
            
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>



    <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

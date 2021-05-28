<?php 
  $currentWebPage = 'contact';
  include "../templates/header.php";
?>

  <!-- ##### Breadcrumb Area Start ##### -->
  <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url('../img/bg-img/24.jpg');">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <div class="breadcrumb-text">
            <h2>CONTACT US</h2>
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
          <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
      </nav>
    </div>
  </div>
  <!-- ##### Breadcrumb Area End ##### -->

  <!-- ##### Contact Information Area Start ##### -->
  <section class="contact-info-area">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Section Heading -->
          <div class="section-heading text-center">
            <p>CONTACT INFO</p>
            <h2>The Best Ways To Contact Us</h2>
            
          </div>
        </div>
      </div>

      <div class="row">

        <!-- Single Information Area -->
        <div class="col-12 col-md-4">
          <div class="single-information-area text-center mb-100 wow fadeInUp" data-wow-delay="100ms">
            <div class="contact-icon">
              <i class="icon_pin_alt"></i>
            </div>
            <h5>Address</h5>
            <h6>20, Colombo 5, Kurunagala, Sri Lanka</h6>
          </div>
        </div>

        <!-- Single Information Area -->
        <div class="col-12 col-md-4">
          <div class="single-information-area text-center mb-100 wow fadeInUp" data-wow-delay="500ms">
            <div class="contact-icon">
              <i class="icon_phone"></i>
            </div>
            <h5>Phone</h5>
            <h6>(+94) 37-2345678</h6>
            
          </div>
        </div>

        <!-- Single Information Area -->
        <div class="col-12 col-md-4">
          <div class="single-information-area text-center mb-100 wow fadeInUp" data-wow-delay="1000ms">
            <div class="contact-icon">
              <i class="icon_mail_alt"></i>
            </div>
            <h5>Email</h5>
            <h6>info.greencrop@gmail.com</h6>
          </div>
        </div>

      </div>
      <div class="c-border"></div>
    </div>
  </section>
  <!-- ##### Contact Information Area End ##### -->

  <!-- ##### Contact Area Start ##### -->
  <section class="contact-area section-padding-100-0">
    <div class="container">
      <div class="row justify-content-between">

        <!-- Contact Content -->
        <div class="col-12 col-lg-5">
          <div class="contact-content mb-100">
            <!-- Section Heading -->
            <div class="section-heading">
              <p>Update With Our New Products</p>
              <h2>Get In Touch With Us</h2>
             
            </div>
            <!-- Contact Form Area -->
            <div class="contact-form-area">
              <form action="scripts/save_messages.php" method="POST">
                <div class="row">
                  <div class="col-12">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                  </div>
                  <div class="col-12">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                  </div>
				          <div class="col-12">
                    <textarea name="message" class="form-control" id="message" name="message" cols="30" rows="10" placeholder="Your Message" required></textarea>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn famie-btn">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Contact Maps -->
        
      </div>
    </div>
  </section>
  <!-- ##### Contact Area End ##### -->

  <?php include "../templates/footer.php"; ?>
<?php 
  $currentPage = 'gallery';
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
            <h1>Gallery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gallery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="row float-right">
                <div class="col-sm-12">
                  <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal_gallery" style="background-color: #77b122; border-color: #77b122;"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Gallery Images</button>
                </div>  
              </div>
              <br>
            <div class="card card-primary mt-3">
              <div class="card-body">
                <div>
                    <div class="float-right">
                      <select class="custom-select" style="width: auto;" data-sortOrder>
                        <option value="index"> Sort by Position </option>
                      </select>
                      <div class="btn-group">
                        <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                        <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                      </div>
                    </div>
                  </div>
                <div>
                  <div class="filter-container p-0 row" style="margin-top: 60px;">
                    <?php   
                      $result = mysqli_query($conn, "SELECT * FROM gallery");
                      while($row = mysqli_fetch_array($result)){
                    ?>
                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                      <a href="<?php echo $row['image']; ?>" data-toggle="lightbox" data-title="">
                      <img src="<?php echo $row['image']; ?>" class="img-thumbnail mb-2" alt="white sample"/>
                      </a>
                      <div class='btn-group btn-group-sm'>
                        <button type='button' class='btn btn-info' onclick='fillGalleryUpdateFields(<?php echo $row["id"]; ?>)'><i class='fas fa-edit'></i></button>
                        <button type='button' class='btn btn-danger' onclick='showGalleryDeleteModel(<?php echo $row["id"]; ?>)'><i class='fas fa-trash'></i></button>
                      </div>
                    </div> 
                    <?php 
                      } 
                    ?>  
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->


      <!-- Insert Gallery Model -->
      <div class="modal fade" id="modal_gallery">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- form start -->
            <form role="form" id="gallery_form" enctype="multipart/form-data">
              <div class="modal-body">
                  <!-- Main content -->
                  <section class="content">
                    <div class="container-fluid">
                      <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                          <!-- jquery validation -->
                          <div class="card card-primary">
                            <div class="card-header" style="background-color: #77b122;">
                              <h3 class="card-title" id="product_header">New Image</h3>
                            </div>
                            <!-- /.card-header -->
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="gallery_file">Select Image</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="gallery_file" name="gallery_file">
                                      <label class="custom-file-label">Choose file</label>
                                    </div>
                                  </div> 
                                </div>       
                              </div>
                              <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                          </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">

                        </div>
                        <!--/.col (right) -->
                      </div>
                      <!-- /.row -->
                    </div><!-- /.container-fluid -->
                  </section>
                  <!-- /.content -->
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" style="background-color: #77b122; border-color: #77b122;">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




      <!-- Update Gallery Model -->
      <div class="modal fade" id="modal_gallery_update">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- form start -->
            <form role="form" id="gallery_form_update" enctype="multipart/form-data">
              <div class="modal-body">
                  <!-- Main content -->
                  <section class="content">
                    <div class="container-fluid">
                      <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                          <!-- jquery validation -->
                          <div class="card card-primary">
                            <div class="card-header" style="background-color: #77b122;">
                              <h3 class="card-title" id="product_header">Update Image</h3>
                            </div>
                            <!-- /.card-header -->
                              <div class="card-body">                                
                                <input type='hidden' name='is_update' id='is_update' value=0>
                                <input type='hidden' name='image_id' id='image_id' value=''>
                                <div class="form-group">
                                  <label for="ugallery_file">Select Image</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="ugallery_file" name="ugallery_file">
                                      <label class="custom-file-label">Choose file</label>
                                    </div>
                                  </div> 
                                </div>
                                <br>
                                <img id='ugallery_image' src='' height='200' width='200' class='img-thumbnail' />
                              </div>
                              <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                          </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">

                        </div>
                        <!--/.col (right) -->
                      </div>
                      <!-- /.row -->
                    </div><!-- /.container-fluid -->
                  </section>
                  <!-- /.content -->
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" style="background-color: #77b122; border-color: #77b122;">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <!-- Update Confirmation Model -->
      <div class="modal fade" id="modal_gallery_update_confirm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to update this image?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-primary" style="background-color: #77b122; border-color: #77b122;" onclick="saveUpdateGallery()">Yes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <!-- Delete Confirmation Model -->
      <div class="modal fade" id="modal_gallery_delete_confirm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <input type='hidden' name='gallery_delete_id' id='gallery_delete_id' value=''>
              <h4 class="modal-title">Delete Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete this image?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-primary" style="background-color: #77b122; border-color: #77b122;" onclick="deleteImage()">Yes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

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

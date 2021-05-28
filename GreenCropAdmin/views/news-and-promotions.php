<?php 
  $currentPage = 'news';
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
            <h1>News and Promotions</h1>           
          </div>                 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">News and Promotions</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-sm-3">
            <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal_news" style="background-color: #77b122; border-color: #77b122;"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add News or Promotion</button>
          </div>  
        </div>
      </div><!-- /.container-fluid --> 
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="news_and_promo_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th hidden>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php   
                      $result = mysqli_query($conn, "SELECT * FROM news_and_promo");
                      while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                      <td hidden><input type='hidden' name='news_row_id' id='news_row_id' value='<?php echo $row['id']; ?>'></td>
                      <td><?php echo $row['title']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><img src='<?php echo $row['image']; ?>' height='80' width='80' class='img-thumbnail' /></td>
                      <td><?php echo $row['category']; ?></td>
                      <td class='text-right py-0 align-middle'>
                          <div class='btn-group btn-group-sm'>
                            <button type='button' class='btn btn-info' onclick='fillNewsFields(<?php echo $row["id"]; ?>)'><i class='fas fa-edit'></i></button>
                            <button type='button' class='btn btn-danger' onclick='showNewsDeleteModel(<?php echo $row["id"]; ?>)'><i class='fas fa-trash'></i></button>
                          </div>
                      </td>
                    </tr>
                    <?php 
                      } 
                    ?>     
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

      <!-- Insert News Model -->
      <div class="modal fade" id="modal_news">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- form start -->
            <form role="form" id="news_and_promo_form" enctype="multipart/form-data">
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
                              <h3 class="card-title">New News or Promotion</h3>
                            </div>
                            <!-- /.card-header -->
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="news_title">Title</label>
                                  <input type="text" name="news_title" class="form-control" id="news_title" placeholder="Enter Title">
                                </div>
                                <!-- textarea -->
                                <div class="form-group">
                                  <label for="news_description">Description</label>
                                  <textarea class="form-control" rows="3" name="news_description" id="news_description" placeholder="Enter Description"></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="news_image">Display Image</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="news_image" name="news_image">
                                      <label class="custom-file-label">Choose file</label>
                                    </div>
                                  </div>
                                </div>
                                <!-- select -->
                                <div class="form-group">
                                  <label>Category</label>
                                  <select class="form-control" name="news_category" id="news_category">
                                    <option>News</option>
                                    <option>Promotion</option>
                                  </select>
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


      <!-- Update News Model -->
      <div class="modal fade" id="modal_news_update">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- form start -->
            <form role="form" id="news_and_promo_form_update" enctype="multipart/form-data">
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
                              <h3 class="card-title">Update News or Promotion</h3>
                            </div>
                            <!-- /.card-header -->
                              <div class="card-body">
                                <div class="form-group">
                                  <input type='hidden' name='is_news_update' id='is_news_update' value=0>
                                  <input type='hidden' name='news_id' id='news_id' value=''>
                                  <label for="unews_title">Title</label>
                                  <input type="text" name="unews_title" class="form-control" id="unews_title" placeholder="Enter Title">
                                </div>
                                <!-- textarea -->
                                <div class="form-group">
                                  <label for="unews_description">Description</label>
                                  <textarea class="form-control" rows="3" name="unews_description" id="unews_description" placeholder="Enter Description"></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="unews_image">Display Image</label>
                                  <div class="input-group">
                                    <img id='news_image_view' src='' height='100' width='100' class='img-thumbnail' />
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="unews_image" name="unews_image">
                                      <label class="custom-file-label">Choose file</label>
                                    </div>
                                  </div>
                                </div>
                                <!-- select -->
                                <div class="form-group">
                                  <label>Category</label>
                                  <select class="form-control" name="unews_category" id="unews_category">
                                    <option>News</option>
                                    <option>Promotion</option>
                                  </select>
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




      <!-- Update Confirmation Model -->
      <div class="modal fade" id="modal_update_news_confirm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to update this record?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-primary" style="background-color: #77b122; border-color: #77b122;" onclick="saveUpdateNews()">Yes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <!-- Delete Confirmation Model -->
      <div class="modal fade" id="modal_delete_news_confirm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <input type='hidden' name='news_delete_id' id='news_delete_id' value=''>
              <h4 class="modal-title">Delete Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete this record?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-primary" style="background-color: #77b122; border-color: #77b122;" onclick="deleteNews()">Yes</button>
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


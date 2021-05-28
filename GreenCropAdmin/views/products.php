<?php 
  $currentPage = 'products';
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
            <h1>Products</h1>           
          </div>                 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-sm-3">
            <button type="button" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal_product" style="background-color: #77b122; border-color: #77b122;"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Product</button>
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
                <table id="products_table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th hidden>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Rental Period</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php   
                      $result = mysqli_query($conn, "SELECT * FROM products WHERE is_deleted=0");
                      while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                      <td hidden><input type='hidden' name='product_row_id' id='product_row_id' value='<?php echo $row['id']; ?>'></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['currency'].' '.number_format($row['price'], 2, '.', ''); ?></td>
                      <td><img src='<?php echo $row['image']; ?>' height='80' width='80' class='img-thumbnail' /></td>
                      <td><?php echo $row['category']; ?></td>
                      <td><?php echo $row['rental_period']; ?></td>
                      <td class='text-right py-0 align-middle'>
                          <div class='btn-group btn-group-sm'>
                            <button type='button' class='btn btn-info' onclick='fillUpdateFields(<?php echo $row["id"]; ?>)'><i class='fas fa-edit'></i></button>
                            <button type='button' class='btn btn-danger' onclick='showDeleteModel(<?php echo $row["id"]; ?>)'><i class='fas fa-trash'></i></button>
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

      <!-- Insert Product Model -->
      <div class="modal fade" id="modal_product">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- form start -->
            <form role="form" id="products_form" enctype="multipart/form-data">
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
                              <h3 class="card-title" id="product_header">New Product</h3>
                            </div>
                            <!-- /.card-header -->
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="product_name">Product Name</label>
                                  <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter product name">
                                </div>
                                <!-- textarea -->
                                <div class="form-group">
                                  <label for="product_description">Description</label>
                                  <textarea class="form-control" rows="3" name="product_description" id="product_description" placeholder="Enter Product Description"></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="product_currency">Price</label>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="input-group">
                                          <select class="form-control" name="product_currency" id="product_currency">
                                            <option>Rs</option>
                                            <option>$</option>
                                          </select>
                                      </div>
                                      <!-- /input-group -->
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                      <div class="input-group">
                                        <input type="text" name="product_price" class="form-control" id="product_price" placeholder="Enter product price">
                                      </div>
                                      <!-- /input-group -->
                                    </div>
                                    <!-- /.col-lg-6 -->
                                  </div>
                                  <!-- /.row -->
                                </div>
                                <div class="form-group">
                                  <label for="product_image">Product Image</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="product_image" name="product_image">
                                      <label class="custom-file-label">Choose file</label>
                                    </div>
                                  </div>
                                </div>
                                <!-- select -->
                                <div class="form-group">
                                  <label>Category</label>
                                  <select class="form-control" name="product_category" id="product_category">
                                    <option>Fruits</option>
                                    <option>Cut Flowers</option>
                                    <option>Plants for Landscaping</option>
                                    <option>Plants for Rent</option>
                                  </select>
                                </div>
                                <label for="product_rental_period">Rental</label>
                                <div class="row">
                                  <div class="col-lg-6">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <input type="checkbox" name="product_is_rental" id="product_is_rental" value=0>
                                        </span>
                                      </div>
                                      <input type="text" class="form-control" name="product_rental_period" id="product_rental_period" placeholder="Enter Rental Period">
                                    </div>
                                    <!-- /input-group -->
                                  </div>
                                  <!-- /.col-lg-6 -->
                                </div>
                                <!-- /.row -->
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


      <!-- Update Product Model -->
      <div class="modal fade" id="modal_product_update">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- form start -->
            <form role="form" id="products_form_update" enctype="multipart/form-data">
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
                              <h3 class="card-title" id="product_header">Update Product</h3>
                            </div>
                            <!-- /.card-header -->
                              <div class="card-body">
                                <div class="form-group">
                                  <input type='hidden' name='is_update' id='is_update' value=0>
                                  <input type='hidden' name='product_id' id='product_id' value=''>
                                  <label for="uproduct_name">Product Name</label>
                                  <input type="text" name="uproduct_name" class="form-control" id="uproduct_name" placeholder="Enter product name">
                                </div>
                                <!-- textarea -->
                                <div class="form-group">
                                  <label for="uproduct_description">Description</label>
                                  <textarea class="form-control" rows="3" name="uproduct_description" id="uproduct_description" placeholder="Enter Product Description"></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="uproduct_currency">Price</label>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="input-group">
                                          <select class="form-control" name="uproduct_currency" id="uproduct_currency">
                                            <option>Rs</option>
                                            <option>$</option>
                                          </select>
                                      </div>
                                      <!-- /input-group -->
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                      <div class="input-group">
                                        <input type="text" name="uproduct_price" class="form-control" id="uproduct_price" placeholder="Enter product price">
                                      </div>
                                      <!-- /input-group -->
                                    </div>
                                    <!-- /.col-lg-6 -->
                                  </div>
                                  <!-- /.row -->
                                </div>
                                <div class="form-group">
                                  <label for="uproduct_image">Product Image</label>
                                  <div class="input-group">
                                    <img id='uprod_image' src='' height='100' width='100' class='img-thumbnail' />
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="uproduct_image" name="uproduct_image">
                                      <label class="custom-file-label">Choose file</label>
                                    </div>
                                  </div>
                                </div>
                                <!-- select -->
                                <div class="form-group">
                                  <label>Category</label>
                                  <select class="form-control" name="uproduct_category" id="uproduct_category">
                                    <option>Fruits</option>
                                    <option>Cut Flowers</option>
                                    <option>Plants for Landscaping</option>
                                    <option>Plants for Rent</option>
                                  </select>
                                </div>
                                <label for="uproduct_rental_period">Rental</label>
                                <div class="row">
                                  <div class="col-lg-6">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <input type="checkbox" name="uproduct_is_rental" id="uproduct_is_rental" value=0>
                                        </span>
                                      </div>
                                      <input type="text" class="form-control" name="uproduct_rental_period" id="uproduct_rental_period" placeholder="Enter Rental Period">
                                    </div>
                                    <!-- /input-group -->
                                  </div>
                                  <!-- /.col-lg-6 -->
                                </div>
                                <!-- /.row -->
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
      <div class="modal fade" id="modal_update_confirm">
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
              <button type="button" class="btn btn-primary" style="background-color: #77b122; border-color: #77b122;" onclick="saveUpdateProduct()">Yes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


      <!-- Delete Confirmation Model -->
      <div class="modal fade" id="modal_delete_confirm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <input type='hidden' name='product_delete_id' id='product_delete_id' value=''>
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
              <button type="button" class="btn btn-primary" style="background-color: #77b122; border-color: #77b122;" onclick="deleteProduct()">Yes</button>
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
</div>
<!-- ./wrapper -->


<?php include "../templates/footer.php"; ?>





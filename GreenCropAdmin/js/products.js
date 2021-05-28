$(function () {
    $("#products_table").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

   $(document).ready(function () {
    //For custom file input
    bsCustomFileInput.init();

    //Validate form
    $.validator.setDefaults({
      submitHandler: function () {
        if($('#is_update').val() === "0"){
          saveProduct();
        } else{
          $('#modal_product_update').modal('hide');
          $('#modal_update_confirm').modal('show');
        }       
      }
    });
    //Validate insert form
    $('#products_form').validate({    
      rules: {
        product_name: {
          required: true
        },
        product_description: {
          required: true
        },
        product_price: {
          required: true
        },
        product_image: {
          required: true
        },
      },
      messages: {
        product_name: "Please enter product name",
        product_description: "Please enter product description",
        product_price: "Please enter product price",
        product_image: "Please provide product image"
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });      

    //Validate update form
    $('#products_form_update').validate({    
      rules: {
        uproduct_name: {
          required: true
        },
        uproduct_description: {
          required: true
        },
        uproduct_price: {
          required: true
        }
      },
      messages: {
        uproduct_name: "Please enter product name",
        uproduct_description: "Please enter product description",
        uproduct_price: "Please enter product price"
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    }); 

  });
  

  //Save Products
  function saveProduct(){
    //Read uploaded file data
    var extension = (document.getElementById("product_image").files[0].name).split('.').pop().toLowerCase();    
    var file = document.getElementById("product_image").files[0];
    var file_size = file.size || file.fileSize;
    
    //Check if uploaded file type is image
    if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
    {    
      toastr.error("Invalid image file.");         
    } else if(file_size > 10000000) //10 MB
    {
      toastr.error("Image file size is more than 10MB.");
    } else{
      if ($('#product_is_rental').is(":checked"))
      {
        $('#product_is_rental').val(1);
        var rental_period = $('#product_rental_period').val();
        if(rental_period === "" || rental_period === null){
          toastr.error("Rental period cannot be empty if rental checkbox is checked."); 
        } else{
            insertProduct();
        }
      } else{
          insertProduct();
      }      
    } 
  }

  //Insert products to database
  function insertProduct(){
    var form_data = new FormData();        
    form_data.append("product_name", $('#product_name').val());
    form_data.append("product_description", $('#product_description').val());
    form_data.append("product_currency", $('#product_currency').val());
    form_data.append("product_price", $('#product_price').val());
    form_data.append("product_image", document.getElementById('product_image').files[0]);
    form_data.append("product_category", $('#product_category').val());
    form_data.append("product_is_rental", $('#product_is_rental').val());
    form_data.append("product_rental_period", $('#product_rental_period').val());
 
    $.ajax({
      url:"scripts/save_products.php",
      method:"POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,   
      success:function(data)
      {
        $('#modal_product').modal('hide');
        toastr[data['status']](data['message']);
        clearProductFields();
        setTimeout( function () {
          window.location.reload();
        }, 3000 );
      }
    });
  }

  //Clear insert form fields
  function clearProductFields(){
    $('#product_name').val("");
    $('#product_description ').val("");
    $('#product_price').val("");
    $('#product_image').val("");
    $('#product_is_rental').val("");
    $('#product_rental_period').val("");
  }


  //Load inserted data to fill update form fields
  function fillUpdateFields(id){
    if(id){
      $('#is_update').val(1);
      $('#product_id').val(id);
      
      $.ajax({
        url:"scripts/view_products_by_id.php",
        method:"GET", 
        data : {"id": id},
        dataType: 'json',
        success:function(data)
        {
          $('#uproduct_name').val(data[0]['name']);
          $('#uproduct_description ').val(data[0]['description']);
          $('#uproduct_currency').val(data[0]['currency']);          
          $('#uproduct_price').val(parseFloat(data[0]['price']).toFixed(2));
          $('#uprod_image').attr('src', data[0]['image']);
          $('#uproduct_category').val(data[0]['category']);
          if(data[0]['for_rental'] === "1"){
            $('#uproduct_is_rental'). prop("checked", true);
          }         
          $('#uproduct_rental_period').val(data[0]['rental_period']);

          $('#modal_product_update').modal('show');
        }
      });
    }
  }


  //Update record
  function saveUpdateProduct(){
    if(document.getElementById("uproduct_image").files[0]){
      //Read uploaded file data
      var extension = (document.getElementById("uproduct_image").files[0].name).split('.').pop().toLowerCase();    
      var updatefile = document.getElementById("uproduct_image").files[0];
      var updatefile_size = updatefile.size || updatefile.fileSize;
      
      //Check if uploaded file type is image
      if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
      {    
        toastr.error("Invalid image file.");         
      } else if(updatefile_size > 10000000) //10 MB
      {
        toastr.error("Image file size is big.");
      } else{
        if ($('#uproduct_is_rental').is(":checked"))
        {
          $('#uproduct_is_rental').val(1);
          var rental_period = $('#uproduct_rental_period').val();
          if(rental_period === "" || rental_period === null){
            toastr.error("Rental period cannot be empty if rental checkbox is checked."); 
          } else{
              updateProduct();
          }
        } else{
            updateProduct();
        }      
      } 
    } else{
      if ($('#uproduct_is_rental').is(":checked"))
      {
        $('#uproduct_is_rental').val(1);
        var rental_period = $('#uproduct_rental_period').val();
        if(rental_period === "" || rental_period === null){
          toastr.error("Rental period cannot be empty if rental checkbox is checked."); 
        } else{
            updateProduct();
        }
      } else{
          updateProduct();
      }      
    }   
  }

  //Update record in database
  function updateProduct(){
    var form_data = new FormData();    
    form_data.append("product_id", $('#product_id').val());    
    form_data.append("uproduct_name", $('#uproduct_name').val());
    form_data.append("uproduct_description", $('#uproduct_description').val());
    form_data.append("uproduct_currency", $('#uproduct_currency').val());
    form_data.append("uproduct_price", $('#uproduct_price').val());

    if(document.getElementById('uproduct_image').files[0]){
      form_data.append("uproduct_image", document.getElementById('uproduct_image').files[0]);
    } 

    form_data.append("uproduct_category", $('#uproduct_category').val());
    form_data.append("uproduct_is_rental", $('#uproduct_is_rental').val());
    form_data.append("uproduct_rental_period", $('#uproduct_rental_period').val());
        
    $.ajax({
      url:"scripts/update_products.php",
      method:"POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,   
      success:function(data)
      {
        $('#modal_update_confirm').modal('hide');
        toastr[data['status']](data['message']);
        clearUpdateProductFields();
        setTimeout( function () {
          window.location.reload();
        }, 3000 );
      }
    });
  }

  //Clear update form fileds
  function clearUpdateProductFields(){
    $('#uproduct_name').val("");
    $('#uproduct_description ').val("");
    $('#uproduct_price').val("");
    $('#uproduct_image').val("");
    $('#uproduct_is_rental').val("");
    $('#uproduct_rental_period').val("");
    $('#is_update').val(0);
    $('#product_id').val("");
  }

  //Show delete confirmation model
  function showDeleteModel(id){
    $('#product_delete_id').val(id);
    $('#modal_delete_confirm').modal('show');
  }

  //Delete record in database
  function deleteProduct(){
    var id = $('#product_delete_id').val();
    $.ajax({
      url:"scripts/delete_products.php",
      method:"POST", 
      data : {"id": id},
      dataType: 'json',
      success:function(data)
      {
        $('#modal_delete_confirm').modal('hide');
        toastr[data['status']](data['message']);
        setTimeout( function () {
          window.location.reload();
        }, 3000 );
      }
    });
  }
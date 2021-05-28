$(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  });

  $(document).ready(function () {
    //For custom file input
    bsCustomFileInput.init();

    //Validate form
    $.validator.setDefaults({
      submitHandler: function () {
        if($('#is_update').val() === "0"){
          saveImage();
        } else{
          $('#modal_gallery_update').modal('hide');
          $('#modal_gallery_update_confirm').modal('show');
        }       
      }
    });
    //Validate insert form
    $('#gallery_form').validate({    
      rules: {
        gallery_file: {
          required: true
        }
      },
      messages: {
        gallery_file: "Please select image"
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
    $('#gallery_form_update').validate({    
      rules: {
        ugallery_file: {
          required: true
        }
      },
      messages: {
        ugallery_file: "Please provide image"
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

  
  //Save images
  function saveImage(){
    //Read uploaded file data
    var extension = (document.getElementById("gallery_file").files[0].name).split('.').pop().toLowerCase();    
    var imagefile = document.getElementById("gallery_file").files[0];
    var imagefile_size = imagefile.size || imagefile.fileSize;
    
    //Check if uploaded file type is image
    if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
    {    
      toastr.error("Invalid image file.");         
    } else if(imagefile_size > 10000000) //10 MB
    {
      toastr.error("Image file size is more than 10MB.");
    } else{
        insertImage(); 
    } 
  }

  //Insert image to database
  function insertImage(){
    var form_data = new FormData();        
    form_data.append("gallery_file", document.getElementById('gallery_file').files[0]);
        
    $.ajax({
      url:"scripts/save_gallery.php",
      method:"POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,   
      success:function(data)
      {
        $('#modal_gallery').modal('hide');
        toastr[data['status']](data['message']);
        clearGalleryFields();
        setTimeout( function () {
          window.location.reload();
        }, 3000 );
      }
    });
  }

  //Clear insert form fields
  function clearGalleryFields(){
    $('#gallery_file').val("");
  }

  //Load inserted data to fill update form fields
  function fillGalleryUpdateFields(id){
    if(id){
      $('#is_update').val(1);
      $('#image_id').val(id);
      
      $.ajax({
        url:"scripts/view_gallery_by_id.php",
        method:"GET", 
        data : {"id": id},
        dataType: 'json',
        success:function(data)
        {
          $('#ugallery_image').attr('src', data[0]['image']);

          $('#modal_gallery_update').modal('show');
        }
      });
    }
  }

  //Update record
  function saveUpdateGallery(){
    if(document.getElementById("ugallery_file").files[0]){
      //Read uploaded file data
      var extension = (document.getElementById("ugallery_file").files[0].name).split('.').pop().toLowerCase();    
      var updatefile = document.getElementById("ugallery_file").files[0];
      var updatefile_size = updatefile.size || updatefile.fileSize;
      
      //Check if uploaded file type is image
      if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
      {    
        toastr.error("Invalid image file.");         
      } else if(updatefile_size > 10000000) //10 MB
      {
        toastr.error("Image file size is big.");
      } else{
        updateGallery(); 
      } 
    } else{
      updateGallery();
    }   
  }

  //Update record in database
  function updateGallery(){
    var form_data = new FormData();    
    form_data.append("image_id", $('#image_id').val()); 
    if(document.getElementById('ugallery_file').files[0]){
      form_data.append("ugallery_file", document.getElementById('ugallery_file').files[0]);
    } 
        
    $.ajax({
      url:"scripts/update_gallery.php",
      method:"POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,   
      success:function(data)
      {
        $('#modal_gallery_update_confirm').modal('hide');
        toastr[data['status']](data['message']);
        clearUpdateGalleryFields();
        setTimeout( function () {
          window.location.reload();
        }, 3000 );
      }
    });
  }

  //Clear update form fileds
  function clearUpdateGalleryFields(){
    $('#ugallery_file').val("");
  }

  //Show delete confirmation model
  function showGalleryDeleteModel(id){
    $('#gallery_delete_id').val(id);
    $('#modal_gallery_delete_confirm').modal('show');
  }

  //Delete record in database
  function deleteImage(){
    var id = $('#gallery_delete_id').val();
    $.ajax({
      url:"scripts/delete_gallery.php",
      method:"POST", 
      data : {"id": id},
      dataType: 'json',
      success:function(data)
      {
        $('#modal_gallery_delete_confirm').modal('hide');
        toastr[data['status']](data['message']);
        setTimeout( function () {
          window.location.reload();
        }, 3000 );
      }
    });
  }
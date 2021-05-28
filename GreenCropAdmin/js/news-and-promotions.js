$(function () {
    $("#news_and_promo_table").DataTable({
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
        if($('#is_news_update').val() === "0"){
          saveNews();
        } else{
          $('#modal_news_update').modal('hide');
          $('#modal_update_news_confirm').modal('show');
        }
      }
    });
    //Validate insert form
    $('#news_and_promo_form').validate({
      rules: {
        news_title: {
          required: true
        },
        news_description: {
          required: true
        },
        news_image: {
          required: true
        },
      },
      messages: {
        news_title: "Please enter title name",
        news_description: "Please enter description",
        news_image: "Please provide display image"
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
    $('#news_and_promo_form_update').validate({
      rules: {
        unews_title: {
          required: true
        },
        unews_description: {
          required: true
        }
      },
      messages: {
        unews_title: "Please enter title name",
        unews_description: "Please enter description"
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


  //Save News
  function saveNews(){
    //Read uploaded file data
    var extension = (document.getElementById("news_image").files[0].name).split('.').pop().toLowerCase();    
    var file = document.getElementById("news_image").files[0];
    var file_size = file.size || file.fileSize;
    
    //Check if uploaded file type is image
    if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1) {   
      toastr.error("Invalid image file.");         
    } else if(file_size > 10000000) { //10 MB
      toastr.error("Image file size is more than 10MB.");
    } else{
          insertNews(); 
    } 
  }


  //Insert news to database
  function insertNews(){
    var form_data = new FormData();        
    form_data.append("news_title", $('#news_title').val());
    form_data.append("news_description", $('#news_description').val());
    form_data.append("news_image", document.getElementById('news_image').files[0]);
    form_data.append("news_category", $('#news_category').val());
        
    $.ajax({
      url:"scripts/save_news.php",
      method:"POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,   
      success:function(data)
      {
        $('#modal_news').modal('hide');
        toastr[data['status']](data['message']);
        clearNewsFields();
        setTimeout( function () {
          window.location.reload();
        }, 3000 );
      }
    });
  }


  //Clear insert form fields
  function clearNewsFields(){
    $('#news_title').val("");
    $('#news_description ').val("");
    $('#news_image').val("");
  }


  //Load inserted data to fill update form fields
  function fillNewsFields(id){
    if(id){
      $('#is_news_update').val(1);
      $('#news_id').val(id);
      
      $.ajax({
        url:"scripts/view_news_by_id.php",
        method:"GET", 
        data : {"id": id},
        dataType: 'json',
        success:function(data)
        {
          $('#unews_title').val(data[0]['title']);
          $('#unews_description ').val(data[0]['description']);
          $('#news_image_view').attr('src', data[0]['image']);
          $('#unews_category').val(data[0]['category']);

          $('#modal_news_update').modal('show');
        }
      });
    }
  }


  //Update record
  function saveUpdateNews(){
    if(document.getElementById("unews_image").files[0]){
      //Read uploaded file data
      var extension = (document.getElementById("unews_image").files[0].name).split('.').pop().toLowerCase();    
      var updatefile = document.getElementById("unews_image").files[0];
      var updatefile_size = updatefile.size || updatefile.fileSize;
      
      //Check if uploaded file type is image
      if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
      {    
        toastr.error("Invalid image file.");         
      } else if(updatefile_size > 10000000) //10 MB
      {
        toastr.error("Image file size is big.");
      } else{
        updateNews(); 
      } 
    } else{
      updateNews();  
    }   
  }


  //Update record in database
  function updateNews(){
    var form_data = new FormData();    
    form_data.append("news_id", $('#news_id').val());    
    form_data.append("unews_title", $('#unews_title').val());
    form_data.append("unews_description", $('#unews_description').val());
    form_data.append("unews_category", $('#unews_category').val());

    if(document.getElementById('unews_image').files[0]){
      form_data.append("unews_image", document.getElementById('unews_image').files[0]);
    } 
        
    $.ajax({
      url:"scripts/update_news.php",
      method:"POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,   
      success:function(data)
      {
        $('#modal_update_news_confirm').modal('hide');
        toastr[data['status']](data['message']);
        clearUpdateNewsFields();
        setTimeout( function () {
          window.location.reload();
        }, 3000 );
      }
    });
  }


  //Clear update form fileds
  function clearUpdateNewsFields(){
    $('#unews_title').val("");
    $('#unews_description ').val("");
    $('#unews_image').val("");
    $('#is_news_update').val(0);
    $('#news_id').val("");
  }

  
  //Show delete confirmation model
  function showNewsDeleteModel (id){
    $('#news_delete_id').val(id);
    $('#modal_delete_news_confirm').modal('show');
  }


  //Delete record in database
  function deleteNews(){
    var id = $('#news_delete_id').val();
    $.ajax({
      url:"scripts/delete_news.php",
      method:"POST", 
      data : {"id": id},
      dataType: 'json',
      success:function(data)
      {
        $('#modal_delete_news_confirm').modal('hide');
        toastr[data['status']](data['message']);
        setTimeout( function () {
          window.location.reload();
        }, 3000 );
      }
    });
  }
$(document).ready(function () {
  //Validate form
    $.validator.setDefaults({
      submitHandler: function () {
        loginUser();
      }
    });
    //Validate login form
    $('#login_form').validate({    
      rules: {
        email: {
          required: true
        },
        password: {
          required: true
        }
      },
      messages: {
        email: "Please enter email",
        password: "Please enter password"
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

  //Process Login
  function loginUser(){
    var form_data = new FormData();        
    form_data.append("email", $('#email').val());
    form_data.append("password", $('#password').val());
        
    $.ajax({
      url:"scripts/login_user.php",
      method:"POST",
      data: form_data,
      contentType: false,
      cache: true,
      processData: false,   
      success:function(data)
      {
        if(data['status'] === "success"){
            window.location.href = "index.php";
        } else{
            toastr[data['status']](data['message']);
        }
               
      }
    });
  }
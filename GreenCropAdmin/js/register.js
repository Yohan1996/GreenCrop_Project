$(document).ready(function () {
    //Validate form
    $.validator.setDefaults({
      submitHandler: function () {
        registerUser();
      }
    });
    //Validate insert form
    $('#register_form').validate({    
      rules: {
        name: {
          required: true
        },
        email: {
          required: true
        },
        password: {
          required: true,
          pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
        },
        confirm_password: {
          required: true,
          equalTo : "#password"
        },
      },
      messages: {
        name: "Please enter name",
        email: "Please enter email",
        password: {
            required: "Please enter password",
            pattern: "Password must be minimum eight characters length and must have at least one uppercase letter, one lowercase letter, one number and one special character."
        },
        confirm_password: {
            required: "Please retype password",
            equalTo: "Confirm password and password does not match"
        }
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

  //Insert user to database
  function registerUser(){
    var form_data = new FormData();        
    form_data.append("name", $('#name').val());
    form_data.append("email", $('#email').val());
    form_data.append("password", $('#password').val());
        
    $.ajax({
      url:"scripts/register_user.php",
      method:"POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,   
      success:function(data)
      {
        toastr[data['status']](data['message']);
        if(data['status'] === "success"){
            setTimeout( function () {
                window.location.href = "login.php";
            }, 3000 );
        }        
      }
    });
  }
<?php
  switch($currentPage){
      case 'home':
        $title = 'Home';
        break;
      case 'products':
        $title = 'Products';
        break;
      case 'news':
        $title = 'News and Promotions';
        break;
      case 'messages':
        $title = 'Site Users Messages';
        break;
      case 'gallery':
        $title = 'Gallery';
        break;
      case 'register':
        $title = 'Register';
        break;
      case 'login':
        $title = 'Login';
        break;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Green Crop Admin | <?php echo $title; ?></title>
  <!-- Favicon -->
  <link rel="icon" href="../dist/img/favicon.ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">

  <style>
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
      background-color: #77b122;
    }
  </style> 
</head>

<?php
  if($currentPage === 'register'){
?>
  <body class="hold-transition register-page">
<?php
  } else if($currentPage === 'login'){
?>
  <body class="hold-transition login-page">
<?php
  } else {
?>
  <body class="hold-transition sidebar-mini">
<?php
  }
?>    

</body>
</html>





<html>

<head>
  <title>CMS</title>
  <link rel="stylesheet" href="include/style.css">
  <script src="include/script.js"></script>

  <!--?php include 'include/external.php'; ?-->

</head>

<body class="d-flex flex-column min-vh-100">

  <?php
  include 'include/validate_user.php';
  include 'include/menubar.php';
  include 'include/dbconnect.php';


      if ($_SERVER['REQUEST_METHOD'] == 'POST') {  

        $userid= $_SESSION['user_id'];
        $pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

    
        $query = "UPDATE `users` SET `password` = '$pwd' WHERE `user_id` = '{$userid}'";
    
        $result = $conn->query($query);

    if ($conn->affected_rows > 0) {
        echo '  
            <div class="d-flex flex-column flex-grow-1 align-items-center mt-5">
                <div class="alert alert-success alert-dismissible fade show col-lg-6 col-md-8" role="alert">
                    Password Changed.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>';
    } else {
        echo '  
            <div class="d-flex flex-column flex-grow-1 align-items-center mt-5">
                <div class="alert alert-danger alert-dismissible fade show col-lg-6 col-md-8" role="alert">
                    Could Not Change Password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>';
    }
    $conn->close();
      }
  ?>


    
 </body> 
 </html>
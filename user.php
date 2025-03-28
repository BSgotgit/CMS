<html>

<head>
  <title>CMS</title>
  <link rel="stylesheet" href="include/style.css">
  <script src="include/script.js"></script>

  <!--?php include 'include/external.php'; ?-->

  <!-- TODO add an offline "search icon" -->
</head>

<body>

  <?php include 'include/menubar.php';

  //$_SESSION['username'] = $_GET['username']; // worked but not as expected.
  ?>
  <br>
  <div class="container">
    <div class="row">


      <!--   LEFT SIDE MAIN POSTS  -->

      <section class="col-lg-7">
        <?php

        // Checking if Category is Selected or Not (in menubar)
        
        if (!empty($_GET['username']) && !empty($_GET['password'])) {
          $queryV = "SELECT * FROM `users` WHERE username ='$_GET[username]' AND password ='$_GET[password]'";

          $resultV = mysqli_query($conn, $queryV);

          if (mysqli_num_rows($resultV) > 0) {

            //$valid=1;
            $_SESSION['validate'] = "valid";

            $rowV = mysqli_fetch_array($resultV);
            //$userid = $row1["user_id"];
        
            $query = "SELECT * FROM `posts` WHERE  user_id='$rowV[user_id]'";
            $result = mysqli_query($conn, $query);
            // Fetching/getting each record/row in loop from result set
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<div class="card">
                            <div class="card-header">
                                <strong>' . $row['title'] . '</strong>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <img src=" ' . $row['image'] . '" width="100%" alt="..." class="">
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="card-text">' . substr($row['description'], 0, 190) . '..... </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class=""> <a href="readpost.php?pid=' . $row['post_id'] . '" class="btn btn-secondary">Read More</a></div>
                                </div>

                            </div>

                        </div> </br>';
            }
          } else {
            //unset($_SESSION['validate']);
            echo ' 
                      <div> 
                          <h4>Invalid Username/Password <h4><br>
                          <a href="login.php">Click here to login again.</a>
                      </div>    
                      ';

          }
        } else {

          header("Location: login.php");
          //$message = "This is your alert message!";
          //echo "<script type='text/javascript'>alert('$message');</script>";
        }


        ?>
      </section>

      <!--   RIGHT SIDE CONTENTS  -->

      <aside class="col-lg-5">



      </aside>

    </div>

  </div>


</body>

</html>
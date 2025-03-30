<html>

<head>
  <title>CMS</title>
  <link rel="stylesheet" href="include/style.css">
  <script src="include/script.js"></script>

  <!--?php include 'include/external.php'; ?-->

</head>

<body>

  <?php
  include 'include/validate_user.php';
  include 'include/menubar.php';
  ?>
  <br>

  <div class="container">
    <div class="row">

      <!--   LEFT SIDE MAIN POSTS  -->

      <section class="col-lg-7">
        <?php

        $query = "SELECT * FROM `posts` WHERE user_id = '{$_SESSION['user_id']}' ORDER BY `date` DESC ";
        $result = mysqli_query($conn, $query);

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
        ?>
      </section>


      <!--   RIGHT SIDE CONTENTS  -->

      <aside class="col-lg-5">
        <div class="card">
          <div class="card-header bg-dark text-white">
            <strong>About User</strong>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12 mt-2">
                <h2 class="card-text"><?php echo $_SESSION['username']?></h2>
              </div>
              <br>
              <br>
              <br>
              <hr>
              <div class="col-lg-12 mt-3">
               <span class="card-text"> <b>Email</b> </span><br>
                <p class="card-text"> <?php echo $_SESSION['email']?> </p>
              </div>

              <div class="col-lg-12 mt-3">
               <span class="card-text"> <b>Gender</b> </span><br>
                <p class="card-text"> <?php echo $_SESSION['gender']?> </p>
              </div>
            </div>
            <br><br>
            <div class="row">
            <span class="card-text"> <b>Joined on :</b> </span><br>
                <p class="card-text"> <?php echo $_SESSION['date']?> </p>
              
            </div>
            <br>
            <div class="row">

              <div>
                <a  href="edituser.php"><img style="max-width: 25px;" src="icons/edits.png" alt="Edit"></a> 
              </div>
  
            </div>

          </div>

        </div>
      </aside>

    </div>

  </div>

</body>

</html>
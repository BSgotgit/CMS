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

      </aside>

    </div>

  </div>

</body>

</html>
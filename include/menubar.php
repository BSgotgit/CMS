<?php
//error_reporting(0);// This hides all error warnings.

include 'include/dbconnect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$logged_in = isset($_SESSION['email']);
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
    <a class="navbar-brand" href="index.php">CMS</a>

         <!-- Mobile Toggle Button -->
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php

                echo '<li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>';

                $category = "Category";
                $st = "";
                if (isset($_GET['cate'])) {
                    $category = $_GET['cate'];
                    $st = "active";
                }

                echo '<li class="nav-item dropdown">
                   <a class="nav-link   dropdown-toggle  ' . $st . ' " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ' . $category . '
                   </a>
                       <ul class="dropdown-menu bg-dark">
                    ';

                echo '<li class="nav-item">
                          <a class="nav-link" aria-current="page" href="index.php">All Category</a>
                         </li> 
                        ';

                $sel_cat = "SELECT DISTINCT `category` from posts ";
                $run_cat = mysqli_query($conn, $sel_cat);

                while ($rows = mysqli_fetch_assoc($run_cat)) {
                    if (isset($_GET['cate']) && ($_GET['cate'] == $rows['category'])) {
                        $state = "active";
                    } else {
                        $state = "";
                    }

                    echo '<li class="nav-item">
                            <a class="nav-link ' . $state . '" aria-current="page" href="index.php?cate='
                        . $rows['category'] . '">' . ucfirst($rows['category']) . '</a> </li>
                    ';
                }

                echo '</ul>
                       </li>';


                echo '</ul>';


                // new post /edit post section
                if($role == 'contributer' || $role == 'editor' || $role == 'admin') {
                    echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link me-3" aria-current="page" href="newpost.php">New Post</a>
                            </li>    
                                <span class="nav-link me-3">|</span>
                            <li class="nav-item">    
                                <a class="nav-link me-4" aria-current="page" href="manageposts.php">Manage Posts</a>
                            </li>
                        </ul> ';
                }

                // dashboard 
                if($role == 'admin' || $role == 'editor'){
                    echo '
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link me-3" aria-current="page" href="dashboard.php">DASHBOARD</a>
                            </li> 
                        </ul>
                    ';
                }



                if ($logged_in) {
                    echo '                       
                            <div class="d-flex text-white " id="user-name">
                              <a href="user.php" style="color: white; text-decoration: none;"> <b> ' . $_SESSION['username'] . '</b> </a>
                            </div> 

                            <div class="d-flex text-white ms-3">
                                <a href="logout.php" class="btn btn-outline-light ">Logout</a>
                            </div> 
                    ';
                } else {
                    echo '
                        <!--/ul-->
                        <div class="d-flex">
                               <a href="login.php" class="btn btn-outline-light me-2">Login</a>
                               <a href="signup.php" class="btn btn-outline-light">Sign Up</a>
                        </div>';
                }
                ?>
        </div>
    </div>
</nav>
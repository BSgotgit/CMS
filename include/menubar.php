<?php
//error_reporting(0);// This hides all error warnings.

include 'include/dbconnect.php';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
        <!--a href="view.php" class="navbar-brand">CMS SYSTEM</a-->
        <!--label class= "navbar-brand">CMS System</label-->

        <span class="navbar-brand">CMS</span>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <!--li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li-->
                
                <?php
                if(!isset($_GET['username']))
            {  
                echo'<li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>';

                      $category="Category";
                      $st ="";
                      if (isset($_GET['cate']))
                      {
                          $category=$_GET['cate'];
                          $st="active";
                      }
                      
                 echo '<li class="nav-item dropdown">
                   <a class="nav-link   dropdown-toggle  '.$st.' " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    '.$category.'
                   </a>
                       <ul class="dropdown-menu bg-dark">
                    ';

                    echo '<li class="nav-item">
                          <a class="nav-link" aria-current="page" href="index.php">All Category</a>
                         </li> 
                        ';

                $sel_cat = "SELECT DISTINCT `category` from posts";
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
            }        
                ?>
            </ul>  
                <!-- Temporary -->
              <?php 
              //$valid=0;
               if(!empty($_GET['username'])&& !empty($_GET['password'])&& !empty($_SERVER['PHP_SELF'])){
                echo ' 
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link me-3" aria-current="page" href="newpost.php?username=user" >New Post</a>
                </li>    
                    <span class="nav-link me-3">|</span>
                <li class="nav-item">    
                    <a class="nav-link me-4" aria-current="page" href="manageposts.php?username=user">Manage Posts</a>
                </li>
            </ul>   
                <div class="d-flex text-white">
                    <a href="index.php" class="btn btn-outline-light ">Logout</a>
                </div> 
                ';
               }
               else  {
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
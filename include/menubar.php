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
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>

                <?php

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

                ?>

    

                <!-- Temporary -->
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="newpost.php">New Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="manageposts.php">Manage Posts</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
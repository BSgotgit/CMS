<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>

    <!--?php include 'include/external.php'; ?-->

</head>

<body>

    <?php
    include 'include/menubar.php';
    ?>
    <br>

    <div class="container">
        <div class="row">


            <!--   LEFT SIDE MAIN POSTS  -->

            <section class="col-lg-7">
                <?php

                // Checking if Category is Selected or Not (in menubar)
                
                if (isset($_GET['cate'])) {
                    $query = "SELECT * FROM `posts` WHERE category='$_GET[cate]'";
                } else {
                    // SHOWING RECENT 10 POSTS IN HOME PAGE
                    $query = "SELECT * FROM `posts` ORDER BY `date` DESC LIMIT 10 ";
                }

                // Executing the mysql query
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
                ?>
            </section>


            <!--   RIGHT SIDE CONTENTS  -->

            <aside class="col-lg-5">

                <!--     SEARCH BOX  -->

                <form role="form" action="search.php" method="get">
                    <div class="card">

                        <div class="card-header">Search Something</div>

                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="input-group">
                                    <input type="search" class="form-control" name="query" placeholder="">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <img src="icons/search-icon.png" style="max-width: 20px;"></img>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


 
                <!--    FEATURED / HIGHLIGHTED POSTS  -->

                <?php

                $query = "SELECT `post_id`,`title`, `description` FROM `posts` WHERE `featured` = 1 ORDER BY `date` DESC LIMIT 5 ";

                //Executing the mysql query
                $result = mysqli_query($conn, $query);

                // Fetching/getting each record/row in loop from result set
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                       <div class="list-group">
                       <a href="readpost.php?pid=' . $row['post_id'] . '" class="list-group-item">
                       <h4 class="list-group-item-heading"> ' . $row['title'] . '</h4>
                       <p class="list-group-item-text">' . substr($row['description'], 0, 230) . '</p>
                       </a>
                       </div> </br>
                   ';
                }
                ?>


            </aside>

        </div>

    </div>
    <?php include 'include/footer.php'; ?>
</body>

</html>
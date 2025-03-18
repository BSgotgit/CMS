<html>

<head>
    <title>CMS</title>
    <script src="jQry/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- TODO add an offline "search icon" -->
</head>

<body>

    <?php include 'include/menubar.php'; ?>
    <br>

    <div class="container">
        <div class="row">


            <!--   LEFT SIDE MAIN POSTS  -->

            <section class="col-lg-7">
                <?php

                // Checking if Category is Selected or Not (in menubar)

                if (isset($_GET['cate'])) {
                    $sel_sql = "SELECT * FROM `posts` WHERE category='$_GET[cate]'";
                } else {
                    // SHOWING RECENT 10 POSTS IN HOME PAGE
                    $sel_sql = "SELECT * FROM `posts` ORDER BY `date` DESC LIMIT 10 ";
                }

                $runs_sql = mysqli_query($conn, $sel_sql);

                while ($row = mysqli_fetch_assoc($runs_sql)) {
                    echo '<div class="card">
                            <div class="card-header">
                                        <strong>' . $row['title'] . '</strong>
                                    </div>
                                <div class="card-body">

                                    <div class="row">
                                    <div class="col-lg-9">
                                    <img src=" ' . $row['image'] . '" width="100%" alt="..." class="">
                                    </div>
                                    <div class="col-lg-12">
                                    <p class="card-text">' . substr($row['description'], 0, 150) . '..... 
                                        </p>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class=""></div>
                                        <div class=""> <a href="readpost.php?pstd=' . $row['post_id'] . '" class="btn btn-secondary">Read More</a></div>
                                    </div>

                                </div>

                            </div>';
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
                                    <input type="search" class="form-control" name="query" placeholder="Search something">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                <!--    LOGIN FORM  -->

                <form role="form" action="">
                    <div class="card">
                        <div class=" card-header">
                            Login Area
                        </div>
                        <div class="card-body">

                            <div class="row mb-2">
                                <label for="username" class="col-sm-4 col-form-label">User Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="username">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="password" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="row mb-2">

                                <div class="col-sm-8">
                                    <input type="submit" id="submit" class="btn btn-success btn-block">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>


                <!--     HIGHLIGHTED POSTS  -->

                <div class="list-group">
                    <a href="" class="list-group-item">
                        <h4 class="list-group-item-heading">Post1</h4>
                        <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                    </a>
                </div>
            </aside>

        </div>
</body>

</html>



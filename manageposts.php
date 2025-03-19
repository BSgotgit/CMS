<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>
</head>

<body>

    <?php include 'include/menubar.php'; ?>
    <br>

    <div class="container">
        <div class="row">


            <!--   LEFT SIDE MAIN POSTS  -->

            <section class="col-lg-7">
                <?php


                // TO DELETE POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['del_post_id'])) {
                    
                    $post_id = $_POST['del_post_id'];
                    $query = "DELETE FROM `posts` WHERE `post_id` = '{$post_id}'";
                    $result = mysqli_query($conn, $query);

                    // Checking if row inserted
                    if ($conn->affected_rows > 0) {
                        echo '
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Post Deleted Successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                }


                // Checking if Category is Selected or Not (in menubar)

                if (isset($_GET['cate'])) {
                    $query = "SELECT * FROM `posts` WHERE category='$_GET[cate]'";
                } else {
                    // SHOWING RECENT 10 POSTS IN HOME PAGE
                    $query = "SELECT * FROM `posts` ORDER BY `date` DESC ";
                }

                // Executing the mysql query
                $result = mysqli_query($conn, $query);

                // Fetching/getting each record/row in loop from result set
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="card mb-3 h-30">
                        <div class="card-header">
                            <strong>' . $row['title'] . '</strong>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="row g-0">
                                <div class="col-lg-4 col-md-5 col-12">
                                    <img src="' . $row['image'] . '" class="img-fluid rounded" style="height: 170px; width: 100%; object-fit: cover;" alt="Post Image">
                                </div>
                    
                                <div class="col-lg-8 col-md-7 col-12 d-flex flex-column">
                                    <p class="card-text flex-grow-1 ms-3">' . substr($row['description'], 0, 190) . '...</p>
                                    <p class="text-muted ms-3 mb-2">By ' . $row['author'] . '</p>
                                    
                                    <div class="d-flex ms-3">
    
                                        <form action="manageposts.php" method="POST" class="me-2">
                                            <input type="hidden" name="del_post_id" value= '. $row['post_id'].'">
                                            <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center">Delete</button>
                                        </form>
    
                                        <a href="editpost.php?pid=' . $row['post_id'] . '" class="btn btn-secondary">Edit</a>
                                    </div>
                                </div>
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
                                            <!-- TODO add icon -->
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </aside>

        </div>
</body>

</html>
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

                // Getting the search query and removing extra spaces
                $query = isset($_GET['query']) ? trim($_GET['query']) : '';

                if (!empty($query)) {
                    //Removing Escape characters (For Safety)
                    $query = $conn->real_escape_string($query);

                    // Breaking the search query into keywords
                    $keywords = explode(" ", $query);

                    // Build search condition
                    $searchConditions = [];
                    foreach ($keywords as $word) {
                        $searchConditions[] = " `title` LIKE '%$word%' OR `description` LIKE '%$word%'";
                    }

                    $query = "SELECT * FROM posts WHERE " . implode(" OR ", $searchConditions) . " ORDER BY 
                            (CASE WHEN `title` LIKE '%$query%' THEN 3
                                  WHEN `description` LIKE '%$query%' THEN 2
                                  ELSE 1 END) DESC";

                    // Executing the mysql query
                    $result = mysqli_query($conn, $query);


                    // Checking number of rows obtained from database
                    if ($result->num_rows > 0) {
                        // Matching post found
                        // Fetching each row in loop from result
                        while ($row = mysqli_fetch_assoc($result)) {
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
                                            <div class=""> <a href="readpost.php?pid=' . $row['post_id'] . '" class="btn btn-secondary">Read More</a></div>
                                        </div>
    
                                    </div>
    
                                </div>';
                        }
                    } else {
                        echo '
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            No Matching Post Found.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                } else {
                    // No valid Query, So, Redirect to the home page
                    header("Location: index.php");
                    exit;
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


                <!--    LOGIN FORM  -->

                

                <!--    FEATURED / HIGHLIGHTED POSTS  -->

                <?php

                $query = "SELECT `title`, `description` FROM `posts` WHERE `featured` = 1 ORDER BY `date` DESC LIMIT 5 ";

                //Executing the mysql query
                $result = mysqli_query($conn, $query);

                // Fetching/getting each record/row in loop from result set
                while ($row = mysqli_fetch_assoc($result)) {
                   echo '
                       <div class="list-group">
                       <a href="" class="list-group-item">
                       <h4 class="list-group-item-heading"> '.$row['title'] .'</h4>
                       <p class="list-group-item-text">'. substr($row['description'], 0, 230). '</p>
                       </a>
                       </div> </br>
                   ';
                }
                ?>
            </aside>

        </div>

        <?php include 'include/footer.php'; ?> 
</body>

</html>

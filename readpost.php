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
            <section class="col-lg-11">

                <?php
                // Selecting only one post
                
                $sel_sql = "SELECT * FROM `posts` WHERE post_id = '$_GET[pid]'";
                $runs_sql = mysqli_query($conn, $sel_sql);

                // Fetching single row
                $row = mysqli_fetch_assoc($runs_sql);

                if ($row) { // Checking if the post exists
                    echo '
                <div class="card">
                    <div class="card-header">
                        <strong>' . $row['title'] . '</strong>
                    </div>
            
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <img src="' . $row['image'] . '" width="100%" alt="...">
                            </div>
                            <div class="col-lg-12">
                                <p class="card-text">' . $row['description'] . '</p>
                            </div>
            
                            <div class="col-lg-12"> <br> <br>
                                <p class="card-text"><i>Posted by:</i>
                                    <br>
                                    <b>' . $row['author'] . '</b>
                                    <br>
                                    <span>' . $row['date'] . '</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>';
                } else {
                    echo '<p>No post found!</p>';
                }
                ?>

            </section>
        </div>
    </div>
</body>

</html>
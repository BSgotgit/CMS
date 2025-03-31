<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>
    <script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this post?');
    }
    </script>
</head>

<body>

    <?php
    include 'include/validate_user.php';
    include 'include/menubar.php'; ?>
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
                                Post Deleted Successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                }


                // Checking if Category is Selected or Not (in menubar)
                
                if (isset($_GET['cate'])) {
                    $query = "SELECT * FROM `posts` WHERE category='$_GET[cate]' AND user_id = '{$_SESSION['user_id']}' ";
                } else {
                    // SHOWING RECENT 10 POSTS IN HOME PAGE
                    $query = "SELECT * FROM `posts` WHERE user_id = '{$_SESSION['user_id']}' ORDER BY `date` DESC ";
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
    
                                        <form action="manageposts.php" method="POST" class="me-2" onsubmit="return confirmDelete()">
                                            <input type="hidden" name="del_post_id" value= ' . $row['post_id'] . '>
                                            <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center">Delete</button>
                                        </form>

                                        <form action="editpost.php" method="GET" class="me-2">
                                            <input type="hidden" name="pid" value= ' . $row['post_id'] . '>
                                            <button type="submit" class="btn btn-secondary btn-sm d-flex align-items-center">Edit</button>
                                        </form>

                                        <form action="readpost.php" method="GET" class="me-2">
                                            <input type="hidden" name="pid" value= ' . $row['post_id'] . '>
                                            <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center">Read More</button>
                                        </form>
                                        
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

                <!--User Information-->

                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <strong>About User</strong>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mt-2">
                                <h2 class="card-text"><?php echo $_SESSION['username'] ?></h2>
                            </div>
                            <br>
                            <br>
                            <br>
                            <hr>
                            <div class="col-lg-12 mt-3">
                                <span class="card-text"> <b>Email</b> </span><br>
                                <p class="card-text"> <?php echo $_SESSION['email'] ?> </p>
                            </div>

                            <div class="col-lg-12 mt-3">
                                <span class="card-text"> <b>Gender</b> </span><br>
                                <p class="card-text"> <?php echo $_SESSION['gender'] ?> </p>
                            </div>
                        </div>

                        <br><br>
                        <div class="row">
                            <span class="card-text"> <b>Joined on :</b> </span><br>
                            <p class="card-text"> <?php echo $_SESSION['date'] ?> </p>
                        </div>
                    </div>
                </div>

                    <!-- Filter Category -->

                    <br>
                    <div class="card">
                        <div class="card-header">Filter Category</div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">

                                <?php
                                $query = "SELECT DISTINCT `category` FROM posts WHERE user_id={$_SESSION['user_id']}" ;
                                $result = mysqli_query($conn, $query);

                                // Color classes
                                $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'];
                                $index = 0; // Index to track colors
                                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $colorClass = $colors[$index % count($colors)];
                                    $index++; // Moving to the next color
                                
                                    echo '
                                    <form action="manageposts.php" method="GET">
                                       <input type="hidden" name="cate" value="' . $row['category'] . '">
                                       <button type="submit" class="btn btn-' . $colorClass . ' btn-sm">' . $row['category'] . '</button>
                                    </form>
                                ';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>

            </aside>

        </div>
</body>

</html>
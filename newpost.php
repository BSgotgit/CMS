<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php
    include 'include/validate_user.php';
    include 'include/menubar.php';
    include 'include/upload_media.php';
    ?>
    <br>

    <div class="container flex-grow-1">
        <div class="row">

            <section class="col-lg-12">

                <?php

                // Checking if the form is submitted using POST
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $category = $_POST['category'];

                    if (isset($_POST['featured'])) {
                        $featured = $_POST['featured'];
                    } else {
                        $featured = 0;
                    }

                    $upload = uploadMedia("image", "../images/");
                    $file_path = $upload['file_path'];
                    $file_type = $upload['file_type'];

                    $user_id = $_SESSION['user_id'];
                    $author = $_SESSION['username'];

                    $published = ($role == 'editor' || $roll == 'admin') ?1:0;

                    $query = "INSERT INTO posts(`title`,`category`,`description`,`file_path`,`file_type`, `author`, `featured`,`published`,`user_id`) VALUES ('{$title}','{$category}','{$description}','{$file_path}','{$file_type}','{$author}','{$featured}' ,'{$published}','{$user_id}')";

                    // Executing the mysql query
                    $result = mysqli_query($conn, $query);

                    // Checking if row inserted
                    if ($conn->affected_rows > 0) {
                        echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Post Created Successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    } else {
                        echo '
                         <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Post creation failed
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                }

                ?>



                <!--   New Post Form  -->

                <form role="form" action="newpost.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class=" card-header">
                            Create a new Post
                        </div>
                        <div class="card-body">

                            <div class="row mb-2">
                                <label for="title" class="col-sm-4 col-form-label">Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="category" class="col-sm-4 col-form-label">Category</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="category" name="category" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="description" class="col-sm-4 col-form-label">Content</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="description" name="description" rows="13"
                                        required></textarea>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="image" class="col-sm-4 col-form-label">Image</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="image" name="image" required>
                                </div>
                            </div>

                            <?php if ($role == 'editor' || $role == 'admin'): ?>
                                <div class="row mb-2">
                                    <div class="col-sm-8">
                                        <input type="checkbox" id="featured" name="featured" value="1"> Checkin to address as
                                        featured.
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row mb-2">

                                <div class="col-sm-8">
                                    <input type="submit" id="submit" value="Publish" class="btn btn-success btn-block">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>


            </section>

        </div>
        <?php include 'include/footer.php'; ?>
</body>

</html>
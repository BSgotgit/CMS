<html>

<head>
    <title>CMS</title>
    <script src="jQry/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>

<body>

    <?php include 'include/menubar.php'; ?>
    <br>

    <div class="container">
        <div class="row">

            <section class="col-lg-12">

                <?php

                // Checking if the form is submitted using POST
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $category = $_POST['category'];
                    $author = $_POST['author'];
                    $image = 'image/'. $_POST['image'];


                    $query = "INSERT INTO posts(`title`,`category`,`description`,`image`,`author`) VALUES ('{$title}','{$category}','{$description}','{$image}','{$author}')";

                    // Executing the mysql query
                    $result = mysqli_query($conn, $query);

                    // Checking if row inserted
                    if ($conn->affected_rows > 0) {
                        echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Post Created Successfully.
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
                                <label for="description" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="description" name="description" rows="18" required></textarea>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="image" class="col-sm-4 col-form-label">Image</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="image" name="image" required>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="author" class="col-sm-4 col-form-label">Author</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="author" name="author" required>
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


            </section>

        </div>
</body>

</html>
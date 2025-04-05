<!DOCTYPE html>
<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php
    include 'include/validate_user.php';
    include 'include/upload_media.php';
    include 'include/menubar.php';
    ?>
    <br>

    <div class="container flex-grow-1">
        <div class="row">
            <section class="col-lg-11">

                <?php

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $post_id = $_POST['post_id'];
                    $title = $_POST['title'];
                    $category = $_POST['category'];
                    $description = $_POST['description'];
                    $author = $_POST['author'];
                    $media = uploadMedia("image", "../images/");
                    $featured = isset($_POST['featured']) ? $_POST['featured'] : 0;

                    if ($media) {
                        $query = "UPDATE `posts` SET `title` = '$title', `category` = '$category', `description` = '$description', 
                        `file_path` = '{$media['file_path']}', `file_type` = '{$media['file_type']}', 
                        `author` = '$author', `featured` = '$featured' WHERE `post_id` = '$post_id'";
                    } else {
                        $query = "UPDATE `posts` SET `title` = '$title', `category` = '$category', `description` = '$description', 
                        `author` = '$author', `featured` = '$featured' WHERE `post_id` = '$post_id'";
                    }

                    $result = mysqli_query($conn, $query);

                    if ($conn->affected_rows > 0) {
                        echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Post Updated Successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    } else {
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Post Not Updated.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['pid'])) {
                    $query = "SELECT * FROM `posts` WHERE post_id = '$_GET[pid]'";
                    $result = mysqli_query($conn, $query);

                    if ($row = mysqli_fetch_assoc($result)) {

                        $check = $row['featured'] ? 'checked' : '';

                        ?>

                        <!-- Edit Post Form -->
                        <form role="form" action="editpost.php" method="post" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header">
                                    Edit Post
                                </div>
                                <div class="card-body">

                                    <div class="row mb-2">
                                        <label for="title" class="col-sm-4 col-form-label">Title</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title'] ;?>" required>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <label for="category" class="col-sm-4 col-form-label">Category</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="category" name="category" required>
                                                <?php
                                                $category_query = $conn->query("SELECT name FROM category");
                                                while ($cat = $category_query->fetch_assoc()) {
                                                    $selected = ($cat['name'] == $row['category']) ? 'selected' : '';
                                                    echo '<option value="' . $cat['name'] . '" ' . $selected . '>' . $cat['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <label for="description" class="col-sm-4 col-form-label">Description</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="description" name="description" rows="15" required><?php echo $row['description']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <label for="image" class="col-sm-4 col-form-label">Image URL</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <label for="author" class="col-sm-4 col-form-label">Author</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="author" name="author" value="<?php echo $row['author']; ?>" required>
                                        </div>
                                    </div>

                                    <?php if ($role == 'editor' || $role == 'admin') : ?>
                                        <div class="row mb-2">
                                            <div class="col-sm-8 offset-sm-4">
                                                <input type="checkbox" id="featured" name="featured" value="1" <?php echo $check ; ?>> Add to Recommended List.
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row mb-2">
                                        <div class="col-sm-8 offset-sm-4">
                                            <input type="hidden" name="post_id" value="<?php echo $row['post_id'] ; ?>">
                                            <button type="submit" id="submit" class="btn btn-success btn-block">Update Post</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>

                        <?php
                    } else {
                        echo '<p>No post found!</p>';
                    }
                } else {
                    echo '<p>No post found!</p>';
                }
                ?>

            </section>
        </div>
    </div>

    <?php include 'include/footer.php'; ?>
</body>

</html>

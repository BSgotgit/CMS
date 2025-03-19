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

                // Checking POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $post_id = $_POST['post_id'];
                    $title = $_POST['title'];
                    $category = $_POST['category'];
                    $description = $_POST['description'];
                    $image = $_POST['image'];
                    $author = $_POST['author'];

                    // Update query
                    $query = "UPDATE `posts` SET `title` = '$title', `category` = '$category', `description` = '$description', 
                              `image` = '$image', `author` = '$author' WHERE `post_id` = '$post_id'";

                    $result = mysqli_query($conn, $query);

                    // Checking if row updated
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
                }


                // TO EDIT POST 

                elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['pid'])) {
                    // Selecting only one post
                    $query = "SELECT * FROM `posts` WHERE post_id = '$_GET[pid]'";
                    $result = mysqli_query($conn, $query);

                    // Checking if the post exists
                    if ($row = mysqli_fetch_assoc($result)) {
                        echo '
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
                                           <input type="text" class="form-control" id="title" name="title" value="' . $row['title'] . '" required>
                                       </div>
                                   </div>
                        
                                   <div class="row mb-2">
                                       <label for="category" class="col-sm-4 col-form-label">Category</label>
                                       <div class="col-sm-8">
                                           <input type="text" class="form-control" id="category" name="category" value="' . $row['category'] . '" required>
                                       </div>
                                   </div>
                        
                                   <div class="row mb-2">
                                       <label for="description" class="col-sm-4 col-form-label">Description</label>
                                       <div class="col-sm-8">
                                           <textarea class="form-control" id="description" name="description" rows="15" required>' . $row['description'] . '</textarea>
                                       </div>
                                   </div>
                        
                                   <div class="row mb-2">
                                       <label for="image" class="col-sm-4 col-form-label">Image URL</label>
                                       <div class="col-sm-8">
                                           <input type="text" class="form-control" id="image" name="image" value="' . $row['image'] . '" required>
                                       </div>
                                   </div>
                        
                                   <div class="row mb-2">
                                       <label for="author" class="col-sm-4 col-form-label">Author</label>
                                       <div class="col-sm-8">
                                           <input type="text" class="form-control" id="author" name="author" value="' . $row['author'] . '" required>
                                       </div>
                                   </div>
                        
                                   <div class="row mb-2">
                                       <div class="col-sm-8 offset-sm-4">
                                            <input type="hidden" class="form-control" name="post_id" value="' . $row['post_id'] . '" required>
                                           <button type="submit" id="submit" class="btn btn-success btn-block">Update Post</button>
                                       </div>
                                   </div>
                        
                               </div>
                           </div>
                       </form>';
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
</body>

</html>
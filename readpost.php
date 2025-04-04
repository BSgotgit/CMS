<?php

// Comment
session_start();
if (isset($_POST['comment']) && isset($_POST['pid']) && isset($_SESSION['user_id'])) {
    include_once 'include/dbconnect.php';
    $query = "INSERT INTO comments(post_id, user_id, comment) VALUES ('{$_POST['pid']}','{$_SESSION['user_id']}' , '{$_POST['comment']}' )";
    $conn->query($query);
}
?>


<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include 'include/menubar.php'; ?>
    <br>

    <div class="container flex-grow-1">
        <div class="row">
            <section class="col-lg-12">

                <?php

                $post_id = $_GET['pid'];
                // Selecting only one post

                $sel_sql = "SELECT * FROM `posts` WHERE post_id = '$post_id]'";
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

                    <div class="ratio ratio-16x9">';
                    // Checking if media is an image or video
                    if ($row['file_type'] == 'image') {
                        echo "<img src='{$row['file_path']}' class='img-fluid object-fit-cover rounded' alt='Post Image'>";
                    } elseif ($row['file_type'] == 'video') {
                        echo "<video src='{$row['file_path']}' class='img-fluid object-fit-cover rounded' controls></video>";
                    }
                    echo  '</div>

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

                    // Comment Section
                    echo '<div class="card mt-4">
                <div class="card-header">
                    <strong>Comments</strong>
                </div>
                <div class="card-body">';

                    $query = "SELECT * FROM comments WHERE post_id = '{$post_id}' ORDER BY `date` DESC LIMIT 30";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($comment_row = $result->fetch_assoc()) {
                            $user_result = $conn->query("SELECT username,profile_pic FROM users WHERE user_id = '{$comment_row['user_id']}'");
                            $row = $user_result->fetch_assoc();

                            $name = $row['username'] ?? 'Anonymous';
                            $profile_photo = !empty($row['profile_pic']) ? $row['profile_pic'] : 'icons/default_profile.jpg'; // fallback image

                            echo '
                            <div class="mb-3 p-3 border rounded bg-light d-flex align-items-start gap-3">
                                <img src="' . $profile_photo . '" alt="Profile" width="50" height="50" class="rounded-circle" style="object-fit: cover;">
                                <div>
                                    <strong>' . $name . '</strong>
                                    <p class="mb-1">' . nl2br($comment_row['comment']) . '</p>
                                    <small class="text-muted">' . $comment_row['date'] . '</small>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<p>No comments yet. Be the first to comment!</p>';
                    }

                    echo '</div>
                    </div>'; // Closing comment section


                    // Comment Box
                    if (isset($_SESSION['user_id'])) {
                        echo '
                        <div class="card mt-4">
                            <div class="card-header"><strong>Leave a Comment</strong></div>
                            <div class="card-body">
                                <form method="POST" action="readpost.php?pid=';
                        echo $post_id;
                        echo '">
                                    <div class="mb-3">
                                        <input type="hidden" name="pid" value=" ';
                        echo $post_id;
                        echo ' ">
                                        <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment here..."></textarea>
                                    </div>
                                    <button type="submit" name="submit_comment" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>';
                    } else {
                        echo '<p class="text-muted mt-3">You must <a href="login.php">log in</a> to comment.</p>';
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
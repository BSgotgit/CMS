<?php
include 'include/validate_admin.php';
include 'include/dbconnect.php';

// Handle new user addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $gender = $_POST['gender'];

    $query = "INSERT INTO users (username, email, gender, `password`, `role`)
        VALUES ('$username', '$email','$gender', '$password', '$role')";

    if ($conn->query($query) === TRUE) {
        $message = "User added successfully!";
    } else {
        $message = "Error adding user: " . $conn->error;
    }
}

// Handle role update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];

    $query = "UPDATE users SET role='$new_role' WHERE user_id=$user_id";
    if ($conn->query($query) === TRUE) {
        $message = "User role updated!";
    } else {
        $message = "Error updating role: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="include/style.css">
    <script>
        function confirmDeletepost() {
            return confirm('Are you sure you want to delete this post?');
        }
        function confirmDeleteuser() {
            return confirm('Are you sure you want to remove this user?');
        }
    </script>
</head>

<body>
    <?php include 'include/menubar.php';  ?>

    <div class="container mt-4">
        <h2>Dashboard</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5>Total Users</h5>
                        <p><?php echo $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0]; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5>Total Posts</h5>
                        <p><?php echo $conn->query("SELECT COUNT(*) FROM posts")->fetch_row()[0]; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5>Total Views</h5>
                        <p><?php echo $conn->query("SELECT SUM(views) FROM posts")->fetch_row()[0]; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5>Total Visitors</h5>
                        <p>56</p>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($role == 'admin'): ?>
            <!-- Add User Section -->
            <h3>Add New User</h3>
            <form action="" method="POST" class="mb-4">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="col-md-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-md-2">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="role" class="form-select">
                            <option value="admin">Admin</option>
                            <option value="editor">Editor</option>
                            <option value="contributer">Contributer</option>
                            <option value="viewer">Viewer</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="add_user" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>

            <!-- User Management Section -->
            <h3>Manage Users</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Change Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM users");
                    while ($row = $result->fetch_assoc()) {
                        $userRole = $row['role']; // current role
                        echo "<tr>
                            <td>{$row['user_id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['role']}</td>
                            <td>
                                <form method='POST' class='d-flex'>
                                    <input type='hidden' name='user_id' value='{$row['user_id']}'>
                                    <select name='role' class='form-select me-2'>
                                        <option value='admin' " . ($userRole == 'admin' ? 'selected' : '') . ">Admin</option>
                                        <option value='editor' " . ($userRole == 'editor' ? 'selected' : '') . ">Editor</option>
                                        <option value='contributer' " . ($userRole == 'contributer' ? 'selected' : '') . ">Contributer</option>
                                        <option value='viewer' " . ($userRole == 'viewer' ? 'selected' : '') . ">Viewer</option>
                                    </select>
                                    <button type='submit' name='update_role' class='btn btn-warning btn-sm'>Update</button>
                                </form> 
                            </td>
                            <td>
                                <form method='POST' class='d-flex' action='modules/delete_user.php'>
                                    <input type='hidden' name='user_id' value='{$row['user_id']}'>
                                    <button type='submit' name='remove_user' class='btn btn-danger btn-sm' onclick='return confirmDeleteuser()' >Remove</button>
                                </form> 
                            </td>

                        </tr> ";
                    }
                    ?>

                </tbody>
            </table>
        <?php endif; ?>

        <!-- Recent Posts Section -->
        <h3>Recent Posts</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th>Recommended</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM posts ORDER BY date DESC LIMIT 10");
                while ($row = $result->fetch_assoc()) {
                    // button properties
                    $btnClass = $row['published'] == 1 ? "btn-secondary" : "btn-success";
                    $btnText = $row['published'] == 1 ? "Unpublish" : "Approve";
                    $btnText_featured = $row['featured'] == 1 ? "Yes" : "No";

                    echo "<tr>
                       <td>{$row['post_id']}</td>
                       <td>{$row['title']}</td>
                       <td>{$row['category']}</td>
                       <td>{$row['author']}</td>
                       <td>{$row['date']}</td>
                       <td>{$row['views']}</td>
                       <td>
                            {$btnText_featured}
                       </td>
                       <td>
                        <form method='POST' action='modules/toggle_publish.php'>
                        <input type='hidden' name='post_id' value='{$row['post_id']}'>
                            <button type='submit' name='toggle_publish' class='btn btn-sm {$btnClass}'>{$btnText}</button>
                       </form>
                    </td>
                    <td>
                    <a href='readpost.php?pid={$row['post_id']}' class='btn btn-primary btn-sm'>View</a>
                    <a href='editpost.php?pid={$row['post_id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='modules/delete_post.php?pid={$row['post_id']}' class='btn btn-danger btn-sm'  onclick='return confirmDeletepost()' >Delete</a>
                   </td>
                   </tr>";
                }
                ?>

            </tbody>
        </table>


        <!-- Settings Section -->
        <?php if ($role == 'admin'): ?>

            <?php
            $default_role = $conn->query("SELECT setting_value FROM settings WHERE setting_key = 'default_role' ")->fetch_row()[0];
            ?>

            <h3>Settings: </h3>
            <!-- Default Role Settings -->
            <div class="card p-3 mb-3" style="max-width: 600px;">
                <h5>Default Role</h5>
                <form method="POST" class="d-flex" action="modules/update_default_role.php">
                    <select name="default_role" class="form-select me-2">
                        <option value="viewer" <?= $default_role == 'viewer' ? 'selected' : '' ?>>Viewer</option>
                        <option value="contributer" <?= $default_role == 'contributer' ? 'selected' : '' ?>>Contributer</option>
                    </select>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </form>
            </div>


            <!-- Settings End -->

            <!-- Category Management -->
            <div class="card p-3 mb-5" style="max-width: 600px;">
                <h5>Manage Categories</h5>

                <!-- Add New Category Form -->
                <form action="modules/add_category.php" method="POST" class="d-flex mb-3">
                    <input type="text" name="category_name" class="form-control me-2" placeholder="New Category" required>
                    <button type="submit" name="add_category" class="btn btn-primary btn-sm">Add</button>
                </form>

                <!-- Display Categories -->
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM category");
                        while ($cat = $result->fetch_assoc()) {
                            echo "<tr>
                        <td>{$cat['id']}</td>
                        <td>{$cat['name']}</td>
                        <td>
                            <form method='POST' action='modules/delete_category.php' style='display:inline;'>
                                <input type='hidden' name='category_id' value='{$cat['id']}'>
                                <button type='submit' name='delete_category' class='btn btn-danger btn-sm'>Delete</button>
                            </form>
                        </td>
                      </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>
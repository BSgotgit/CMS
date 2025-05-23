<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>

</head>

<body class="d-flex flex-column min-vh-100">

    <?php
    include 'include/menubar.php';
    $email_exist = false;

    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

        include 'include/upload_media.php';

        
        $image = uploadMedia("profile_pic", "../images/profile/");
        $image_path = ($image) ? $image['file_path'] : './icons/default_profile.jpg';
        
        
        include './include/dbconnect.php';

        // Getting Default Role
        $default_role = $conn->query("SELECT setting_value FROM settings WHERE setting_key = 'default_role' ")->fetch_row()[0];

        $query = "SELECT * FROM users WHERE email = '{$email}' ";
        $result = $conn->query($query);

        if ($result->num_rows == 0) {
            // New Account
            $query = "INSERT INTO users(username, gender, email, `password`, `role`, profile_pic) VALUES ('{$name}', '{$gender}', '{$email}', '{$pwd}', '{$default_role}', '{$image_path}')";
            
            $result = $conn->query($query);

            if ($conn->affected_rows > 0) {
                echo '
                    <div class="d-flex justify-content-center align-items-start mt-4 flex-grow-1">
                        <div class="alert alert-success alert-dismissible fade show col-lg-6 col-md-8 text-center mt-3" role="alert">
                            Account Created Successfully
                        </div>
                    </div>

                ';
                $conn->close();
                include 'include/footer.php';
                exit();
            }
        } else {
            $email_exist = true;
        }
    }
    ?>

    <br>

    <div class="container flex-grow-1">
        <div class="row justify-content-center mt-5">

            <!-- SIGN UP FORM -->
            <section class="col-lg-6 col-md-8">
                <form role="form" action="signup.php" method="POST" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            Create an Account
                        </div>
                        <div class="card-body">

                            <div class="row mb-4">
                                <label for="name" class="col-sm-4 col-form-label">Full Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="email" class="col-sm-4 col-form-label">Email Address</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email" name="email" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="gender" class="col-sm-4 col-form-label">Gender</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="">--Select--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="password" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="image" class="col-sm-4 col-form-label">Profile Picture</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="image" name="profile_pic" value="">
                                </div>
                            </div>

                            <div class="row mb-4 justify-content-end">
                                <div class="col-sm-8">
                                    <input type="submit" id="submit" class="btn btn-success btn-block" value="Sign Up">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

                <?php
                if ($email_exist) {
                    echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Email Address already registered. Please Login
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                ?>

            </section>

        </div>
    </div>

    <?php include 'include/footer.php'; ?>

</body>

</html>
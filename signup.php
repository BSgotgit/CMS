<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>

    <!--?php include 'include/external.php'; ?-->
</head>

<body>

    <?php
    include 'include/menubar.php';
    $email_exist = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $pwd = $_POST['password'];

        include './include/dbconnect.php';

        $query = "SELECT * FROM users WHERE email = '{$email}' ";
        $result = $conn->query($query);

        if ($result->num_rows == 0) {
            // New Account
            $query = "INSERT INTO users(username, gender, email, `password`) VALUES ('{$name}', '{$gender}', '{$email}', '{$pwd}')";
            $result = $conn->query($query);

            if ($conn->affected_rows > 0) {
                echo '
                    <div class="alert alert-success alert-dismissible fade show col-lg-6 col-md-8 justify-content-center mt-5" role="alert">
                        Account Created Successfully 
                    </div>';
                $conn->close();
                exit();
            }
        } else {
            $email_exist = true;
        }
    }
    ?>

    <br>

    <div class="container">
        <div class="row justify-content-center mt-5">

            <!-- SIGN UP FORM -->
            <section class="col-lg-6 col-md-8">
                <form role="form" action="signup.php" method="POST">
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
                                    <input type="text" class="form-control" id="gender" name="gender" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="password" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password" name="password" required>
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
</body>

</html>
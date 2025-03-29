<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>

    <!--?php include 'include/external.php'; ?-->
</head>

<body>

    <?php include 'include/menubar.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        include './include/dbconnect.php';

        $query = "SELECT password FROM users WHERE email = '{$email}' ";
        $result = $conn->query($query);

        if ($result->num_rows  == 0) {
            $query = "INSERT INTO students(email, password, name) VALUES ('{$email}', '{$password}', '{$name}')";
            $result = $conn->query($query);

            if ($conn->affected_rows > 0) {
                echo 'Account Created Successfully <br/>';
                echo '<a href="login.php"> Please Login</a>';

                $conn->close();
                exit();
            }
        } else {
            echo 'Email address already registered <br/>';
            echo '<a href="login.php"> Please Login</a>';
        }
    }


    ?>
    <br>

    <div class="container">
        <div class="row justify-content-center mt-5">

            <!--    SIGN UP FORM  -->
            <section class="col-lg-6 col-md-8">
                <form role="form" action="signup.php" method="POST">
                    <div class="card">
                        <div class=" card-header bg-dark  text-white">
                            Create an Account
                        </div>
                        <div class="card-body">

                            <div class="row mb-4">
                                <label for="fullname" class="col-sm-4 col-form-label">Full Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="email" class="col-sm-4 col-form-label">Email Address</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="password" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="password" name="username" required>
                                </div>
                            </div>

                            <div class="row mb-4  justify-content-end">

                                <div class="col-sm-8 ">
                                    <input type="submit" id="submit" class="btn btn-success btn-block" value="Sign Up">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </section>

        </div>

    </div>
</body>

</html>
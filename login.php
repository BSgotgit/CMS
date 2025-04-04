<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>

</head>

<body class="d-flex flex-column min-vh-100">

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include './include/dbconnect.php';

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // To verify the entered password with the hashed password from the database
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['date'] = $row['date'];

                if ($row['role'] == 'admin') {
                    $_SESSION['admin_logged_in'] = true;
                    header("Location: dashboard.php");
                } else {
                    header("Location: user.php");
                }
                exit();
            }
        }
        $conn->close();
    }

    include 'include/menubar.php';
    ?>

    <br>

    <div class="container flex-grow-1">
        <div class="row justify-content-center mt-5">

            <!-- LOGIN FORM -->
            <section class="col-lg-6 col-md-8">
                <form role="form" action="login.php" method="POST">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            LOG IN
                        </div>
                        <div class="card-body">

                            <div class="row mb-4">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email" name="email" required>
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
                                    <input type="submit" id="submit" class="btn btn-success btn-block" value="Login">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </section>

        </div>
    </div>

    <?php include 'include/footer.php'; ?>
</body>

</html>
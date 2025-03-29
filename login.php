<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>

    <!--?php include 'include/external.php'; ?-->

    <!-- TODO add an offline "search icon" -->
</head>

<body>

    <?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
        include './include/dbconnect.php';

        $query = "SELECT * FROM users WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}' ";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
                session_start();
                $_SESSION['email'] = $_POST['email'];

                header("Location: index.php");
                $conn->close();
                exit();
        }
    }

    include 'include/menubar.php';

    ?>



    <br>

    <div class="container">
        <div class="row justify-content-center mt-5">

            <!--    LOGIN FORM  -->
            <section class="col-lg-6 col-md-8">
                <form role="form" action="login.php" method="POST">
                    <div class="card">
                        <div class=" card-header bg-dark  text-white">
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
                            <div class="row mb-4  justify-content-end">

                                <div class="col-sm-8 ">
                                    <input type="submit" id="submit" class="btn btn-success btn-block" value="Submit">
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
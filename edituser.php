<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>

</head>

<body>

    <?php
    require 'include/validate_user.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Updating user details in session varibles
    
        $_SESSION['username'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['password'] = $_POST['password'];




        $name = $_POST['name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $pwd = $_POST['password'];

        include 'include/menubar.php';
        include './include/dbconnect.php';



        $query = "UPDATE `users` SET `username` = '$name',`gender`='$gender', `email` = '$email', `password` = '$pwd' WHERE `user_id` = '{$_SESSION['user_id']}'";
        $result = $conn->query($query);

        if ($conn->affected_rows > 0) {
            echo '
                <div style="display:flex; justify-content:space-around;">
                    <div class="alert alert-success alert-dismissible fade show col-lg-6 col-md-8  mt-5" role="alert">
                        Account Updated
                    </div>
                </div>';
        } else {
            echo '  
            <div style="display:flex; justify-content:space-around;">
                    <div class="alert alert-danger alert-dismissible fade show col-lg-6 col-md-8  mt-5" role="alert">
                        Could Not Update.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            </div>';
        }
        $conn->close();
        exit();
    } else {
        include 'include/menubar.php';
    }

    ?>

    <br>

    <div class="container">
        <div class="row justify-content-center mt-5">

            <!-- SIGN UP FORM -->
            <section class="col-lg-6 col-md-8">
                <form role="form" action="edituser.php" method="POST">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            Edit User Details
                        </div>
                        <div class="card-body">

                            <div class="row mb-4">
                                <label for="name" class="col-sm-4 col-form-label">Full Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?php echo $_SESSION['username']; ?>">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="email" class="col-sm-4 col-form-label">Email Address</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="<?php echo $_SESSION['email']; ?>">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="gender" class="col-sm-4 col-form-label">Gender</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <script>
                                document.getElementById("gender").value = "<?= $_SESSION['gender'] ?>" ;
                            </script>


                            <div class="row mb-4">
                                <label for="password" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="<?php echo $_SESSION['password']; ?>">
                                </div>
                            </div>

                            <div class="row mb-4 justify-content-end">
                                <div class="col-sm-8">
                                    <input type="submit" id="submit" class="btn btn-success btn-block" value="Update">
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
    
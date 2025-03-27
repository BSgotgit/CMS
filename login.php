<html>

<head>
    <title>CMS</title>
    <link rel="stylesheet" href="include/style.css">
    <script src="include/script.js"></script>
    
    <!--?php include 'include/external.php'; ?-->

    <!-- TODO add an offline "search icon" -->
</head>

<body>

    <?php include 'include/menubar.php'; ?>
    <br>

    <div class="container">
        <div class="row justify-content-center mt-5">

                <!--    LOGIN FORM  -->
            <section class="col-lg-6 col-md-8">
                <form role="form" action="user.php">
                    <div class="card">
                        <div class=" card-header bg-dark  text-white">
                            LOGIN
                        </div>
                        <div class="card-body">

                            <div class="row mb-4">
                                <label for="username" class="col-sm-4 col-form-label" >User Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="username"  name="username">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="password" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="row mb-4  justify-content-end">

                                <div class="col-sm-8 ">
                                    <input type="submit" id="submit" class="btn btn-success btn-block">
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
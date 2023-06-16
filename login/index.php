
<?php

require_once('../class.php');
$session = new sessionManage();
$session->redirectIfLoggedIn();//If logged in redirect to account page


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>All my Things in the web</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Nunito%20Sans.css">
    <link rel="stylesheet" href="../assets/css/Navbar-Centered-Brand-icons.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="py-4 py-xl-5">
                    <div class="container">
                        <div class="row mb-5">
                            <div class="col-md-8 col-xl-6 text-center mx-auto">
                                <h2>ALL MY THINGS</h2>
                                <p style="color: darkred;"><?php echo $_GET["msg"]; ?></p>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-5">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                            </svg></div>
                                        <form class="text-center" method="post" action="login_handle.php">
                                            <div class="mb-3"><input class="form-control" type="text" name="THE_username" id="THE_username"aria-describedby="THE_username"placeholder="Your Username" required></div>
                                            <div class="mb-3"><input class="form-control" type="password" name="THE_password"
                   id="THE_password" placeholder="Password"></div>
                                            <div class="mb-3"><button class="btn btn-primary d-block w-100" name="submitLogin" type="submit">Login</button></div>
                                            <p class="text-muted">Forgot your password? Contact me!</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"></div>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
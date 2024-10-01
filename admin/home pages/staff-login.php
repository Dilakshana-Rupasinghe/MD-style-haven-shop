<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Md-style-haven</title>
     <!-- Bootstrap CSS link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home.css">
    <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <!-- navigation bar start -->
    <?php
    include('../../includes/admin-navigation.php');
    ?>


<div class="sign-up">
        <div class="sign-up-bg col-md-10 mx-auto" style="background: url('images/log bg.jpg') no-repeat; background-size: cover;  background-position: center; border-radius: 20px ">


            <!-- </div> -->
            <div class="container row my-5 mx-auto  ">
                <div class="col-md-5 mx-auto my-3 ">
                    <div class="wrapper">
                        <form action="#" method="POST" class="login">
                            <h1 class="text-center">MD-Style Haven</h1>
                            <h2 class="text-center">Log-in</h2>
                            <div class="input-box">
                                <input type="text" name="username" id="username" placeholder="USERNAME" required>
                            </div>

                            <div class="input-box">
                                <input type="password" name="password" id="password" placeholder="PASSWORD" required>
                            </div>
                            <div class="remember-me">
                                <label> <input type="checkbox" name="rememberme"> Remember ME </label>
                                <a href="#" class="ps-3 "> Froget-password?</a>
                            </div>

                            <button type="submit" class="submit btn-dark " name="customer-login">Log-in</button>
                            <div class="register-link">
                                <h5>Don't have an account <a href="sign-up.php" class="ps-3 ">Sign-In</a></h5>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
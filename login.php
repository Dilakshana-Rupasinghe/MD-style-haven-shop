<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/login.css">

    <title>MD-Style Haven shop/online shoping-Home page</title>
</head>

<body style="background: url('images/BG1.jpg') no-repeat; background-size: cover;  background-position: center; 
 " >
     
    <!-- navigation bar start -->
    <?php
    include('includes/navbar.php');
    ?>
    <!-- navigaton bar  end -->

    
    <!-- </div> -->
    <div class="container row my-5 mx-auto ">
        <div class="col-md-5 mx-auto ">
            <div class="wrapper">
                <form action="#" class="login">
                    <h1 class="text-center">MD-Style Haven</h1>
                    <h2 class="text-center">Log-in</h2>
                    <div class="input-box">
                        <input type="text" name="username" placeholder="USERNAME" required>
                    </div>

                    <div class="input-box">
                        <input type="password" name="password" placeholder="PASSWORD" required>
                    </div>
                    <div class="remember-me">
                        <label> <input type="checkbox" name="rememberme"> Remember ME </label>
                        <a href="#" class="ps-3 "> Froget-password?</a>
                    </div>

                    <button type="submit" class="submit btn-dark " name="login">Log-in</button>
                    <div class="register-link">
                        <h6>Don't have an account <a href="#" class="ps-3 ">Sign-In</a></h6>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- footer section -->

    <?php 
        include('includes/footer.php');
     ?>


</body>

</html>
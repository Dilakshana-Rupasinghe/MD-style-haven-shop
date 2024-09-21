<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- material icons css link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- css links -->
    <link rel="stylesheet" href="css/home.css">
    <!-- <link rel="stylesheet" href="css/login.css"> -->
    <link rel="stylesheet" href="css/sign-up.css">

    <title>MD-Style Haven shop/online shoping-Sign-up page</title>
</head>

<body>
    <?php
    include('includes/navbar.php');
    ?>

    <div class="sign-up" >
        <div class="sign-up-bg col-md-10 mx-auto" style="background: url('images/log4.jpg') no-repeat; background-size: cover;  background-position: center; border-radius: 20px ">

    
        <!-- sign in form start -->
        <div class="container row my-5 mx-auto ">
            <div class="col-md-6 mx-auto my-4" >

                <div class="wrapper">
                    <form action="#" method="post">
                        <h1 class="text-center">MD-Style Haven shop</h1>
                        <h2 class="text-center"> Sign-UP </h2>

                        <div class="input-box">
                            <input type="email" name="email" placeholder="@Email" required>
                        </div>

                        <div class="input-box">
                            <input type="text" name="username" placeholder="USERNAME" required>
                        </div>

                        <div class="input-box">
                            <input type="password" name="password" placeholder="PASSWORD" required>
                        </div>

                        <div class="input-box">
                            <input type="text" name="firstname" placeholder="FIRST NAME" required>
                        </div>

                        <div class="input-box">
                            <input type="text" name="lastname" placeholder="LAST NAME" required>
                        </div>

                        <div class="input-box">
                            <input type="text" name="phonenumber" placeholder="PHONE NUMBER" required>
                        </div>

                        <div class="input-box">
                            <input type="text" name="addressline1" placeholder="ADDRESS LINE 1" required>
                        </div>

                        <div class="input-box">
                            <input type="text" name="addressline2" placeholder="ADDRESS LINE 2">
                        </div>

                        <div class="input-box">
                            <input type="text" name="addresskine3" placeholder="AADDRESS LINE 3">
                        </div>

                        <div class="input-box">
                            <input type="text" name="city" placeholder="CITY">
                        </div>

                        <button type="submit" class="submit btn-dark " name="login">Sign-up</button>

                        <div class="register-link">
                            <h5> have an account? <a class="ps-3" href="login.php"> Login </a></h5>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- sign in form end -->
        </div>
    </div>




    <?php
    include('includes/footer.php');
    ?>
    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
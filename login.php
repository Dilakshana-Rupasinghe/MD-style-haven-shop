<?php
session_start();

// include satabase connection
include('database/config.php');

//check if the form is submited or not
if (isset($_POST['customer-login'])) {

    // add user inputs
    $username = $_POST['username'];
    $password = $_POST['password'];

    //ferify if password and username store in DB or not
    $select_quirey  = " SELECT * FROM customer WHERE cust_username='$username'";

    $result = mysqli_query($con, $select_quirey );
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    if ($row_count > 0) {
        //check user input password and DB store password are maching or not 
        if ($password == $row_data['cust_pwd']) {
            // check if user is active or not
            if ($row_data['cust_is_active'] == 1) {
                $_SESSION['custId'] = $row_data['cust_id'];
                header("location:index.php");
                exit();
            } else {
                echo "<script>alert('User is Deactive');</script>";
            }
        } else {
            echo "<script>alert('Invalid Password');</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- material icons css link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/login.css">
    <title>MD-Style Haven shop/online shoping-login page</title>
</head>

<body>

    <!-- navigation bar start -->
    <?php
    include('includes/navbar.php');
    ?>
    <!-- navigaton bar  end -->

    <div class="sign-up">
        <div class="sign-up-bg col-md-10 mx-auto" style="background: url('images/log\ bg1.jpg') no-repeat; background-size: cover;  background-position: center; border-radius: 20px ">


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
    <!-- footer section -->

    <?php
    include('includes/footer.php');
    ?>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<?php
// Close the database connection
mysqli_close($con);
?>
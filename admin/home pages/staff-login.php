<?php
session_start();

//include database connection
include('../../database/config.php');

// check if the form is submited or not
if (isset($_POST['staff-login'])) {

    // add user inputs 
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check the username and passweord are correct or nor

    //verifi if password store in db in correct username
    $select_quiry = "SELECT * FROM staff WHERE staff_username = '$username'";

    $result = mysqli_query($con, $select_quiry);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    if ($row_count > 0) {
        // check user input passowrd and DB store passweord are maching or not
        if ($password == $row_data['staff_pwd']) {
            if ($row_data['staff_is_active'] == 1) { //check user is active

                // store staff id into session
                $_SESSION['staffId'] = $row_data['staff_id'];
                $staff_type_id = ($row_data['fk_staff_type_id']);

                // rederect to the user they relevent home page according to staff type id
                if ($staff_type_id == 1001) {
                    header("location:admin-home.php");
                    exit();
                } elseif ($staff_type_id == 1002) {
                     header('location:inventorymanager-home.php');
                     exit();
                 }elseif($staff_type_id == 1003){
                     header('location:deliver-home.php');
                     exit();
                    }elseif($staff_type_id == 1004){
                        header('location:accountant-home.php');
                        exit();
                    }elseif($staff_type_id == 1005){
                     header('location:customerservice-home.php');
                     exit();
                 }elseif($staff_type_id == 1006){
                     header('location:designer-home.php');
                     exit();
                 }
            }else{
                echo "<script> alart('User is Deactive'); </script>" ;
            }
        }else{
            echo "<script>alert('Invalid Password');</script>";
        }
    }else{
        echo "<script>alert('Invalid Credentials');</script>";
    }
}


?>

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
    <link rel="stylesheet" href="../../css/login.css">

    <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <!-- navigation bar start -->
    <?php
    include('../../includes/admin-navigation.php');
    ?>


    <div class="sign-up">
        <div class="sign-up-bg col-md-10 mx-auto" style="background: url('../../images/log\ bg1.jpg') no-repeat; background-size: cover;  background-position: center; border-radius: 20px ">


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

                            <button type="submit" class="submit btn-dark " name="staff-login">Log-in</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- footer section start -->
    <div>
        <footer class="copyr fixed-bottom">
            <div class="container ">
                <div class="row col-12 pt-3 ">
                    <p class="copy-right">Copyright &COPY; 2024 MD-Style Haven SHOP | Develop by - <a href="#"> Malindu </a> </p>
                </div>
            </div>
        </footer>
    </div>
    <!-- footer section end -->

</body>

</html>

<?php
// close the databse connection
mysqli_close($con);
?>
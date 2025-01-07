<?php
session_start();

// include the database configureation file 
include('database/config.php');


// check if the form is submited
if (isset($_POST['customer-signup'])) {

    // add user inputs
    $email = $_POST['email'];
    $username =  $_POST['username'];
    $password =  $_POST['password'];
    $firstname =  $_POST['firstname'];
    $lastname =  $_POST['lastname'];
    $phonenumber =  $_POST['phonenumber'];
    $addressline1 =  $_POST['addressline1'];
    $addressline2 =  $_POST['addressline2'];
    $addressline3 =  $_POST['addressline3'];
    $city =  $_POST['city'];


    // check filds not empty 
    if ($email != '' and $username != '' and $password != '' and $firstname != '' and $lastname != '' and $phonenumber != '' and $addressline1 != '' and $addressline2 != '' and $addressline3 != '' and $city != '') {

        // check for exist email 
        $emailchechkQuary = "SELECT cust_email FROM customer WHERE cust_email = '$email'";
        $emailresult = mysqli_query($con, $emailchechkQuary);
        $emailrow_count = mysqli_num_rows($emailresult);

        if ($emailrow_count > 0) {
            echo "<script>alert('The email address is already registered. Please use a different email.');</script>";
        } else {  // check for exist user name 
            $usernamecheckQuary = "SELECT cust_username FROM customer WHERE cust_username = '$username'";
            $usernameresult = mysqli_query($con, $usernamecheckQuary);
            $user_row_count = mysqli_num_rows($usernameresult);

            if ($user_row_count > 0) {
                echo "<script>alert('The username is already registered. Please use a different username.');</script>";
            } else {
                $customerinsertQuary = " INSERT INTO customer(cust_fname, cust_lname, cust_username, cust_pwd, cust_email, cust_phone, cust_add_line1, cust_add_line2, cust_add_line3, cust_add_line4) VALUES ('$firstname' , '$lastname' , '$username' , '$password' , '$email' , '$phonenumber' , '$addressline1' , '$addressline2' , '$addressline3' , '$city') ";

                // insert user information in to database
                // check if the exicution of the SQL quary 
                if (mysqli_query($con, $customerinsertQuary)) {
                    echo "<script>alert('Sign-up successful! please verify your email ');</script>";
                }
            }
        }
    } else {
        echo "<script>alert('All fields marked as required must be filled out.');</script>";
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

    <div class="sign-up">
        <div class="sign-up-bg col-md-10 mx-auto" style="background: url('images/log\ bg1.jpg') no-repeat; background-size: cover;  background-position: center; border-radius: 20px ">


            <!-- sign in form start -->
            <div class="container row my-5 mx-auto ">
                <div class="col-md-6 mx-auto my-4">

                    <div class="wrapper">
                        <form action="#" method="post" onsubmit="return registerValication();">
                            <h1 class="text-center">MD-Style Haven shop</h1>
                            <h2 class="text-center"> Sign-UP </h2>

                            <div class="input-box">
                                <input type="email" id="email" name="email" placeholder="@Email" required>
                            </div>

                            <div class="input-box">
                                <input type="text" id="username" name="username" placeholder="USERNAME" required>
                            </div>

                            <div class="input-box">
                                <input type="password" id="password" name="password" placeholder="PASSWORD" required>
                            </div>

                            <div class="input-box">
                                <input type="text" id="firstname" name="firstname" placeholder="FIRST NAME" required>
                            </div>

                            <div class="input-box">
                                <input type="text" id="lastname" name="lastname" placeholder="LAST NAME" required>
                            </div>

                            <div class="input-box">
                                <input type="text" id="phonenumber" name="phonenumber" placeholder="PHONE NUMBER" required>
                            </div>

                            <div class="input-box">
                                <input type="text" id="addressline1" name="addressline1" placeholder="ADDRESS LINE 1" required>
                            </div>

                            <div class="input-box">
                                <input type="text" id="addressline2" name="addressline2" placeholder="ADDRESS LINE 2">
                            </div>

                            <div class="input-box">
                                <input type="text" id="addressline3" name="addressline3" placeholder="AADDRESS LINE 3">
                            </div>

                            <div class="input-box">
                                <input type="text" id="city" name="city" placeholder="CITY">
                            </div>

                            <button type="submit" class="submit btn-dark " name="customer-signup">Sign-up</button>

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

    <script type="text/javascript">
        function registerValication() {
            var email = document.getElementById("email").value.trim(); // trim is used to check if user enter only spasce to fields
            var username = document.getElementById("username").value.trim();
            var password = document.getElementById("password").value.trim();
            var firstname = document.getElementById("firstname").value.trim();
            var lastname = document.getElementById("lastname").value.trim();
            var phonenumber = document.getElementById("phonenumber").value.trim();
            var addressline1 = document.getElementById("addressline1").value.trim();
            var addressline2 = document.getElementById("addressline2").value.trim();
            var city = document.getElementById("city").value.trim();

            //check if the requred fields are not empty 
            if (email == "" || username == "" || password == "" || firstname == "" || lastname == "" || phonenumber == "" ||
                addressline1 == "" || addressline2 == "" || city == "") {
                alert('Please fill in all required fields. No blank fields allowed.');
                return false;
            }

            // Password validation
            if (password.length < 4) {
                alert("Password must be at least 3 characters long.");
                return false;
            }
            // Check phone number format
            const phoneRegex = /^\d{10}$/; // regex format 
            if (!phoneRegex.test(phonenumber)) {
                alert('Please enter a valid phone number (10 digits).');
                return false;
            }
            return ture;
        }
    </script>

    <!-- <script type="text/javascript">
        function registerValication() {

            var email = document.getElementById("email").value.trim(); // trim is used to check if user enter only spasce to fields
            var username = document.getElementById("username").value.trim();
            var password = document.getElementById("password").value.trim();
            var firstname = document.getElementById("firstname").value.trim();
            var lastname = document.getElementById("lastname").value.trim();
            var phonenumber = document.getElementById("phonenumber").value.trim();
            var addressline1 = document.getElementById("addressline1").value.trim();
            var addressline2 = document.getElementById("addressline2").value.trim();
            var city = document.getElementById("city").value.trim();

            // check if the related field are not empty
            if (email == "" || username == "" || password == "" || firstname == "" || lastname == "" || phonenumber == "" ||
                addressline1 == "" || addressline2 == "" || city == "") {
                alert('Please fill in all required fields. No blank fields allowed.');
                return false;
            }

            // Password validation
            if (password.length < 4) {
                alert("Password must be at least 4 characters long.");
                return false;
            }

            // If all validations pass
            return true;
        }
        //check phone number format 

        
    </script> -->



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
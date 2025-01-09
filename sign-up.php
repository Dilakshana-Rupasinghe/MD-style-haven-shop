<?php
session_start();

// include the database configureation file 
include('database/config.php');

//generate random otp 
$otp = rand(100000, 999999);
$otpTimestamp = time();
$_SESSION['otp'] = $otp;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// create function to send the mail 
function sebdemail_verify($firstname, $lastname, $email, $otp)
{
    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //server setting 
        $mail->isSMTP();                                            // Send using SMTP
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'malindudilak@gmail.com';               // SMTP username
        $mail->Password   = 'bhmv fuxd amnl cqai';                  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to (587 for TLS)

        // app password
        // bhmv fuxd amnl cqai

        // Optional: Disable strict SSL verification (Temporary for debugging)
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];


        // Recipients
        $mail->setFrom('mdstylehaven@gmail.com', 'MD-Style Haven');
        $mail->addAddress($email, $firstname . ' ' . $lastname);    // Add recipient with full name

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Email Verification from MD-Style Haven';
        $mail->Body    = "
                <h2>Welcome to MD-Style Haven!</h2>
                <p>Dear $firstname $lastname,</p>
                <p>Thank you for registering with us. Your verification code is:</p>
                <h1>$otp</h1>
                <p>Please enter this code to complete your registration.</p>
            ";

        // Send email
        $mail->send();
        echo "<script>alert('Verification code has been sent to your email. Please check it!');</script>";
        echo "<script>window.location.href = 'verify-otp.php';</script>";
        // header("Location: verify-otp.php");
        // exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


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

    //create session for email to pass data to verify.php
    $_SESSION['email'] = $email;

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
                // insert user information into the database
                $customerInsertQuery = "INSERT INTO customer (cust_fname, cust_lname, cust_username, cust_pwd, cust_email, cust_phone, cust_add_line1, cust_add_line2, cust_add_line3, cust_add_line4, otp, active_code) 
                  VALUES ('$firstname', '$lastname', '$username', '$password', '$email', '$phonenumber', '$addressline1', '$addressline2', '$addressline3', '$city', '$otp', '$activation_code')";

                if (mysqli_query($con, $customerInsertQuery)) {
                    sebdemail_verify("$firstname", "$lastname", "$email", "$otp");
                    echo "<script>alert('Sign-up successful! please verify your email ');</script>";
                } else {
                    echo "<script>alert('Error occurred during sign-up. Please try again later.');</script>";
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
    <link rel="stylesheet" href="css/home-all-style.css">
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

                            <!-- store otp and actication code in hidden inputfield -->
                            <input type="hidden" name="otp" id="otp" value="<?php echo $otp; ?>">
                            <input type="hidden" name="activation_code" id="activation_code" value="<?php echo $activation_code; ?>">

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
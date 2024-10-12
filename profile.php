<?php
session_start();

//include database connection 
include('database/config.php');

//rederect to the login page if user is not login
if (!isset($_SESSION['custId'])) {
    header('location:login.php');
    exit();
}

$custId = $_SESSION['custId'];


// rederect to if logout button clicked
if (isset($_POST['custLogout'])) {
    session_destroy();
    header('location:index.php');
    exit();
}


// check the form is click the save change button
if (isset($_POST['saveChanges'])) {
    // get user input form the form
    // $userName = $_POST['userName']; // cant change the user name 
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $address3 = $_POST['address3'];
    $address4 = $_POST['address4'];

    // check filds are not empty
    if ($firstName != '' and $lastName != '' and $email != '' and $phone != '' and $address1 != '' and $address2 != '' and $address3 != '' and $address4 != '') {
        $custUpdateDetails = "UPDATE customer SET  cust_fname = '$firstName', cust_lname = '$lastName', cust_email = '$email', cust_phone = '$phone', cust_add_line1 = '$address1', cust_add_line2 = '$address2', cust_add_line3 = '$address3', cust_add_line4 = '$address4' WHERE cust_id = $custId";

        // update user details 
        if (mysqli_query($con, $custUpdateDetails)) {
            echo "<script> alart('Information update is successfull'); </script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MD Style Haven Shop - Account Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- material icons css link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- css links -->
    <link rel="stylesheet" href="css/my-profile.css">
    <link rel="stylesheet" href="css/home-style.css">
    <link rel="stylesheet" href="css/style.css">



</head>

<body>
    <!-- include navigation bar -->

    <?php
    include('includes/navbar.php');
    ?>

    <h2 class="ms-5 mt-3">Account Details</h2>

    <hr>
    <!-- Main Section -->

    <aside>
        <h2 class="ms-5 ps-3">My Profile</h2>
        <div class="profile-section ms-5">
            <img src="profile.jpg" alt="Profile Picture" class="profile-pic">
            <button class="edit-profile">✎</button>

            <!-- Logout section start -->
            <div class="container row my-1 mx-auto">
                <div class="col-md-7 mx-auto">
                    <div class="wrapper-out">
                        <form action="#" method="post" style="margin: 8%; padding: 25px;">
                            <h3 class="text-center" style="color: white;">You are login to the system</h3>
                            <button type="submit" class="submit mt-5 " name="custLogout"> Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Logout section end -->

    </aside>

    <hr>


    <!-- Display user details and change -->
    <main>
        <section class="account-details col-md-8 mx-auto">
            <?php
            // get customer information into form
            if (isset($_SESSION['custId'])) {

                $getUserDetails = "SELECT cust_username, cust_fname, cust_lname, cust_email, cust_phone, cust_add_line1, cust_add_line2,cust_add_line3,cust_add_line4 FROM customer WHERE cust_id = $custId";

                $result = mysqli_query($con, $getUserDetails);
                $row_count = mysqli_num_rows($result);

                if ($row_count == 0) {
                    echo "<h2 class='bg-danger text-center mt-5 '> No users yet </h2>";
                } else {
                    // fetch user details
                    while ($row_data = mysqli_fetch_assoc($result)) {
                        $cust_username = $row_data['cust_username'];
                        $cust_fname = $row_data['cust_fname'];
                        $cust_lname = $row_data['cust_lname'];
                        $cust_email = $row_data['cust_email'];
                        $cust_phone = $row_data['cust_phone'];
                        $cust_address1 = $row_data['cust_add_line1'];
                        $cust_address2 = $row_data['cust_add_line2'];
                        $cust_address3 = $row_data['cust_add_line3'];
                        $cust_address4 = $row_data['cust_add_line4'];

            ?>



                        <form id="account-form" action="#" method="post">

                            <label for="userName">User name</label>
                            <input type="text" id="userName" name="userName" value="<?php echo $cust_username; ?>" readonly>

                            <label for="firstName">First name</label>
                            <input type="text" id="firstName" name="firstName" value="<?php echo $cust_fname; ?>" required>

                            <label for="lastName">Last name</label>
                            <input type="text" id="lastName" name="lastName" value="<?php echo $cust_lname; ?>" required>

                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo $cust_email; ?>" required>

                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo $cust_phone; ?>" required>

                            <label for="address1">Address</label>
                            <input type="text" id="address" name="address1" value="<?php echo $cust_address1; ?>" required>
                           
                            <label for="address2">Address</label>
                            <input type="text" id="address" name="address2" value="<?php echo $cust_address2; ?>" required>
                           
                            <label for="address3">Address</label>
                            <input type="text" id="address" name="address3" value="<?php echo $cust_address3; ?>" required>
                           
                            <label for="address4">Address</label>
                            <input type="text" id="address" name="address4" value="<?php echo $cust_address4; ?>" required>

                            <button class="savechange" type="submit" name="saveChanges" id="saveChanges">Save Changes</button>
                        </form>

            <?php
                    }
                }
            }

            ?>
        </section>
    </main>
    <!-- Order History Section -->
    <section class="order-history">
        <h2>Order History</h2>
        <div class="no-orders">
            You haven't placed any orders yet.
        </div>
    </section>


    <!-- footer section -->
    <?php
    include('includes/footer.php');
    ?>

    <script src="script.js"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
<?php
// Close the database connection
mysqli_close($con);
?>
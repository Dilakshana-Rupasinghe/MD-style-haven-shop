<?php
session_start();

//rederect user to login page if user not login 
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}

// include the database configaration file
include('../../database/config.php');

if (isset($_POST['update_details'])) {

    //get user input from  the form
    // $userNam = $_POST['userName'];
    // $staffType = $_POST['staffType'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $nic = $_POST['nic'];
    $phone = $_POST['phone'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $address2 = $_POST['address2'];
    $address3 = $_POST['address3'];
    $address4 = $_POST['address4'];

    $staff_id = $_GET['staffId'];

    // check form filds are not empty
    if ($firstName != '' and $lastName != '' and $email != '' and $nic != '' and $phone != '' and $address1 != '' and $address2 != '' and $address3 != '' and $address4 != '') {

        $staffUpdateQuiry = "UPDATE staff SET  staff_fname = '$firstName', staff_lname ='$lastName', staff_email= '$email', staff_nic = '$nic', staff_phone = '$phone', staff_add_line1 = '$address1', staff_add_line2 = '$address2', staff_add_line3 = '$address3', staff_add_line4 = '$address4' WHERE staff_id= '$staff_id'";

        // update user details
        if (mysqli_query($con, $staffUpdateQuiry)) {
            echo "<script>alert('Staff Information Update is succefully');</script>";
        }
    }
}


// change passowrd 

if (isset($_POST['update-password'])) {

    //get user input from  the form
    $password = $_POST['password'];

    $staff_id = $_GET['staffId'];

    // check form filds are empty or not
    if($password != ''){
        $passwordUpdateQuary = "UPDATE staff SET staff_pwd = '$password' WHERE staff_id = '$staff_id'";

        //update quary
        if(mysqli_query($con ,$passwordUpdateQuary)){
            echo "<script>alert('Staff Password Change is succefully');</script>";

        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit staff account</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">

    <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <?php
    include('../../includes/admin-navigation.php');
    ?>
    <div class="container-body">
        <!-- menu section start -->
        <aside class="left-menu" style="height: fit-content;">
            <?php
            include('../../includes/back-side-nav.php');
            ?>
        </aside>
        <div class="middle-side">

            <!-- main section start -->
            <main class="mx-4">
                <!-- BACK button start -->
                <div class="back-button-container mt-1">
                    <a href="staff-management.php" class="back-button">Back</a>
                </div>
                <!-- BACK button end -->
                <h1>Staff manaement - edit/update user details</h1>

                <div class="edit">
                    <div class="change" style="width: 35rem;">
                        <h3 class="text-center">Edit/Update user details</h3>

                        <?PHP
                        // get user id using get method
                        if (isset($_GET['staffId'])) {
                            $staff_id = $_GET['staffId'];

                            $get_staffDetails = "SELECT staff_username, staff_type_name, staff_fname, staff_lname, staff_email, staff_nic, staff_phone, staff_add_line1, staff_add_line2, staff_add_line3, staff_add_line4 FROM staff
                        INNER JOIN staff_type ON staff.fk_staff_type_id = staff_type.staff_type_id
                        WHERE staff.staff_id = $staff_id"; //get user type from staff table

                            $result = mysqli_query($con, $get_staffDetails);
                            $row_count = mysqli_num_rows($result);

                            // check table row count
                            if ($row_count == 0) {
                                echo "<h2 class='bg-danger text-center mt-5 '> No users yet </h2>";
                            } else {

                                while ($row_data = mysqli_fetch_assoc($result)) {
                                    // assigne DB value to variables
                                    $staff_username = $row_data['staff_username'];
                                    $staff_type_name = $row_data['staff_type_name'];
                                    $staff_fname = $row_data['staff_fname'];
                                    $staff_lname = $row_data['staff_lname'];
                                    $staff_email = $row_data['staff_email'];
                                    $staff_nic = $row_data['staff_nic'];
                                    $staff_phone = $row_data['staff_phone'];
                                    $staff_address1 = $row_data['staff_add_line1'];
                                    $staff_address2 = $row_data['staff_add_line2'];
                                    $staff_address3 = $row_data['staff_add_line3'];
                                    $staff_address4 = $row_data['staff_add_line4'];

                        ?>

                                    <form action="" method="post" class="details-change">
                                        <div>
                                            <label for="userName">User name</label> <br>
                                            <input type="text" id="userName" name="userName" value="<?php echo $staff_username; ?>" readonly>
                                        </div>

                                        <div>
                                            <label for="staffType">Staff Type</label> <br>
                                            <input type="text" id="staffType" name="staffType" value="<?php echo $staff_type_name; ?>" readonly>
                                        </div>

                                        <div>
                                            <label for="firstName">First name</label> <br>
                                            <input type="text" id="firstName" name="firstName" value="<?php echo $staff_fname; ?>" required>
                                        </div>

                                        <div>
                                            <label for="lastName">Last name</label> <br>
                                            <input type="text" id="lastName" name="lastName" value="<?php echo $staff_lname; ?>" required>
                                        </div>

                                        <div>
                                            <label for="email">Email</label> <br>
                                            <input type="email" id="email" name="email" value="<?php echo $staff_email; ?>" required>
                                        </div>

                                        <div>
                                            <label for="nic">NIC</label> <br>
                                            <input type="text" id="nic" name="nic" value="<?php echo $staff_nic; ?>" required>
                                        </div>

                                        <div>
                                            <label for="phone">Phone Number</label> <br>
                                            <input type="text" id="phone" name="phone" value="<?php echo $staff_phone; ?>" required>
                                        </div>

                                        <div>
                                            <label for="address1">Address</label> <br>
                                            <input type="text" id="address" name="address1" value="<?php echo $staff_address1; ?>" required>
                                        </div>

                                        <div>
                                            <label for="address2">Address</label> <br>
                                            <input type="text" id="address" name="address2" value="<?php echo $staff_address2; ?>" required>
                                        </div>

                                        <div>
                                            <label for="address3">Address</label> <br>
                                            <input type="text" id="address" name="address3" value="<?php echo $staff_address3; ?>" required>
                                        </div>

                                        <div>
                                            <label for="address4">Address</label> <br>
                                            <input type="text" id="address" name="address4" value="<?php echo $staff_address4; ?>" required>
                                        </div>
                                        <div style="margin: 0 9rem;">
                                            <button class="update-change" type="submit" name="update_details" id="update">Update Details</button>
                                        </div>
                                    </form>


                        <?php
                                }
                            }
                        }

                        ?>
                    </div>
                    <div class="change" style="height: fit-content;">
                        <h3 class="text-center">Channge password</h3>

                        <?php
                        // get user id using get method
                        if (isset($_GET['staffId'])) {
                            $staff_id = $_GET['staffId'];

                            $get_staffDetails = "SELECT staff_username FROM staff
                             WHERE staff.staff_id = $staff_id"; //get user type from staff table

                            $result = mysqli_query($con, $get_staffDetails);
                            $row_count = mysqli_num_rows($result);

                            // check table row count
                            if ($row_count == 0) {
                                echo "<h2 class='bg-danger text-center mt-5 '> No users yet </h2>";
                            } else {

                                while ($row_data = mysqli_fetch_assoc($result)) {
                                    // assigne DB value to variables
                                    $staff_username = $row_data['staff_username'];
                        ?>
                                    <form action="" method="post" class="password-change">
                                        <div>
                                            <label for="userName">User-Name</label> <br>
                                            <input type="text" id="userName" name="userName" value="<?php echo $staff_username; ?>" readonly>
                                        </div>

                                        <div>
                                            <label for="password">Password</label> <br>
                                            <input type="password" id="password" name="password" required>
                                        </div>

                                        <div style="margin:0 40px;">
                                            <button type="submit" name="update-password" id="update"> Changes Password</button>
                                        </div>

                                    </form>

                        <?php
                                }
                            }
                        }
                        ?>

                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- footer section start -->
    <div>
        <footer class="copyr fixed-bottom  ">
            <div class="container ">
                <div class="row col-12 pt-3 ">
                    <p class="copy-right">Copyright &COPY; 2024 MD-Style Haven SHOP | Develop by - <a href="#"> Malindu </a> </p>
                </div>
            </div>
        </footer>
    </div>
    <!-- footer section end -->

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<?php
// cloce the database connection
mysqli_close($con);
?>
<?php
session_start();

//rederect user to login page if user not login 
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}

// include the database configaration file
include('../../database/config.php');
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

                        <form action="" method="post" class="details-change">
                            <div>
                                <label for="userName">User name</label> <br>
                                <input type="text" id="userName" name="userName" readonly>
                            </div>

                            <div>
                                <label for="firstName">First name</label> <br>
                                <input type="text" id="firstName" name="firstName" required>
                            </div>

                            <div>
                                <label for="lastName">Last name</label> <br>
                                <input type="text" id="lastName" name="lastName" required>
                            </div>

                            <div>
                                <label for="email">Email</label> <br>
                                <input type="email" id="email" name="email" required>
                            </div>

                            <div>
                                <label for="phone">Phone Number</label> <br>
                                <input type="tel" id="phone" name="phone" required>
                            </div>

                            <div>
                                <label for="address1">Address</label> <br>
                                <input type="text" id="address" name="address1" required>
                            </div>

                            <div>
                                <label for="address2">Address</label> <br>
                                <input type="text" id="address" name="address2" required>
                            </div>

                            <div>
                                <label for="address3">Address</label> <br>
                                <input type="text" id="address" name="address3" required>
                            </div>

                            <div>
                                <label for="address4">Address</label> <br>
                                <input type="text" id="address" name="address4" required>
                            </div>
                            <div style="margin: 0 9rem;">
                                <button class="update-change" type="submit" name="update" id="update">Update Details</button>
                            </div>
                        </form>

                    </div>
                    <div class="change" style="height: fit-content;">
                        <h3 class="text-center">Channge password</h3>
                        <form action="" method="post" class="password-change">
                            <div>
                                <label for="userName">User-Name</label> <br>
                                <input type="text" id="userName" name="userName" readonly>
                            </div>

                            <div>
                                <label for="password">Password</label> <br>
                                <input type="text" id="password" name="password" required>
                            </div>

                            <div style="margin:0 40px;" >
                                <button  type="submit" name="update" id="update"> Changes Password</button>
                            </div>

                        </form>

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
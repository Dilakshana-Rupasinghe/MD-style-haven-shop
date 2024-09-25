<?php
// include the database configaration file
include('../../database/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff registration</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home.css">
    <link rel="stylesheet" href="../../css/back-style.css">

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
        <!-- main section start -->
        <main class="mx-4">

            <h1 class="mt-5">Register staff</h1>
            <!-- Staff Register form section start -->
            <div class="container  row my-5 mx-auto" >
                <div class="wrapper col-md-4 mx-auto">
                    <form action="#" method="post">

                        <!-- First name -->
                        <div class="input-box">
                            <input type="text" name="fName" id="fName" placeholder="First Name" required>
                        </div>
                        <!-- Last name -->
                        <div class="input-box">
                            <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                        </div>
                        <!-- Username -->
                        <div class="input-box">
                            <input type="text" name="userName" id="userName" placeholder="Username" required>
                        </div>
                        <!-- Password -->
                        <div class="input-box">
                            <input type="password" name="password" id="password" placeholder="Password" required>
                        </div>
                        <!-- staff type dropdown -->
                        <div class="input-box">
                            <select name="staffType" required>
                                <option selected value=''>Select Staff Type</option>
                            </select>
                        </div>
                        <!-- E-mail -->
                        <div class="input-box">
                            <input type="text" name="email" id="email" placeholder="E-mail" required>
                        </div>
                        <!-- Contact no -->
                        <div class="input-box">
                            <input type="text" name="contactNo" id="contactNo" placeholder="Contact No" required>
                        </div>
                        <!-- NIC -->
                        <div class="input-box">
                            <input type="text" name="nic" id="nic" placeholder="NIC" required>
                        </div>
                        <!-- Address line1 -->
                        <div class="input-box">
                            <input type="text" name="addressLine1" id="addressLine1" placeholder="Address Line-1" required>
                        </div>
                        <!-- Address line2 -->
                        <div class="input-box">
                            <input type="text" name="addressLine2" id="addressLine2" placeholder="Address Line-2" required>
                        </div>
                        <!-- Address line3 -->
                        <div class="input-box">
                            <input type="text" name="addressLine3" id="addressLine3" placeholder="Address Line-3">
                        </div>
                        <!-- City  -->
                        <div class="input-box">
                            <input type="text" name="city" id="city" placeholder="City" required>
                        </div>
                        <!-- Register button -->
                        <button type="submit" class="btn text-bg-secondary" name="staffRegister">Register</button>
                        <!-- Admin logon link -->
                    </form>
                </div>
            </div>
            <!-- Staff Register form section end -->
        </main>
        <!-- main section end -->
        <!-- right section start -->
        <div class="right me-4">
            <!-- BACK button start -->
            <div class="back-button-container">
                <a href="staff-management.php" class="back-button">Back</a>
            </div>
            <!-- BACK button end -->
        </div>
        <!-- right cestion end -->
    </div>
    <!--  -->



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

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>

<?php
// cloce the database connection
mysqli_close($con);
?>
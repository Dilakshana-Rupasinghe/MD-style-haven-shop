<?php
session_start();

// rederect login page if user logout
if (!isset($_SESSION['staffId'])) {
    header('location:home pages/staff-login.php');
    exit();
}

//distroy session if user click logout button
if (isset($_POST['staffLogout'])) {
    session_destroy();
    header('location:home pages/staff-login.php');
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log out</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- material icons css link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- css links -->
    <link rel="stylesheet" href="../css/my-profile.css">
    <link rel="stylesheet" href="../css/home-all-style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/back-style.css">
</head>

<body>
    <!-- nevigation bar section start -->
    <nav class="navbar navbar-expand-lg bg-body-secondary  sticky-top py-0">
        <div class="container-fluid">
            <a class="navbar-brand ms-2 me-auto" href="">
                <img src="../images/logo .jpg" alt="logo" style="height: 80px; width: 120px;" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- right  nav bar -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link me-3" href="logout.php"><img src="../icons/profile-line.svg" style="width: 32px;"></a>
                    </li>
                </ul>
            </div>
        </DIV>
        </div>
    </nav>

    <!-- navigation bar section end -->

    <!-- Logout section start -->

    <!-- BACK button start -->
    <div class="back-button-container">
        <a href="home pages/admin-home.php" class="back-button">Back</a>
    </div>
    <!-- BACK button end -->

    <aside>

        <div class="container row my-5 pt-2 mx-auto">
            <div class="col-md-7 mx-auto">
                <div class="wrapper-out">
                    <form action="#" method="post" style="margin: 8%; padding: 25px;">
                        <h3 class="text-center" style="color: white;">You are login to the system</h3>
                        <button type="submit" class="submit mt-5 " name="staffLogout"> Logout</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!-- Logout section end -->

    </aside>


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

    <script src="script.js"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
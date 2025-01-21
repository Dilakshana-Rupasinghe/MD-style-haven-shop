<?php
session_start();


// rederect user to the login if user not logingtothe system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
} else {
    $staffId = $_SESSION['staffId'];
}
// include the database configaration file
// include('../../database/config.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <!-- <link rel="stylesheet" href="../../css/fuck.css"> -->
    <link rel="stylesheet" href="../../css/styles.css">

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
            <main class="ms-4">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1 d-flex justify-content-between">
                    <!-- Report selection form -->
                    <form method="post" action="">
                        <select name="report" id="report" style="width: 20rem;">
                            <option value="0">Select Report</option>
                            <option value="1">Active Staff Report</option>
                            <option value="2">Low Stock Items Report</option>
                            <option value="3">Top rated Items Report</option>
                            <option value="4">Highest Offers Items Report</option>
                            <option value="5">Loyalty customers Report</option>
                            <option value="6">Pending Orders Reports</option>
                            <option value="7">Deavtive Staff Reports</option>
                            <option value="8">Complete Order report</option>
                        </select>
                        <input type="submit" name="submit" value="Generate Report" class="deactivate bg-warning text-dark">
                    </form>
                    <a href="../home pages/admin-home.php" class="back-button">Back</a>
                </div>
                <!--  BACK & Register button end -->
                <div class="container row my-2 mx-auto">
                    <div>
                        <h2 class="text-center">Report Details</h2>
                        <br>
                    </div>
                </div>

                <?php
                // include the database configaration file
                include('../../database/config.php');
                // Handle form submission
                if (isset($_POST['submit'])) {
                    $value = $_POST['report'];

                    if ($value == 1) {
                        include('active-staff-report.php');
                    } elseif ($value == 2) {
                        include('outofstock-items.php');
                    } elseif ($value == 3) {
                        include('top-ratad-item-report.php');
                    } elseif ($value == 4) {
                        include('offers-report.php');
                    } elseif ($value == 5) {
                        include('loyalty-customers-report.php');
                    } elseif ($value == 6) {
                        include('orders-pending-report.php');
                    } elseif ($value == 7) {
                        include('deactive-staff-report.php');
                    } elseif ($value == 8) {
                        include('order-complete-report.php');
                    }
                }
                ?>

            </tr>

                </tr>
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

<!-- close database connection -->
<?php
mysqli_close($con);
?>
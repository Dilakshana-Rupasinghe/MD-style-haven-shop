<?php
session_start();

// rederect user to the login if user not logingtothe system
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
    <title>Inventory management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/manage-button.css">

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
                <div class="back-button-container mt-1">
                <div class="date ms-4" style=" line-height: 2rem;">
                        <input type="date" style=" padding: 0px 10px;">
                    </div>
                    <a href="#" class="manage-item-button">Manage item / category </a>
                    <a href="../home pages/admin-home.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                    <h1>Inventory management</h1>


                <div class="charts">
                    <div class="chart" style="width: 90%;">
                        <h3>Stock Turnover Rate (2024)</h3>
                        <canvas id="lineChart"></canvas>

                    </div>
                </div>

                <!-- start recent order -->
                <div class="recent_order mt-4">
                    <hr>
                    <h2 class="ms-5 ps-5 mb-3"> Product list</h2>
                    <hr>
                    <table>
                        <tr>
                            <th>item ID</th>
                            <th>item name</th>
                            <th>Brand</th>
                            <th>sell Price </th>
                            <th>Discount </th>
                            <th>Cost price </th>
                            <th>Quntity </th>
                            <th>Action </th>
                        </tr>
                        <tr>
                            <td>25001</td>
                            <td>POLO T-SHIRT SIGNATURE V NECK</td>
                            <td>MAS</td>
                            <td>Rs : 3299.99</td>
                            <td class="warring" style="color: darkred;">5%</td>
                            <td>Rs : 3350.99</td>
                            <td>69</td>
                            <td>
                                <a href='#' class='view'>View</a>
                            </td>
                        </tr>
                    </table>
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

    <!-- Chart JS link -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../script/strockchart.js"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<!-- close database connection -->
<?php
mysqli_close($con);
?>
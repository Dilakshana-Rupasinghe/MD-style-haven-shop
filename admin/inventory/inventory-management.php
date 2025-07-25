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
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/manage-button.css">
    <link rel="stylesheet" href="../../css/manage-button1.css">

    <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <?php
    include('../../includes/admin-navigation.php');
    ?>
    <div class="container-body">

        <!-- menu section start -->
        <aside class="left-menu" style="height: 100%;">
            <?php
            include('../../includes/back-side-nav.php');
            ?>
        </aside>
        <div class="middle-side">


            <!-- main section start -->
            <main class="ms-4">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1">
                    <div class="date ms-0" style="padding: 0px 35px 0px 0px; line-height: 1.5rem;">
                    </div>
                    <a href="fabric-management.php" class="manage-fabric-button">
                        Manage Fabrics
                        <span class="material-symbols-outlined" style="font-size:18px; padding-left: 7px; ">
                            styler
                        </span></a>
                    <a href="item-management.php" class="manage-item-button">
                        Manage item
                        <span class="material-symbols-outlined" style="font-size:18px; padding-left: 7px; ">
                            inventory_2
                        </span></a>
                    <a href="category.php" class="manage-category-button">Manage Category
                        <span class="material-symbols-outlined" style="font-size:18px; padding-left: 7px;">
                            category
                        </span></a>
                    <?php
                    $invisible = '';
                    $invisible = ($_SESSION['staffId'] != 1001) ? 'invisible' : '';
                    // Admin has staff_type_id = 1001, Designer = 1006
                    $logged_in_staff_id = isset($_SESSION['fk_staff_type_id']) ? $_SESSION['fk_staff_type_id'] : null; // Here's the mismatch
                    if ($_SESSION['fk_staff_type_id'] == 1001) {
                        echo '<a href="../home pages/admin-home.php" class="back-button">Back</a>';
                    } else {
                        echo '<a href="#" class="' . $invisible . ' back-button disabled" style="pointer-events: none; opacity: 0.5;">Back</a>';
                    }
                    ?>
                </div>

                <!--  BACK & Register button end -->
                <h1>Inventory management</h1>


                <div class="charts">
                    <!-- <div class="d-flex"> -->
                    <div class="edit " style="margin-top: 1rem;">
                        <div class="change  " style="height: fit-content; width: 60rem">
                            <!-- <div class="chart" style="width: 90%;"> -->


                            <?php
                            // Get data from DB to prepare item quantity data for the chart
                            $sqlItemQuantity = "SELECT item_id, item_name, item_stock_qty
                                    FROM item
                                    ORDER BY item_id;
                                ";

                            $resultItemQuantity = mysqli_query($con, $sqlItemQuantity);

                            $item_labels = [];
                            $item_data = [];
                            while ($rowItemQuantity = mysqli_fetch_assoc($resultItemQuantity)) {
                                $item_labels[] = $rowItemQuantity['item_name'];
                                $item_data[] = $rowItemQuantity['item_stock_qty'];
                            }
                            ?>

                            <h3>Strock by item</h3>
                            <canvas id="bar-chart"></canvas>

                        </div>

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

    <!-- Chart JS link -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../script/strockchart.js"></script>

    <script>
        var item_labels = <?php echo json_encode($item_labels); ?>; //convert array (staff_type_name) to json
        var item_data = <?php echo json_encode($item_data); ?>; //convert array (staff_count) to json
    </script>
    <script src="../../script/stockcount.js"></script>


    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<!-- close database connection -->
<?php
mysqli_close($con);
?>
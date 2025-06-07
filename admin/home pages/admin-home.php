<?php
session_start();

if (!isset($_SESSION['staffId'])) {
    header('location:staff-login.php');
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
    <title>Admin dashboard</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/manage-button.css">

    <style>
        .cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 5px;
            padding: 5px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 220px;
            height: 150px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .card-content {
            text-align: center;
            margin-bottom: 10px;
        }

        .number {
            font-size: 40px;
            font-weight: bold;
            color: rgb(17, 136, 136);
        }

        .card-name {
            font-size: 20px;
            font-weight: 700;
        }

        .icon-box {
            font-size: 20px;
            color: rgb(20, 19, 19);
        }





        /* Responsive Design */
        @media (max-width: 768px) {
            .cards {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 50%;
                height: 20%;
            }

            .number {
                font-size: 15px;
                align-items: center;
            }

            .card-name {
                font-size: 15px;
                align-items: center;
            }
        }
    </style>

    <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <!-- navigation bar start -->
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
    </div>


    <!-- main section start -->
    <div class="middle-side">
        <div class="d-flex justify-content-between">

            <!--  BACK & Register button end -->
            <h1 class="mt-5 ms-3">Dashboard</h1>
            <!-- BACK & Register button start -->
            <div class="back-button-container mt-0">
                <div class="date ms-5" style=" line-height: 2rem;">
                    <input type="date" style=" padding: 0px 10px;">
                </div>
            </div>
        </div>


        <div class="cards">

            <div class="card" style="background-color:rgb(230, 255, 255)">
                <?php
                $sqlclothCustCount = "SELECT COUNT(cust_id) AS customer_count FROM customer WHERE cust_is_active= 1";
                $resulCustomerCount = mysqli_query($con, $sqlclothCustCount);
                $rowCustomerCount = mysqli_fetch_assoc($resulCustomerCount);
                $customersCount = $rowCustomerCount['customer_count'];
                ?>

                <div class="card-content">
                    <div class="card-name text-dark">TOTLE CUSTOMERS</div>
                    <div class="number"><?php echo $customersCount; ?></div>
                    <span class="material-symbols-outlined">
                        group
                    </span>
                </div>
                <div class="icon-box">
                    <i class="fas fa-shoe-prints"></i>
                </div>
            </div>

            <?php
            $sqlCateCount = "SELECT COUNT(category_name) as category_count FROM category;";
            $resultCateCount = mysqli_query($con, $sqlCateCount);
            $rowCateCount = mysqli_fetch_assoc($resultCateCount);
            $categoryCount = $rowCateCount['category_count'];
            ?>
            <div class="card " style="background-color:rgb(204, 221, 255)
">
                <div class="card-content">
                    <div class="card-name">CATEGORY</div>
                    <div class="number"><?php echo $categoryCount; ?></div>
                    <span class="material-symbols-outlined">
                        category
                    </span>
                </div>
            </div>
            <div class="card" style="background-color:rgb(243, 230, 255)">
                <?php
                $sqlclothCustCount = "SELECT COUNT(customization_id) AS customization_count FROM customization";
                $resulCustCount = mysqli_query($con, $sqlclothCustCount);
                $rowShoeCustCount = mysqli_fetch_assoc($resulCustCount);
                $clothCustomizationCount = $rowShoeCustCount['customization_count'];
                ?>

                <div class="card-content">
                    <div class="card-name text-dark">CUSTOMIZATION</div>
                    <div class="number"><?php echo $clothCustomizationCount; ?></div>
                    <span class="material-symbols-outlined">
                        apparel
                    </span>
                </div>
                <div class="icon-box">
                    <i class="fas fa-shoe-prints"></i>
                </div>
            </div>


            <div class="card" style="background-color:rgb(255, 230, 230)">
                <?php
                $sqlOrdersCount = "SELECT COUNT(*) AS pending_order_count FROM `order`
                                       WHERE order_status = 'Pending';";
                $resulOrdersCount = mysqli_query($con, $sqlOrdersCount);
                $rowOrdersCount = mysqli_fetch_assoc($resulOrdersCount);
                $ordersCount = $rowOrdersCount['pending_order_count'];
                ?>
                <div class="card-content">

                    <div class="card-name text-dark">PENDING ORDER</div>
                    <div class="number"><?php echo $ordersCount; ?></div>
                    <span class="material-symbols-outlined">
                        pending_actions
                    </span>
                </div>
                <div class="icon-box">
                    <i class="fas fa-rupee-sign"></i>
                </div>
            </div>
        </div>

        <div class="main">

            <main class="mx-2" style="height: fit-content;">


                <div class="chart m-3">
                    <!-- <div class="d-flex"> -->
                    <div class="edit " style="margin-top: 1rem;">
                        <div class="change  " style="height: fit-content; width: 60rem">
                            <!-- <div class="chart" style="width: 90%;"> -->


                            <?php
                            // Get data from DB to prepare item quantity data for the chart
                            $sqlItemQuantity = "SELECT item_id,item_name, item_stock_qty
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

                            <h3>Stock by Item</h3>
                            <canvas id="bar-chart"></canvas>
                        </div>

                    </div>
                </div>
                <div class="d-flex">

                    <?php
                    // Get data from DB to staff doughnut-chart
                    $sqlTotalStaff = "SELECT st.staff_type_name, COUNT(s.staff_id) AS staff_count
              FROM staff_type st
             INNER JOIN staff s ON st.staff_type_id = s.fk_staff_type_id
             GROUP BY st.staff_type_name;
                ";

                    $resultTotalStaff = mysqli_query($con, $sqlTotalStaff);

                    $staff_labels = [];
                    $staff_data = [];
                    while ($rowTotalStaff = mysqli_fetch_assoc($resultTotalStaff)) {
                        $staff_labels[] = $rowTotalStaff['staff_type_name'];
                        $staff_data[] = $rowTotalStaff['staff_count'];
                    }
                    ?>

                    <div class="chart m-3 text-center" id="pie-cahrt" style="width: 29rem; height:31rem">
                        <h3>Employes</h3>
                        <canvas id="pieChart"></canvas>

                    </div>

                    <?php
                    // Get data from DB to Payment type line-chart
                    $sqlTotalPaymentType = "SELECT order_payment_option , COUNT(order_id) AS payment_count
              FROM `order` WHERE order_status = 'Complete' 
             GROUP BY order_payment_option;
                ";

                    $resultTotalpaymentType = mysqli_query($con, $sqlTotalPaymentType);

                    $payment_type_labels = [];
                    $payment_type_data = [];
                    while ($rowTotalpayment_type = mysqli_fetch_assoc($resultTotalpaymentType)) {
                        $payment_type_labels[] = $rowTotalpayment_type['order_payment_option'];
                        $payment_type_data[] = $rowTotalpayment_type['payment_count'];
                    }
                    ?>

                    <div class="chart m-3 mt-5 text-center " id="line-chart" style="width: 36rem; height: 26rem;">
                        <h3>Payments</h3>
                        <canvas id="lineChart" class="mt-5"></canvas>

                    </div>



                </div>
            </main>
        </div>






    </div>



    <!-- main section end -->



    <!-- right section start -->
    <div class="right me-4 mb-5">
        <h1></h1>
    </div>
    <!-- right cestion end -->
    </div>



    </div>


    <!-- footer section start -->
    <div>
        <footer class="copyr fixed-bottom ">
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
    <script>
        var item_labels = <?php echo json_encode($item_labels); ?>; //convert array (staff_type_name) to json
        var item_data = <?php echo json_encode($item_data); ?>; //convert array (staff_count) to json
    </script>
    <script src="../../script/stockcount.js"></script>


    <script>
        var staffLabels = <?php echo json_encode($staff_labels); ?>; //convert array (staff_type_name) to json
        var staffData = <?php echo json_encode($staff_data); ?>; //convert array (staff_count) to json
    </script>
    <script src="../../script/staffchart.js"></script>



    <!-- for payment type chart -->
    <script>
        var Payment_Type_labels = <?php echo json_encode($payment_type_labels); ?>; //convert array (staff_type_name) to json
        var Payment_Type_data = <?php echo json_encode($payment_type_data); ?>; //convert array (staff_count) to json
    </script>
    <script src="../../script/PaymentTypeLineChart.JS"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
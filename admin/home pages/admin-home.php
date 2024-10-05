<?php
session_start();

if (!isset($_SESSION['staffId'])) {
    header('location:staff-login.php');
    exit();
}
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
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">

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
        <!-- main section start -->
        <main class="mx-2" style="height: fit-content;">
            <h1 class="mt-5 ms-3">Dashboard</h1>

            <div class="date ms-4 mt-3">
                <input type="date">
            </div>

            <div class="insights mt-5 ms-1">

                <!-- start sessing -->
                <div class="seals text-center">
                    <span class="material-symbols-outlined">
                        trending_up
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h5>total seals</h5>
                            <h4>Rs. 45,840.50</h4>
                        </div>
                        <div class="progoss">
                            <svg>
                                <circle r="30" cy="40" cx="9.3rem"> </circle>
                            </svg>
                            <div class="number">75%</div>
                        </div>
                        <small>Last 24 Hours</small>
                    </div>
                </div>
                <!-- end selling -->


                <!-- start expensess -->
                <div class="expenses text-center">
                    <span class="material-symbols-outlined">
                        local_mall
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h5> total expenses</h5>
                            <h4>Rs. 25,480.99</h4>
                        </div>
                        <div class="progoss">
                            <svg>
                                <circle r="30" cy="40" cx="9.3rem"> </circle>
                            </svg>
                            <div class="number">85%</div>
                        </div>
                        <small>Last 24 Hours</small>
                    </div>

                </div>
                <!-- end expensess -->

                <!-- start income -->
                <div class="income text-center">
                    <span class="material-symbols-outlined">
                        monitoring
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h5> total income</h5>
                            <h4>Rs. 128,980.19</h4>
                        </div>
                        <div class="progoss">
                            <svg>
                                <circle r="30" cy="40" cx="9.3rem"> </circle>
                            </svg>
                            <div class="number">65%</div>
                        </div>
                        <small>Last 24 Hours</small>
                    </div>

                </div>

                <!-- end income -->

            </div>

        </main>
        <!-- main section end -->



        <!-- right section start -->
        <div class="right me-4 mb-5">
            <h1>right</h1>
        </div>
        <!-- right cestion end -->
    </div>
    </div>
    </div>

    <!-- start recent order -->
    <div class="recent_order mt-4">
        <hr>
        <h2 class="ms-5 ps-5 mb-3" >Recent orders</h2>
        <hr>
        <table>
            <tr>
                <th>item name</th>
                <th>item code</th>
                <th>Price </th>
                <th>Payment Method </th>
                <th>Status </th>
            </tr>
            <tr>
                <td>POLO T-SHIRT SIGNATURE V NECK</td>
                <td>25001</td>
                <td>Rs : 3299.99</td>
                <td>COD</td>
                <td class="warring" style="color: darkred;">Pending</td>
            </tr>
            <tr>
                <td>GRAPHIC T-SHIRT Tropic Night Tee</td>
                <td>25052</td>
                <td>Rs : 5900.00</td>
                <td>Bank payment</td>
                <td class="warring" style="color: green;">Delivering</td>
            </tr>
        </table>
    </div>
    <!-- end recent order -->




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
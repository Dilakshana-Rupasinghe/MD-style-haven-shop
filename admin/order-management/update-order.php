<?php
session_start();

// rederect user to the login if user not logingtothe system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}
// include the database configaration file
include('../../database/config.php');


//get value from item table using item id
if (isset($_GET['orderId'])) {
    $view_order = $_GET['orderId'];


    $get_Details = "SELECT * FROM `order`
WHERE order_id = $view_order"; //get category name from category table

    $result = mysqli_query($con, $get_Details);
    $row_count = mysqli_num_rows($result);

    if ($row_count == 0) {
        echo "<h2 class = 'bd-danger text-center mt-5'> No item yet </h2> ";
    } else {
        while ($row_data = mysqli_fetch_assoc($result)) {

            $order_id = $row_data['order_id'];
            $order_details = $row_data['order_details'];
            $fk_cust_id = $row_data['fk_cust_id'];
            $customer = $row_data['order_fname'] . ' ' . $row_data['order_lname'];
            $order_status = $row_data['order_status'];
            $order_total = $row_data['order_total'];
            $paymentMethod = $row_data['order_payment_option'];
        }
    }
}

$_SESSION['order_id'] =  $order_id;
$_SESSION['order_details'] =  $order_details;
$_SESSION['customer'] =  $customer;
$_SESSION['fk_cust_id'] =  $fk_cust_id;
$_SESSION['order_total'] =  $order_total;
$_SESSION['paymentMethod'] =  $paymentMethod;

$order_id = isset($_SESSION['order_id']) ?  $_SESSION['order_id']  : "N/A";
$order_details = isset($_SESSION['order_details']) ?  $_SESSION['order_details']  : "N/A";
$customer = isset($_SESSION['customer']) ?  $_SESSION['customer']  : "N/A";
$fk_cust_id = isset($_SESSION['fk_cust_id']) ?  $_SESSION['fk_cust_id']  : "N/A";
$order_total = isset($_SESSION['order_total']) ?  $_SESSION['order_total']  : 0;
$paymentMethod = isset($_SESSION['paymentMethod']) ?  $_SESSION['paymentMethod']  : "error";

// control user loyalty point if payment option COD

//get user loyalty detail in checkout.php page 
// Check if the customer already has a loyalty record and get current point value
$pointSelectQuary = "SELECT points FROM user_loyalty WHERE fk_cust_id = '$fk_cust_id'";
$pointsResult = mysqli_query($con, $pointSelectQuary);
$rowdata = mysqli_fetch_assoc($pointsResult);

//get current point value store in DB
$currentPoint = $rowdata['points'];

//calculate points using current purches total 
$earnedPoint = (float)($order_total / 100); // e.g., Rs.100 = 1 point
$UpdetNewPointS = $currentPoint + $earnedPoint;

// store in session to pass the data 
$_SESSION['currentPoint'] =  $currentPoint;
$_SESSION['earnedPoint'] =  $earnedPoint;
$_SESSION['UpdetNewPointS'] =  $UpdetNewPointS;

if (isset($_POST['statusupdate'])) {
    $value = $_POST['status'];

    if ($value == 1) {
        $updateQuary = "UPDATE `order` SET order_status = 'Processing' WHERE order_id= '$order_id'";
        $result = mysqli_query($con, $updateQuary);
        echo "<script>alert('Status update success!');</script>";
        echo "<script>window.open('order-manage.php', '_self');</script>";
    } elseif ($value == 2) {
        $updateQuary = "UPDATE `order` SET order_status = 'Ready for Delivery' WHERE order_id= '$order_id'";
        $result = mysqli_query($con, $updateQuary);
        echo "<script>alert('Status update success!');</script>";
        echo "<script>window.open('order-manage.php', '_self');</script>";
    } elseif ($value  == 3) {
        $updateQuary = "UPDATE `order` SET order_status = 'Complete' WHERE order_id= '$order_id'";
        $result = mysqli_query($con, $updateQuary);
        // if paymet method COD then add new/update loylty point to table
        if ($paymentMethod == 'cod') {
            $pointUpdateQuary = "UPDATE user_loyalty SET points = $UpdetNewPointS WHERE fk_cust_id = '$fk_cust_id'";
            $result = mysqli_query($con, $pointUpdateQuary);
        }

        echo "<script>alert('Status update success!');</script>";
        echo "<script>window.open('order-manage.php', '_self');</script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">
    <link rel="stylesheet" href="../../css/manage-button-1.css">
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
        <aside class="left-menu" style="height: 100%;">
            <?php
            include('../../includes/back-side-nav.php');
            ?>
        </aside>
        <div class="middle-side">

            <main class="ms-4">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1">

                    <a href="order-manage.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1 class="mt-2">Order management-Update order process</h1>

                <h3>Order Details - <i> <?php echo $order_details ?> </i></h3>
                <div class="d-flex  justify-content-center contact-form mx-4 mt-2 mb-5">
                    <form action="#" method="post">
                        <div>

                            <label for="email"><strong>Customer- </strong> <i><?php echo $customer ?></i></label> <br>
                        </div>
                        <div class="my-5">

                            <select name="status" id="status" style="width: 30rem;">
                                <option value="0">Select Report</option>
                                <option value="1">Processing</option>
                                <option value="2">Ready for Delivery</option>
                                <option value="3">Complete</option>
                            </select>
                        </div>



                        <button type="submit" name="statusupdate" class="submit-btn">Update Status</button>
                    </form>
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

<!-- close database connection -->
<?php
mysqli_close($con);

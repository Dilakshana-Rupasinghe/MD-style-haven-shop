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
if (isset($_GET['customizationId'])) {
    $view_order = $_GET['customizationId'];


    $get_Details = "SELECT * FROM `customization`
WHERE customization_id = $view_order"; //get category name from category table

    $result = mysqli_query($con, $get_Details);
    $row_count = mysqli_num_rows($result);

    if ($row_count == 0) {
        echo "<h2 class = 'bd-danger text-center mt-5'> No item yet </h2> ";
    } else {
        while ($row_data = mysqli_fetch_assoc($result)) {

            $customization_id = $row_data['customization_id'];
            $order_details = $row_data['Cloth_type'].' ' .$row_data['fabric'].' Qty-'.$row_data['cust_qty'];
            $fk_cust_id = $row_data['fk_cust_id'];
            $order_status = $row_data['customize_status'];
            $fk_cust_id = $row_data['fk_cust_id'];

            $get_customer = "SELECT * FROM customer WHERE cust_id=  $fk_cust_id";
            $customerResult = mysqli_query($con, $get_customer);
            $row_count = mysqli_num_rows($customerResult);
            $row_data = mysqli_fetch_assoc($customerResult);

            $customer = $row_data['cust_fname']. ' '. $row_data['cust_lname'];
        }
    }
}

$_SESSION['customization_id'] =  $customization_id;
$_SESSION['order_details'] =  $order_details;
$_SESSION['customer'] =  $customer;

$customization_id = isset($_SESSION['customization_id']) ?  $_SESSION['customization_id']  : "N/A";
$order_details = isset($_SESSION['order_details']) ?  $_SESSION['order_details']  : "N/A";
$customer = isset($_SESSION['customer']) ?  $_SESSION['customer']  : "N/A";


if (isset($_POST['statusupdate'])) {
    $value = $_POST['status'];

    if ($value == 1) {
        $updateQuary = "UPDATE `customization` SET customize_status = 'Processing' WHERE customization_id= '$customization_id'";
        $result = mysqli_query($con, $updateQuary);
        echo "<script>alert('Status update success!');</script>";
        echo "<script>window.open('customization-management.php', '_self');</script>";
    } elseif ($value == 2) {
        $updateQuary = "UPDATE `customization` SET customize_status = 'Ready for fits on' WHERE customization_id= '$customization_id'";
        $result = mysqli_query($con, $updateQuary);
        echo "<script>alert('Status update success!');</script>";
        echo "<script>window.open('customization-management.php', '_self');</script>";
    } elseif ($value  == 3) {
        $updateQuary = "UPDATE `customization` SET customize_status = 'Complete' WHERE customization_id= '$customization_id'";
        $result = mysqli_query($con, $updateQuary);
        echo "<script>alert('Status update success!');</script>";
        echo "<script>window.open('customization-management.php', '_self');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customization management</title>
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

                    <a href="customization-management.php" class="back-button">Back</a>
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
                                <option value="2">Ready for Fiton</option>
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

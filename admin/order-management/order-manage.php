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

            <main class="ms-4">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1">

                    <a href="../home pages/admin-home.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1 class="mt-2">Order management</h1>

                <h2 class="text-center">Order Details</h2>


                <table>
                    <tr>
                        <th>order ID</th>
                        <th>order date</th>
                        <th>Customer</th>
                        <th>Order Detils</th>
                        <th>Total Price</th>
                        <th>Payment method</th>
                        <th>Status</th>
                        <th>Action </th>
                    </tr>
                    <?php
                    //get value from item table
                    $get_itemDetails = "SELECT * FROM `order`";
                    $result = mysqli_query($con, $get_itemDetails);
                    $row_count = mysqli_num_rows($result);

                    if ($row_count == 0) {
                        echo "<h2 class = 'bd-danger text-center mt-5'> No item yet </h2> ";
                    } else {
                        while ($row_data = mysqli_fetch_assoc($result)) {

                            $order_id = $row_data['order_id'];
                            $order_date = $row_data['order_date'];
                            $customer = $row_data['order_fname'] . ' ' . $row_data['order_lname'];
                            $order_details = $row_data['order_details'];
                            $order_total = $row_data['order_total'];
                            $order_payment_option = $row_data['order_payment_option'];
                            $order_status = $row_data['order_status'];

                            echo "
              <tr>
        <td> $order_id </td>
        <td> $order_date </td>
        <td> $customer </td>
        <td> $order_details </td>
        <td> $order_total </td>
        <td> $order_payment_option </td>
        <td> $order_status </td>
        <td class='action-links'>
         <a href='order-view.php?orderId=$order_id' class='view'>View</a> 
         <a href='update-order.php?orderId=$order_id' class='update'>Status</a>
         <a href='#' class='deactivate'>Cancle</a>
        
        </td>
    </tr>";
                        }
                    }

                    ?>


                </table>

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

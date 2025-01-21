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

            <main class="ms-4 mb-5">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1">

                    <a href="order-manage.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1 class="mt-2">Order management</h1>

                <table >
                    <?php
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
                                $order_date = $row_data['order_date'];
                                $order_details = $row_data['order_details'];
                                $order_total = $row_data['order_total'];
                                $fk_cust_id = $row_data['fk_cust_id'];
                                $customer = $row_data['order_fname']. ' '. $row_data['order_lname'];
                                $order_email = $row_data['order_email'];
                                $discrict = $row_data['discrict'];
                                $address = $row_data['order_address_line1'] . ' '. $row_data['order_address_line2']. ' '. $row_data['order_address_line3']. ' '. $row_data['city'];
                                $postal_code = $row_data['postal_code'];
                                $contact = $row_data['order_contact1']. ' '. $row_data['order_contact2'];
                                $order_status = $row_data['order_status'];
                                $order_payment_option = $row_data['order_payment_option'];

                                echo
                                " <tr>
                        <th>Order ID</th>
                        <td>$order_id</td>
                    </tr>
                    <tr>
                        <th>Order date</th>
                        <td> $order_date </td>

                        </tr>
                    <tr>
                        <th>Order </th>
                        <td> $order_details </td>

                        </tr>
                    <tr>
                        <th>Total price</th>
                        <td> $order_total </td>
                  
                        </tr>
                    <tr>
                        <th>Customer ID</th>
                        <td> $fk_cust_id </td>

                        </tr>
                    <tr>
                        <th>Customer</th>
                        <td> $customer </td>

                        </tr>
                    <tr>
                        <th>Email</th>
                        <td> $order_email </td>
                        </tr>
                     <tr>
                        <th>Reagion</th>
                        <td> $discrict </td>

                        </tr>
                    <tr>
                        <th>Address </th>
                        <td> $address </td>

                        </tr>
                    <tr>
                        <th>Postal code </th>
                        <td> $postal_code </td>
                        </tr>
                    <tr>
                        <th>Contact </th>
                        <td> $contact </td>

                        </tr>
                   
                    <tr>
                        <th>Payment method</th>
                        <td> $order_payment_option </td>


                    </tr>
                    <tr>
                        <th>Status</th>
                        <td> $order_status </td>


                    </tr>
                   ";
                            }
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

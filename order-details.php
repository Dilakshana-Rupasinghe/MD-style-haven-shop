<?php
session_start();

//include database connection 
include('database/config.php');

//rederect to the login page if user is not login
if (!isset($_SESSION['custId'])) {
    header('location:login.php');
    exit();
}

$custId = $_SESSION['custId'];

if (isset($_GET['canclell'])) {
    $order_id = $_GET['canclell'];

    $GetDetails = "SELECT * FROM `order` WHERE order_id = $order_id";
    $result = mysqli_query($con, $GetDetails);
    $row_data = mysqli_fetch_assoc($result);
    $status = $row_data['order_status'];

    // Correct conditional check
    if ($status !== 'Complete' || $status !== 'Ready for Delivery' || $status !== 'Cancelled') {
        $UpdateStatus = "UPDATE `order` SET order_status = 'Cancelled' WHERE order_id = $order_id";
        mysqli_query($con, $UpdateStatus);

        $updatePayment = "UPDATE payment SET payment_status = 'Cancelled' WHERE fk_order_id = $order_id";
        mysqli_query($con, $updatePayment);

        //  Restore stock for each item from order_item table
        $getOrderItems = "SELECT fk_item_id, item_qty FROM order_item WHERE fk_order_id = $order_id";
        $itemsResult = mysqli_query($con, $getOrderItems);

        if ($itemsResult && mysqli_num_rows($itemsResult) > 0) {
            while ($itemRow = mysqli_fetch_assoc($itemsResult)) {
                $itemId = (int)$itemRow['fk_item_id'];
                $qty = (int)$itemRow['item_qty'];

                // Update only that item's stock
                $updateStock = "UPDATE item SET item_stock_qty = item_stock_qty + $qty WHERE item_id = $itemId";
                mysqli_query($con, $updateStock);
                echo "<script>alert('Order cancelled successfully!');</script>";
                echo "<script>window.open('profile.php', '_self');</script>";
            }
            // after canscle order delete order_item tabal details
            $deleteOrderItems = "DELETE FROM order_item WHERE fk_order_id = $order_id";
            mysqli_query($con, $deleteOrderItems);
        } else {
            echo "<script>alert('No items found in the order to restock.');</script>";
            echo "<script>window.open('profile.php', '_self');</script>";
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MD Style Haven Shop - Account Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- material icons css link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- css links -->
    <link rel="stylesheet" href="css/my-profile.css">
    <link rel="stylesheet" href="css/home-all-style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/back-style.css">

    <style>
        .deactivate {
            padding: 8px 16px;
            cursor: pointer;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: flow-root;
            font-size: 19px;
            font-weight: 700;
            margin-right: 5px;
        }

        .deactivate {
            background-color: #DC3545;
        }
    </style>



</head>

<body>
    <!-- include navigation bar -->

    <?php
    include('includes/navbar.php');
    ?>
    <div class="d-flex justify-content-between">
        <h2 class="ms-5 mt-3">Order Details</h2>
        <!-- BACK button start -->
        <div class="back-button-container mt-1">
            <a href="profile.php" class="back-button">Back</a>
        </div>
        <!-- BACK button end -->
    </div>
    <table class="col-11 m-5">

        <?php
        // get value from staff and staff type table
        if (isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];


            $selectOrderDetails = "SELECT * FROM `order` WHERE order_id= $order_id";
            $Orderresult = mysqli_query($con, $selectOrderDetails);
            $row_count = mysqli_num_rows($Orderresult);

            if ($row_count > 0) {
                while ($row_data = mysqli_fetch_assoc($Orderresult)) {
                    $order_id = $row_data['order_id'];
                    $order_date = $row_data['order_date'];
                    $order_details = $row_data['order_details'];
                    $order_total = $row_data['order_total'];
                    $order_cust_name = $row_data['order_fname'] . '' . $row_data['order_lname'];
                    $order_email = $row_data['order_email'];
                    $order_address = $row_data['discrict'] . ', ' . $row_data['order_address_line1'] . ', ' . $row_data['order_address_line2'] ?? null . ', ' . $row_data['order_address_line3'] ?? null;
                    $city = $row_data['city'];
                    $postal_code = $row_data['postal_code'];
                    $order_contact = $row_data['order_contact1'] . ' ' . $row_data['order_contact2'] ?? null;
                    $order_payment_option = $row_data['order_payment_option'];
                    $order_status = $row_data['order_status'];
                    $order_deliver_date = $row_data['order_deliver_date'];
                    $item_id = $row_data['fk_item_id'];
                    echo "
<tr>
    <th>Order ID</th> 
    <td>$order_id</td>
</tr>
<tr>
    <th>Order Date </th>
    <td>$order_date</td>
 </tr>
<tr>
    <th>Customer name</th>
    <td>$order_cust_name</td>

 </tr>
<tr>
    <th>Order Detail</th>
    <td>$order_details</td>

</tr>
<tr>
    <th>Total Price</th>
    <td>$order_total</td>

</tr>
<tr>
    <th>Email</th>
    <td>$order_email</td>

</tr>
<tr>
    <th>Address</th>
    <td>$order_address</td>

</tr>
<tr>
    <th>City</th>
    <td>$city</td>

</tr>
<tr>
    <th>Postal code</th>
    <td>$postal_code</td>

</tr>
<tr>
    <th>Contact</th>
    <td>$order_contact</td>

</tr>
<tr>
    <th>Payment method</th>
    <td>$order_payment_option</td>

</tr>
<tr>
    <th>Status</th>
    <td>$order_status</td>
</tr>
<tr>
    <th>Item</th>
    <td>$item_id</td>
</tr>
<tr>
    <th>Delivery Date</th>
    <td>$order_deliver_date</td>
</tr>";
                }
            }
        } else {
            echo "<h2 class='bg-danger text-center m-5 py-2 '> Not any Orders yet </h2>";
        }

        ?>

    </table>
    <div class="d-flex justify-content-center">
        <div class="mb-4 col-4 ">
            <?php
            $GetDetails = "SELECT * FROM `order` WHERE order_id = $order_id";
            $result = mysqli_query($con, $GetDetails);
            $row_data = mysqli_fetch_assoc($result);
            $status = $row_data['order_status'];
            $invisible = ($status == 'Cancelled' || $status == 'Complete' || $status == 'Ready for Delivery') ? 'invisible' : '';

            echo  "<a href='order-details.php?canclell=$order_id' class='$invisible deactivate'>Cancle order</a>" ?>
        </div>

    </div>



    <!-- footer section -->
    <?php
    include('includes/footer.php');
    ?>

    <script src="script.js"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
<?php
// Close the database connection
mysqli_close($con);
?>
<?php
session_start();

// redirect user to login if not logged in
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}

// include DB config
include('../../database/config.php');

// Handle filter and search
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$search_customer = isset($_GET['search_customer']) ? trim($_GET['search_customer']) : '';

// Build query based on filters
if (!empty($status_filter) && !empty($search_customer)) {
    $get_itemDetails = "SELECT * FROM `order` 
                        WHERE order_status = '$status_filter' 
                        AND CONCAT(order_fname, ' ', order_lname) LIKE '%$search_customer%'
                        ORDER BY order_status = 'Pending' DESC, order_id DESC";
} elseif (!empty($status_filter)) {
    $get_itemDetails = "SELECT * FROM `order` 
                        WHERE order_status = '$status_filter' 
                        ORDER BY order_status = 'Pending' DESC, order_id DESC";
} elseif (!empty($search_customer)) {
    $get_itemDetails = "SELECT * FROM `order` 
                        WHERE CONCAT(order_fname, ' ', order_lname) LIKE '%$search_customer%'
                        ORDER BY order_status = 'Pending' DESC, order_id DESC";
} else {
    $get_itemDetails = "SELECT * FROM `order` ORDER BY order_status = 'Pending' DESC, order_id DESC";
}

$result = mysqli_query($con, $get_itemDetails);
$row_count = mysqli_num_rows($result);


if (isset($_GET['canclellID'])) {
    $order_id = $_GET['canclellID'];

    $GetDetails = "SELECT * FROM `order` WHERE order_id = $order_id";
    $result = mysqli_query($con, $GetDetails);
    $row_data = mysqli_fetch_assoc($result);
    $status = $row_data['order_status'];
    $order_total = $row_data['order_total'];
    $fk_cust_id = $row_data['fk_cust_id'];


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
                echo "<script>window.open('order-manage.php', '_self');</script>";
            }
            // after canscle order delete order_item tabal details
            $deleteOrderItems = "DELETE FROM order_item WHERE fk_order_id = $order_id";
            mysqli_query($con, $deleteOrderItems);
        } else {
            echo "<script>alert('No items found in the order to restock.');</script>";
        }
    }



    // Check if the customer already has a loyalty record
    $pointSelectQuary = "SELECT points FROM user_loyalty WHERE fk_cust_id = $fk_cust_id";
    $pointsResult = mysqli_query($con, $pointSelectQuary);
    $rowdata = mysqli_fetch_assoc($pointsResult);

    $currentPoint = $rowdata['points'];

    // Calculate new points based on purchase amount
    $earnedPoints = (float)($order_total / 100); // e.g., Rs.100 = 1 point

    $getOrderDetails = "SELECT * FROM `order` WHERE order_id = $order_id";
    $result = mysqli_query($con, $getOrderDetails);
    $rowdata = mysqli_fetch_assoc($result);

    $is_loyalty_used = $rowdata['is_loyalty_used'];

    if ($is_loyalty_used == 1) {
        $refundQuery = "UPDATE user_loyalty SET points = points + 100 WHERE fk_cust_id = $fk_cust_id";
        mysqli_query($con, $refundQuery);
        $updateIsloyalsyStatus = "UPDATE `order` SET is_loyalty_used = 0 WHERE  order_id = $order_id";
        mysqli_query($con, $updateIsloyalsyStatus);
    }

    $UpdetNewPoint = 0;
    if ($earnedPoints > 0) {
        $UpdetNewPoint = $currentPoint - $earnedPoints;
        // Deduct earned points
        $updatePoints = "UPDATE user_loyalty SET points = points - $UpdetNewPoint WHERE fk_cust_id = $fk_cust_id";
        mysqli_query($con, $updatePoints);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">
    <link rel="stylesheet" href="../../css/manage-button-1.css">
    <!-- Material icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>
    <?php include('../../includes/admin-navigation.php'); ?>

    <div class="container-body">
        <!-- menu section -->
        <aside class="left-menu" style="height: 100%;">
            <?php include('../../includes/back-side-nav.php'); ?>
        </aside>

        <div class="middle-side">
            <main class="ms-4">
                <!-- Back button -->
                <div class="back-button-container mt-1">
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

                <h1 class="mt-2">Order Management</h1>

                <!-- Filter by status -->
                <form method="GET" class="mb-3">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="status" class="col-form-label fw-bold">Filter by Status:</label>
                        </div>
                        <div class="col-auto">
                            <select name="status" id="status" class="form-select">
                                <option value="">All Orders</option>
                                <option value="Pending" <?= $status_filter == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Processing" <?= $status_filter == 'Processing' ? 'selected' : '' ?>>Processing</option>
                                <option value="Ready for Delivery" <?= $status_filter == 'Ready for Delivery' ? 'selected' : '' ?>>Ready for Delivery</option>
                                <option value="Complete" <?= $status_filter == 'Complete' ? 'selected' : '' ?>>Complete</option>
                                <option value="Cancelled" <?= $status_filter == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                        </div>

                        <!-- Customer search -->
                        <div class="col-auto d-flex">
                            <label for="status" class="col-form-label fw-bold">Search:</label>
                            <input type="text" name="search_customer" class="col-10 col-form-label py-2" placeholder="Search by Customer Name" value="<?= htmlspecialchars($search_customer) ?>">
                        </div>

                        <div class="col-auto d-flex">
                            <button type="submit" class="btn btn-primary ms-5">Apply</button>
                            <a href="order-manage.php" class="btn btn-secondary ms-3">Reset</a>
                        </div>
                    </div>
                </form>

                <!-- Result message -->
                <?php
                if (!empty($search_customer)) {
                    echo "<h5 class='text-success text-center' >serching results for : <strong class='text-danger' >" . htmlspecialchars($search_customer) . "</strong></h5>";
                }
                ?>

                <!-- Orders Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th>Order Details</th>
                            <th>Total Price</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $result = mysqli_query($con, $get_itemDetails);

                        // Check query success
                        if (!$result) {
                            die("Query Failed: " . mysqli_error($con));
                        }

                        $row_count = mysqli_num_rows($result);


                        if ($row_count == 0) {
                            echo "<tr><td colspan='11' class='text-center'>No orders found.</td></tr>";
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['order_id'] . "</td>";
                                echo "<td>" . $row['order_date'] . "</td>";
                                echo "<td>" . $row['order_fname'] . " " . $row['order_lname'] . "</td>";
                                echo "<td>" . $row['order_details'] . "</td>";
                                echo "<td>" . $row['order_total'] . "</td>";
                                echo "<td>" . $row['order_payment_option'] . "</td>";
                                echo "<td>" . $row['order_status'] . "</td>";

                                $invisible = ($row['order_status'] == 'Complete' || $row['order_status'] == 'Cancelled') ? 'invisible' : '';
                                $invisiblecancle = ($row['order_status'] == 'Complete' || $row['order_status'] == 'Ready for Delivery' || $row['order_status'] == 'Cancelled') ? 'invisible' : '';

                                echo "<td class='action-links'>
                            <a href='order-view.php?orderId=" . $row['order_id'] . "' class='view'>View</a>
                            <a href='update-order.php?orderId=" . $row['order_id'] . "' class='$invisible update'>Status</a>
                            <a href='order-manage.php?canclellID=" . $row['order_id'] . "' class='$invisiblecancle deactivate'>Cancel</a></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="copyr fixed-bottom">
        <div class="container">
            <div class="row col-12 pt-3">
                <p class="copy-right">Copyright &COPY; 2024 MD-Style Haven SHOP |
                    Develop by - <a href="#">Malindu</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
mysqli_close($con);
?>
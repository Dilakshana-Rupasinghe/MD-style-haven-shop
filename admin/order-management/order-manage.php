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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <aside class="left-menu" style="height: fit-content;">
            <?php include('../../includes/back-side-nav.php'); ?>
        </aside>

        <div class="middle-side">
            <main class="ms-4">
                <!-- Back button -->
                <div class="back-button-container mt-1">
                    <a href="../home pages/admin-home.php" class="back-button">Back</a>
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
                        if ($row_count == 0) {
                            echo "<tr><td colspan='8' class='text-center text-danger'>No orders found.</td></tr>";
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
                                    <td>$order_id</td>
                                    <td>$order_date</td>
                                    <td>$customer</td>
                                    <td>$order_details</td>
                                    <td>$order_total</td>
                                    <td>$order_payment_option</td>
                                    <td>$order_status</td>
                                    <td class='action-links'>
                                        <a href='order-view.php?orderId=$order_id' class='view'>View</a> 
                                        <a href='update-order.php?orderId=$order_id' class='update'>Status</a>
                                        <a href='#' class='deactivate'>Cancel</a>
                                    </td>
                                </tr>";
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
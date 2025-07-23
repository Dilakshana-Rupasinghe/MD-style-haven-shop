<?php
session_start();

// Redirect user to login if not logged into the system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}

// Include the database configuration file
include('../../database/config.php');

// Handle filter and search
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$search_customer = isset($_GET['search_customer']) ? trim($_GET['search_customer']) : '';

// Build query based on filters
if (!empty($status_filter) && !empty($search_customer)) {
    $get_itemDetails = "SELECT c.*, cu.cust_fname, cu.cust_lname FROM customization c
                        JOIN customer cu ON c.fk_cust_id = cu.cust_id
                        WHERE c.customize_status = '$status_filter' 
                        AND CONCAT(cu.cust_fname, ' ', cu.cust_lname) LIKE '%$search_customer%'
                        ORDER BY c.customize_status = 'Pending' DESC, c.customization_id DESC";
} elseif (!empty($status_filter)) {
    $get_itemDetails = "SELECT c.*, cu.cust_fname, cu.cust_lname FROM customization c
                        JOIN customer cu ON c.fk_cust_id = cu.cust_id
                        WHERE c.customize_status = '$status_filter' 
                        ORDER BY c.customize_status = 'Pending' DESC, c.customization_id DESC";
} elseif (!empty($search_customer)) {
    $get_itemDetails = "SELECT c.*, cu.cust_fname, cu.cust_lname FROM customization c
                        JOIN customer cu ON c.fk_cust_id = cu.cust_id
                        WHERE CONCAT(cu.cust_fname, ' ', cu.cust_lname) LIKE '%$search_customer%'
                        ORDER BY c.customize_status = 'Pending' DESC, c.customization_id DESC";
} else {
    $get_itemDetails = "SELECT c.*, cu.cust_fname, cu.cust_lname FROM customization c
                        JOIN customer cu ON c.fk_cust_id = cu.cust_id
                        ORDER BY c.customize_status = 'Pending' DESC, c.customization_id DESC";
}

// Run the query
$result = mysqli_query($con, $get_itemDetails);
$row_count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customization management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts & Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">
    <link rel="stylesheet" href="../../css/manage-button-1.css">
</head>

<body>
    <?php include('../../includes/admin-navigation.php'); ?>
    <div class="container-body">
        <!-- Sidebar -->
        <aside class="left-menu" style="height: fit-content;">
            <?php include('../../includes/back-side-nav.php'); ?>
        </aside>

        <!-- Main Content -->
        <div class="middle-side">
            <main class="ms-4">
                <div class="back-button-container mt-1">
                    <a href="../home pages/admin-home.php" class="back-button">Back</a>
                </div>

                <h1 class="mt-2">Order Management</h1>

                <!-- Filter Form -->
                <form method="GET" class="mb-3">
                    <div class="row g-3 align-items-center">
                        <!-- Status Dropdown -->
                        <div class="col-auto">
                            <label for="status" class="col-form-label fw-bold">Filter by Status:</label>
                        </div>
                        <div class="col-auto">
                            <select name="status" id="status" class="form-select">
                                <option value="">All Orders</option>
                                <option value="Pending" <?= $status_filter == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Processing" <?= $status_filter == 'Processing' ? 'selected' : '' ?>>Processing</option>
                                <option value="Ready for Fiton" <?= $status_filter == 'Ready for Fiton' ? 'selected' : '' ?>>Ready for Fiton</option>
                                <option value="Complete" <?= $status_filter == 'Complete' ? 'selected' : '' ?>>Complete</option>
                            </select>
                        </div>

                        <!-- Customer Search -->
                        <div class="col-auto d-flex">
                            <label for="status" class="col-form-label fw-bold">Search:</label>
                            <input type="text" name="search_customer" class="col-10 col-form-label py-2" placeholder="Search by customer name" value="<?= htmlspecialchars($search_customer) ?>">
                        </div>

                        <div class="col-auto d-flex">
                            <button type="submit" class="btn btn-primary ms-5">Apply</button>
                            <a href="customization-management.php" class="btn btn-secondary ms-3">Reset</a>
                        </div>
                    </div>
                </form>

                <?php
                if (!empty($search_customer)) {
                    echo "<h5 class='text-success text-center'>Searching results for: <strong class='text-danger'>" . htmlspecialchars($search_customer) . "</strong></h5>";
                }
                ?>

                <!-- <h2 class="text-center">Order Details</h2> -->

                <!-- Order Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Custom ID</th>
                            <th>Order Date</th>
                            <th>Customer ID</th>
                            <th>Customer</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Advance Pay</th>
                            <th>Pickup/Fiton</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($row_count == 0) {
                            echo "<tr><td colspan='11' class='text-center text-danger'>No records found</td></tr>";
                        } else {
                            while ($row_data = mysqli_fetch_assoc($result)) {
                                $customization_id = $row_data['customization_id'];
                                $customization_date = $row_data['customization_date'];
                                $fk_cust_id = $row_data['fk_cust_id'];
                                $Cloth_type = $row_data['Cloth_type'];
                                $cust_qty = $row_data['cust_qty'];
                                $total_price = $row_data['total_price'];
                                $advance_pay_amount = $row_data['advance_pay_amount'];
                                $pickup_date = $row_data['pickup_date'];
                                $customize_status = $row_data['customize_status'];

                                // Get customer name
                                $get_customer = "SELECT * FROM customer WHERE cust_id = $fk_cust_id";
                                $customerResult = mysqli_query($con, $get_customer);
                                $customer_data = mysqli_fetch_assoc($customerResult);
                                $customer = $customer_data['cust_fname'] . ' ' . $customer_data['cust_lname'];

                                // check the order complete or not
                                if ($customize_status == 'Complete' ) {
                                    $status = "Deactive";
                                    $invisible = "invisible";
                                } else {
                                    $status = "Active";
                                    $invisible = "";
                                }

                                echo "
                                    <tr>
                                        <td>$customization_id</td>
                                        <td>$customization_date</td>
                                        <td>$fk_cust_id</td>
                                        <td>$customer</td>
                                        <td>$Cloth_type</td>
                                        <td>$cust_qty</td>
                                        <td>$total_price</td>
                                        <td>$advance_pay_amount</td>
                                        <td>$pickup_date</td>
                                        <td>$customize_status</td>
                                        <td class='action-links'>
                                            <a href='cutomize-view.php?customizationId=$customization_id' class='view'>View</a> 
                                            <a href='update-customize.php?customizationId=$customization_id' class='$invisible update'>Status</a>
                                            <a href='#' class='$invisible deactivate'>Cancel</a>
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
                    Developed by - <a href="#">Malindu</a></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Close DB connection
mysqli_close($con);
?>
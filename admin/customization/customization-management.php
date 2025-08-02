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


if (!$result) {
    die("Query Error: " . mysqli_error($con));
}


if (isset($_GET['canclellID'])) {
    $customization_id = $_GET['canclellID'];

    $GetDetails = "SELECT * FROM customization WHERE customization_id = $customization_id";
    $result = mysqli_query($con, $GetDetails);
    $row_data = mysqli_fetch_assoc($result);
    $status = $row_data['customize_status'];

    // Correct conditional check
    if ($status !== 'Complete' || $status !== 'Ready for fits on' || $status !== 'Cancelled') {
        $UpdateStatus = "UPDATE customization SET customize_status = 'Cancelled' WHERE customization_id = $customization_id";
        mysqli_query($con, $UpdateStatus);

        $updatePayment = "UPDATE payment SET payment_status = 'Cancelled Downpayment' WHERE fk_customization_id = $customization_id";
        mysqli_query($con, $updatePayment);

        echo "<script>alert('Order cancelled successfully!');</script>";
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
    <!-- Material icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

</head>

<body>
    <?php include('../../includes/admin-navigation.php'); ?>
    <div class="container-body">
        <!-- Sidebar -->
        <aside class="left-menu" style="height: 100%;">
            <?php include('../../includes/back-side-nav.php'); ?>
        </aside>

        <!-- Main Content -->
        <div class="middle-side">
            <main class="ms-4">
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



                <h1 class="mt-2">Customize Order Management</h1>

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
                                <option value="Ready for fits on" <?= $status_filter == 'Ready for fits on' ? 'selected' : '' ?>>Ready for fits on</option>
                                <option value="Complete" <?= $status_filter == 'Complete' ? 'selected' : '' ?>>Complete</option>
                                <option value="Cancelled" <?= $status_filter == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
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
                        $result = mysqli_query($con, $get_itemDetails);

                        // Check query success
                        if (!$result) {
                            die("Query Failed: " . mysqli_error($con));
                        }

                        $row_count = mysqli_num_rows($result);


                        if ($row_count == 0) {
                            echo "<tr><td colspan='11' class='text-center'>No customization requests found.</td></tr>";
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['customization_id'] . "</td>";
                                echo "<td>" . $row['customization_date'] . "</td>";
                                echo "<td>" . $row['cust_fname'] . " " . $row['cust_lname'] . "</td>";
                                echo "<td>" . $row['Cloth_type'] . "</td>";
                                echo "<td>" . $row['cust_qty'] . "</td>";
                                echo "<td>" . $row['total_price'] . "</td>";
                                echo "<td>" . $row['advance_pay_amount'] . "</td>";
                                echo "<td>" . $row['pickup_date'] . "</td>";
                                echo "<td>" . $row['customize_status'] . "</td>";

                                $invisible = ($row['customize_status'] == 'Complete' || $row['customize_status'] == 'Cancelled') ? 'invisible' : '';
                                $invisiblecancle = ($row['customize_status'] == 'Complete' || $row['customize_status'] == 'Ready for fits on'|| $row['customize_status'] == 'Cancelled') ? 'invisible' : '';


                                echo "<td class='action-links'>
                            <a href='cutomize-view.php?customizationId=" . $row['customization_id'] . "' class='view'>View</a>
                            <a href='update-customize.php?customizationId=" . $row['customization_id'] . "' class='$invisible update'>Status</a>
                            <a href='customization-management.php?canclellID=" . $row['customization_id'] . "'' class='$invisiblecancle deactivate'>Cancel</a></td>";
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
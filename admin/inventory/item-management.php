<?php
session_start();

// rederect user to the login if user not logingtothe system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}
// include the database configaration file
include('../../database/config.php');


//check delete button is clicked
if (isset($_GET['itemId'])) { //get item detail from item id
    $item_id = $_GET['itemId'];

    $item_deleteQuery = "DELETE FROM item WHERE item_id = $item_id"; //detelet queiry

    if (mysqli_query($con, $item_deleteQuery)) {
        echo "<script>alert('Item is deleted successfully');</script>";
    }
}

// Handle search input
$search_input = '';
if (isset($_GET['search_input'])) {
    $search_input = trim(mysqli_real_escape_string($con, $_GET['search_input']));
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item management</title>
    <!-- CSS Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/manage-button.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
</head>

<body>
    <?php include('../../includes/admin-navigation.php'); ?>

    <div class="container-body">
        <!-- Side Navigation -->
        <aside class="left-menu" style="height: fit-content;">
            <?php include('../../includes/back-side-nav.php'); ?>
        </aside>

        <div class="middle-side">
            <main class="ms-4">
                <!-- Action Buttons -->
                <div class="back-button-container mt-1">
                    <div class="date ms-4" style="line-height: 2rem;"></div>
                    <a href="add-item.php" class="manage-item-button" style="font-size: 16px; padding:11px 22px">
                        Add Item
                        <span class="material-symbols-outlined" style="font-size:20px; padding-left: 7px;">list_alt_add</span>
                    </a>
                    <a href="inventory-management.php" class="back-button">Back</a>
                </div>

                <h1>Item Management</h1>

                <!-- Search Form -->
                <form method="GET" class="mb-3">
                    <div class="row g-5 align-items-center">
                        <div class="col-auto d-flex">
                            <label for="search_input" class="col-form-label fw-bold">Search:</label>
                            <input type="text" name="search_input" class="col-12 col-form-label py-2 ms-2" placeholder="Search by Category or Item ID" value="<?= htmlspecialchars($search_input) ?>">
                        </div>
                        <div class="col-auto d-flex">
                            <button type="submit" class="btn btn-primary ms-4">Apply</button>
                            <a href="item-management.php" class="btn btn-secondary ms-3">Reset</a>
                        </div>
                    </div>
                </form>

                <!-- Search Result Message -->
                <?php if (!empty($search_input)) {
                    echo "<h5 class='text-success text-center'>Searching results for: <strong class='text-danger'>" . htmlspecialchars($search_input) . "</strong></h5>";
                } ?>

                <h2 class="text-center">Item Details</h2>

                <table>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Material</th>
                        <th>Sell Price</th>
                        <th>Discount</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    // SQL query to fetch items
                    $get_itemDetails = "SELECT item_id, item_name, category_name, item_brand, item_material, item_sell_price, item_discount, item_stock_qty 
                                        FROM item 
                                        INNER JOIN category ON item.fk_category_id = category.category_id";

                    if (!empty($search_input)) {
                        if (is_numeric($search_input)) {
                            // Search by item ID
                            $get_itemDetails .= " WHERE item.item_id = $search_input";
                        } else {
                            // Search by category name
                            $get_itemDetails .= " WHERE category_name LIKE '%$search_input%'";
                        }
                    }

                    $result = mysqli_query($con, $get_itemDetails);
                    $row_count = mysqli_num_rows($result);

                    if ($row_count == 0) {
                        echo "<tr><td colspan='9' class='text-center text-danger py-4'>No items found.</td></tr>";
                    } else {
                        while ($row_data = mysqli_fetch_assoc($result)) {
                            $item_id = $row_data['item_id'];
                            $item_name = $row_data['item_name'];
                            $category_name = $row_data['category_name'];
                            $item_brand = $row_data['item_brand'];
                            $item_material = $row_data['item_material'];
                            $item_sell_price = $row_data['item_sell_price'];
                            $item_discount = $row_data['item_discount'];
                            $item_stock_qty = $row_data['item_stock_qty'];

                            echo "
                            <tr>
                                <td>$item_id</td>
                                <td>$item_name</td>
                                <td>$category_name</td>
                                <td>$item_brand</td>
                                <td>$item_material</td>
                                <td>$item_sell_price</td>
                                <td>$item_discount</td>
                                <td>$item_stock_qty</td>
                                <td class='action-links'>
                                    <a href='item-view.php?itemId=$item_id' class='view'>View</a>
                                    <a href='update-item.php?itemId=$item_id' class='update'>Update</a>
                                    <a href='item-management.php?itemId=$item_id' class='deactivate' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </table>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="copyr fixed-bottom">
        <div class="container">
            <div class="row col-12 pt-3">
                <p class="copy-right">Copyright &COPY; 2024 MD-Style Haven SHOP | Develop by -
                    <a href="#"> Malindu </a>
                </p>
            </div>
        </div>
    </footer>

    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../script/strockchart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
mysqli_close($con);
?>

<?php
session_start();

// redirect user to login if not logged in
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}

include('../../database/config.php');

// Add or update cost
if (isset($_POST['costAdd'])) {
    $costname = $_POST['costname'];
    $costprice = $_POST['costprice'];
    $is_percentage = $_POST['is_percentage'];
    $percentage_rate = $_POST['percentage_rate'];
    $costId = $_POST['costId'] ?? '';

    if ($costname != '') {
        if ($costId != '') {
            // Update existing cost
            $updateQuery = "UPDATE additional_cost 
                            SET cost_type = '$costname', amount = '$costprice', is_percentage = '$is_percentage', percentage_rate = '$percentage_rate' 
                            WHERE cost_id = $costId";
            if (mysqli_query($con, $updateQuery)) {
                echo "<script>alert('Cost updated successfully'); window.location.href='parameeter-management.php';</script>";
            }
        } else {
            // Insert new cost
            $costSelectQuery = "SELECT * FROM additional_cost WHERE cost_type = '$costname'";
            $result = mysqli_query($con, $costSelectQuery);
            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('{$costname} already exists');</script>";
            } else {
                $insertQuery = "INSERT INTO additional_cost (cost_type, amount, is_percentage, percentage_rate)
                                VALUES ('$costname', '$costprice', '$is_percentage', '$percentage_rate')";
                if (mysqli_query($con, $insertQuery)) {
                    echo "<script>alert('New cost details added successfully'); window.location.href='parameeter-management.php';</script>";
                } else {
                    echo 'Insert Error';
                }
            }
        }
    }
}

// Delete cost
if (isset($_GET['costId'])) {
    $costId = $_GET['costId'];
    $deleteQuery = "DELETE FROM additional_cost WHERE cost_id = $costId";
    if (mysqli_query($con, $deleteQuery)) {
        echo "<script>alert('Cost type deleted successfully'); window.location.href='parameeter-management.php';</script>";
    }
}

// Load cost data for editing
$edit_data = ['cost_id' => '', 'cost_type' => '', 'amount' => '', 'is_percentage' => '0', 'percentage_rate' => ''];
if (isset($_GET['editId'])) {
    $editId = $_GET['editId'];
    $getQuery = "SELECT * FROM additional_cost WHERE cost_id = $editId";
    $result = mysqli_query($con, $getQuery);
    if ($result && mysqli_num_rows($result) > 0) {
        $edit_data = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cost Management</title>
  <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">
    <link rel="stylesheet" href="../../css/manage-button1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>

<?php include('../../includes/admin-navigation.php'); ?>

<div class="container-body">
    <aside class="left-menu" style="height: 100%;">
        <?php include('../../includes/back-side-nav.php'); ?>
    </aside>

    <div class="middle-side">
        <main class="ms-4">
            <div class="back-button-container mt-1">
                <a href="cost-manage.php" class="back-button">Back</a>
            </div>

            <h1>Cost Management - Add/Update Parameter Type</h1>

            <div class="edit" style="margin-top: 3rem; width: 69rem">
                <div class="change col-8" style="height: fit-content; width: 22rem">
                    <h3 class="text-center">
                        <?php echo ($edit_data['cost_id']) ? "Update Cost Parameter" : "Add New Additional Cost"; ?>
                    </h3>

                    <form action="#" method="post" id="categoryAddForm">
                        <input type="hidden" name="costId" value="<?php echo $edit_data['cost_id']; ?>">

                        <div>
                            <label for="costname">Cost Name/Type</label> <br>
                            <input type="text" id="costname" name="costname" required value="<?php echo $edit_data['cost_type']; ?>">
                        </div>

                        <div>
                            <label for="costprice">Cost Price</label> <br>
                            <input type="number" id="costprice" name="costprice" value="<?php echo $edit_data['amount']; ?>">
                        </div>

                        <div>
                            <label for="is_percentage">Is Percentage Based:</label>
                            <select id="is_percentage" name="is_percentage" class="bg-white col-4">
                                <option value="0" <?php echo ($edit_data['is_percentage'] == '0') ? 'selected' : ''; ?>>No</option>
                                <option value="1" <?php echo ($edit_data['is_percentage'] == '1') ? 'selected' : ''; ?>>Yes</option>
                            </select>
                        </div>

                        <div>
                            <label for="percentage_rate">Percentage Rate:</label>
                            <input type="number" id="percentage_rate" name="percentage_rate" step="0.01" placeholder="e.g., 5.00" value="<?php echo $edit_data['percentage_rate']; ?>">
                        </div>

                        <div style="margin:10px 40px;">
                            <button type="submit" name="costAdd" id="update">
                                <?php echo ($edit_data['cost_id']) ? "Update" : "Add"; ?>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Table of existing costs -->
                <div>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Cost Type</th>
                            <th>Amount</th>
                            <th>Is Percentage</th>
                            <th>Percentage Rate</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        $get_costDetail = "SELECT * FROM additional_cost";
                        $result = mysqli_query($con, $get_costDetail);

                        if (mysqli_num_rows($result) == 0) {
                            echo "<tr><td colspan='6' class='text-center text-danger'>No cost records found.</td></tr>";
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $status = $row['is_percentage'] == 1 ? 'Yes' : 'No';

                                echo "<tr>
                                    <td>{$row['cost_id']}</td>
                                    <td>{$row['cost_type']}</td>
                                    <td>{$row['amount']}</td>
                                    <td>$status</td>
                                    <td>{$row['percentage_rate']}</td>
                                    <td class='action-links'>
                                        <a href='parameeter-management.php?editId={$row['cost_id']}' class='update'>Edit</a>
                                        <a href='parameeter-management.php?costId={$row['cost_id']}' class='deactivate' onclick=\"return confirm('Are you sure to delete this?')\">Delete</a>
                                    </td>
                                </tr>";
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Footer -->
<div>
    <footer class="copyr fixed-bottom">
        <div class="container">
            <div class="row col-12 pt-3">
                <p class="copy-right">Copyright &COPY; 2024 MD-Style Haven SHOP |
                    Develop by - <a href="#">Malindu</a>
                </p>
            </div>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../../script/categorychart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php mysqli_close($con); ?>

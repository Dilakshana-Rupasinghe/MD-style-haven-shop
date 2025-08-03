<?php
session_start();

// Redirect user to login if not logged in
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}

// Include DB config
include('../../database/config.php');

// Add or Update parameter
if (isset($_POST['parameeterAdd'])) {
    $paratype = $_POST['paratype'];
    $paraname = $_POST['paraname'];
    $price = $_POST['price'];
    $paraid = isset($_POST['paraid']) ? $_POST['paraid'] : '';

    if ($paraname != '' && $paratype != '' && $price != '') {
        if ($paraid != '') {
            // Update existing parameter
            $updateQuery = "UPDATE cost_parameter SET para_type = '$paratype', para_name = '$paraname', para_cost = '$price' WHERE para_id = $paraid";
            if (mysqli_query($con, $updateQuery)) {
                echo "<script>alert('Parameter updated successfully'); window.location.href='cost-manage.php';</script>";
            }
        } else {
            // Insert new parameter
            $checkQuery = "SELECT * FROM cost_parameter WHERE para_name = '$paraname'";
            $result = mysqli_query($con, $checkQuery);
            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('{$paraname} already exists'); window.location.href='cost-manage.php';</script>";
            } else {
                $insertQuery = "INSERT INTO cost_parameter (para_type, para_name, para_cost) VALUES ('$paratype', '$paraname', '$price')";
                if (mysqli_query($con, $insertQuery)) {
                    echo "<script>alert('New parameter added successfully'); window.location.href='cost-manage.php';</script>";
                }
            }
        }
    }
}

// Delete parameter
if (isset($_GET['paraId'])) {
    $paraId = $_GET['paraId'];
    $deleteQuery = "DELETE FROM cost_parameter WHERE para_id = $paraId";
    if (mysqli_query($con, $deleteQuery)) {
        echo "<script>alert('Parameter deleted successfully'); window.location.href='cost-manage.php';</script>";
    }
}

// Load data for editing
$edit_data = ['para_id' => '', 'para_type' => '', 'para_name' => '', 'para_cost' => ''];
if (isset($_GET['editId'])) {
    $editId = $_GET['editId'];
    $getQuery = "SELECT * FROM cost_parameter WHERE para_id = $editId";
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
    <title>Admin: Manage Customization Costs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">
    <link rel="stylesheet" href="../../css/manage-button1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>

<?php include('../../includes/admin-navigation.php'); ?>

<div class="container-body">
    <aside class="left-menu" style="height: 100%;">
        <?php include('../../includes/back-side-nav.php'); ?>
    </aside>

    <div class="middle-side">
        <main class="ms-4">
            <!-- Back & manage buttons -->
            <div class="back-button-container mt-1">
                <a href="parameeter-management.php" class="manage-fabric-button">
                    Manage parameter type
                    <span class="material-symbols-outlined" style="font-size:18px; padding-left: 7px;">request_quote</span>
                </a>
                <?php
                $invisible = ($_SESSION['staffId'] != 1001) ? 'invisible' : '';
                $logged_in_staff_id = $_SESSION['fk_staff_type_id'] ?? null;
                if ($logged_in_staff_id == 1001) {
                    echo '<a href="../home pages/admin-home.php" class="back-button">Back</a>';
                } else {
                    echo '<a href="#" class="' . $invisible . ' back-button disabled" style="pointer-events: none; opacity: 0.5;">Back</a>';
                }
                ?>
            </div>

            <h1>Cost Management</h1>

            <!-- Form to add/update parameter -->
            <div class="edit mt-5" style="width: 68rem">
                <div class="change col-8" style="width: 68rem">
                    <h3 class="text-center">
                        <?php echo ($edit_data['para_id'] != '') ? 'Update Parameter' : 'Add New Parameter'; ?>
                    </h3>

                    <form action="#" method="post" class="d-flex">
                        <input type="hidden" name="paraid" value="<?php echo $edit_data['para_id']; ?>">

                        <div class="col-2.5">
                            <label for="paratype">Parameter Type</label> <br>
                            <input type="text" id="paratype" name="paratype" required value="<?php echo $edit_data['para_type']; ?>">
                        </div>

                        <div class="col-2.5 ms-4">
                            <label for="paraname">Parameter Name</label> <br>
                            <input type="text" id="paraname" name="paraname" required value="<?php echo $edit_data['para_name']; ?>">
                        </div>

                        <div class="col-2.5 ms-4">
                            <label for="price">Price</label> <br>
                            <input type="number" id="price" name="price" required value="<?php echo $edit_data['para_cost']; ?>">
                        </div>

                        <div class="col-2" style="margin:30px 57px;">
                            <button type="submit" name="parameeterAdd" id="update">
                                <?php echo ($edit_data['para_id'] != '') ? 'Update' : 'Add'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Parameter table -->
            <div>
                <table>
                    <tr>
                        <th>Parameter ID</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Cost</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $get_paraDetail = "SELECT * FROM cost_parameter";
                    $result = mysqli_query($con, $get_paraDetail);

                    if (mysqli_num_rows($result) == 0) {
                        echo "<tr><td colspan='5' class='text-center bg-danger text-white'>No parameter records yet.</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['para_id']}</td>
                                <td>{$row['para_type']}</td>
                                <td>{$row['para_name']}</td>
                                <td>{$row['para_cost']}</td>
                                <td class='action-links'>
                                    <a href='cost-manage.php?editId={$row['para_id']}' class='update'>Update</a>
                                    <a href='cost-manage.php?paraId={$row['para_id']}' class='deactivate' onclick=\"return confirm('Are you sure you want to delete this parameter?')\">Delete</a>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Footer -->
<div>
    <footer class="copyr fixed-bottom">
        <div class="container">
            <div class="row col-12 pt-2">
                <p class="copy-right">Copyright &COPY; 2024 MD-Style Haven SHOP | Develop by - 
                    <a href="#">Malindu</a>
                </p>
            </div>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../../script/categorychart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
mysqli_close($con);
?>

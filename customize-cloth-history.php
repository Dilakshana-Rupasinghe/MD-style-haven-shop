<?php
session_start();

if (!isset($_SESSION['custId'])) {
    $custId = $_SESSION['custId'];
    echo "<script>window.open('Login.php', '_self');</script>";
    exit();
}

//database connection
include('database/config.php');



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize order history - MD Style Haven</title>
    <!-- material icons css link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- <link rel="stylesheet" href="css/home.css"> -->
    <link rel="stylesheet" href="css/home-all-style.css">
</head>

<body>
    <!-- navigation bar start -->
    <?php
    include('includes/navbar.php');
    ?>

    <h3 class="text-center my-3">CUSTOMIZATION HISTORY</h3>

    <?php
    if (isset($_SESSION['custId'])) {
        $custId = $_SESSION['custId'];

        $dataSelectQary = "SELECT * FROM customization WHERE fk_cust_id =  $custId ";
        $result = mysqli_query($con, $dataSelectQary);

        $row_count = mysqli_num_rows($result);

        if ($row_count > 0) {

    ?>

            <div class="px-3">
                <table class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Placeorder Date</th>
                            <th>Cloth Type</th>
                            <th>Measurement</th>
                            <th>Fabric</th>
                            <th>Neck Type</th>
                            <th>QTY</th>
                            <th>Total Price</th>
                            <th>Advance Payment</th>
                            <th>Remaining Balance</th>
                            <th>Pickup Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row_data = mysqli_fetch_assoc($result)) {
                            $orderdate = $row_data['customization_date'];
                            $clothtype = $row_data['Cloth_type'];
                            $measurement = $row_data['measurement'];
                            $fabric = $row_data['fabric'];
                            $neck_type = $row_data['neck_type'];
                            $qty = (int)$row_data['cust_qty'];
                            $totalprice = (float)$row_data['total_price'];
                            $advance = (float)$row_data['advance_pay_amount'];
                            $balance = (float)$row_data['balance'];
                            $pickupdate = $row_data['pickup_date'];
                            $status = $row_data['customize_status'];


                        ?>
                            <tr>
                                <td>
                                    <?php echo $orderdate; ?>
                                </td>
                                <td>
                                    <?php echo $clothtype; ?>
                                </td>
                                <td>
                                    <?php echo $measurement; ?>
                                </td>
                                <td>
                                    <?php echo $fabric; ?>
                                </td>
                                <td>
                                    <?php echo $neck_type; ?>
                                </td>
                                <td>
                                    <?php echo $qty; ?>
                                </td>
                                <td>
                                    <?= number_format($totalprice, 2); ?>
                                </td>
                                <td>
                                    <?= number_format($advance, 2); ?>
                                </td>
                                <td>
                                    <?= number_format($balance, 2); ?>
                                </td>
                                <td>
                                    <?php echo $pickupdate; ?>
                                </td>
                                <td>
                                    <?php echo $status; ?>
                                </td>
                                <td>

                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>

        <?php
        }else {
            echo "<h2 class='bg-danger text-center m-5 py-2 '> Not any customization yet </h2>";
    } 
    } ?>

            </div>
            <!-- footer section -->
            <?php
            include('includes/footer.php');
            ?>
            <!-- footer end -->

</body>

</html>

<!-- close the DB connection -->
<?php
mysqli_close($con);
?>
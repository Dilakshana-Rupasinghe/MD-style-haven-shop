<?php
session_start();

if (!isset($_SESSION['custId'])) {
    $custId = $_SESSION['custId'];
    echo "<script>window.open('Login.php', '_self');</script>";
    exit();
}

// Include the database configuration file
include('database/config.php');

$balance = 0;

if (isset($_POST['okay_btn'])) {
    // reverse session data witch is sending customize-cloth.php
    $clothingTypename = isset($_SESSION['clothingTypename']) ? $_SESSION['clothingTypename'] : 'No value';
    $fabricTypename = isset($_SESSION['fabricTypename']) ? $_SESSION['fabricTypename'] : 'No value';
    $neckTypename = isset($_SESSION['neckTypename']) ? $_SESSION['neckTypename'] : 'No value';
    $sizeValve = isset($_SESSION['size']) ? $_SESSION['size'] : 'NO value';
    $quantity = isset($_SESSION['quantity']) ? $_SESSION['quantity'] : 'NO value';
    $totalCost = isset($_SESSION['totalCost']) ? $_SESSION['totalCost'] : 'NO value';
    $downPayment = isset($_SESSION['downpayment']) ? $_SESSION['downpayment'] : 0;
    $balance = isset($_SESSION['balance']) ?  $_SESSION['balance']  : 0;
    $logo = isset($_SESSION['logo']) ?  $_SESSION['logo']  : 'No value';
    $image = isset($_SESSION['image']) ?   $_SESSION['image']  : 'No value';
    $additionalText = isset($_SESSION['additionalText']) ?   $_SESSION['additionalText']  : 'No value';
    $ideadetails = isset($_SESSION['ideadetails']) ?   $_SESSION['ideadetails']  : 'No value';
    $dateRequired = isset($_SESSION['dateRequired']) ?   $_SESSION['dateRequired']  : 'No value';
    $custId = isset($_SESSION['custId']) ?   $_SESSION['custId']  : "no input";

    // //send data to database table which is customization
    $orderInsertQuary = "INSERT INTO `customization`(Cloth_type, measurement, neck_type, fabric, logo, image_design, cust_qty, customization_date, customization_text, total_price, advance_pay_amount, balance, comment, customize_status, pickup_date, fk_cust_id)
    VALUES ('$clothingTypename', '$sizeValve ', '$neckTypename', '$fabricTypename', '$logo', '$image', '$quantity', NOW(), '$additionalText', '$totalCost', ' $downPayment', '$balance ', '$ideadetails', 'Pending', '$dateRequired ', $custId)";

    $result = mysqli_query($con, $orderInsertQuary);
    echo "<script>window.open('customize-cloth.php', '_self');</script>";

} 


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <form method="POST" action="" class="col-8">
        <div class="container text-center">
            <div class="card shadow-lg p-4">
                <h1 class="text-success">🎉 Customization Order Successful!</h1>
                <p class="mt-3">Thank you for your order! We have received your details.</p>
                <div class="d-flex justify-content-center">
                    <button type="submit" id="okay-btn" name="okay_btn" class="btn btn-primary mt-4 col-3">Okay</button>
                </div>
            </div>
        </div>
    </form>



</body>

</html>
<!-- close the DB connection -->
<?php
mysqli_close($con);
?>
<?php
session_start();

if (!isset($_SESSION['custId'])) {
    $custId = $_SESSION['custId'];
    echo "<script>window.open('Login.php', '_self');</script>";
    exit();
}

// Include the database configuration file
include('database/config.php');

if (isset($_POST['okaybtn'])) {
    // reverse session data witch is sending checkout.php
    $firstName = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : "no input";
    $lastName = isset($_SESSION['lastName']) ? $_SESSION['lastName'] : "error";
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : "error";
    $district = isset($_SESSION['district']) ? $_SESSION['district'] : "error";
    $addressline1 = isset($_SESSION['address_line1']) ? $_SESSION['address_line1'] : "error";
    $addressline2 = isset($_SESSION['address_line2']) ? $_SESSION['address_line2'] : "error";
    $addressline3 = isset($_SESSION['address_line3']) ? $_SESSION['address_line3'] : "error";
    $city = isset($_SESSION['city']) ? $_SESSION['city'] : "error";
    $postalCode = isset($_SESSION['postalCode']) ? $_SESSION['postalCode'] : "error";
    $billingCompanyName = isset($_SESSION['billingCompanyName']) ? $_SESSION['billingCompanyName'] : "error";
    $phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : "error";
    $secondaryPhone = isset($_SESSION['secondaryPhone']) ? $_SESSION['secondaryPhone'] : "error";
    $paymentMethod = isset($_SESSION['paymentMethod']) ? $_SESSION['paymentMethod'] : "error";
    $Order_totle = isset($_SESSION['Order_totle']) ? $_SESSION['Order_totle'] : 0;
    $custId = isset($_SESSION['custId']) ?   $_SESSION['custId']  : "no input";

    //send data to database table which is order table 
    $orderInsertQuary = "INSERT INTO `order` (order_date, order_total, order_fname, order_lname, order_email, discrict, order_address_line1, order_address_line2, order_address_line3, city, postal_code, order_contact1, order_contact2,order_status, order_payment_option, fk_cust_id)
        VALUES (NOW(),'$Order_totle', '$firstName', '$lastName', '$email', '$district', '$addressline1', '$addressline2', '$addressline3', '$city', '$postalCode', '$phone', '$secondaryPhone','pending', '$paymentMethod', $custId)";

    $result = mysqli_query($con, $orderInsertQuary);

    if ($result) {
        // Retrieve purchased items and quantities
        $cartItemsQuery = "SELECT fk_item_id, item_qty FROM cart_item WHERE fk_cust_id = $custId";
        $cartItemsResult = mysqli_query($con, $cartItemsQuery);

        if ($cartItemsResult && mysqli_num_rows($cartItemsResult) > 0) {
            while ($row = mysqli_fetch_assoc($cartItemsResult)) {
                $itemId = $row['fk_item_id'];
                $purchasedQty = $row['item_qty'];

                // Update item stock quantity
                $updateStockQuery = "UPDATE item SET item_stock_qty = item_stock_qty - $purchasedQty WHERE item_id = $itemId";
                $updateStockResult = mysqli_query($con, $updateStockQuery);

                if (!$updateStockResult) {
                    echo "<script>alert('Error updating stock for item ID: $itemId');</script>";
                }
            }
        } else {
            echo "<script>alert('No items found in cart for this customer.');</script>";
        }

        // Delete cart items after stock update
        $cartDeleteQuery = "DELETE FROM cart_item WHERE fk_cust_id = $custId";
        $cartDeleteResult = mysqli_query($con, $cartDeleteQuery);

        if ($cartdltresult) {
        }

        // echo "<script>alert('order successful! ');</script>";
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('SQL error! ');</script>";
    }
}
// }
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
                <h1 class="text-success">🎉 Order Successful!</h1>
                <p class="mt-3">Thank you for your order! We have received your details.</p>
                <div class="d-flex justify-content-center">
                    <button type="submit" id="okay-btn" name="okaybtn" class="btn btn-primary mt-4 col-3">Okay</button>
                </div>
            </div>
        </div>
    </form>


    <script>
        document.getElementById("okay-btn").addEventListener("click", function() {
            window.location.href = "index.php"; // Redirect to home page or desired page
        });
    </script>
</body>

</html>
<!-- close the DB connection -->
<?php
mysqli_close($con);
?>
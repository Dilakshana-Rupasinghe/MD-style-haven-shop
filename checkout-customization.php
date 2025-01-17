<?php
session_start();
//database connection
include('database/config.php');

if(isset($_POST['customplaceorder'])){
    echo "<script>window.open('online-payment-customiz.php', '_self');</script>";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- material icons css link -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- <link rel="stylesheet" href="css/home-style.css"> -->
    <link rel="stylesheet" href="css/home-all-style.css">
    <link rel="stylesheet" href="css/back-style.css">

    <!-- stripe payment methos include link -->
    <script src="https://js.stripe.com/v3/"></script>

    <title>Checkout Customization</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
        .table-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 10vh; /* Makes sure it vertically centers within the viewport */
    }
    </style>
</head>

<body>
     <!-- navigation bar start -->
     <?php
    include('includes/navbar.php');
    ?>
    <!-- navigaton bar  end -->

    <h1 class="text-center p-3">Checkout Customization Summary</h1>

    <?php
            $quantity = '';
            $totalCost = 0;
            $downPayment = 0;
            $balance = 0;

    if (!isset($_SESSION['clothingTypename']) || !isset($_SESSION['totalCost'])) {
        echo "<h4 class= 'bg-danger text-center m-5 p-3'>No customization data found. Please complete your customization first.</h4>";
    } else {
        // Retrieve session data
        $clothingTypename = $_SESSION['clothingTypename'];
        $clothingTypenamecost = $_SESSION['clothingTypenamecost'];
        $fabricTypename = $_SESSION['fabricTypename'];
        $fabricTypenamecost = isset($_SESSION['fabricTypenamecost']) ? $_SESSION['fabricTypenamecost'] :0;
        $neckTypename = $_SESSION['neckTypename'];
        $neckTypecost = isset($_SESSION['neckTypecost']) ? $_SESSION['neckTypecost'] :0;
        $sizeOption = $_SESSION['sizeOption'];
        $sizeValve = isset($_SESSION['size']) ? $_SESSION['size'] : 'NO value';
        $fitStyle = $_SESSION['fitStyle'];
        $quantity = $_SESSION['quantity'];
        $totalCost = $_SESSION['totalCost'];
        $downPayment = isset($_SESSION['downpayment']) ? $_SESSION['downpayment'] :0;
        $balance = $totalCost- $downPayment; // Assuming advance payment is 30% if not passed
        $logocost = isset($_SESSION['logocost']) ?   $_SESSION['logocost']  : 0;
        $imagecost = isset($_SESSION['imagecost']) ?  $_SESSION['imagecost']  : 0;
        $additionalTextcost = isset($_SESSION['additionalTextcost']) ?  $_SESSION['additionalTextcost']  : 0;

        // Display customization details in a table
        echo "
        <div class='table-container'>
        <table class= 'col-10'>
            <thead>
                <tr>
                    <th>Customization Item</th>
                    <th>Cost (LKR)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Clothing Type: $clothingTypename</td>
                    <td>LKR " . number_format($clothingTypenamecost, 2) . "</td>
                </tr>
                <tr>
                    <td>Fabric Type: $fabricTypename</td>
                    <td>LKR " . number_format($fabricTypenamecost, 2) . "</td>
                </tr>
                <tr>
                    <td>Nek Type: $neckTypename</td>
                    <td>LKR " . number_format($neckTypecost, 2) . "</td>
                    </tr>
                    <tr>
                    <tr>
                    <td>Size Option: $sizeOption</td>
                    <td> $sizeValve </td>
                    </tr>
                    <tr>
                    <td>Logo</td>
                    <td>LKR " . number_format($logocost, 2) . "</td>
                    </tr>
                    <tr>
                    <td>Image</td>
                    <td>LKR " . number_format($imagecost, 2) . "</td>
                    </tr>
                    <tr>
                    <td>Additional Text</td>
                    <td>LKR " . number_format($additionalTextcost, 2) . "</td>
                </tr>
            </tbody>
           
        </table>
        </div>" ;
    }
    
    $_SESSION['balance'] = $balance;

    ?>

    <div class="text-center me-5 " style="justify-items: center;">
        <div class="d-flex justify-content-between col-3 mt-3 " style="text-align: right !important;">
            <h7 class="text " style="font-weight:700 ">QUANRIRY : </h7>
            <h7 class="price  " style="font-weight:700" name="totalPrice"> <?= $quantity ?> </h7>
        </div>
        <div class="d-flex justify-content-between col-3 mt-3 " style="text-align: right !important;">
            <h7 class="text " style="font-weight:700 ">TOTAL PRICE: </h7>
            <h7 class="price  " style="font-weight:700" name="totalPrice"> Rs.<?= number_format($totalCost, 2) ?> </h7>
        </div>
        <div class="d-flex justify-content-between col-3 mt-3 " style="text-align: right !important;">
            <h7 class="text " style="font-weight:700 ">DOWNPAYMENT: </h7>
            <h7 class="price  " style="font-weight:700" name="totalPrice"> Rs. <?= number_format($downPayment, 2) ?> </h7>
        </div>
        <div class="d-flex justify-content-between col-3 mt-3 " style="text-align: right !important;">
            <h7 class="text " style="font-weight:700 ">BALANCE: </h7>
            <h7 class="price  " style="font-weight:700" name="totalPrice"> Rs. <?= number_format($balance, 2) ?> </h7>
        </div>
    </div>
    </div>
    </div>

    <form action="#" method="POST" class="row g-3 mt-4">

        <!-- Submit Button -->
        <div class="col-12 text-center d-flex justify-content-around">
            <button type="submit" name="customplaceorder" class="btn mx-5 bg-success text-white"> your customization PlaceOrder</button>
        </div>
    </form>



    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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
<?php
session_start();

//include database connection 
include('database/config.php');

//rederect to the login page if user is not login
if (!isset($_SESSION['custId'])) {
    header('location:login.php');
    exit();
}

$custId = $_SESSION['custId'];

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
        echo "<script>window.open('customize-cloth-history.php', '_self');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MD Style Haven Shop - Account Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- material icons css link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- css links -->
    <link rel="stylesheet" href="css/my-profile.css">
    <!-- <link rel="stylesheet" href="css/home-style.css"> -->
    <link rel="stylesheet" href="css/home-all-style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/back-style.css">

    <style>
        .deactivate {
            padding: 8px 16px;
            cursor: pointer;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: flow-root;
            font-size: 19px;
            font-weight: 700;
            margin-right: 5px;
        }

        .deactivate {
            background-color: #DC3545;
        }
    </style>

</head>

<body>
    <!-- include navigation bar -->

    <?php
    include('includes/navbar.php');
    ?>


    <div class="d-flex justify-content-between">
        <h2 class="ms-5 mt-3">Customization Order Details</h2>
        <!-- BACK button start -->
        <div class="back-button-container mt-1">
            <a href="customize-cloth-history.php" class="back-button">Back</a>
        </div>
        <!-- BACK button end -->
    </div>

    <table class="col-11 m-5">
        <?php
        if (isset($_GET['customization_id'])) {
            $customization_id = $_GET['customization_id'];

            $dataSelectQary = "SELECT * FROM customization WHERE customization_id =  $customization_id ";
            $result = mysqli_query($con, $dataSelectQary);

            $row_count = mysqli_num_rows($result);

            if ($row_count > 0) {

                while ($row_data = mysqli_fetch_assoc($result)) {
                    $customization_id = $row_data['customization_id'];
                    $orderdate = $row_data['customization_date'];
                    $clothtype = $row_data['Cloth_type'];
                    $measurement = $row_data['measurement'];
                    $fabric = $row_data['fabric'];
                    $neck_type = $row_data['neck_type'];
                    $logo = $row_data['logo'];
                    $customization_text = $row_data['customization_text'];
                    $image_design = $row_data['image_design'] ?? null;
                    $qty = (int)$row_data['cust_qty'];
                    $totalprice = (float)$row_data['total_price'];
                    $advance = (float)$row_data['advance_pay_amount'];
                    $balance = (float)$row_data['balance'];
                    $pickupdate = $row_data['pickup_date'];
                    $status = $row_data['customize_status'];
                    $comment = $row_data['comment'];

                    echo "
<tr>
    <th>Customize ID</th> 
    <td>$customization_id</td>
</tr>
<tr>
    <th>Order Date </th>
    <td>$orderdate</td>
 </tr>
<tr>
    <th>Cloth Type</th>
    <td>$clothtype</td>

 </tr>
 <tr>
     <th>Fabric</th>
     <td>$fabric</td>
     
 </tr>
<tr>
    <th>QTY</th>
    <td>$qty</td>
     
</tr>
<tr>
    <th>Mesurment</th>
    <td>$measurement</td>

</tr>
<tr>
    <th>Nek Type</th>
    <td>$neck_type</td>

</tr>
<tr>
    <th>Logo image</th>
    <td>  
    <img class='object-fit-contain' id='mainimage' src='images/$logo' height='140' width='auto'> 
    $logo
</td>

</tr>

<tr>
    <th> Print Image</th>
    <td>$image_design  <img class='object-fit-contain' id='mainimage' src='images/$image_design' height='140' width='auto'>
</td>

</tr>
<tr>
    <th>printing text</th>
    <td>$customization_text</td>

</tr>
<tr>
    <th>Total amount</th>
    <td>$totalprice</td>

</tr>
<tr>
    <th>Down payment</th>
    <td>$advance</td>

</tr>
<tr>
    <th>Balance</th>
    <td>$balance</td>

</tr>
<tr>
    <th>Picup/Fiton</th>
    <td>$pickupdate</td>
</tr>
<tr>
<th>Status</th>
<td>$status</td>
</tr>
<tr>
    <th>Discription</th>
    <td>$comment</td>
</tr>";
                }
            }
        } else {
            echo "<h2 class='bg-danger text-center m-5 py-2 '> Not any Orders yet </h2>";
        }

        ?>
    </table>

    <div class="d-flex justify-content-center">
        <div class="mb-5 col-4" >
            <?php
            $GetDetails = "SELECT * FROM customization WHERE customization_id = $customization_id";
            $result = mysqli_query($con, $GetDetails);
            $row_data = mysqli_fetch_assoc($result);
            $status = $row_data['customize_status'];
            $invisible = ($status == 'Cancelled' || $status == 'Complete' || $status == 'Ready for fits on') ? 'invisible' : '';

            echo  "<a href='order-details-customize.php?canclellID=$customization_id' class='$invisible deactivate'>Cancel order</a>";
            ?>
        </div>


    </div>

    <!-- footer section -->
    <?php
    include('includes/footer.php');
    ?>

    <script src="script.js"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
<?php
// Close the database connection
mysqli_close($con);
?>
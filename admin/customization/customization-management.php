<?php
session_start();

// rederect user to the login if user not logingtothe system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}
// include the database configaration file
include('../../database/config.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customization management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">
    <link rel="stylesheet" href="../../css/manage-button-1.css">

    <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <?php
    include('../../includes/admin-navigation.php');
    ?>
    <div class="container-body">

        <!-- menu section start -->
        <aside class="left-menu" style="height: fit-content;">
            <?php
            include('../../includes/back-side-nav.php');
            ?>
        </aside>
        <div class="middle-side">

            <main class="ms-4">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1">

                    <a href="../home pages/admin-home.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1 class="mt-2">Order management</h1>

                <h2 class="text-center">Order Details</h2>


                <table class="me-5 mb-5">
                    <tr>
                        <th>Custom ID</th>
                        <th>order date</th>
                        <th>Customer Id</th>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Quntity</th>
                        <th>Total Price</th>
                        <th>Advance pay</th>
                        <th>Pikup/Fiton</th>
                        <th>Status</th>
                        <th>Action </th>
                    </tr>
                    <?php
                    //get value from item table
                    $get_itemDetails = "SELECT * FROM `customization`";
                    $result = mysqli_query($con, $get_itemDetails);
                    $row_count = mysqli_num_rows($result);

                    if ($row_count == 0) {
                        echo "<h2 class = 'bd-danger text-center mt-5'> No item yet </h2> ";
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
                            $fk_cust_id = $row_data['fk_cust_id'];

                            $get_customer = "SELECT * FROM customer WHERE cust_id=  $fk_cust_id";
                            $customerResult = mysqli_query($con, $get_customer);
                            $row_count = mysqli_num_rows($customerResult);
                            $row_data = mysqli_fetch_assoc($customerResult);

                            $customer = $row_data['cust_fname']. ' '. $row_data['cust_lname'];
                            echo "
              <tr>
        <td> $customization_id </td>
        <td> $customization_date </td>
        <td> $fk_cust_id </td>
        <td> $customer </td>
        <td> $Cloth_type </td>
        <td> $cust_qty </td>
        <td> $total_price </td>
        <td> $advance_pay_amount </td>
        <td> $pickup_date </td>
        <td> $customize_status </td>
        <td class='action-links'>
         <a href='cutomize-view.php?customizationId=$customization_id' class='view'>View</a> 
         <a href='update-customize.php?customizationId=$customization_id' class='update'>Status</a>
         <a href='#' class='deactivate'>Cancle</a>
        
        </td>
    </tr>";
                        }
                    }

                    ?>


                </table>

            </main>
        </div>
    </div>


    <!-- footer section start -->
    <div>
        <footer class="copyr fixed-bottom  ">
            <div class="container ">
                <div class="row col-12 pt-3 ">
                    <p class="copy-right">Copyright &COPY; 2024 MD-Style Haven SHOP | Develop by - <a href="#"> Malindu </a> </p>
                </div>
            </div>
        </footer>
    </div>
    <!-- footer section end -->

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<!-- close database connection -->
<?php
mysqli_close($con);

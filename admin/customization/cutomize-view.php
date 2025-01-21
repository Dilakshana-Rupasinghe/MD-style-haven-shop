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

            <main class="ms-4 mb-5">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1">

                    <a href="customization-management.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1 class="mt-2">Order management</h1>

                <table>
                    <?php
                    //get value from item table using item id
                    if (isset($_GET['customizationId'])) {
                        $view_cuztom = $_GET['customizationId'];


                        $get_Details = "SELECT * FROM `customization`
                    WHERE customization_id = $view_cuztom"; //get category name from category table

                        $result = mysqli_query($con, $get_Details);
                        $row_count = mysqli_num_rows($result);

                        if ($row_count == 0) {
                            echo "<h2 class = 'bd-danger text-center mt-5'> No item yet </h2> ";
                        } else {
                            while ($row_data = mysqli_fetch_assoc($result)) {
                                $customization_id = $row_data['customization_id'];
                                $orderdate = $row_data['customization_date'];
                                $fk_cust_id = $row_data['fk_cust_id'];
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

                                $get_customer = "SELECT * FROM customer WHERE cust_id=  $fk_cust_id";
                                $customerResult = mysqli_query($con, $get_customer);
                                $row_count = mysqli_num_rows($customerResult);
                                $row_data = mysqli_fetch_assoc($customerResult);
    
                                $customer = $row_data['cust_fname']. ' '. $row_data['cust_lname'];

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
                    <th>Customer ID </th>
                    <td>$fk_cust_id</td>
                 </tr>
                <tr>
                    <th>Customer </th>
                    <td>$customer</td>
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
                    <th>Quntity</th>
                    <td>$qty</td>
                     
                </tr>
                <tr>
                    <th>Mesurments</th>
                    <td>$measurement</td>
                
                </tr>
                <tr>
                    <th>Email</th>
                    <td>$neck_type</td>
                
                </tr>
                <tr>
                    <th>Logo image</th>
                    <td>  
                    <img class='object-fit-contain' id='mainimage' src='../../images/$logo' height='140' width='auto'> 
                    $logo
                </td>
                
                </tr>
                
                <tr>
                    <th>Printing imge</th>
                    <td>  <img class='object-fit-contain' id='mainimage' src='../../images/$image_design' height='140' width='auto'>
                     $image_design    
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

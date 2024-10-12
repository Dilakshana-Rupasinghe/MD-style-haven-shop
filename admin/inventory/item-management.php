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

    $item_deleteQuiry = "DELETE FROM item WHERE item_id = $item_id"; //detelet queiry

    if (mysqli_query($con, $item_deleteQuiry)) {
        echo "<script>alert('item is deleted successfully');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/manage-button.css">

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


            <!-- main section start -->
            <main class="ms-4">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1">
                    <div class="date ms-4" style=" line-height: 2rem;">
                        <input type="date" style=" padding: 0px 10px;">
                    </div>
                    <a href="add-item.php" class="manage-item-button" style="font-size: 16px; padding:11px 22px">
                        Add Item
                        <span class="material-symbols-outlined" style="font-size:20px; padding-left: 7px; ">
                            list_alt_add
                        </span></a>
                    <a href="inventory-management.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1>Item management</h1>

                <h2 class="text-center">Item Details</h2>


                <table>
                    <tr>
                        <th>item ID</th>
                        <th>item name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Material</th>
                        <th>sell Price </th>
                        <th>Discount </th>
                        <th>Quntity </th>
                        <th>Action </th>
                    </tr>
                    <?php
                    //get value from item table
                    $get_itemDetails ="SELECT item_id, item_name, category_name, item_brand, item_material, item_sell_price, item_discount, item_stock_qty FROM item
                    INNER JOIN category ON item.fk_category_id = category.category_id ";
                    $result = mysqli_query($con, $get_itemDetails);
                    $row_count = mysqli_num_rows($result);

                    if ($row_count == 0) {
                        echo "<h2 class = 'bd-danger text-center mt-5'> No item yet </h2> ";
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
                        <td> $item_id </td>
                        <td> $item_name </td>
                        <td> $category_name </td>
                        <td> $item_brand </td>
                        <td> $item_material </td>
                        <td> $item_sell_price </td>
                        <td> $item_discount </td>
                        <td> $item_stock_qty </td>
                        <td class='action-links'>
                         <a href='item-view.php?itemId=$item_id' class='view'>View</a> 
                         <a href='update-item.php?itemId=$item_id' class='update'>Update</a>
                         <a href='item-management.php?itemId=$item_id' class='deactivate'>Delete</a>
                        
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

    <!-- Chart JS link -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../script/strockchart.js"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<!-- close database connection -->
<?php
mysqli_close($con);
?>
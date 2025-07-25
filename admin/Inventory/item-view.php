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
    <title>Item management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
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
        <aside class="left-menu" style="height: 100%;">
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
                    </div>
                    <a href="add-item.php" class="manage-item-button" style="font-size: 16px; padding:11px 22px">
                        Add Item
                        <span class="material-symbols-outlined" style="font-size:20px; padding-left: 7px; ">
                            list_alt_add
                        </span></a>
                    <a href="item-management.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1>Item management</h1>

                <h2 class="text-center">View Item Details</h2>


                <table>
                    <?php
                    //get value from item table using item id
                    if (isset($_GET['itemId'])) {
                        $view_item = $_GET['itemId'];

                        $get_itemDetails = "SELECT item_id, item_name, category_name, item_brand, item_material, item_description, item_sell_price, item_discount, item_cost_price, item_stock_qty, item_date_added FROM item
                    INNER JOIN category ON item.fk_category_id = category.category_id 
                    WHERE item.item_id = $view_item"; //get category name from category table

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
                                $item_description = $row_data['item_description'];
                                $item_cost_price = $row_data['item_cost_price'];
                                $item_sell_price = $row_data['item_sell_price'];
                                $item_discount = $row_data['item_discount'];
                                $item_stock_qty = $row_data['item_stock_qty'];
                                $item_date_added = $row_data['item_date_added'];

                                echo
                                " <tr>
                        <th>item ID</th>
                        <td>$item_id</td>
                    </tr>
                    <tr>
                        <th>item name</th>
                        <td> $item_name </td>

                        </tr>
                    <tr>
                        <th>Category </th>
                        <td> $category_name </td>

                        </tr>
                    <tr>
                        <th>Brand</th>
                        <td> $item_brand </td>
                  
                        </tr>
                    <tr>
                        <th>Material</th>
                        <td> $item_material </td>

                        </tr>
                    <tr>
                        <th>Discription</th>
                        <td> $item_description </td>
                        </tr>
                     <tr>
                        <th>Cost price </th>
                        <td> $item_cost_price </td>

                        </tr>
                    <tr>
                        <th>sell Price </th>
                        <td> $item_sell_price </td>

                        </tr>
                    <tr>
                        <th>Discount </th>
                        <td> $item_discount </td>
                        </tr>
                    <tr>
                        <th>Quntity </th>
                        <td> $item_stock_qty </td>

                        </tr>
                   
                    <tr>
                        <th>Item date added </th>
                        <td> $item_date_added </td>


                    </tr>
                   ";
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
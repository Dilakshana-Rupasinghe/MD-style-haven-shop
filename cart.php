<?php
session_start();

//rederect to the login page if user is not login
if (!isset($_SESSION['custId'])) {
    header('location:login.php');
    exit();
} else {
    $custId = $_SESSION['custId'];
}


// Include the database configuration file
include('database/config.php');


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
    <link rel="stylesheet" href="css/home-style.css">
    <link rel="stylesheet" href="css/back-style.css">

    <title>MD-Style Haven shop/online shoping-Home page</title>
</head>


<body>
    <!-- navigation bar start -->
    <?php
    include('includes/navbar.php');
    ?>
    <!-- navigaton bar  end -->

    <!-- show cart table start -->
    <div class="container my-5 px-0">
        <div class="row">
            <?php
            $getCartItemSelectQuiry = "SELECT item_id, item_name, item_image1, item_sell_price, item_stock_qty, item_discount, cart_id, item_qty FROM item
                INNER JOIN cart_item ON item.item_id = cart_item.fk_item_id
                INNER JOIN customer ON cart_item.fk_cust_id = customer.cust_id
                WHERE customer.cust_id = $custId ";


            $result = mysqli_query($con, $getCartItemSelectQuiry);
            $totalPrice = 0;
            $row_count = mysqli_num_rows($result);

            if ($row_count > 0) { //cart is empty or not
            ?>

                <table class="">
                    <thead>
                        <tr>
                            <th>ITEM IMAGE</th>
                            <th>ITEM</th>
                            <th>PRICE</th>
                            <th>QTY</th>
                            <th>SUBTOTAL</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row_data = mysqli_fetch_assoc($result)) {
                            $item_id = $row_data['item_id'];
                            $item_name = $row_data['item_name'];
                            $item_image1 = $row_data['item_image1'];
                            $item_sell_price = (float)$row_data['item_sell_price'];
                            $item_discount = (float)$row_data['item_discount'];
                            $item_stock_qty = (int)$row_data['item_stock_qty'];

                            $cart_id = $row_data['cart_id'];
                            $item_qty = (int)$row_data['item_qty'];

                            // discount price calculation
                            $discountPrice = $item_sell_price * (100 - $item_discount) / 100;

                            // get subtotle price
                            $subtotal = $item_qty * $discountPrice;

                            // get total price
                            $totalPrice += $subtotal;

                        ?>

                            <tr>
                                <!-- Product Image -->
                                <td class="text-center">
                                    <a href="product-view.php?productId=<?= $item_id ?>">
                                        <img class="object-fit-contain" src="images/products/<?php echo $item_image1; ?>" width="100" height="100%">
                                    </a>
                                </td>
                                <!-- Product name -->
                                <td>
                                    <a class="text-decoration-none text-dark" href="product-view.php?productId=<?= $item_id ?>" style="text-transform:uppercase; font-size:larger">
                                        <?php echo $item_name; ?>
                                    </a>
                                </td>
                                <!-- Price -->
                                <td style="font-size:larger;">Rs. <?= number_format($discountPrice, 2) ?> </td>

                                <!-- QTY -->
                                <td class="col-1">
                                    <form action="#" method="post">
                                        <input class="form-control" type="number" min="1" max="<?= $item_stock_qty + $item_qty  ?>" value="<?= $item_qty ?>" name="cartQty" required>
                                </td>

                                <!-- subtotal -->
                                <td>Rs. <?= number_format($subtotal, 2) ?></td>

                                <!-- action -->
                                <td class="text-center px-0 ">
                                    <input type="submit" value="Update-Item" name="updateCartItem<?= $cart_id ?>" class="update mx-0 d-inline ">
                                    </form>
                                    <!-- hidden form start-->
                                    <form action="#" method="post" class="d-inline">
                                        <input type="hidden" name="cartId" value="<?= $cart_id ?>">
                                        <input type="hidden" name="itemId" value="<?= $item_id ?>">
                                        <input type="hidden" name="existCartItemQty" value="<?= $item_qty ?>">
                                        <input type="hidden" name="existItemStockQty" value="<?= $item_stock_qty ?>">
                                        <!-- hidden form end-->
                                        <input type="submit" value="Remove-Item" name="removeCartItem<?= $cart_id ?>" class="deactivate mx-0 d-inline mt-1 mt-lg-0">
                                    </form>
                                </td>
                            </tr>

                            <?php
                            // update cart item
                            updateCartItem($con, $cart_id, $item_id, $item_qty, $item_stock_qty);
                            
                            // remove cart item
                            removeCartItem($con, $cart_id, $item_id, $item_qty, $item_stock_qty);

                            ?>
                        <?php } ?>

                    </tbody>
                </table>
            <?php
            } else {
                echo "<h2 class='bg-danger text-center mt-5 '> Not added item in cart </h2>";
            } ?>
        </div>


        <div class="row">
            <div class="col-md-6 ps-0">
                <a href="index.php"><button class="back-button">Keep Shopping</button></a>
                <a href="checkout.php"><button class="Registration bg-info">CheckOut</button></a>
            </div>
            <div class="col-md-6 text-md-end mt-2 mt-md-0 pe-0">
                <h3>Total Price: Rs. <?= number_format($totalPrice, 2) ?> </h3>
            </div>
        </div>
    </div>
    <!-- show cart table end -->



    <!-- footer section -->
    <?php
    include('includes/footer.php');
    ?>
    <!-- footer end -->
    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<!-- close the DB connection -->
<?php
mysqli_close($con);
?>
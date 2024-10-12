<?php
session_start();

// Include the database configuration file
include('database/config.php');



include('function/commen-function.php');


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
    <link rel="stylesheet" href="css/home.css">
    <title>MD-Style Haven shop/online shoping-Home page</title>
</head>


<body>
    <!-- navigation bar start -->
    <?php
    include('includes/navbar.php');
    ?>
    <!-- navigaton bar  end -->

    <!-- Item image and details section start -->
    <div class="container my-5 px-0 mx-auto">
        <div class="row d-flex mx-auto bg-primary bg-gradient bg-opacity-25 rounded-4">
            <?php

            if (isset($_GET['productId'])) {
                $itemId = $_GET['productId'];

                $itemSelectQuairy = "SELECT * FROM item WHERE item_id = $itemId";

                $item_result = mysqli_query($con, $itemSelectQuairy);
                $row_count = mysqli_num_rows($item_result);
                $row_data = mysqli_fetch_assoc($item_result);


                $item_image1 = $row_data['item_image1'];
                $item_image2 = $row_data['item_image2'] ?? null;
                $item_name = $row_data['item_name'];
                $item_brand = $row_data['item_brand'];
                $item_material = $row_data['item_material'];
                $item_description = $row_data['item_description'];
                $item_sell_price = $row_data['item_sell_price'];
                $item_discount = $row_data['item_discount'];
                $item_discount = $row_data['item_discount'];
                $item_stock_qty = $row_data['item_stock_qty'];


                //discount calculation
                $discountPrice = $item_sell_price * (100 - $item_discount) / 100;

                //hide discount badge and discount price if item has not any discount
                if ($item_discount == 0) {
                    $showNoneDiscount = 'd-none';
                }

                // show item availability
                if ($item_stock_qty == 0) {
                    $statusAvailabal = 'slod out';
                    $showItemQntyColor = 'text-danger';
                    $showNoneQnty = 'd-none';
                } else {
                    $statusAvailabal = 'In stock';
                    $showItemQntyColor = 'text-success';
                }
            ?>


                <!-- image show section start -->
                <div class="col-md-6 d-flex" style="align-items: center; grid-gap: 18px; padding-left: 35px;">
                    <div class="py-3 px-2">
                        <div class="text-center">
                            <img class="object-fit-contain" id="mainimage" src="images/products/<?php echo $item_image1; ?>" height="500" width="100%">
                        </div>
                    </div>
                    <div class="text-center ps-3 d-grid">
                        <img class="object-fit-contain" onclick="change_image(this)" src="images/products/<?php echo $item_image1; ?>" height="90" width="50">
                        <?php if ($item_image2): ?>
                            <img class="object-fit-contain" onclick="change_image(this)" src="images/products/<?php echo $item_image2; ?>" height="90" width="50">
                        <?php else: ?>
                            <!-- Optionally, you can display a placeholder image or hide this section -->
                            <img class="object-fit-contain" src="">
                        <?php endif; ?>

                    </div>
                </div>
                <!-- image show section end -->

                <!-- item details show section start  -->
                <div class="col-md-6 p-3 bg-secondary bg-gradient bg-opacity-25 rounded-4">
                    <h4><span>Name : </span><?php echo $item_name; ?></h4>
                    <h5 class='text-body-secondary'> <span>Brand : </span><?php echo $item_brand; ?></h5>
                    <p><span>Matirial : </span><?php echo $item_material; ?></p>
                    <p><span>Discription : </span><?php echo $item_description; ?></p>
                    <h5>Size</h5>
                    <div class="size d-flex px-2">

                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> S
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> M
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> L
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> XL
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> XXL
                        </div>
                    </div>
                    <div class="size d-flex px-2">

                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> 28
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> 30
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> 32
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> 34
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> 36
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input" name="Size" value=""> 38
                        </div>
                    </div>

                    <h5>color</h5>

                    <div class=" color d-flex px-2">
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-primary" name="color" value="">
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-success" name="color" value="">
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-danger" name="color" value="">
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-secondary" name="color" value="">
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-dark" name="color" value="">
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-light" name="color" value="">
                        </div>
                    </div>
                    <span>price : </span>
                    <h3 class="<?php echo $showNoneDiscount; ?> text-decoration-line-through text-body-tertiary"> <?php echo number_format($item_sell_price, 2) ?> <span class="badge bg-success ms-2">- <?php echo $item_discount ?> %</span> </h3>

                    <h3> <?php echo number_format($discountPrice, 2); ?></h3>

                    <h4 class="<?php echo $showItemQntyColor ?> fw-bold"><?php echo $statusAvailabal ?></h4>

                    <form action="" method="post" class="d-flex mx-auto">
                        <div class="<?php echo $showNoneQnty ?> d-flex mt3">
                            <input type="number" class="form-controle" min="1" max="<?php echo $item_stock_qty ?>" value="1" name="cartQnty" required>
                        </div>
                        <div>
                            <button class="btn btn-outline-dark btn-orange py-1 ms-2" type="submit" name="AddtoCart"> Add To Cart</button>
                        </div>
                        <p class="mt-3 text-black bg-body-tertiary rounded-3"></p>
                    </form>
                </div>
                <!-- item details show section end  -->
            <?php
            }

            ?>
        </div>
    </div>
    </div>
    <!-- Item image and details section end -->


    <!-- add to the cart start-->
    <?php
    if (isset($_POST['AddtoCart'])) {
        //rederect to the login page if user is not login
        if (!isset($_SESSION['custId'])) {
            echo "<script>window.open('Login.php', '_self');</script>";
            exit();
        }

        $cust_id = $_SESSION['custId'];
        $addingItemQTY = $_POST['cartQnty'];

        $cartSelectQuiry = "SELECT * FROM cart_item WHERE fk_item_id= $itemId and fk_cust_id= $cust_id";
        $cartResult = mysqli_query($con, $cartSelectQuiry);

        // check if item alrady existe
        if(mysqli_num_rows($cartResult) > 0 ) {
            echo "<script>alert('This item already exists in your cart.');</script>";
            echo "<script>window.open('cart.php', '_self')</script>";
            exit();
        }

        // add item to cart item
        $cartInsertQuiry = "INSERT INTO cart_item (item_qty, fk_cust_id, fk_item_id) VALUES ($addingItemQTY, $cust_id, $itemId)";

        if(mysqli_query($con, $cartInsertQuiry)){
            echo "<script>alert('Add item to cart successfully');</script>";
        }

        // Update the stock quantity of the item after add to cart
        $newStockQTY = $item_stock_qty - $addingItemQTY;

        $updateItemQuiry = "UPDATE cart_item SET item_stock_qty= $newStockQTY WHERE item_id = $itemId ";
        if(mysqli_query($con, $updateItemQuiry)){
            echo "<script>window.open('product.php', '_self');</script>";
            exit();
        }

    }
    ?>

    <!-- add to the cart end-->


    <!-- footer section -->
    <?php
    include('includes/footer.php');
    ?>
    <!-- footer end -->
    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

<script>
    function Buynow() {
        alert("Successfully Buying");

    }
</script>

</html>

<!-- close the DB connection -->
<?php
mysqli_close($con);
?>
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


                $item_image1 = $item_result['item_image1'];
                $item_image2 = $item_result['item_image2'];
                $item_name = $item_result['item_name'];
                $item_brand = $item_result['item_brand'];
                $item_material = $item_result['item_material'];
                $item_description = $item_result['item_description'];
                $item_sell_price = $item_result['item_sell_price'];
                $item_discount = $item_result['item_discount'];
                $item_discount = $item_result['item_discount'];
                $item_stock_qty = $item_result['item_stock_qty'];


                //discount calculation
                $discountPrice = $item_sell_price * (100 - $item_discount) / 100;

                //hide discount badge and discount price if item has not any discount
                if ($item_discount == 0) {
                    $showNoneDiscount = 'd-none';
                }

                // show item availability
                if ($item_stock_qty == 0) {
                    $statusAvailabal = 'slod out';
                    $showItemQnty = 'text-danger';
                    $showNoneQnty = 'd-none';
                } else {
                    $statusAvailabal = 'In stock';
                    $showItemQnty = 'text-success';
                }
            ?>


                <!-- image show section start -->
                <div class="col-md-6 d-flex" style="align-items: center;">
                    <div class="py-3 px-2">
                        <div class="text-center">
                            <img class="object-fit-contain" id="mainimage" src="images/products/<? echo $item_image1; ?>" >
                        </div>
                    </div>
                    <div class="text-center py-3">
                        <img class="object-fit-contain" onclick="change_image(this)" src="images/products/<? echo $item_image1; ?>" height="60">
                        <img class="object-fit-contain" onclick="change_image(this)" src="images/products/<? echo $item_image2; ?>" height="60">
                    </div>
                </div>
                <!-- image show section end -->

                <!-- item details show section start  -->
                <div class="col-md-6 p-3 bg-secondary bg-gradient bg-opacity-25 rounded-4">
                    <h3>name</h3>
                    <h4>brand</h4>
                    <h6>Matirial</h6>
                    <h6>discription</h6>
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
                            <input type="radio" class="form-check-input bg-primary" name="Size" value="">
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-success" name="Size" value="">
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-danger" name="Size" value="">
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-secondary" name="Size" value="">
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-dark" name="Size" value="">
                        </div>
                        <div class="px-2">
                            <input type="radio" class="form-check-input bg-light" name="Size" value="">
                        </div>
                    </div>

                    <h3> sell price <span class="badge bg-success ms-2">- %</span> </h3>

                    <h3>Discount price</h3>


                    <form action="" method="post" class="d-flex mx-auto">
                        <div class="d-flex mt3">
                            <input type="number" class="form-controle" min="1" value="1" name="cartQnty" required>
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

    <!-- Item image and details section end -->


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
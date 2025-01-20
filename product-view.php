<?php
session_start();

// Include the database configuration file
include('database/config.php');


// Check if the feedback form is submitted
if (isset($_POST['feddback'])) {
    if (!isset($_SESSION['custId'])) {
        echo "<script>window.open('Login.php', '_self');</script>";
        exit();
    }
    // Store customer ID session data in a variable
    $cust_id = $_SESSION['custId'];

    // Get user input from the form
    $ratings = $_POST['rating'] ?? null; // If user wants to send only feedback, ratings can be null
    $feedback = trim($_POST['feedback']) ?? null; // If user wants to send only ratings, feedback can be null

    // Get product ID to identify which product the feedback and ratings refer to
    if (isset($_GET['productId'])) {
        $productId = $_GET['productId'];
    }

    // Check if the user has already given ratings for this product
    $checkRatingQuery = "SELECT * FROM rating WHERE fk_cust_id = $cust_id AND fk_item_id = $productId";
    $checkRatingResult = mysqli_query($con, $checkRatingQuery);

    if ($ratings) {
        if (mysqli_num_rows($checkRatingResult) > 0) {
            // If a rating exists, update it
            $updateRatingQuery = "UPDATE rating SET rating_date = NOW(), rating_value = '$ratings' WHERE fk_cust_id = $cust_id AND fk_item_id = $productId";
            $updateRatingResult = mysqli_query($con, $updateRatingQuery);

            if ($updateRatingResult) {
                echo "<script>alert('Rating updated successfully!');</script>";
            } else {
                echo "<script>alert('Error updating rating!');</script>";
            }
        } else {
            // If no rating exists, insert a new rating
            $insertRatingQuery = "INSERT INTO rating(rating_date, rating_value, fk_cust_id, fk_item_id) VALUES(NOW(), '$ratings', $cust_id, $productId)";
            $insertRatingResult = mysqli_query($con, $insertRatingQuery);

            if ($insertRatingResult) {
                echo "<script>alert('Rating sent successfully!');</script>";
            } else {
                echo "<script>alert('Error sending rating!');</script>";
            }
        }
    }
    //check if the usre has already submit feedback for this product 
    $checkfedbackQuery = "SELECT * FROM feedback WHERE fk_cust_id = $cust_id AND fk_item_id = $productId";
    $checkfedbackresult = mysqli_query($con, $checkfedbackQuery);

    // Insert feedback into the DB
    if ($feedback) {
        //check if DB hase row of 
        if (mysqli_num_rows($checkfedbackresult) > 0) {
            echo "<script>alert('You have already submit feedback message for this product.Thank you!');</script>";
            echo "<script>window.open('Index.php', '_self');</script>";
            exit();
        } else {
            $feedbackInsert = "INSERT INTO feedback (feedback_date, feedback_msg, feedback_status, fk_cust_id, fk_item_id) VALUES (NOW(), '$feedback', 'Pending', $cust_id, $productId)";
            $feedbackResult = mysqli_query($con, $feedbackInsert);

            if ($feedbackResult) {
                echo "<script>alert('Feedback sent successfully!');</script>";
            } else {
                echo "<script>alert('Error sending feedback!');</script>";
            }
        }
    }
    echo "<script>window.open('Index.php', '_self');</script>";
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
    <link rel="stylesheet" href="css/home-all-style.css">
    <link rel="stylesheet" href="css/ratings.css">

    <title>MD-Style Haven shop/online shoping-Product view </title>
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

            if (isset($_GET['productId'])) { //get product id from item card in funtion section
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

                  // Fetch average rating for the product
                  $avgRatingQuery = "SELECT AVG(rating_value) AS average_rating FROM rating WHERE fk_item_id = $itemId";
                  //AS mean create tempory attibutr to store average rating
                  //execute quary
                  $avgRatingResult = mysqli_query($con, $avgRatingQuery);
                  if ($avgRatingResult) {
                      $avgRatingRow = mysqli_fetch_assoc($avgRatingResult);
                      $average_rating = $avgRatingRow['average_rating'];
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
                    <h4 class="text-success"><strong><span class="text-dark">Ratings :</span><?php echo number_format($average_rating, 1); ?> / 5 </strong></h4>
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
                    <h3 class="<?php echo $showNoneDiscount; ?> text-decoration-line-through text-body-tertiary"> <?php echo number_format($item_sell_price, 2) ?> <span class="badge bg-danger ms-2" style="font-size:medium;">- <?php echo $item_discount ?> %</span> </h3>

                    <h3> <?php echo number_format($discountPrice, 2); ?></h3>

                    <h4 class="<?php echo $showItemQntyColor ?> fw-bold"><?php echo $statusAvailabal ?></h4>

                    <form action="" method="post" class="d-flex mx-auto">
                        <div class="<?php echo $showNoneQnty ?> d-flex mt3">
                            <input type="number" class="form-controle" min="1" max="<?php echo $item_stock_qty ?>" value="1" name="cartQnty" required>
                        </div>
                        <div class="col-8">
                            <button class="btn btn-outline-dark btn-orange py-1 ms-2 " type="submit" name="AddtoCart"> Add To Cart</button>
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
            $row_data = mysqli_fetch_assoc($cartResult);
            $_SESSION['CartId'] = $row_data['cart_id'];
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


    <form class="feedback-form" method="post" action="#">
        <h2>Rate & Feedback</h2>

        <!-- Star Rating -->
        <div class="rating">
            <input type="radio" id="star1" name="rating" value="5">
            <label for="star1" title="5 star">★</label>

            <input type="radio" id="star2" name="rating" value="4">
            <label for="star2" title="4 stars">★</label>

            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3" title="3 stars">★</label>

            <input type="radio" id="star4" name="rating" value="2">
            <label for="star4" title="2 stars">★</label>

            <input type="radio" id="star5" name="rating" value="1">
            <label for="star5" title="1 stars">★</label>
        </div>

        <!-- Feedback Text Area -->
        <textarea rows="3" name="feedback" placeholder="Write your feedback here..."></textarea>

        <!-- Submit Button -->
        <button type="submit" name="feddback">Submit Feedback</button>
    </form>

    <!-- Feedback Card -->
    <div class="d-flex  justify-content-around">

        <?php
        if (isset($_GET['productId'])) {
            $productId = $_GET['productId'];

            //get data feedback table data form DB
            $selectFeedback = "SELECT * FROM feedback WHERE fk_item_id =  $productId and feedback_status='Accept' ";
            $feedbackResult = mysqli_query($con, $selectFeedback);

            if (mysqli_num_rows($feedbackResult) > 0) {
                while ($row_data = mysqli_fetch_assoc($feedbackResult)) {
                    $feedback_date = $row_data['feedback_date'];
                    $feedback_msg = $row_data['feedback_msg'];
                    $fk_cust_id = $row_data['fk_cust_id'];
                    $feedback_status = $row_data['feedback_status'];

                    //get customer name 
                    $selectName = "SELECT * FROM customer WHERE cust_id=  $fk_cust_id ";
                    $resultCustomer = mysqli_query($con, $selectName);
                    $row_count = mysqli_num_rows($resultCustomer);

                    if ($row_count > 0) {
                        while ($row_data = mysqli_fetch_assoc($resultCustomer)) {
                            $cust_fname = $row_data['cust_fname'];



        ?>


                            <div class="col-md-3  m-4">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo  $cust_fname ?></h5>
                                        <p class="card-text"><?php echo  $feedback_msg ?></p>
                                        <small class="text-muted">Submitted on: <?php echo  $feedback_date ?></small>
                                    </div>
                                </div>
                            </div>

        <?php
                        }
                    }
                }
            }
        }
        ?>
    </div>

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
<?php
session_start();

//rederect to the login page if user is not login
if (!isset($_SESSION['custId'])) {
    header('location:login.php');
    exit();
} else {
    $custId = $_SESSION['custId'];
}

if (isset($_POST['placeorder'])) {

    // get form data when user enter data and validate inputs
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $district = htmlspecialchars($_POST['district']);
    $addressline1 = htmlspecialchars($_POST['address-line1']);
    $addressline2 = htmlspecialchars($_POST['address-line2']);
    $addressline3 = htmlspecialchars($_POST['address-line3']);
    $city = htmlspecialchars($_POST['city']);
    $postalCode = htmlspecialchars($_POST['postalCode']);
    $billingCompanyName = htmlspecialchars($_POST['billingCompanyName']);
    $phone = htmlspecialchars($_POST['phone']);
    $secondaryPhone = htmlspecialchars($_POST['secondaryPhone']);
    $paymentMethod = htmlspecialchars($_POST['paymentMethod']);

    // Store in session to pass data to another page 
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['email'] = $email;
    $_SESSION['district'] = $district;
    $_SESSION['address_line1'] = $addressline1;
    $_SESSION['address_line2'] = $addressline2;
    $_SESSION['address_line3'] = $addressline3;
    $_SESSION['city'] = $city;
    $_SESSION['postalCode'] = $postalCode;
    $_SESSION['billingCompanyName'] = $billingCompanyName;
    $_SESSION['phone'] = $phone;
    $_SESSION['secondaryPhone'] = $secondaryPhone;
    $_SESSION['paymentMethod'] = $paymentMethod;

    // Include the database configuration file
    include('database/config.php');


    // rederect page related to user choose payment systems 
    if ($paymentMethod === "online") {
        echo "<script>window.open('online-payment.php', '_self');</script>";
    } else if ($paymentMethod === "cod") {
        echo "<script>window.open('order-success.php', '_self');</script>";
    }
}

// Include the database configuration file
include('database/config.php');


// Add this where the total price and items are calculated:
$itemDescriptions = []; // Array to hold item names
$totalPrice = 0;
$totalCost = 0;
$item_id = '';

// Fetch data from the cart query
$getCartItemSelectQuiry = "SELECT item_id, item_name, item_image1, item_sell_price, item_stock_qty, item_discount, cart_id, item_qty FROM item
INNER JOIN cart_item ON item.item_id = cart_item.fk_item_id
INNER JOIN customer ON cart_item.fk_cust_id = customer.cust_id
WHERE customer.cust_id = $custId ";

$result = mysqli_query($con, $getCartItemSelectQuiry);

if (mysqli_num_rows($result) > 0) {
    while ($row_data = mysqli_fetch_assoc($result)) {
        $item_id = $row_data['item_id'];
        $item_name = $row_data['item_name'];
        $item_qty = $row_data['item_qty'];
        $item_price = $row_data['item_sell_price'];
        $item_discount = $row_data['item_discount'];

        // Calculate discounted price
        $discountPrice = $item_price * (100 - $item_discount) / 100;

        // Add subtotal to total price
        $subtotal = $discountPrice * $item_qty;

        // Add the subtotal to the total price
        $totalPrice += $subtotal;


        // Add item name to descriptions
        $itemDescriptions[] = $item_id . '-' . $item_name . '-' . " (Qty: $item_qty)";
    }
}

// Fetch delivery cost from the database
$deliveryCost = 0;
$getDeliveryCostQuery = "SELECT * FROM additional_cost WHERE cost_type = 'delivery'";
$deliveryCostResult = mysqli_query($con, $getDeliveryCostQuery);

if (mysqli_num_rows($deliveryCostResult) > 0) {
    $deliveryCostData = mysqli_fetch_assoc($deliveryCostResult);

    $deliveryCost = $deliveryCostData['amount'];
}

// Calculate final total price to send payment getway
$loyaltyDiscount = isset($_SESSION['loyaltyDiscount']) ? $_SESSION['loyaltyDiscount']  : 0;
$finalTotalPrice = $totalPrice + $deliveryCost - $loyaltyDiscount;

// Store data in session
$_SESSION['checkout_items'] = implode(", ", $itemDescriptions);
$_SESSION['checkout_total_price'] = $finalTotalPrice * 100; // Convert to cents
$_SESSION['Order_totle'] = $finalTotalPrice;
$_SESSION['item_id '] =  $item_id;


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
    <link rel="stylesheet" href="css/back-style.css">

    <title>MD-Style Haven shop/online shoping-Home page</title>
</head>

<body>

    <!-- navigation bar start -->
    <?php
    include('includes/navbar.php');
    ?>
    <!-- navigaton bar  end -->


    <div class="container my-5">
        <h1 class="text-center mb-4">CHECKOUT</h1>
        <hr>

        <div class="row">
            <!-- Billing Details Section -->
            <div class="col-md-6 bg-light p-4 " style="border-radius: 30px 0 0 30px ">
                <h4 class="mb-3 text-center">BILLING DETAILS</h4>
                <hr>

                <form action="" method="post" id="checkoutForm">
                    <div id="sameasBillingAddressForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="district" class="form-label">District </label>
                            <select class="form-select" name="district" id="district" required>
                                <option value="" selected>Select Destrict</option>
                                <option value="Ampara">Ampara</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Badulla">Badulla</option>
                                <option value="Batticaloa">Batticaloa</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Galle">Galle</option>
                                <option value="Gampaha">Gampaha</option>
                                <option value="Hambantota">Hambantota</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Kalutara">Kalutara</option>
                                <option value="Kegalla">Kegalla</option>
                                <option value="Kilinochchi">Kilinochchi</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Mannar">Mannar</option>
                                <option value="Matale">Matale</option>
                                <option value="Matara">Matara</option>
                                <option value="Monaragala">Monaragala</option>
                                <option value="Mullaittivu">Mullaittivu</option>
                                <option value="Nuwara Eliya">Nuwara Eliya</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Puttalam">Puttalam</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Trincomalee">Trincomalee</option>
                                <option value="Vavuniya">Vavuniya</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="address-line1" class="form-label">Address-line1</label>
                            <input type="text" class="form-control" name="address-line1" id="address-line1" placeholder="line1" required>
                        </div>
                        <div class="mb-3">
                            <label for="address-line2" class="form-label">Address-line2</label>
                            <input type="text" class="form-control" name="address-line2" id="address-line2" placeholder="line2" required>
                        </div>
                        <div class="mb-3">
                            <label for="address-line3" class="form-label">Address-line3 (If any)</label>
                            <input type="text" class="form-control" name="address-line3" id="address-line3" placeholder="line3 ">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="City" required>
                            </div>
                            <div class="col-md-6">
                                <label for="postalCode" class="form-label">Postcode / ZIP</label>
                                <input type="text" class="form-control" name="postalCode" id="postalCode" placeholder="Postcode" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="billingCompanyName" class="form-label">Company (optional)</label>
                            <input type="text" class="form-control" name="billingCompanyName" id="billingCompanyName" placeholder="Company">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Primary Phone" required>
                            </div>
                            <div class="col-md-6">
                                <label for="secondaryPhone" class="form-label">Secondary Phone</label>
                                <input type="tel" class="form-control" name="secondaryPhone" id="secondaryPhone" placeholder="Secondary Phone">
                            </div>
                        </div>
                    </div>



                    <hr>
                    <!-- Payment Section -->
                    <h4 class="mt-4 mb-3">Payment</h4>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="online" checked>
                        <label class="form-check-label" for="creditCard">Pay with Debit or Credit Card</label>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cashOnDelivery" value="cod">
                        <label class="form-check-label" for="cashOnDelivery">Cash on Delivery (COD)</label>
                    </div>

                    <hr>
                    <button type="submit" name="placeorder" class="btn btn-success w-100" onclick="handleOrder()" disabled>Place Order</button>

                </form>
            </div>

            <!-- Your Order Section -->
            <div class="col-md-6 py-4 display-fixed " style="    padding-right: 0rem !important; padding-left: 1rem !important;">
                <h4 class="mb-3 text-center">YOUR ORDER</h4>
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

                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th>ITEM IMAGE</th>
                                <th>ITEM DETAILS</th>
                                <th>QTY</th>
                                <th>SUBTOTAL</th>
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

                                $totalPrice += $subtotal;

                                // Fetch delivery cost from the database
                                $deliveryCost = 0;
                                $getDeliveryCostQuery = "SELECT * FROM additional_cost WHERE cost_type = 'delivery'";
                                $deliveryCostResult = mysqli_query($con, $getDeliveryCostQuery);

                                if (mysqli_num_rows($deliveryCostResult) > 0) {
                                    $deliveryCostData = mysqli_fetch_assoc($deliveryCostResult);

                                    $deliveryCost = $deliveryCostData['amount'];
                                }

                                // LOYALTY POINTS DISCOUNT CALCULATION  

                                //get user loyalty detail in checkout.php page 
                                $earnedPoints = isset($_SESSION['earnedPoints']) ? $_SESSION['earnedPoints'] : 0;
                                $currentPoint = isset($_SESSION['currentPoint']) ? $_SESSION['currentPoint'] : 0;
                                $UpdetNewPoint = isset($_SESSION['UpdetNewPoint']) ? $_SESSION['UpdetNewPoint'] : 0;
                                $isEligible = isset($_SESSION['isEligible']) ? $_SESSION['isEligible'] : "error";
                                $isChecked = isset($_SESSION['isChecked']) ? $_SESSION['isChecked'] : "error";

                                $maxPoints = 100;
                                $progress = min(100, ($currentPoint / $maxPoints) * 100);
                                $isEligible = $currentPoint >= 100;
                                $_SESSION['isEligible'] = $isEligible;
                                $isChecked = false;
                                $_SESSION['isChecked'] = $isChecked;
                                $loyaltyDiscount = 0;

                                if (isset($_POST['apply_loyalty'])) {
                                    if ($isEligible) {
                                        $loyaltyDiscount = $totalPrice * 0.10;
                                        $_SESSION['loyalty_discount_used'] = true; //to update loyalty table and reduce used points
                                        $loyalty_discount_used = "UPDATE user_loyalty SET is_used = 1 WHERE fk_cust_id = $custId ";
                                        mysqli_query($con, $loyalty_discount_used);
                                    }
                                }

                                // Show checkbox as checked only for that one submission
                                $isChecked = isset($_SESSION['loyalty_discount_used']) && $_SESSION['loyalty_discount_used'] === true;
                                $_SESSION['isChecked'] = $isChecked;


                                // Calculate final total price
                                $finalTotalPrice = $totalPrice + $deliveryCost - $loyaltyDiscount;
                                $_SESSION['finalTotalPrices'] = $finalTotalPrice;
                                $_SESSION['loyaltyDiscount'] = $loyaltyDiscount;


                                // Unset the checkbox flag so it won't stay checked
                                if ($isChecked) {
                                    unset($_SESSION['loyalty_discount_used']);
                                }

                            ?>

                                <tr>
                                    <!-- Product Image -->
                                    <td class="text-center">
                                        <a href="product-view.php?productId=<?= $item_id ?>">
                                            <img class="object-fit-contain" src="images/products/<?php echo $item_image1; ?>" width="80" height="40%">
                                        </a>
                                    </td>
                                    <!-- Product name -->
                                    <td>
                                        <a class="text-decoration-none text-dark" href="product-view.php?productId=<?= $item_id ?>" style="text-transform:uppercase; font-size:small">
                                            <?php echo $item_name; ?>
                                        </a>
                                    </td>

                                    <!-- QTY -->
                                    <td class="col-1 text-center">
                                        <?php echo $item_qty; ?>
                                    </td>

                                    <!-- subtotal -->
                                    <td>Rs. <?= number_format($subtotal, 2) ?></td>

                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                <?php
                } else {
                    echo "<h2 class='bg-danger text-center mt-5 '> Not added item in cart to checkout </h2>";
                } ?>

                <div class="text-center">
                    <div class="d-flex justify-content-between align-items-center" style="text-align: right !important;">
                        <h7 class="text mx-3" style="font-weight:700">DELIVERY COST : </h7>
                        <h7 class="price px-3" style="font-weight:700" name="totalPrice"> Rs.<?= number_format($deliveryCost, 2) ?> </h7>
                    </div>
                    <div class="d-flex justify-content-between align-items-center" style="text-align: right !important;">
                        <h7 class="text mx-3" style="font-weight:700">LOYALTY DISCOUNT : </h7>
                        <h7 class="price px-3" style="font-weight:700" name="totalPrice"> Rs.<?= number_format($loyaltyDiscount, 2) ?> </h7>
                    </div>
                    <div class="d-flex justify-content-between align-items-center" style="text-align: right !important;">
                        <h7 class="text mx-3" style="font-weight:700">TOTAL PRICE: </h7>
                        <h7 class="price px-3" style="font-weight:700" name="totalPrice"> Rs.<?= number_format($finalTotalPrice, 2) ?> </h7>
                    </div>

                    <?php
                    // Check if the customer already has a loyalty record
                    $pointSelectQuary = "SELECT points FROM user_loyalty WHERE fk_cust_id = $custId";
                    $pointsResult = mysqli_query($con, $pointSelectQuary);
                    $rowdata = mysqli_fetch_assoc($pointsResult);

                    $currentPoint = $rowdata['points'];
                    // Assume session is already started, and customer ID is available
                    $custId = $_SESSION['custId'];

                    // Calculate new points based on purchase amount
                    $earnedPoints = (float)($finalTotalPrice / 100); // e.g., Rs.100 = 1 point

                    $UpdetNewPoint = 0;
                    if ($earnedPoints > 0) {
                        $UpdetNewPoint = $currentPoint + $earnedPoints;
                    }

                    echo number_format($earnedPoints, 2);
                    echo '<br>';
                    echo number_format($currentPoint, 2);
                    echo '<br>';
                    echo number_format($UpdetNewPoint, 2);
                    echo '<br>';


                    // Store in session to pass data to another page 
                    $_SESSION['earnedPoints'] = $earnedPoints;
                    $_SESSION['currentPoint'] = $currentPoint;
                    $_SESSION['UpdetNewPoint'] = $UpdetNewPoint;
                    $maxPoints = 100;
                    $progress = min(100, ($currentPoint / $maxPoints) * 100);

                    $isEligible = $currentPoint >= 100;
                    $_SESSION['isEligible'] = $isEligible;
                    $isChecked = isset($_SESSION['isChecked']) ? $_SESSION['isChecked'] : "error";

                    ?>
                    <hr>
                    <!-- Display Loyalty Points to Customer -->
                    <div class="loyalty-box mt-4" style="background: #ccccccff; border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 6px;">
                        <strong>Your Total Loyalty Points:</strong> <?= number_format($currentPoint, 2) ?> points<br>
                        <small>Earn 1 point for every Rs.100 you spend!</small>

                        <!-- Progress bar -->

                        <div class="progress text-center mt-3" style="height: 20px; background-color: #fffafaff; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar"
                                style="width: <?= $progress ?>%; background-color: #198b1dff; color: #fff; border-radius: 10px;"
                                aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100">
                                <?= number_format($progress, 0) ?>%
                            </div>
                        </div>

                        <!-- Checkbox: only enabled if points >= 100 -->
                        <form method="POST">
                            <div class="form-check mt-3">
                                <label class="form-check-label" for="checkOffers">
                                    Check for available point offers
                                </label>
                                <input class="form-check-input" type="checkbox" name="apply_loyalty" value="" id="checkOffers"
                                    <?= $isEligible ? '' : 'disabled' ?> onchange="this.form.submit()" <?= $isChecked ? 'checked' : '' ?>>
                                <?php if (!$isEligible) { ?>
                                    <div style="font-size: 12px; color: #888;">* Reach 100 points to unlock offers</div>
                                <?php } else {  ?>
                                    <!-- Hidden offer message -->
                                    <div id="offerMessage" class="mt-2" style="color: #4caf50;">
                                        <?= $isChecked ? '🎉 Reward applied using your loyalty points!' : '✅ You are eligible — click to apply your reward.' ?>
                                    </div>
                                <?php }; ?>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
        //check form is full fild or not then dicable or visible place order button
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            const placeOrderButton = document.querySelector('button[onclick="handleOrder()"]');
            const requiredFields = form.querySelectorAll('input[required], select[required]');

            // Disable the button initially
            placeOrderButton.disabled = true;

            const validateForm = () => {
                // Check if all required fields are filled
                const allFilled = Array.from(requiredFields).every(input => input.value.trim() !== '');
                placeOrderButton.disabled = !allFilled; // Enable button if all fields are valid
            };

            // Add event listeners to all required fields
            requiredFields.forEach(input => {
                input.addEventListener('input', validateForm);
            });

            // Initial validation
            validateForm();

            function handleOrder() {
                // Get selected payment method
                // const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;


            }
        });
    </script>

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
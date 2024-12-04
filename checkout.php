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


    <div class="container my-5">
        <h1 class="text-center mb-4">CHECKOUT</h1>
        <hr>
        <div class="row">
            <!-- Billing Details Section -->
            <div class="col-md-6 bg-light p-4 " style="border-radius: 30px 0 0 30px ">
                <h4 class="mb-3 text-center">BILLING DETAILS</h4>
                <hr>
                <form>
                    <div id="sameasBillingAddressForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="First name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Last name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="example@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="district" class="form-label">District </label>
                            <select class="form-select" id="district" required>
                                <option value="Dictrict" selected>Select Destrict</option>
                                <option value="LK52">Ampara</option>
                                <option value="LK71">Anuradhapura</option>
                                <option value="LK81">Badulla</option>
                                <option value="LK51">Batticaloa</option>
                                <option value="LK11">Colombo</option>
                                <option value="LK31">Galle</option>
                                <option value="LK12">Gampaha</option>
                                <option value="LK33">Hambantota</option>
                                <option value="LK41">Jaffna</option>
                                <option value="LK13">Kalutara</option>
                                <option value="LK21">Kandy</option>
                                <option value="LK92">Kegalla</option>
                                <option value="LK42">Kilinochchi</option>
                                <option value="LK61">Kurunegala</option>
                                <option value="LK43">Mannar</option>
                                <option value="LK22">Matale</option>
                                <option value="LK32">Matara</option>
                                <option value="LK82">Monaragala</option>
                                <option value="LK45">Mullaittivu</option>
                                <option value="LK23">Nuwara Eliya</option>
                                <option value="LK72">Polonnaruwa</option>
                                <option value="LK62">Puttalam</option>
                                <option value="LK91">Ratnapura</option>
                                <option value="LK53">Trincomalee</option>
                                <option value="LK44">Vavuniya</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="address-line1" class="form-label">Address-line1</label>
                            <input type="text" class="form-control" id="address-line1" placeholder="line1" required>
                        </div>
                        <div class="mb-3">
                            <label for="address-line2" class="form-label">Address-line2</label>
                            <input type="text" class="form-control" id="address-line2" placeholder="line2" required>
                        </div>
                        <div class="mb-3">
                            <label for="address-line3" class="form-label">Address-line3 (If any)</label>
                            <input type="text" class="form-control" id="address-line3" placeholder="line3 ">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" placeholder="City" required>
                            </div>
                            <div class="col-md-6">
                                <label for="postalCode" class="form-label">Postcode / ZIP</label>
                                <input type="text" class="form-control" id="postalCode" placeholder="Postcode" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="billingCompanyName" class="form-label">Company (optional)</label>
                            <input type="text" class="form-control" id="billingCompanyName" placeholder="Company">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Primary Phone" required>
                            </div>
                            <div class="col-md-6">
                                <label for="secondaryPhone" class="form-label">Secondary Phone</label>
                                <input type="tel" class="form-control" id="secondaryPhone" placeholder="Secondary Phone">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Billing Address Options -->
                    <h4 class="mt-4 mb-3">Billing Address</h4>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="billingAddress" id="sameAddress" checked onclick="toggleBillingAddress(false)">
                        <label class="form-check-label" for="sameAddress">Same as shipping address</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="billingAddress" id="differentAddress" onclick="toggleBillingAddress(true)">
                        <label class="form-check-label" for="differentAddress">Use a different billing address</label>
                    </div>

                    <hr>
                    <!-- Additional Billing Address Form -->
                    <div id="differentBillingAddressForm" class="d-none">
                        <h4 class="mt-4 mb-3">Different Address</h4>
                        <div class="mb-3">
                            <label for="country" class="form-label">Region</label>
                            <select class="form-select" id="district" required>
                                <option value="Dictrict" selected>Select Destrict</option>
                                <option value="LK52">Ampara</option>
                                <option value="LK71">Anuradhapura</option>
                                <option value="LK81">Badulla</option>
                                <option value="LK51">Batticaloa</option>
                                <option value="LK11">Colombo</option>
                                <option value="LK31">Galle</option>
                                <option value="LK12">Gampaha</option>
                                <option value="LK33">Hambantota</option>
                                <option value="LK41">Jaffna</option>
                                <option value="LK13">Kalutara</option>
                                <option value="LK21">Kandy</option>
                                <option value="LK92">Kegalla</option>
                                <option value="LK42">Kilinochchi</option>
                                <option value="LK61">Kurunegala</option>
                                <option value="LK43">Mannar</option>
                                <option value="LK22">Matale</option>
                                <option value="LK32">Matara</option>
                                <option value="LK82">Monaragala</option>
                                <option value="LK45">Mullaittivu</option>
                                <option value="LK23">Nuwara Eliya</option>
                                <option value="LK72">Polonnaruwa</option>
                                <option value="LK62">Puttalam</option>
                                <option value="LK91">Ratnapura</option>
                                <option value="LK53">Trincomalee</option>
                                <option value="LK44">Vavuniya</option>
                            </select>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="billingFirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="billingFirstName" placeholder="First name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="billingLastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="billingLastName" placeholder="Last name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address-line1" class="form-label">Address-line1</label>
                            <input type="text" class="form-control" id="address-line1" placeholder="line1" required>
                        </div>
                        <div class="mb-3">
                            <label for="address-line2" class="form-label">Address-line2</label>
                            <input type="text" class="form-control" id="address-line2" placeholder="line2" required>
                        </div>
                        <div class="mb-3">
                            <label for="address-line3" class="form-label">Address-line3 (If any)</label>
                            <input type="text" class="form-control" id="address-line3" placeholder="line3 ">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" placeholder="City" required>
                            </div>
                            <div class="col-md-6">
                                <label for="postalCode" class="form-label">Postcode / ZIP</label>
                                <input type="text" class="form-control" id="postalCode" placeholder="Postcode" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="billingCompanyName" class="form-label">Company (optional)</label>
                            <input type="text" class="form-control" id="billingCompanyName" placeholder="Company">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Primary Phone" required>
                            </div>
                            <div class="col-md-6">
                                <label for="secondaryPhone" class="form-label">Secondary Phone</label>
                                <input type="tel" class="form-control" id="secondaryPhone" placeholder="Secondary Phone">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- Payment Section -->
                    <h4 class="mt-4 mb-3">Payment</h4>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                        <label class="form-check-label" for="creditCard">Pay with Debit or Credit Card</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="bankTransfer">
                        <label class="form-check-label" for="bankTransfer">Bank Card / Bank Account</label>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cashOnDelivery">
                        <label class="form-check-label" for="cashOnDelivery">Cash on Delivery (COD)</label>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success w-100">Place Order</button>
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

                                // get total price
                                $totalPrice += $subtotal;

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
                        <h7 class="text mx-3" style="font-weight:700">TOTAL PRICE: </h7>
                        <h7 class="price px-3" style="font-weight:700"> Rs.<?= number_format($totalPrice, 2) ?> </h7>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



    <script>
        // Toggle visibility of billing address form
        function toggleBillingAddress(isDifferentAddress) {
            const differentBillingAddressForm = document.getElementById("differentBillingAddressForm");
            const shippingFields = document.querySelectorAll("#firstName, #lastName, #district, #address-line1, #address-line2, #city, #postalCode, #phone");
            const billingFields = document.querySelectorAll("#billingFirstName, #billingLastName, #district, #address-line1, #address-line2, #city, #postalCode, #phone");

            if (isDifferentAddress) {
                // Show the different billing address form
                differentBillingAddressForm.classList.remove("d-none");

                // Hide the same as billing address form
                sameasBillingAddressForm.classList.add("d-none");

                // Clear the "Same as shipping address" fields
                shippingFields.forEach(field => field.value = "");
            } else {
                // Hide the different billing address form
                differentBillingAddressForm.classList.add("d-none");

                // Show the same as billing address form
                sameasBillingAddressForm.classList.remove("d-none");

                // Clear the "Different billing address" fields
                billingFields.forEach(field => field.value = "");

                // Automatically copy data from shipping to billing fields
                const shippingData = {
                    firstName: document.getElementById("firstName").value,
                    lastName: document.getElementById("lastName").value,
                    district: document.getElementById("district").value,
                    addressLine1: document.getElementById("address-line1").value,
                    addressLine2: document.getElementById("address-line2").value,
                    city: document.getElementById("city").value,
                    postalCode: document.getElementById("postalCode").value,
                    phone: document.getElementById("phone").value,
                };

                document.getElementById("billingFirstName").value = shippingData.firstName;
                document.getElementById("billingLastName").value = shippingData.lastName;
                document.getElementById("district").value = shippingData.district;
                document.getElementById("address-line1").value = shippingData.addressLine1;
                document.getElementById("address-line2").value = shippingData.addressLine2;
                document.getElementById("city").value = shippingData.city;
                document.getElementById("postalCode").value = shippingData.postalCode;
                document.getElementById("phone").value = shippingData.phone;
            }
        }

        // Handle form submission and provide confirmation alerts
        function handleFormSubmission(event) {
            // Prevent default form submission behavior
            event.preventDefault();

            // Check if "Same as shipping address" is selected
            const isSameAddressChecked = document.getElementById("sameAddress").checked;

            // Confirmation alert logic
            if (isSameAddressChecked) {
                alert("Your order has been placed successfully! Billing address is the same as the shipping address.");
            } else {
                // Ensure required fields for different billing address are filled
                const billingFirstName = document.getElementById("billingFirstName").value;
                const billingLastName = document.getElementById("billingLastName").value;
                const billingCity = document.getElementById("city").value;
                const billingPostalCode = document.getElementById("postalCode").value;

                if (billingFirstName && billingLastName && billingCity && billingPostalCode) {
                    alert("Your order has been placed successfully! Billing address is different from the shipping address.");
                } else {
                    alert("Please fill in all the required fields in the billing address form.");
                    return; // Stop submission if form is incomplete
                }
            }

            // Provide an additional forum confirmation for tracking purposes
            console.log("Forum 1: Confirmation sent.");
            console.log("Forum 2: Confirmation sent.");
        }

        // Attach form submission handler
        document.querySelector(".btn-success").addEventListener("click", handleFormSubmission);
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
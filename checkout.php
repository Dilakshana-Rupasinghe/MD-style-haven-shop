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
            <div class="col-md-6 bg-light p-4 rounded">
                <h4 class="mb-3">Billing Details</h4>
                <hr>
                <form>
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
                        <label for="district" class="form-label">District (optional)</label>
                        <select class="form-select" id="district">
                            <option value="Colombo" selected>Colombo</option>
                            <option value="Gampaha">Gampaha</option>
                            <option value="Kandy">Kandy</option>
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
                        <div class="mb-3">
                            <label for="country" class="form-label">Country/Region</label>
                            <select class="form-select" id="country" required>
                                <option value="Sri Lanka" selected>Sri Lanka</option>
                                <option value="India">India</option>
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
            <div class="col-md-6 bg-primary text-white p-4 rounded " style="background-color: rgba(113, 169, 242, 1);">
                <h4 class="mb-3">Your Order</h4>
                <table class="table text-white">
                    <thead>
                        <tr>
                            <th scope="col">Item Detail</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Order items will be dynamically inserted -->
                        <tr>
                            <!-- <td colspan="2" class="text-end">Shipping Cost:</td>
                            <td>$0.00</td> -->
                        </tr>
                        <tr>
                            <!-- <td colspan="2" class="text-end">Total Amount:</td>
                            <td>$0.00</td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleBillingAddress(show) {
            const form = document.getElementById('differentBillingAddressForm');
            if (show) {
                form.classList.remove('d-none');
            } else {
                form.classList.add('d-none');
            }
        }
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
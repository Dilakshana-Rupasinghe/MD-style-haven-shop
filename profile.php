<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MD Style Haven Shop - Account Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- material icons css link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- css links -->
    <link rel="stylesheet" href="css/my-profile.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <!-- include navigation bar -->

    <?php
    include('includes/navbar.php');
    ?>

    <!-- Main Section -->
    <main>
        <section class="account-details">
            <h2>Account Details</h2>
            <div class="profile-section">
                <img src="profile.jpg" alt="Profile Picture" class="profile-pic">
                <button class="edit-profile">✎</button>
            </div>
            <form id="account-form">
                <label for="firstName">First name</label>
                <input type="text" id="firstName" name="firstName" placeholder="First name">

                <label for="lastName">Last name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Last name">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email">

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Phone Number">

                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="Address">

                <button type="button" id="saveChanges">Save Changes</button>
            </form>
        </section>

        <!-- Order History Section -->
        <section class="order-history">
            <h2>Order History</h2>
            <div class="no-orders">
                You haven't placed any orders yet.
            </div>
        </section>
    </main>

    <!-- footer section -->
    <?php
    include('includes/footer.php');
    ?>

    <script src="script.js"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
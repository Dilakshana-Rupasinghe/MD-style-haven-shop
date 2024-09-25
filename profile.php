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
    <link rel="stylesheet" href="css/style.css">



</head>

<body>
    <!-- include navigation bar -->

    <?php
    include('includes/navbar.php');
    ?>

    <h2 class="ms-5 mt-3">Account Details</h2>

    <hr>
    <!-- Main Section -->

    <aside>
        <h2 class="ms-5 ps-3">My Profile</h2>
        <div class="profile-section ms-5">
            <img src="profile.jpg" alt="Profile Picture" class="profile-pic">
            <button class="edit-profile">✎</button>

            <!-- Logout section start -->
            <div class="container row my-1 mx-auto">
                <div class="col-md-7 mx-auto" >
                    <div class="wrapper-out">
                        <form action="#" method="post" style="margin: 8%; padding: 25px;">
                            <h3 class="text-center" style="color: white;">You are login to the system</h3>
                            <button type="submit" class="submit mt-5 " name="custLogout"> Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Logout section end -->

    </aside>

    <hr>

    <main>
        <section class="account-details col-md-8 mx-auto">

            <form id="account-form">

                <label for="firstName">User name</label>
                <input type="text" id="userName" name="userName" placeholder="User name" required>

                <label for="firstName">First name</label>
                <input  type="text" id="firstName" name="firstName" placeholder="First name" required>

                <label for="lastName">Last name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Last name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" placeholder="Address" required>

                <button class="savechange" type="button" id="saveChanges">Save Changes</button>
            </form>
        </section>
    </main>
    <!-- Order History Section -->
    <section class="order-history">
        <h2>Order History</h2>
        <div class="no-orders">
            You haven't placed any orders yet.
        </div>
    </section>


    <!-- footer section -->
    <?php
    include('includes/footer.php');
    ?>

    <script src="script.js"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
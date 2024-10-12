<?php
session_start();

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
    <link rel="stylesheet" href="css/styles.css">
    <title>MD-Style Haven shop/online shoping-Home page</title>
</head>


<body>
    <!-- navigation bar start -->
    <?php
    include('includes/navbar.php');
    ?>
    <!-- navigaton bar  end -->

    <section class="about-us">
        <div class="container">
            <div class="about-content">
                <h1>About MD Style Haven</h1>
                <p>Welcome to MD Style Haven Shop, your ultimate destination for premium men’s fashion. Our mission is to provide you with stylish, high-quality clothing that not only enhances your wardrobe but also reflects your personality. Whether you're looking for the latest trends, custom-made suits, or timeless classics, we've got you covered.</p>
                <p>At MD Style Haven, we believe that fashion is more than just clothing – it’s a way of expressing yourself. That’s why we offer a wide range of clothing options to suit every taste and occasion, from casual wear to formal attire. Our expert designers and tailors work with the finest fabrics to create pieces that are as comfortable as they are stylish.</p>
                <p>Customer satisfaction is at the heart of everything we do. From our seamless online shopping experience to our flexible customization options, we strive to provide you with the best service. Thank you for choosing MD Style Haven as your trusted fashion partner.</p>
            </div>
        </div>
    </section>

    <!-- footer section -->
    <?php
    include('includes/footer.php');
    ?>
    <!-- footer end -->
    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>
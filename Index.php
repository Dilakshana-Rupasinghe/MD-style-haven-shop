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

    <div class="bg-light pt-1 pb-4 ">


        <h5 class="text-center my-3  text-primary-emphasis ">WELCOME TO -<span
                style="text-transform:uppercase; color: rgb(43, 92, 226); font-size:30px;"> MD-Style heven </span> - ONLINE SHOPING
        </h5>

        <!-- serch item -->
        <?php
        include('includes/search.php');
        ?>
        <!-- search item end -->

    </div>

    <!-- cover image -->
    <!-- <div class="carousel slide ">
        <div class="carousel-inner ">
            <div class="cover-image carousel-item active ">
                <img src="images/log4.jpg" class="rounded d-block w-100 " alt="...">
            </div>
        </div>
    </div> -->

    <!-- Product table -->

    <div class="container py-5 mt-5">

     <!-- search product start -->
     <?php
        if (isset($_GET['search'])) {
            $item_name = $_GET['searchName'];
        ?>
            <div class="col-lg-6 m-auto text-center">
                <h2> <?php echo "Searching result for \"$item_name\""; ?> </h2>
                <hr>
            </div>
            <div class="row">
                <?php
                $itemSelectQuairy = "SELECT * FROM item WHERE item_name LIKE '%$item_name%'";
                getItemCard($con, $itemSelectQuairy);
                ?>
            </div>

        <?php
        }
        ?>
        
        <div class="col-lg-6 m-auto text-center">
            <h2> NEW ARRIVALS </h2>
            <hr>
        </div>
        <div class="row">
            <?php
            $itemSelectQuairy = "SELECT * FROM item ORDER BY item_date_added DESC LIMIT 5,5";
            getItemCard($con, $itemSelectQuairy);
            ?>
        </div>

        <?php
        if (!isset($_GET['categoryId'])) {
            if (!isset($_GET['search'])) {
        ?>

                <div class="col-lg-6 m-auto text-center">
                    <h2> ALL PRODUCT </h2>
                    <hr>
                </div>
                <div class="row">

                    <?php
                    $itemSelectQuairy = "SELECT * FROM item ORDER BY rand()";
                    getItemCard($con, $itemSelectQuairy);
                    ?>
                </div>
        <?php
            }
        } ?>

       


        <!-- search product end -->


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
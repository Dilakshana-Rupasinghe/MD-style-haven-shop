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

        <!-- serch item -->
        <div class="container col-7">
            <form action="#" method="get" class="search d-flex  my-4 ">
                <input type="text" class="me-3 search-bar fw-semibold form-control py-1" placeholder="Search here"
                    name="searchName" required>
                <button type="submit" class=" rounded-2 py-1 px-3 fw-semibold" name="search"> Search</button>
            </form>

        </div>
    </div>

    <div class="container ">

        <!-- product view using select category in navigation bar -->
        <?php
        if (isset($_GET['categoryId'])) {
            $categoryId = $_GET['categoryId'];
        ?>
            <div class="col-lg-6 m-auto text-center my-3">
                <h1><?php echo $_GET['categoryName']; ?></h1>
            </div>
            <div class="row">
                <?php
                $itemSelectQuairy = "SELECT * FROM item WHERE fk_category_id = $categoryId ";
                getItemCard($con, $itemSelectQuairy); // call the function to get item cart 
                ?>
            </div>
        <?php
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
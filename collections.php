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
        <?php
        include('includes/search.php');
        ?>
        <!-- search item end -->
    </div>

    <!-- filter option  -->


    <div class="container ">

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar Filters -->
                <div class="col-md-3">
                    <div class="filter-section my-4 px-3 py-1" style="background-color: whitesmoke;">
                        <h5 class="mt-2">COLLECTION</h5>
                        <?php
                        if (isset($_GET['categoryId'])) {
                            if (!isset($_GET['search'])) {
                                $categoryId = $_GET['categoryId'];
                        ?>
                                <div class="m-auto my-2">
                                    <h6 class="text-center pt-2"> <i><?php echo "MEN'S", " ", $_GET['categoryName']; ?> </i> </h6>
                                </div>
                        <?php
                            }
                        }
                        ?>

                        <hr>
                        <h5 class="mt-4">SIZE</h5>
                        <div class="sizes d-flex">
                            <ul style="list-style-type:none;">
                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="XS" type="radio" class="form-check-input" id="sizeXS">
                                        <label for="sizeXS" class="form-check-label">XS</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="S" type="radio" class="form-check-input" id="sizeS">
                                        <label for="sizeS" class="form-check-label">S</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="M" type="radio" class="form-check-input" id="sizeM">
                                        <label for="sizeM" class="form-check-label">M</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="L" type="radio" class="form-check-input" id="sizeL">
                                        <label for="sizeL" class="form-check-label">L</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="XL" type="radio" class="form-check-input" id="sizeXL">
                                        <label for="sizeXL" class="form-check-label">XL</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="XXL" type="radio" class="form-check-input" id="sizeXXL">
                                        <label for="sizeXXL" class="form-check-label">XXL</label>
                                    </div>
                                </li>

                                </li>
                            </ul>
                            <hr>
                            <ul style="list-style-type:none;">
                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="28" type="radio" class="form-check-input" id="size28">
                                        <label for="size28" class="form-check-label">28</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="30" type="radio" class="form-check-input" id="size30">
                                        <label for="size30" class="form-check-label">30</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="32" type="radio" class="form-check-input" id="size32">
                                        <label for="size32" class="form-check-label">32</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="34" type="radio" class="form-check-input" id="size34">
                                        <label for="size34" class="form-check-label">34</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="38" type="radio" class="form-check-input" id="size38">
                                        <label for="size38" class="form-check-label">38</label>
                                    </div>
                                </li>

                                <li>
                                    <div class="form-check">
                                        <input name="Size" value="40" type="radio" class="form-check-input" id="size40">
                                        <label for="size40" class="form-check-label">40</label>
                                    </div>
                                </li>

                            </ul>
                            <hr>


                            <!-- Add more sizes -->
                        </div>

                        <h5 class="mt-4">COLOR</h5>
                        <div class="colors d-flex flex-wrap">
                            <span class="color-swatch bg-black"></span>
                            <span class="color-swatch bg-gray"></span>
                            <span class="color-swatch bg-primary"></span>
                            <!-- Add more colors -->
                        </div>

                    </div>
                </div>

                <!-- Product Grid -->
                <div class="col-md-9">

                    <!-- product view using select category in navigation bar -->
                    <?php
                    if (isset($_GET['categoryId'])) {
                        if (!isset($_GET['search'])) {
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
                    }
                    ?>

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
                </div>
            </div>



        </div>
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
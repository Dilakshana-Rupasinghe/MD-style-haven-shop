<?php
session_start();

// rederect user to the login if user not logingtothe system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}
// include the database configaration file
include('../../database/config.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/manage-button.css">

    <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <?php
    include('../../includes/admin-navigation.php');
    ?>
    <div class="container-body">

        <!-- menu section start -->
        <aside class="left-menu" style="height: fit-content;">
            <?php
            include('../../includes/back-side-nav.php');
            ?>
        </aside>
        <div class="middle-side">


            <!-- main section start -->
            <main class="ms-4">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1">
                    <div class="date ms-4" style=" line-height: 2rem;">
                        <input type="date" style=" padding: 0px 10px;">
                    </div>
                    <a href="item-management.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1>Add Item </h1>

                
                <!-- item add form section start -->
                <div class="container  row my-5 mx-auto">
                    <div class="wrapper col-md-6 mx-auto">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <h2>Add Item</h2>
                            <!-- Name -->
                            <div class="input-box">
                                <input type="text" name="itemName" id="itemName" placeholder="Name" required>
                            </div>
                            <!-- Image 1 -->
                            <label class="" for="image1">Upload Image</label>
                            <div class="input-file-box mt-0 ">
                                <input class="" type="file" name="image1" id="image1" required>
                            </div>
                            <!-- Image 2 -->
                            <label class="" for="image2">Upload Image</label>
                            <div class="input-file-box mt-0 ">
                                <input class="" type="file" name="image2" id="image2" required>
                            </div>
                            <!-- Category dropdown -->
                            <div>
                                <select name="category" required>
                                    <option selected value=''>Select Category</option>
                                    
                                </select>
                            </div>
                            <!-- Brand -->
                            <div class="input-box">
                                <input type="text" name="brand" id="brand" placeholder="Brand" required>
                            </div>
                            <!-- Description -->
                            <textarea style="height: 120px;" name="description" id="description" placeholder="Description" rows="3" required></textarea>
                            <!-- Cost price -->
                            <div class="input-box mt-2">
                                <input type="text" name="costPrice" id="costPrice" placeholder="Cost Price" required>
                            </div>
                            <!-- Sell price -->
                            <div class="input-box">
                                <input type="text" name="sellPrice" id="sellPrice" placeholder="Sell Price" required>
                            </div>
                            <!-- Discount -->
                            <div class="input-box">
                                <input type="text" name="discount" id="discount" placeholder="Discount" required>
                            </div>
                            <!-- Stock quantity -->
                            <div class="input-box">
                                <input type="text" name="stockQty" id="stockQty" placeholder="Stock Quantity" required>
                            </div>

                            <button type="submit" class="btn text-bg-secondary" name="itemAdd">Add</button>
                        </form>
                    </div>
                </div>
                <!-- item add form section end -->
            </main>
        </div>
    </div>





    <!-- footer section start -->
    <div>
        <footer class="copyr fixed-bottom  ">
            <div class="container ">
                <div class="row col-12 pt-3 ">
                    <p class="copy-right">Copyright &COPY; 2024 MD-Style Haven SHOP | Develop by - <a href="#"> Malindu </a> </p>
                </div>
            </div>
        </footer>
    </div>
    <!-- footer section end -->

    <!-- Chart JS link -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../script/strockchart.js"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<!-- close database connection -->
<?php
mysqli_close($con);
?>
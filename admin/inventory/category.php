<?php
session_start();

// rederect user to the login if user not logingtothe system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}
// include the database configaration file
include('../../database/config.php');

// check if user click the button or not
if (isset($_POST['categoryAdd'])) {

    // get user input
    $categoryname = $_POST['Categoryname'];

    //check fild is not empty
    if ($categoryname != '') {
        // check if category alrady exists
        $categorySelectQuiry = "SELECT * FROM category WHERE category_name = '$categoryname'";
        $result = (mysqli_query($con, $categorySelectQuiry));
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('{$categoryname} already exists');</script>";
        } else {

            //insert new catagory into DB
            $addcategoryQuory = "INSERT INTO category(category_name) VALUES('$categoryname')";

            if (mysqli_query($con, $addcategoryQuory)) {
                echo "<script>alert('New Category is added Successfully')</script>";
            }
        }
    }
}

// delete category if user click delete button
if (isset($_GET['categoryId'])) {
    $categoryId = $_GET['categoryId'];

    $categoryDeleteQuire = "DELETE FROM category WHERE category_id = $categoryId"; //delete quary
    if (mysqli_query($con, $categoryDeleteQuire)) {
        echo "<script>alert('Category is deleted successfully');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">
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

                    <a href="inventory-management.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1>Category management</h1>



                <div class="edit ms-5" style="margin-top: 1rem;">
                    <div class="change ms-3 " style="height: fit-content; width: 25rem">
                        <h3 class="text-center">Add category</h3>

                        <form action="#" method="post" id="categoryAddForm">
                            <!-- Category name -->
                            <div>
                                <label for="Categoryname">Category name</label> <br>
                                <input type="Categoryname" id="Categoryname" name="Categoryname" required>
                            </div>

                            <div style="margin:0 40px;">
                                <button type="submit" name="categoryAdd" id="update"> Add </button>
                            </div>
                        </form>
                    </div>


                    <div class="change ms-5" style="width: 25rem;">
                        <h3>Strock by Category</h3>
                        <canvas id="pie-chart"></canvas>

                    </div>
                </div>

                <div>
                    <table>
                        <tr>
                            <th>Category ID</th>
                            <th>Category name</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $get_categoryDetail = "SELECT * FROM category ";

                        $result = mysqli_query($con, $get_categoryDetail);
                        $row_count = mysqli_num_rows($result);

                        if ($row_count == 0) {
                            echo "<h2 class='bg-danger text-center mt-5'>Np user yet </h2>";
                        } else {
                            while ($row_date = mysqli_fetch_assoc($result)) {
                                $category_id = $row_date['category_id'];
                                $categoryName = $row_date['category_name'];

                                echo "<tr>
                                
                                <td> $category_id </td>
                                <td> $categoryName </td>

                                <td class='action-links'>
                                <a href='category.php?categoryId=$category_id' class='deactivate'> Delete </a> 
                                </td>
                                
                                </tr>";
                            }
                        }
                        ?>

                    </table>
                </div>





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
    <script src="../../script/categorychart.js"></script>

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<!-- close database connection -->
<?php
mysqli_close($con);
?>
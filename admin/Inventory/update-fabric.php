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
if (isset($_POST['fabricupdate'])) {

    // get user input
    $fabrictype = $_POST['fabrictype'];
    $fabriccost = $_POST['fabricprice'];

    //get fabric id form add-fabric.php 
    $fabric_type_id = $_GET['fabrictypeId'];

    //check fild is not empty
    if ($fabrictype != ''  and $fabriccost != '') {
        // item Update quari
        $fabricUpdateQuiry = "UPDATE fabric_type SET fabric_Type_name = '$fabrictype', fabric_cost = '$fabriccost' WHERE fabric_type_id = $fabric_type_id";

        // insert new item to DB
        if (mysqli_query($con, $fabricUpdateQuiry)) {
            echo "<script>alert('new fabric is Update successfully');</script>";
            echo "<script>window.open('fabric-management.php', '_self');</script>";
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabric management -update fabric </title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">
    <link rel="stylesheet" href="../../css//manage-button1.css">

    <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <?php
    include('../../includes/admin-navigation.php');
    ?>
    <div class="container-body">

        <!-- menu section start -->
        <aside class="left-menu" style="height: 100%;">
            <?php
            include('../../includes/back-side-nav.php');
            ?>
        </aside>
        <div class="middle-side">


            <!-- main section start -->
            <main class="ms-4">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1">

                    <a href="fabric-management.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1>Fabric management - update Fabric </h1>

                <div class="edit ms-1" style="margin-top: 3rem; width: 68rem">
                    <div class="change ms-1 col-8 " style="height: fit-content; width: 25rem">
                        <h3 class="text-center">Add new fabric here</h3>

                        <?php
                        if (isset($_GET['fabrictypeId'])) {
                            $fabric_type_id = $_GET['fabrictypeId'];

                            // select data DB in item table 
                            $fabricSelectQuiry = "SELECT * FROM fabric_type WHERE fabric_type_id = $fabric_type_id";

                            $result = mysqli_query($con, $fabricSelectQuiry);
                            $row_count = mysqli_num_rows($result);

                            if ($row_count == 0) {
                                echo "<h2 class='bg-danger text-center mt-5 '> No Item yet </h2>";
                            } else {
                                while ($row_data = mysqli_fetch_assoc($result)) {

                                    $fabric_Type_name = $row_data['fabric_Type_name'];
                                    $fabric_cost = $row_data['fabric_cost'];
                                   
                                }
                            }
                        }
                        ?>

                        <form action="#" method="post" id="categoryAddForm">
                            <!-- Category name -->
                            <div>
                                <label for="fabrictype">fabric Type</label> <br>
                                <input type="text" id="fabrictype" name="fabrictype"  value="<?php echo $fabric_Type_name; ?>" required>
                            </div>
                            <div>
                                <label for="fabricprice">fabric Price</label> <br>
                                <input type="number" id="fabricprice" name="fabricprice" value="<?php echo $fabric_cost; ?>"  required>
                            </div>

                            <div style="margin:0 40px;">
                                <button type="submit" name="fabricupdate" id="update"> Update </button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th>Fabric Type ID</th>
                                <th>Fabric Type name</th>
                                <th>Fabric Price</th>
                            </tr>
                            <?php
                            $get_fabricDetail = "SELECT * FROM fabric_type ";

                            $result = mysqli_query($con, $get_fabricDetail);
                            $row_count = mysqli_num_rows($result);

                            if ($row_count == 0) {
                                echo "<h2 class='bg-danger text-center mt-5'>Np fabric yet </h2>";
                            } else {
                                while ($row_date = mysqli_fetch_assoc($result)) {
                                    $fabrictypeid = $row_date['fabric_type_id'];
                                    $fabricTypename = $row_date['fabric_Type_name'];
                                    $fabriccost = $row_date['fabric_cost'];

                                    echo "<tr>
                                
                                <td> $fabrictypeid </td>
                                <td> $fabricTypename </td>
                                <td> $fabriccost </td>
                                
                                </tr>";
                                }
                            }
                            ?>

                        </table>
                    </div>
                </div>

        </div>


        <!-- footer section start -->
        <div>
            <footer class="copyr fixed-bottom  ">
                <div class="container ">
                    <div class="row col-12 pt-2 ">
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

<!-- close database connection -->
<?php
mysqli_close($con);
?>
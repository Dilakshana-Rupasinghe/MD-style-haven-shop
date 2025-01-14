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
if (isset($_POST['fabricAdd'])) {

    // get user input
    $fabrictype = $_POST['fabrictype'];
    $fabriccost = $_POST['fabricprice'];

    //check fild is not empty
    if ($fabrictype != '') {
        // check if category alrady exists
        $fabricSelectQuiry = "SELECT * FROM fabric_type WHERE fabric_Type_name = '$fabrictype'";
        $result = (mysqli_query($con, $fabricSelectQuiry));
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('{$fabrictype} already exists');</script>";
        } else {

            //insert new catagory into DB
            $addfabricQuory = "INSERT INTO fabric_type(fabric_Type_name, fabric_cost) VALUES('$fabrictype', '$fabriccost')";

            if (mysqli_query($con, $addfabricQuory)) {
                echo "<script>alert('New fabric is added Successfully')</script>";
                echo "<script>window.open('add-fabric.php', '_self');</script>";
            }
        }
    }
}

// delete fabric if user click delete button
if (isset($_GET['fabrictypeId'])) {
    $fabrictypeId = $_GET['fabrictypeId'];

    $fabricDeleteQuire = "DELETE FROM fabric_type WHERE fabric_type_id = $fabrictypeId"; //delete quary
    if (mysqli_query($con, $fabricDeleteQuire)) {
        echo "<script>alert('fabric type is deleted successfully');</script>";
        echo "<script>window.open('add-fabric.php', '_self');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabric management -add new fabric </title>
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


                <h1>Fabric management - Add new Fabric Type</h1>

                <div class="edit ms-1" style="margin-top: 3rem; width: 68rem">
                    <div class="change ms-1 col-8 " style="height: fit-content; width: 25rem">
                        <h3 class="text-center">Add new fabric here</h3>

                        <form action="#" method="post" id="categoryAddForm">
                            <!-- Category name -->
                            <div>
                                <label for="fabrictype">fabric Type</label> <br>
                                <input type="text" id="fabrictype" name="fabrictype" required>
                            </div>
                            <div>
                                <label for="fabricprice">fabric Price</label> <br>
                                <input type="number" id="fabricprice" name="fabricprice" required>
                            </div>

                            <div style="margin:0 40px;">
                                <button type="submit" name="fabricAdd" id="update"> Add </button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th>Fabric Type ID</th>
                                <th>Fabric Type name</th>
                                <th>Fabric Price</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $get_fabricDetail = "SELECT * FROM fabric_type ";

                            $result = mysqli_query($con, $get_fabricDetail);
                            $row_count = mysqli_num_rows($result);

                            if ($row_count == 0) {
                                echo "<h2 class='bg-danger text-center mt-5'>Np user yet </h2>";
                            } else {
                                while ($row_date = mysqli_fetch_assoc($result)) {
                                    $fabrictypeid = $row_date['fabric_type_id'];
                                    $fabricTypename = $row_date['fabric_Type_name'];
                                    $fabriccost = $row_date['fabric_cost'];

                                    echo "<tr>
                                
                                <td> $fabrictypeid </td>
                                <td> $fabricTypename </td>
                                <td> $fabriccost </td>

                                <td class='action-links'>
                                <a href='update-fabric.php?fabrictypeId=$fabrictypeid' class='update'> Update </a> 
                                <a href='add-fabric.php?fabrictypeId=$fabrictypeid' class='deactivate'> Delete </a> 
                                </td>
                                
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
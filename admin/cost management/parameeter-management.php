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
if (isset($_POST['costAdd'])) {

    // get user input
    $costname = $_POST['costname'];
    $costprice = $_POST['costprice'];
    $is_percentage = $_POST['is_percentage'];
    $percentage_rate = $_POST['percentage_rate'];

    //check fild is not empty
    if ($costname != '') {
        // check if category alrady exists
        $costSelectQuiry = "SELECT * FROM additional_cost WHERE cost_type = '$costname'";
        $result = (mysqli_query($con, $costSelectQuiry));
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('{$costname} already exists');</script>";
        } else {

            //insert new catagory into DB
            $addcostQuory = "INSERT INTO additional_cost(cost_type, amount, is_percentage, percentage_rate	) VALUES('$costname', '$costprice', '$is_percentage', '$percentage_rate')";

            if (mysqli_query($con, $addcostQuory)) {
                echo "<script>alert('New cost details is added Successfully')</script>";
                echo "<script>window.open('parameeter-management.php', '_self');</script>";
            }else{
                echo 'error';
            }
        }
    }
}

// delete category if user click delete button
if (isset($_GET['costId'])) {
    $costId = $_GET['costId'];

    $costDeleteQuire = "DELETE FROM additional_cost WHERE cost_id = $costId"; //delete quary
    if (mysqli_query($con, $costDeleteQuire)) {
        echo "<script>alert('Cost type is deleted successfully');</script>";
        echo "<script>window.open('parameeter-management.php', '_self');</script>";
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
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">
    <link rel="stylesheet" href="../../css/manage-button1.css">

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

                    <a href="cost-manage.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <h1>Cost management - Add new parameeter Type</h1>

                <div class="edit" style="margin-top: 3rem; width: 69rem">
                    <div class="change  col-8 " style="height: fit-content; width: 22rem">
                        <h3 class="text-center">Add new additional costs here</h3>

                        <form action="#" method="post" id="categoryAddForm">
                            <!-- Category name -->
                            <div>
                                <label for="costname">cost name/type</label> <br>
                                <input type="text" id="costname" name="costname" required>
                            </div>
                            <div>
                                <label for="costprice">cost price</label> <br>
                                <input type="numebr" id="costprice" name="costprice">
                            </div>
                            <div>
                                <label for="is_percentage">Is Percentage Based:</label>
                                <select id="is_percentage" name="is_percentage" class="bg-white col-4">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>

                            <div>
                                <label for="percentage_rate">Percentage Rate:</label>
                                <input type="number" id="percentage_rate" name="percentage_rate" step="0.01" placeholder="e.g., 5.00">
                            </div>
                            <div style="margin:10px 40px;">
                                <button type="submit" name="costAdd" id="update"> Add </button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Cost Type</th>
                                <th>Amount</th>
                                <th>Is Percentage</th>
                                <th>Percentage Rate</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            $get_costDetail = "SELECT * FROM additional_cost ";

                            $result = mysqli_query($con, $get_costDetail);
                            $row_count = mysqli_num_rows($result);

                            if ($row_count == 0) {
                                echo "<h2 class='bg-danger text-center mt-5'>Np user yet </h2>";
                            } else {
                                while ($row_date = mysqli_fetch_assoc($result)) {
                                    $costId = $row_date['cost_id'];
                                    $costname = $row_date['cost_type'];
                                    $amount = $row_date['amount'];
                                    $is_percentage = $row_date['is_percentage'];
                                    $percentage_rate = $row_date['percentage_rate'];
                                    if($is_percentage == 1){
                                        $status = 'Yes';
                                    }else{
                                        $status = 'No';
                                    }

                                    echo "<tr>

                                     <td> $costId </td>
                                     <td> $costname </td>
                                    <td> $amount </td>
                                    <td> $status </td>
                                    <td> $percentage_rate </td>

                                    <td class='action-links'>
                                    <a href='parameeter-management.php?costId=$costId' class='deactivate'> Delete </a> 
                                    </td>

                                     </tr>";
                                }
                            }
                            
                            ?>

                        </table>
                    </div>
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
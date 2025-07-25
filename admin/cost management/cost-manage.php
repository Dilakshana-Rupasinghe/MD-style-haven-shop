<?php
session_start();

// rederect user to the login if user not logingtothe system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}

// include the database configaration file
include('../../database/config.php');

if (isset($_POST['parameeterAdd'])) {

    //get user input data
    $paratype = $_POST['paratype'];
    $paraname = $_POST['paraname'];
    $price = $_POST['price'];

    //check fild is not empty
    if ($paraname != '' && $paratype != '' && $price != '') {
        // check if category alrady exists
        $fabricSelectQuiry = "SELECT * FROM cost_parameter WHERE para_name = '$paraname'";
        $result = (mysqli_query($con, $fabricSelectQuiry));
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('{$paraname} already exists');</script>";
            echo "<script>window.open('cost-manage.php', '_self');</script>";
        } else {

            $parameterInsertQary = "INSERT INTO cost_parameter (para_type, para_name, para_cost) VALUES ('$paratype', '$paraname', '$price')";

            if (mysqli_query($con, $parameterInsertQary)) {
                echo "<script>alert('New parameeter is added Successfully')</script>";
                echo "<script>window.open('cost-manage.php', '_self');</script>";
            }
        }
    }
}

// delete parameter if user click delete button
if (isset($_GET['paraId'])) {
    $paraId = $_GET['paraId'];

    $parameterDeleteQuire = "DELETE FROM cost_parameter WHERE para_id = $paraId"; //delete quary
    if (mysqli_query($con, $parameterDeleteQuire)) {
        echo "<script>alert('cost parameter type is deleted successfully');</script>";
        echo "<script>window.open('cost-manage.php', '_self');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Manage Customization Costs</title>
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
                    <a href="parameeter-management.php" class="manage-fabric-button">
                        Manage parameetr type
                        <span class="material-symbols-outlined" style="font-size:18px; padding-left: 7px; ">
                            request_quote
                        </span></a>

                    <?php
                    $invisible = '';
                    $invisible = ($_SESSION['staffId'] != 1001) ? 'invisible' : '';
                    // Admin has staff_type_id = 1001, Designer = 1006
                    if ($_SESSION['staffId'] == 1001) {
                        echo '<a href="../home pages/admin-home.php" class="back-button">Back</a>';
                    } else {
                        echo '<a href="#" class="' . $invisible . ' back-button disabled" style="pointer-events: none; opacity: 0.5;">Back</a>';
                    }
                    ?>
                </div>

                <h1>Cost management</h1>

                <div class="edit " style="margin-top: 3rem; width: 68rem">
                    <div class="change  col-8 " style="height: fit-content; width: 68rem">
                        <h3 class="text-center">Add new parameeter here</h3>

                        <form action="#" method="post" id="categoryAddForm" class="d-flex">
                            <!-- Category name -->
                            <div class="col-2.5">
                                <label for="paratype">parameetr Type</label> <br>
                                <input type="text" id="paratype" name="paratype" required>
                            </div>
                            <div class="col-2.5  ms-4 ">
                                <label for="paraname">parameeter name</label> <br>
                                <input type="text" id="paraname" name="paraname" required>
                            </div>
                            <div class="col-2.5 ms-4">
                                <label for="price">Price</label> <br>
                                <input type="number" id="price" name="price" required>
                            </div>
                            <div class="col-2" style="margin:30px 57px;">
                                <button type="submit" name="parameeterAdd" id="update"> Add </button>
                            </div>
                        </form>
                    </div>

                </div>

                <div>
                    <table>
                        <tr>
                            <th>Parameter Type ID</th>
                            <th>Parameter Type name</th>
                            <th>Parameter name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $get_paraDetail = "SELECT * FROM cost_parameter ";

                        $result = mysqli_query($con, $get_paraDetail);
                        $row_count = mysqli_num_rows($result);

                        if ($row_count == 0) {
                            echo "<h2 class='bg-danger text-center mt-5'>Np user yet </h2>";
                        } else {
                            while ($row_date = mysqli_fetch_assoc($result)) {
                                $paraid = $row_date['para_id'];
                                $paratype = $row_date['para_type'];
                                $paraname = $row_date['para_name'];
                                $paracost = $row_date['para_cost'];

                                echo "<tr>
                                
                                <td> $paraid </td>
                                <td> $paratype </td>
                                <td> $paraname </td>
                                <td> $paracost </td>

                                <td class='action-links'>
                                <a href='#' class='update'> Update </a> 
                                <a href='cost-manage.php?paraId=$paraid' class='deactivate'> Delete </a> 
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

</html>

<!-- close the DB connection -->
<?php
mysqli_close($con);
?>
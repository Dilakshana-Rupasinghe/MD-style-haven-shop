<?php
session_start();

// rederect user to login page if user not loggin
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}

// create database connection
include('../../database/config.php');


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff account details</title>

    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home.css">
    <link rel="stylesheet" href="../../css/back-style.css">

    <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <!-- top side navigation bar -->
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
                <!-- BACK button start -->
                <div class="back-button-container mt-1">
                    <a href="staff-management.php" class="back-button">Back</a>
                </div>
                <!-- BACK button end -->
                <h1>Staff manaement - view user details</h1>

                <!-- user details view table -->
                <table>

                    <?php
                    // get value from staff and staff type table
                    if (isset($_GET['staffId'])) {
                        $view_staff = $_GET['staffId'];


                        $get_staffdetails = "SELECT staff_id, staff_type_name, staff_fname, staff_lname, staff_username, staff_email, staff_nic, staff_phone, staff_add_line1, staff_add_line2, staff_add_line3, staff_add_line4, staff_hire_date, staff_is_active FROM staff
                    INNER JOIN staff_type ON staff.fk_staff_type_id = staff_type.staff_type_id
                    WHERE staff.staff_id = $view_staff "; //get user position form staff type table

                        $result = mysqli_query($con, $get_staffdetails);
                        $row_count = mysqli_num_rows($result);


                        //chect table row connt
                        if ($row_count == 0) {
                            echo "<h2 style='bg-danger text-center mt-5 '>no user yet</h2>";
                        } else {
                            while ($row_data = mysqli_fetch_assoc($result)) {
                                // assign values
                                $staff_id = $row_data['staff_id'];
                                $staff_type_name = $row_data['staff_type_name'];
                                $staff_name = $row_data['staff_fname'] . ' ' . $row_data['staff_lname'];
                                $staff_username = $row_data['staff_username'];
                                $staff_email = $row_data['staff_email'];
                                $staff_nic = $row_data['staff_nic'];
                                $staff_phone = $row_data['staff_phone'];
                                $staff_address = $row_data['staff_add_line1'] . ' ' . $row_data['staff_add_line2'] . ' ' . $row_data['staff_add_line3'] . ' ' . $row_data['staff_add_line4'];
                                $staff_hire_date = $row_data['staff_hire_date'];
                                $staff_is_active = $row_data['staff_is_active'];



                                // check is user actiive or deactive
                                $status = "Deactive";
                                if ($staff_is_active == 1) {
                                    $status = "Active";
                                }
                                echo "
                    <tr>
                        <th>Staff ID</th> 
                        <td>$staff_id</td>
                    </tr>
                    <tr>
                        <th>Staff Type </th>
                        <td>$staff_type_name</td>
                     </tr>
                    <tr>
                        <th>Name</th>
                        <td>$staff_name</td>

                     </tr>
                    <tr>
                        <th>User name</th>
                        <td>$staff_username</td>

                    </tr>
                    <tr>
                        <th> Email</th>
                        <td>$staff_email</td>

                    </tr>
                    <tr>
                        <th>NIC</th>
                        <td>$staff_nic</td>

                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td>$staff_phone</td>

                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>$staff_address</td>

                    </tr>
                    <tr>
                        <th>Hire Date</th>
                        <td>$staff_hire_date</td>

                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>$status</td>
                    </tr>";
                            }
                        }
                    }
                    ?>

                </table>
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

    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>

<!-- close database connection -->
<?php
mysqli_close($con);
?>
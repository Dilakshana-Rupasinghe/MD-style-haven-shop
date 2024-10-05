<?php
// include the database configaration file
include('../../database/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home.css">
    <link rel="stylesheet" href="../../css/back-style.css">

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
            <main class="mx-4">
                <!-- BACK & Register button start -->
                <div class="back-button-container mt-1">
                    <a href="staff-registration.php" class="Registration">Register</a>
                    <a href="../home pages/admin-home.php" class="back-button">Back</a>

                </div>

                <!--  BACK & Register button end -->
                <h1>Staff management</h1>
                <!-- Staff details  section start -->
                <table>
                    <tr>
                        <th>Staff ID</th>
                        <th>Staff Type</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <!-- get value from staff table and staff type table -->
                    <?php
                    $getStaffDetails = "SELECT staff_id, staff_type_name, staff_fname, staff_lname, staff_email, staff_username, staff_is_active FROM staff 
                 INNER JOIN staff_type ON staff.fk_staff_type_id = staff_type.staff_type_id"; //get user position from staff type tale

                    $result = mysqli_query($con, $getStaffDetails);
                    $row_count = mysqli_num_rows($result);


                    // check the table row count
                    if ($row_count == 0) {
                        echo "<h2 class='bg-danger text-center mt-5'> No user yet </h2>";
                    } else {
                        $number = 0;
                        while ($row_data = mysqli_fetch_assoc($result)) {
                            //  assigne to database valuse to variable 
                            $staff_id = $row_data['staff_id'];
                            $staff_type_name = $row_data['staff_type_name'];
                            $staff_name = $row_data['staff_fname'] . ' ' . $row_data['staff_lname'];
                            $staff_email = $row_data['staff_email'];
                            $staff_username = $row_data['staff_username'];
                            $staff_is_active = $row_data['staff_is_active'];
                            $number++;


                            // check the user is active or deactive
                            if ($staff_is_active == 1) {
                                $status = "Active";
                            } else {
                                $status = "Deactive";
                                $invisible = "invisible";
                            }

                            echo "<tr>
                        <td> $staff_id </td>
                        <td> $staff_type_name </td>
                        <td> $staff_name </td>
                        <td> $staff_email </td>
                        <td> $staff_username </td>
                        <td> $status </td>

                          <td class='action-links'>
                    <a href='#' class='view' >View</a> 
                    <a href='#' class='update'>Update</a>
                    <a href='#' class='deactivate'>Deactivate</a>
                    </td>
                        
                        </td>


                        </tr>
                        ";
                        }
                    }




                    ?>
                </table>
            </main>
            <!-- main section end -->

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

<?php
// cloce the database connection
mysqli_close($con);
?>
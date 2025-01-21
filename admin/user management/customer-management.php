<?php

// include the database configaration file
include('../../database/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer details</title>
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
                <!-- BACK button start -->
                <div class="back-button-container mt-1">
                    <a href="staff-management.php" class="back-button">Back</a>
                </div>
                <!-- BACK button end -->

                <h1>Customer management</h1>

                <!-- Staff details  section start -->
                <table>
                    <tr>
                        <th>Custiomer ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Status</th>

                    </tr>
                    <!-- get value from customer table -->
                    <?php
                    $get_custdetails = " SELECT * FROM customer ";
                    $result = mysqli_query($con, $get_custdetails);
                    $row_count = mysqli_num_rows($result);


                    //  check the table row count
                    if ($row_count == 0) {
                        echo "<h2 class='bg-danger text-center mt-5 '> No users yet </h2>";
                    } else {
                        $number = 0;
                        while ($row_data = mysqli_fetch_assoc($result)) {  // fatch a single row of result data an assosiative array
                            // assign to database value to variable 
                            $cust_id = $row_data['cust_id'];
                            $cust_name = $row_data['cust_fname'] . ' ' . $row_data['cust_lname'];
                            $cust_email = $row_data['cust_email'];
                            $cust_username = $row_data['cust_username'];
                            $cust_contact = $row_data['cust_phone'];
                            $cust_address = $row_data['cust_add_line1'] . '' . $row_data['cust_add_line2'] . '' . $row_data['cust_add_line3'] . '' . $row_data['cust_add_line4'];
                            $cust_is_active = $row_data['cust_is_active'];
                            $number++;

                            // chack the user deactive or active
                            if ($cust_is_active == 1) {
                                $status = 'Active';
                            } else {
                                $status = 'Deactive';
                            }
                            echo "<tr>
                        <td>$cust_id</td>
                        <td>$cust_name</td>
                        <td>$cust_email</td>
                        <td>$cust_username</td>
                        <td>$cust_contact</td>
                        <td>$cust_address</td>
                        <td>$status</td>
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
            <footer class="copyr fixed-bottom ">
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
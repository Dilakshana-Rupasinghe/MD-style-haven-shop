<?php
session_start();

// rederect user to the login if user not logingtothe system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}else{
    $staffId = $_SESSION['staffId'];
}
// include the database configaration file
include('../../database/config.php');


if(isset($_GET['FeedbackIdaccept'])){
    $feedback_id = $_GET['FeedbackIdaccept'];

    $updateFeedback = "UPDATE feedback SET feedback_status= 'Accept' , fk_staff_id =$staffId WHERE feedback_id = $feedback_id ";
    $Updateresult = mysqli_query($con, $updateFeedback);
}

if(isset($_GET['FeedbackIdcancle'])){
    $feedback_id = $_GET['FeedbackIdcancle'];

    $updateFeedback = "UPDATE feedback SET feedback_status= 'reject' , fk_staff_id =$staffId WHERE feedback_id = $feedback_id ";
    $Updateresult = mysqli_query($con, $updateFeedback);
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/fuck.css">
    <link rel="stylesheet" href="../../css/manage-button-1.css">

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

                    <a href="../home pages/admin-home.php" class="back-button">Back</a>
                </div>
                <!--  BACK & Register button end -->

                <h1>Feedback Management</h1>

                <table>
                    <tr>
                        <th>Feedback ID</th>
                        <th>Date</th>
                        <th>Customer name</th>
                        <th>product Id</th>
                        <th>Feedback</th>
                        <th>Status</th>
                        <th>Action </th>
                    </tr>

                    <?php

                    //get feedback data from DB
                    $getFeedbackData = "SELECT * FROM feedback ";

                    $result = mysqli_query($con, $getFeedbackData);
                    $row_count = mysqli_num_rows($result);


                    if ($row_count > 0) {
                        while ($row_data = mysqli_fetch_assoc($result)) {
                            $feedback_id = $row_data['feedback_id'];
                            $fk_item_id = $row_data['fk_item_id'];
                            $feedback_msg = $row_data['feedback_msg'];
                            $feedback_date = $row_data['feedback_date'];
                            $feedback_status = $row_data['feedback_status'] ?? null;
                            $fk_cust_id = $row_data['fk_cust_id'];

                            //to get customer name form customer table 
                            $getCustomerName = "SELECT * FROM customer WHERE cust_id=  $fk_cust_id ";
                            $resultCustomer = mysqli_query($con, $getCustomerName);
                            $row_count = mysqli_num_rows($resultCustomer);

                            if ($row_count > 0) {
                                while ($row_data = mysqli_fetch_assoc($resultCustomer)) {
                                    $cust_fname = $row_data['cust_fname'];

                                    //get combination of cust ID and  Firt name of customer 
                                    $cust_details =  $fk_cust_id . '-' .   $cust_fname;

                                    echo "
                        <tr>
                  <td> $feedback_id </td>
                  <td> $feedback_date </td>
                  <td> $cust_details  </td>
                  <td> $fk_item_id </td>
                  <td> $feedback_msg </td>
                  <td> $feedback_status </td>
                  <td class='action-links'>
                   <a href='feedback-manage.php?FeedbackIdaccept=$feedback_id' class='view'>Accept</a> 
                   <a href='feedback-manage.php?FeedbackIdcancle=$feedback_id' class='deactivate'>Cancle</a>
                  
                  </td>
              </tr>";
                                }
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
<?php
session_start();
if (isset($_SESSION['custId'])) {
    $custId = $_SESSION['custId'];
}

// Include the database configuration file
include('database/config.php');

//get data form inquary form using post method
if (isset($_POST['sendinquary'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $messege = $_POST['message'];
        $custId = isset($_SESSION['custId']) ? $_SESSION['custId'] : NULL; //get session data to pass data to DB
        if ($name !='' and $email !='' and $messege !='') {

            //if user not registerd then the Cust ID should be null
            $custIdValue = $custId !== NULL ? $custId : 'NULL';
            // insert quary
            $inquaryInsertQary = "INSERT INTO inquiry(inquiry_date,sender_name,email,inquiry_msg,inquary_status,fk_cust_id) VALUES (NOW(), '$name', '$email', '$messege','pending', $custIdValue)";

            $result = mysqli_query($con, $inquaryInsertQary);

            if ($result) {
                echo "<script>alert('Inquary successful Send!');</script>";
                echo "<script>window.open('contact-us.php', '_self');</script>";
            } else {
                echo "<script>alert('SQL error!');</script>";
            }
        }
} 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- material icons css link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- <link rel="stylesheet" href="css/home-style.css"> -->
    <link rel="stylesheet" href="css/home-all-style.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>MD-Style Haven shop/online shoping-Home page</title>
</head>


<body>
    <!-- navigation bar start -->
    <?php
    include('includes/navbar.php');
    ?>
    <!-- navigaton bar  end -->

    <section class="contact-us">
        <div class="container">
            <div class="contact-info">
                <h1>Contact Us</h1>
                <p>If you have any questions or need assistance, feel free to reach out to us. We're here to help!</p>
                <div class="contact-details">
                    <p><strong>Email:</strong> mdstylehaven@gmail.com</p>
                    <p><strong>Phone:</strong> +94 70 120 1347</p>
                    <p><strong>Address:</strong> No 01, MD-Styele Haven shop, Rathnapura Road, Avissawella.</p>
                    <p><strong>Working Hours:</strong> Mon - Sat: 9:00 AM - 6:00 PM</p>
                </div>
            </div>
            <div class="contact-form">
                <h2>Get in Touch</h2>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" name="sendinquary" class="submit-btn">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- footer section -->
    <?php
    include('includes/footer.php');
    ?>
    <!-- footer end -->
    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>
<!-- close the DB connection -->
<?php
mysqli_close($con);
?>
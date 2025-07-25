<?php
session_start();

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

function sebdemail_reply($sender_name, $email, $inquiry_msg, $Reply)
{
    // Create an instance; passing `true` enables exceptions
    $mailrply = new PHPMailer(true);

    try {
        // Server settings
        $mailrply->isSMTP();                                            // Send using SMTP
        $mailrply->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        // $mailrply->SMTPDebug = 0;                                    // Disable verbose debug output
        $mailrply->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mailrply->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mailrply->Username   = 'malindudilak@gmail.com';               // SMTP username
        $mailrply->Password   = 'bhmv fuxd amnl cqai';                  // SMTP password
        $mailrply->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
        $mailrply->Port       = 587;                                    // TCP port to connect to (587 for TLS)
        // $mailrply->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL encryption
        // $mailrply->Port = 465;

        // Optional: Disable strict SSL verification (Temporary for debugging)
        $mailrply->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        // Recipients
        $mailrply->setFrom('mdstylehaven@gmail.com', 'MD-Style Haven');
        $mailrply->addAddress($email, $sender_name);    // Add recipient with full name

        // Content
        $mailrply->isHTML(true);                                        // Set email format to HTML
        $mailrply->Subject = 'Inquary Reply from MD-Style Haven';
        $mailrply->Body    = "
              <h2>Welcome to MD-Style Haven!</h2>
              <p>Dear $sender_name ,</p>
              <p>Thank you for interact with us. Your Inquary was:</p>
              <h4><i>$inquiry_msg</i></h4>
              <br>
              <p>Solution.</p>
              <h4>$Reply</h4>
              <p>If you have any issue, we can help to you.</p>
          ";

        // Send email
        $mailrply->send();
        echo "<script>alert('Reply has been sent to Customer email!');</script>";

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mailrply->ErrorInfo}";
    }
}




// rederect user to the login if user not logingtothe system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}else{
    $staffId = $_SESSION['staffId'];
}
// include the database configaration file
include('../../database/config.php');

if (isset($_GET['InquaryId'])) { //get item detail from item id
    $inquiry_id = $_GET['InquaryId'];

    $getInquaryData = "SELECT * FROM inquiry WHERE inquiry_id= $inquiry_id ";

    $result = mysqli_query($con, $getInquaryData);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        while ($row_data = mysqli_fetch_assoc($result)) {
            $inquiry_id = $row_data['inquiry_id'];
            $sender_name = $row_data['sender_name'];
            $email = $row_data['email'];
            $inquiry_msg = $row_data['inquiry_msg'];

        }
    }
}
$_SESSION['sender_name'] =  $sender_name ;
$_SESSION['email'] =  $email ;
$_SESSION['inquiry_msg'] =  $inquiry_msg ;

$sender_name = isset($_SESSION['sender_name']) ?  $_SESSION['sender_name']  : "N/A";
$email = isset($_SESSION['email']) ?  $_SESSION['email']  : "N/A";
$inquiry_msg = isset($_SESSION['inquiry_msg']) ?  $_SESSION['inquiry_msg']  : "N/A";


if(isset($_POST['ReplyQuary'])){
    $Reply =$_POST['Reply'];

    $updateInquaryDetails = "UPDATE inquiry SET inquary_status ='complete', inquiry_reply='$Reply' ,inquiry_reply_date = NOW() , fk_staff_id = $staffId Where inquiry_id = $inquiry_id ";
    $result = mysqli_query($con, $updateInquaryDetails);

    
    if ($result) {
        sebdemail_reply("$sender_name", "$email", "$inquiry_msg", "$Reply");
        echo "<script>window.open('inquary-manage.php', '_self');</script>";

    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquary management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home-all-style.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <!-- <link rel="stylesheet" href="../../css/fuck.css"> -->
    <link rel="stylesheet" href="../../css/styles.css">

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

                    <a href="inquary-manage.php" class="back-button">Back</a>
                </div>
                <!--  BACK & Register button end -->

                <h3>Send Reply - To <i> <?php echo $sender_name ?> </i></h3>
                <div class="contact-form mx-4 mt-2 mb-5">
                    <form action="#" method="post">
                            <label for="email"><strong>Customer Email- </strong> <i><?php echo $email ?></i></label> <br>
                            <label class="d-flex col-10 my-3 ms-3 p-2 bg-white" for="inquary"><strong>Customer Inquary- </strong> <?php echo $inquiry_msg ?></label>
                        <div class="form-group mt-4">
                            <label class="d-flex " for="message">Reply</label>
                            <textarea id="message" name="Reply" rows="5" required></textarea>
                        </div>
                        <button type="submit" name="ReplyQuary" class="submit-btn">Send Message</button>
                    </form>
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


    <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<!-- close database connection -->
<?php
mysqli_close($con);
?>
<?php
//start session
session_start();

// include the database configureation file 
include('database/config.php');

if(isset($_POST['verify-otp']))
{
    $enterdotp = $_POST['enter-otp']; // user enterd otp

    //get email form signup page
    if(isset($_SESSION['email']))
    {
        $email = $_SESSION['email'] ;
  
        // Fetch the OTP from the database for the provided email
        $getdataQuary = "SELECT otp FROM customer WHERE cust_email = '$email' ";

        $result = mysqli_query($con, $getdataQuary);
        $row_count = mysqli_num_rows($result);

        if($row_count > 0)
        {
            $row_data = mysqli_fetch_assoc($result);
            $storedotp = $row_data['otp'];


            // Check if the entered OTP matches the stored OTP
            if($storedotp == $enterdotp)
            {
                // OTP matches, update the user's status as verified
                $updateQuary = "UPDATE customer SET is_verify = 1 WHERE cust_email = '$email' ";

                $updateresult = mysqli_query($con, $updateQuary);

                if($updateQuary)
                {
                    echo "<script>alert('OTP verified successfully! Your account is now active.');</script>";
                    echo "<script>window.location.href = 'login.php';</script>";

                    // header('Location: login.php');
                    // exit();
                }else{
                    echo "<script>alert('An error occurred while updating the verification status. Please try again later.');</script>";
                }

            }else{
                echo "<script>alert('Invalid OTP. Please try again.');</script>";
            }
        }else{
            echo "<script>alert('No OTP found for the provided email. Please try registering again.');</script>";
        }
    }else{
        echo "<script>alert('Session expired. Please try registering again.');</script>";
    }
}

?>



<!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Verify OTP</title>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 </head>

 <body>
     <div class="container vh-100 d-flex justify-content-center align-items-center">
         <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%;">
             <h4 class="text-center mb-4">Verify Email using OTP</h4>
             <form action="#" method="post">
                 <div class="mb-3">
                     <label for="otp" class="form-label">Enter OTP</label>
                     <input type="text" class="form-control" id="enter-otp" name="enter-otp" placeholder="Enter OTP" required>
                 </div>
                 <button type="submit" class="btn btn-primary w-100" name="verify-otp">Verify</button>
             </form>
         </div>
     </div>
     <!-- Bootstrap Bundle JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 </body>

 </html>
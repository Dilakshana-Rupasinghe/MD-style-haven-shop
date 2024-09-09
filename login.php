<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="login.css">

    <title>MD-Style Haven shop/online shoping-Home page</title>
</head>

<body>
    <!-- navigation bar start -->
    <?php
    include('includes/navbar.php');
    ?>
    <!-- navigaton bar  end -->


    <!-- </div> -->
    <div class="container row my-5 mx-auto ">
        <div class="col-md-5 mx-auto ">
            <div class="wrapper">
                <form action="#" class="login">
                    <h1 class="text-center">MD-Style Haven</h1>
                    <h2 class="text-center">Log-in</h2>
                    <div class="input-box">
                        <input type="text" name="username" placeholder="USERNAME" required>
                    </div>

                    <div class="input-box">
                        <input type="password" name="password" placeholder="PASSWORD" required>
                    </div>
                    <div class="remember-me">
                        <label> <input type="checkbox" name="rememberme"> Remember ME </label>
                        <a href="#" class="ps-3 "> Froget-password?</a>
                    </div>

                    <button type="submit" class="submit btn-dark " name="login">Log-in</button>
                    <div class="register-link">
                        <h6>Don't have an account <a href="#" class="ps-3 ">Sign-In</a></h6>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- footer section -->

    <footer class="footer-section">
        <div class="container ">
            <div class="row mt-2 pt-4">
                <div class="col-3 ">
                    <h4>Who we are</h4>
                    <p>
                        Junky Books was started in 2024 with the vision of buying
                        cloths online in a wide range of digital formats.
                    </p>
                </div>
                <div class="col-2 mx-2 ">
                    <h4 class="mx-3 ">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="Index.html">Home</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-4">
                    <h4 class="mx-3 ">Contact</h4>
                    <ul class="footer-links">
                        <li>For Product Advice : +94 70 120 1347</li>
                        <li> For Delivery Details : +94 11 234 456</li>
                        <li> Email : <a href="#" class="email">sathsarabooks@gmail.com</a></li>
                    </ul>
                </div>
                <div class="col-2">
                    <h4> Location </h4>
                    <address>
                        No 01,<br>
                        Sathsara Book shop,<br>
                        Dehiovita Road,<br>
                        Deraniyagala.
                    </address>
                </div>
            </div>
            <hr>
            <div class="container ">
                <div class="row mt-1 ">
                    <div class="col-6 mb-3  ">
                        <h4> Shoicial links</h4>
                        <ul class="social-links">
                            <li>
                                <a href="#" class="facebook"> <img src="icons/facebook-circle-fill.svg" alt=""
                                        style="width: 38px; padding-bottom: 5px;"> </a>
                            </li>
                            <li>
                                <a href="#" class="whatsapp"> <img src="icons/whatsapp-line.svg" alt=""
                                        style="width: 38px; padding-bottom: 5px;"></a>
                            </li>
                            <li>
                                <a href="#" class="instergrame"> <img src="icons/instagram-fill.svg" alt="no image"
                                        style="width: 38px; padding-bottom: 5px;"></a>
                            </li>
                            <li>
                                <a href="#" class="tiktok"> <img src="icons/tiktok-line.svg" alt=""
                                        style="width: 38px; padding-bottom: 5px;"> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <footer class="copyr">
        <div class="container ">
            <div class="row col-12 pt-3 ">
                <p class="copy-right">Copyright &COPY; 2024 SATHSAR BOOK SHOP | Develop by - <a href="#"> Malindu
                    </a> </p>
            </div>
        </div>
    </footer>


</body>

</html>
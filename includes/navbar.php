<nav class="navbar navbar-expand-lg bg-body-secondary  sticky-top py-0">
    <div class="container-fluid">
        <a class="navbar-brand ms-2 me-auto" href="Index.php">
            <img src="images/logo 1.jpg" alt="logo" style="height: 85px; width: 120px;" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item ms-3 ">
                    <a class="nav-link " href="Index.php">Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="#"> Categorys </a>
                </li>
                <li class=" nav-item ">
                    <a class="nav-link " href="#">Customize</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="#">About us</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="#">Contact us</a>
                </li>
            </ul>

            <!-- right  nav bar -->
            <ul class="navbar-nav ms-auto ">
                <?php
                if (!isset($_SESSION['custId'])) {
                    $displayNone = "";
                } else {
                    $displayNone = "d-none";
                }
                ?>
                <li class="<?php echo $displayNone; ?> nav-item">
                    <a class="nav-link " href="sign-up.php">Sign up</a>
                </li>
                <li class="<?php echo $displayNone; ?> nav-item me-2">
                    <a class="nav-link " href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-img position-relative me-1" href="#"><img src="icons/cart-2-line.svg" style="width: 32px;"> -->
                    <a class="nav-link " href="#" style="color:black;">
                        <span class="material-symbols-outlined">
                            shopping_cart
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-img me-3" href="#"><img src="icons/profile-line.svg" style="width: 32px;"></a>  -->
                    <a class="nav-link " href="profile.php" style="font-size: 19px; color:black;">
                        <span class="material-symbols-outlined">
                            account_circle
                        </span>
                    </a>

                </li>
            </ul>
        </DIV>
    </div>
</nav>
<?php
include('function/commen-function.php');
$current_page = basename($_SERVER['PHP_SELF']); // to idintifi current loded page 
?>
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
                    <a class="nav-link <?php echo($current_page == 'Index.php')? 'fw-bold text-decoration-underline': ''; ?> " href="Index.php">HOME</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> CATEGORY </a>
                    <ul class="dropdown-menu">
                        <?php
                        $categorySelectQuiey = "SELECT * FROM category ORDER BY category_name"; //select quary

                        $result = mysqli_query($con, $categorySelectQuiey); //exicute SQL quary
                        $row_count = mysqli_num_rows($result); // get row count

                        if ($row_count > 0) {
                            $textBgColor = "";
                            while ($row_data = mysqli_fetch_assoc($result)) {

                                //apply background color if the category is selected 
                                if (isset($_GET['categoryId'])) {
                                    if ($_GET['categoryId'] == $row_data['category_id']) {
                                        $textBgColor = 'text-bg-dark';
                                    } else {
                                        $textBgColor = ""; // remove bagroound color class 

                                    }
                                }
                                //display category in dropdown menu
                                echo "<li> <a class='dropdown-item $textBgColor' href='collections.php?categoryId={$row_data['category_id']}&categoryName={$row_data['category_name']}'>{$row_data['category_name']} </a> </li>";
                            }
                        } else {
                            //display not available if there is no category
                            echo "<li><a class='dropdown-item'>Not Available Category</a></li>";
                        }
                        ?>

                    </ul>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php echo($current_page == 'about-us.php')? 'fw-bold text-decoration-underline':''; ?> " href="about-us.php">ABOUT-US </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php echo ($current_page == 'contact-us.php') ? 'fw-bold text-decoration-underline' : ''; ?>" href="contact-us.php">CONTACT-US </a>
                </li>
                <?php
                if (!isset($_SESSION['custId'])) {
                    $displayNonecustom = "d-none";
                } else {
                    $displayNonecustom = "";
                }
                ?>
                <li class="<?php echo $displayNonecustom; ?> nav-item">
                    <a class="nav-link <?php echo ($current_page == 'customize-cloth.php') ? 'fw-bold text-decoration-underline' : ''; ?>" href="customize-cloth.php">CUSTOMIZE</a>

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
                    <a class="nav-link <?php echo($current_page == 'sign-up.php')? 'fw-bold text-decoration-underline' : '';?> " href="sign-up.php">Sign up</a>
                </li>
                <li class="<?php echo $displayNone; ?> nav-item me-2">
                    <a class="nav-link <?php echo($current_page == 'login.php')? 'fw-bold text-decoration-underline' : '';?> " href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php" style="color:black;">
                        <span class="material-symbols-outlined <?php echo($current_page == 'cart.php')? 'text-decoration-underline' : '';?>">
                            shopping_cart
                        </span>
                        <?php
                        if (isset($_SESSION['custId'])) {
                        ?>
                            <span class="position-absolute top-00 start-10 translate-middle badge rounded-pill bg-danger">
                                <?php echo getNoOfCartItem($con); ?>
                            </span>
                        <?php } ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="profile.php" style="font-size: 19px; color:black;">
                        <span class="material-symbols-outlined <?php echo($current_page == 'profile.php')? 'text-decoration-underline' : '';?>">
                            account_circle
                        </span>
                    </a>

                </li>
            </ul>
        </DIV>
    </div>
</nav>
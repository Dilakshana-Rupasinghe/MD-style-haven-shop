<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home.css">
    <!-- material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>
    <!-- navigation bar start -->
    <?php
    include('../../includes/admin-navigation.php');
    ?>


    <div class="container-body">
        <!-- menu section start -->
        <aside class="left-menu">
            <h3 class="ms-4 mt-2"> MENU
                <span class="material-symbols-outlined">
                    menu
                </span>
            </h3>
            <div class="menu">
                <span class="material-symbols-outlined">
                    dashboard
                </span>
                <a href="admin-home.php"> Dashboard</a>
            </div>
            <div class="menu">
                <span class="material-symbols-outlined">
                    orders
                </span>
                <a href="#"> Orders</a>

            </div>
            <div class="menu">
                <span class="material-symbols-outlined">
                    inventory
                </span>
                <a href="#"> Inventory </a>

            </div>
            <div class="menu">
                <span class="material-symbols-outlined">
                    tune
                </span>
                <a href="#"> Customization </a>

            </div>
            <div class="menu">
                <span class="material-symbols-outlined">
                    support_agent
                </span>
                <a href="#"> Inquary </a>
            </div>
            <div class="menu">
                <span class="material-symbols-outlined">
                    report
                </span>
                <a href="#"> Reports </a>

            </div>
            <div class="menu">
                <span class="material-symbols-outlined">
                    group_add
                </span>
                <a href="#"> Staff </a>

            </div>
            <div class="menu">
                <span class="material-symbols-outlined">
                    manage_accounts
                </span>
                <a href="#"> Customer</a>

            </div>
            <div class="menu">
                <span class="material-symbols-outlined">
                    feedback
                </span>
                <a href="#"> feedbacks </a>

            </div>
            <div class="menu mb-2">
                <span class="material-symbols-outlined">
                    local_shipping
                </span>
                <a href="#"> Dilivery </a>

            </div>
        </aside>
        <!-- menu section end -->

        <!-- main section start -->
        <main class="ms-4">
            <h1>Main</h1>
        </main>
        <!-- main section end -->

        <!-- right section start -->
        <div class="right me-4">
            <h1>right</h1>
        </div>
        <!-- right cestion end -->
    </div>


    <!-- footer section start -->
    <div>
        <footer class="copyr">
            <div class="container ">
                <div class="row col-12 pt-3 ">
                    <p class="copy-right">Copyright &COPY; 2024 MD-Style Haven SHOP | Develop by - <a href="#"> Malindu </a> </p>
                </div>
            </div>
        </footer>
    </div>
    <!-- footer section end -->
</body>

</html>
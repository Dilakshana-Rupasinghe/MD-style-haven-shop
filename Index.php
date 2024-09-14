<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!-- material icons css link -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />    <link rel="stylesheet" href="css/home.css">
    <title>MD-Style Haven shop/online shoping-Home page</title>
</head>


<body >
    <!-- navigation bar start -->
<?php
include('includes/navbar.php');
?>
    <!-- navigaton bar  end -->

<div class="bg-light pt-1 pb-4 ">


    <h4 class="text-center my-3  text-primary-emphasis ">Welcome to <span
            style="text-transform:uppercase; color: rgb(43, 92, 226);">" MD-Style heven" </span> - online Shoping
    </h4>

    <!-- serch item -->
    <div class="container col-7">
        <form action="#" method="get" class="search d-flex  my-4 ">
            <input type="text" class="me-3 search-bar fw-semibold form-control py-1" placeholder="Search here"
                name="searchName" required>
            <button type="submit" class=" rounded-2 py-1 px-3 fw-semibold" name="search"> Search</button>
        </form>

    </div>
    <!-- cearch item end -->

</div>

    <!-- cover image -->
    <!-- <div class="carousel slide ">
        <div class="carousel-inner ">
            <div class="cover-image carousel-item active ">
                <img src="images/log4.jpg" class="rounded d-block w-100 " alt="...">
            </div>
        </div>
    </div> -->

    <!-- Product table -->

    <div class="container ">
        <div class="all-product my-3 ">
            <h2> NEW ARRIVALS  </h2>
            <hr>
            <table class="new-arrivals-tbl" >
                <tr>
                    <td>
                        <img src="images/POLO 1.jpg" alt="" style="width: 210px;">
                        <h6 > POLO T-SHIRT <br> SIGNATURE V NECK </h6>
                        <p>Rs : 3299.99  </p>
                        <button class="btn" onclick="Buynow()">Add to Cart</button>
                    </td>
                    <td>
                        <img src="images/T T2.jpg" alt="" style="width: 220px;">
                        <h6> GRAPHIC T-SHIRT <br> Tropic Night Tee</h6>
                        <p>Rs: 5900.00</p>
                        <button class="btn" onclick="Buynow()">Add to Cart</button>

                    </td>
                    <td>
                        <img src="images/tt3.jpg" alt="" style="width: 190px;">
                        <h6> POLO T-SHIRT <br> TURQUOISE LINEN</h6>
                        <p>Rs : 3599.99</p>
                        <button class="btn" onclick="Buynow()">Add to Cart</button>

                    </td>
                    <td>
                        <img src="images/tt4.jpg" alt="" style="width: 190px;">
                        <h6>GRAPHIC T-SHIRT <br> OVERSIZE </h6>
                        <p>Rs : 4890.99 </p>
                        <button class="btn" onclick="Buynow()">Add to Cart</button>

                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="images/DD1.jpg" alt="" style="width: 210px;">
                        <h6 > BEIGE MID RISE  <br>SLIM FIT PANTS </h6>
                        <p>Rs : 5399.99  </p>
                        <button class="btn" onclick="Buynow()">Add to Cart</button>
                    </td>
                    <td>
                        <img src="images/DD2.jpg" alt="" style="width: 210px;">
                        <h6>BEIGE MID RISE LINEN  <br> SLIM FIT PANTS</h6>
                        <p>Rs: 5900.00</p>
                        <button class="btn" onclick="Buynow()">Add to Cart</button>

                    </td>
                    
                </tr>
            </table>

            <h2 class="my-3 "> TOP DESIGNS </h2>
            <hr>
            <table class="top-design-tbl">
                <tr>
                    <td>
                        <img src="images/tt5.jpg" alt="" style="width: 200px;">
                        <BR></BR>
                        <h6>GRAPHIC T-SHIRT</h6>
                        <button class="btn" onclick="Buynow()"> Add to Cart </button>
                    </td>
                    <td>
                        <img src="images/tt8.jpg" alt="" style="width: 200px;">
                        <BR></BR>
                        <h6> PRINTED T-SHIRT</h6>
                        <button class="btn" onclick="Buynow()">Add to Cart</button>
                    </td>
                    <td>
                        <img src="images/tt6.jpg" alt="" style="width: 210px;">
                        <BR></BR>
                        <BR></BR>
                        <h6> UNIFORMS </h6>
                        <button class="btn" onclick="Buynow()">Add to Cart</button>
                    </td>
                    <td>
                        <img src="images/tt7.jpg" alt="" style="width: 200px;">
                        <BR></BR>
                        <h6>AVURUDU SASHES</h6>
                        <button class="btn" onclick="Buynow()"> Add to Cart</button>
                    </td>
                </tr>

            </table>

        </div>

    </div>

    <!-- footer section -->
     <?php 
        include('includes/footer.php');
     ?>
    <!-- footer end -->
      <!--Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

<script>
    function Buynow(){
        alert("Successfully Buying");

    }
</script>

</html>
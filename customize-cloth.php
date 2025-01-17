<?php
session_start();


//database connection
include('database/config.php');


// initial store variables 
$Descriptions = []; // Array to hold customization details
$totalCost = 0;
$quantity = '';
$size = '';
$clothingTypename = '';
$fabricTypename = 'N/A';
$fabricTypenamecost = 0;
$neckTypename = 'N/A';
$neckTypenamecost = 0;
$downPayment = 0;
$logocost = 0;
$imagecost = 0;
$additionalTextcost = 0;
$balance = 0;

// get data from form
if (isset($_POST['custome_confirm'])) {

    //rederect to the login page if user is not login
    if (!isset($_SESSION['custId'])) {
        header('location:login.php');
        exit();
    } else {
        $custId = $_SESSION['custId'];
    }


    // Fetch form inputs
    $clothingType = $_POST['clothingType'];
    $sizeOption = $_POST['sizeOption'];

    // stransed size
    $Standard = $_POST['standardSize'];

    //coutom size 
    $Neck_grith = 'Neck-grith=' . $_POST['Neck-grith'];
    $chest = 'chest=' . $_POST['chest'];
    $Hip = 'Hip=' . $_POST['Hip'];
    $Shoulder = 'Shoulder=' . $_POST['Shoulder'];
    $waist = 'waist=' . $_POST['waist'];
    $length = 'length=' . $_POST['length'];
    $Thigh = 'Thigh=' . $_POST['Thigh'];
    $Front_rise = 'Front_rise=' . $_POST['Front_rise'];
    $Hem_Open = 'Hem_Open=' . $_POST['Hem_Open'];

    //all custome size store in one variable 
    $custom_size = $Neck_grith . ' ' . $chest . ' ' . $Hip . ' ' . $Shoulder . ' '
        . $waist . ' ' . $length . ' ' . $Thigh . ' ' . $Front_rise . ' ' . $Hem_Open;

    $fabric = $_POST['fabric'];
    // $fabricColor = $_POST['fabricColor'];
    $neckType = $_POST['neckType'];
    $sleeveLength = $_POST['sleeveLength'];
    $fitStyle = $_POST['fitStyle'];
    $quantity = $_POST['Quntity'];
    $logo =  $_POST['logo'];
    $image =  $_POST['image'];
    $additionalText = $_POST['additionalText'];
    $sample_design =  $_POST['sample_design'];
    $dateRequired = $_POST['dateRequired'];
    $ideadetails = $_POST['ideadetails'];

    //get size values form standard or custom and save it in one variable 
    if ($sizeOption == 'standard') {
        $size =  $Standard;
    } else if ($sizeOption == 'custom') {
        $size =  $custom_size;
    }

    if ($clothingType) {
        $query = "SELECT * FROM cost_parameter WHERE para_id = '$clothingType'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $clothingTypename = $row['para_name'];
        $clothingTypenamecost = $row['para_cost'];
        $totalCost += $row['para_cost'];
    }

    if ($fabric) {
        $query = "SELECT * FROM fabric_type WHERE fabric_Type_name = '$fabric'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $fabricTypenamecost = $row['fabric_cost'];
        $totalCost += $row['fabric_cost'];
    }

    if ($neckType) {
        $query = "SELECT * FROM cost_parameter WHERE para_id = '$neckType'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $neckTypename = $row['para_name'];
        $neckTypenamecost = $row['para_cost'];
        $totalCost += $row['para_cost'];
    }

    if ($sleeveLength) {
        $query = "SELECT * FROM cost_parameter WHERE para_id = '$sleeveLength'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $lengthTypename = $row['para_name'];
        $lengthTypenamecost = $row['para_cost'];
        $totalCost += $row['para_cost'];
    }

    if ($logo) {
        $query = "SELECT * FROM cost_parameter WHERE para_type = 'logo'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $logocost += $row['para_cost'];

        $totalCost += $logocost;
    }

    if ($image) {
        $query = "SELECT * FROM cost_parameter WHERE para_type = 'image'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $imagecost += $row['para_cost'];

        $totalCost += $imagecost;
    }

    if ($additionalText) {
        $query = "SELECT * FROM cost_parameter WHERE para_type = 'letter'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $additionalTextcost += $row['para_cost'];

        $totalCost += $additionalTextcost;
    }

    // Array to hold item names

    // Multiply by quantity to calculate total cost
    $totalCost *= $quantity;


    //down pay calculation
    $query = "SELECT * FROM additional_cost WHERE cost_type = 'Advance pay'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $advance = $row['percentage_rate'];
    $downPayment = $totalCost * $advance  / 100;

    //balance calculation
    $balance = $totalCost - $downPayment;

    // customization type store session data 
    $_SESSION['sizeOption'] = $sizeOption;
    $_SESSION['fabricTypename'] = $fabric;
    $_SESSION['neckTypename'] = $neckTypename;
    $_SESSION['fitStyle'] = $fitStyle;
    $_SESSION['quantity'] = $quantity;
    $_SESSION['logo'] = $logo;
    $_SESSION['image'] = $image;
    $_SESSION['additionalText'] = $additionalText;
    $_SESSION['ideadetails'] = $ideadetails;
    $_SESSION['dateRequired'] = $dateRequired;
    $_SESSION['totalCost'] = $totalCost;



    //strore price here as a session data 
    $_SESSION['clothingTypenamecost'] = $clothingTypenamecost;
    $_SESSION['neckTypecost'] = $neckTypenamecost;
    $_SESSION['quantity'] = $quantity;
    $_SESSION['totalCost'] = $totalCost;

    if (isset($_SESSION['balance'])) {
        $balance = $_SESSION['balance'];
        $balance = isset($_SESSION['balance']) ?  $_SESSION['balance']  : 0;
    }
    // Redirect or confirm
    echo "<script>alert('Customization saved! Total Cost: LKR $totalCost');</script>";
    echo "<script>window.open('checkout-customization.php', '_self');</script>";
}



//store data in session 
$_SESSION['clothingTypename'] = $clothingTypename;
$_SESSION['size'] = $size;
$Descriptions[] = $clothingTypename . ' ' . $fabricTypename . ' ' . $neckTypename . ' ' . " (Qty: $quantity)";
$_SESSION['checkout_items'] = implode(", ", $Descriptions);
$_SESSION['fabricTypenamecost'] = $fabricTypenamecost;
$_SESSION['logocost'] = $logocost;
$_SESSION['imagecost'] = $imagecost;
$_SESSION['additionalTextcost'] = $additionalTextcost;
$_SESSION['downpayment'] = $downPayment;
$_SESSION['checkout_total_price'] = $downPayment * 100; // Convert to cents to show in sprite pay
$balance = isset($_SESSION['balance']) ?  $_SESSION['balance']  : 0;

if(isset($_POST['history'])){
    echo "<script>window.open('customize-cloth-history.php', '_self');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Your Clothing - MD Style Haven</title>
    <!-- material icons css link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- <link rel="stylesheet" href="css/home.css"> -->
    <link rel="stylesheet" href="css/home-all-style.css">

    <!-- <link rel="stylesheet" href="css/login.css"> -->
</head>

<body>

    <!-- navigation bar start -->
    <?php
    include('includes/navbar.php');
    ?>
    <!-- navigaton bar  end -->
    <form action="#" method="post">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" name="history" class="col-2 mx-5 mt-3 text-dark p-2 " style="border-radius: 10px;">
               <strong> CUSTOMIZATION HISTORY </strong>
            </button>
        </div>
    </form>

    <div class="container my-3">
        <h1 class="text-center mb-4">Customize Your Clothing</h1>
        <form id="customizeClothForm" action="#" method="POST" class="row g-3 pt-4">

            <!-- Type of Clothing -->
            <div class="custom-size" style=" border: 2px solid rgb(5, 5, 5);  padding: 20px;
            border-radius: 5px;
              ">
                <div class="cloth-type col-md-6 ms-5 mb-3">

                    <label for="clothingType" class="form-label" style="font-weight: 700; font-size: 20px;">Type of Clothing:</label>
                    <select id="clothingType" name="clothingType" class="form-select ms-3" required>
                        <option value="">Select Clothing Type</option>
                        <?php
                        $clothTypeSelectQuiry = "SELECT * FROM cost_parameter WHERE para_type = 'cloth_type'";

                        // execute quiry and get the result
                        $costTypeResult = mysqli_query($con, $clothTypeSelectQuiry);

                        // fetch staff type
                        while ($clothTypeRowdata = mysqli_fetch_assoc($costTypeResult)) {
                            $paraname = $clothTypeRowdata['para_name'];
                            $paracost = $clothTypeRowdata['para_cost'];
                            // add staff types into drop down menu
                            echo "<option value='{$clothTypeRowdata['para_id']}'> {$clothTypeRowdata['para_name']} </option>";
                        }

                        //store fabric data in session
                        $_SESSION['para_cloth_type_cost'] = $paracost;
                        $_SESSION['fabric_Type_name'] =   $paraname;
                        ?>
                    </select>
                    <!-- add quntities -->
                    <div class="col-md-8  mt-3 ">
                        <label for="Quntity" class="form-label"><strong>Quntity</strong></label>
                        <input type="number" id="Quntity" name="Quntity" class="form-control ms-3" min="1" placeholder="add quntities here" required>
                    </div>
                </div>


            </div>

            <div class="custom-size" style=" border: 2px solid rgb(5, 5, 5);  padding: 20px;
            border-radius: 5px;
              ">

                <!-- Personal Measurements or Standard Sizes -->
                <fieldset class="col-12">
                    <legend><strong>Size Details </strong></legend>
                    <div class="mb-3 ">
                        <label for="sizeOption" class="form-label">Choose Size Option:</label>
                        <select id="sizeOption" name="sizeOption" class="form-select" required>
                            <option value="">Select Option</option>
                            <option value="standard">Standard Sizes</option>
                            <option value="custom">Personal Measurements</option>
                        </select>

                        <div class="col-md-4 pt-4" style="display: flex;">
                            <label for="Size-guidlines" class="form-label">Size-guidlines (in Inch):</label>
                            <img src="images/pants mesurments.jpeg" style="height: 20rem; width: 35rem;" alt="Size-guidlines">
                            <div class="ps-5 pt-4" style="display: grid;">
                                <img src="images/size guid shirt.png" style="height: 10rem; width: 12rem;" alt="Size-guidlines">
                                <img src="images/size guid shirt img.png .png" style="height: 12rem; width: 26rem;" alt="Size-guidlines">
                            </div>
                        </div>


                        <!-- Standard Sizes -->
                        <div id="standardSizes" class="row g-3 pt-4 pe-auto ">
                            <div class="col-md-4">
                                <label for="standardSize" class="form-label">Standard Size:</label>
                                <select id="standardSize" name="standardSize" class="form-select">
                                    <option value="">Select Size</option>
                                    <option value="S">Small (S)</option>
                                    <option value="M">Medium (M)</option>
                                    <option value="L">Large (L)</option>
                                    <option value="XL">Extra Large (XL)</option>
                                </select>
                            </div>

                        </div>

                        <hr>

                        <!-- Personal Measurements -->
                        <div id="customMeasurements" class="row g-3 pt-2">
                            <div class="col-md-4">
                                <label for="Neck-grith" class="form-label">Neck-grith (in Inch):</label>
                                <input type="number" id="Neck-grith" name="Neck-grith" class="form-control" min="0" placeholder="e.g., 10">
                            </div>
                            <div class="col-md-4">
                                <label for="chest" class="form-label">Chest (in Inch):</label>
                                <input type="number" id="chest" name="chest" class="form-control" min="0" placeholder="e.g., 20">
                            </div>
                            <div class="col-md-4">
                                <label for="Hip" class="form-label">Hip (in Inch):</label>
                                <input type="number" id="Hip" name="Hip" class="form-control" min="0" placeholder="e.g., 19.5">
                            </div>
                            <div class="col-md-4">
                                <label for="Shoulder" class="form-label">Shoulder (in Inch):</label>
                                <input type="number" id="Shoulder" name="Shoulder" class="form-control" min="0" placeholder="e.g., 15.5">
                            </div>
                            <div class="col-md-4">
                                <label for="waist" class="form-label">Waist (in Inch):</label>
                                <input type="number" id="waist" name="waist" class="form-control" min="0" placeholder="e.g., 16">
                            </div>
                            <div class="col-md-4">
                                <label for="length" class="form-label">Length (in Inch):</label>
                                <input type="number" id="length" name="length" class="form-control" min="0" placeholder="e.g., 29">
                            </div>
                            <div class="col-md-4">
                                <label for="Thigh" class="form-label">Thigh (in Inch):</label>
                                <input type="number" id="Thigh" name="Thigh" class="form-control" min="0" placeholder="e.g., 10">
                            </div>
                            <div class="col-md-4">
                                <label for="Front-rise" class="form-label">Front-rise (in Inch):</label>
                                <input type="number" id="Front-rise" name="Front_rise" class="form-control" min="0" placeholder="e.g., 11">
                            </div>
                            <div class="col-md-4">
                                <label for="Hem Open" class="form-label">Hem Open (in Inch):</label>
                                <input type="number" id="Hem Open" name="Hem_Open" class="form-control" min="0" placeholder="e.g., 7">
                            </div>
                        </div>
                </fieldset>

            </div>

            <div class="custom-febric py-2" style=" border: 2px solid rgb(5, 5, 5);  padding: 20px;
            border-radius: 5px;
              ">
                <!-- Fabric Type and Color -->
                <div class="col-md-6 py-2">
                    <legend><strong>Fabric & Cloth structure Details </strong></legend>

                    <label for="fabric" class="form-label">Fabric Type:</label>
                    <select id="fabric" name="fabric" class="form-select">
                        <option selected value=''>Select fabric Type</option>
                        <?php
                        $fabricTypeSelectQuiry = "SELECT * FROM fabric_type";

                        // execute quiry and get the result
                        $fabricTypeResult = mysqli_query($con, $fabricTypeSelectQuiry);

                        // fetch staff type
                        while ($fabricTypeRowdata = mysqli_fetch_assoc($fabricTypeResult)) {
                            $fabricTypePrice = $fabricTypeRowdata['fabric_cost'];
                            // add staff types into drop down menu
                            echo "<option value='{$fabricTypeRowdata['fabric_Type_name']}'> {$fabricTypeRowdata['fabric_Type_name']} </option>";
                        }

                        //store fabric data in session
                        $_SESSION['fabric_cost'] = $fabricTypePrice;
                        $_SESSION['fabric_Type_name'] = $fabricTypeRowdata['fabric_Type_name'];

                        ?>
                    </select>
                </div>
                <div class="col-md-6 py-2">
                    <label for="fabricColor" class="form-label">Fabric Color:</label>
                    <input type="color" id="fabricColor" name="fabricColor" class="form-control form-control-color">
                </div>

                <!-- Neck Type, Sleeve Length, Fit Style -->
                <div class="py-2" style="display: flex;">


                    <div class="col-md-4 px-2">
                        <label for="neckType" class="form-label">Neck Type:</label>
                        <select id="neckType" name="neckType" class="form-select">
                            <option selected value="">Nek Type</option>
                            <?php
                            $clothTypeSelectQuiry = "SELECT * FROM cost_parameter WHERE para_type = 'nec-type'";

                            // execute quiry and get the result
                            $costTypeResult = mysqli_query($con, $clothTypeSelectQuiry);

                            // fetch staff type
                            while ($clothTypeRowdata = mysqli_fetch_assoc($costTypeResult)) {
                                $paraname = $clothTypeRowdata['para_name'];
                                $paracost = $clothTypeRowdata['para_cost'];
                                // add staff types into drop down menu
                                echo "<option value='{$clothTypeRowdata['para_id']}'> {$clothTypeRowdata['para_name']} </option>";
                            }

                            //store fabric data in session
                            $_SESSION['nek_cost'] = $paracost;
                            $_SESSION['fabric_Type_name'] =   $paraname;
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 px-2">
                        <label for="sleeveLength" class="form-label">Sleeve Length:</label>
                        <select id="sleeveLength" name="sleeveLength" class="form-select">
                            <option value="">Select Sleeve Length</option>
                            <?php
                            $clothTypeSelectQuiry = "SELECT * FROM cost_parameter WHERE para_type = 'Sleeve Length'";

                            // execute quiry and get the result
                            $costTypeResult = mysqli_query($con, $clothTypeSelectQuiry);

                            // fetch staff type
                            while ($clothTypeRowdata = mysqli_fetch_assoc($costTypeResult)) {
                                $paraname = $clothTypeRowdata['para_name'];
                                $paracost = $clothTypeRowdata['para_cost'];
                                // add staff types into drop down menu
                                echo "<option value='{$clothTypeRowdata['para_id']}'> {$clothTypeRowdata['para_name']} </option>";
                            }

                            //store fabric data in session
                            $_SESSION['para_cost'] = $paracost;
                            $_SESSION['fabric_Type_name'] =   $paraname;
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 px-2">
                        <label for="fitStyle" class="form-label">Fit Style:</label>
                        <select id="fitStyle" name="fitStyle" class="form-select">
                            <option value="">Select Fit Style</option>
                            <option value="slim">Slim Fit</option>
                            <option value="regular">Regular Fit</option>
                            <option value="loose">Loose Fit</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="custom-aditinal-detaild" style=" border: 2px solid rgb(5, 5, 5);  padding: 20px;
            border-radius: 5px;
              ">
                <!-- Logo or Image Upload -->
                <div class="col-md-6 py-2">
                    <label for="logo" class="form-label">Upload Logo/Image (Optional):</label>
                    <input type="file" id="logo" value="" name="logo" class="form-control" accept="image/*">
                    <?php
                    $clothTypeSelectQuiry = "SELECT * FROM cost_parameter WHERE para_type = 'logo'";

                    // execute quiry and get the result
                    $costTypeResult = mysqli_query($con, $clothTypeSelectQuiry);

                    // fetch staff type
                    if ($paraTypeRowdata = mysqli_fetch_assoc($costTypeResult)) {
                        $paraname = $paraTypeRowdata['para_name'];
                        $paracost = $paraTypeRowdata['para_cost'];
                        // add staff types into drop down menu
                        echo "<p><strong>Cost pre one item:</strong> {$paracost}</p>";
                    }

                    //store fabric data in session
                    $_SESSION['para_logo_cost'] = $paracost;
                    $_SESSION['fabric_Type_name'] =   $paraname;
                    ?>
                </div>

                <!-- sample design or Image Upload -->
                <div class="col-md-6 py-2">
                    <label for="sample design" class="form-label">If any Image to add to cloth (Optional):</label>
                    <input type="file" id="sample design" name="image" class="form-control" accept="image/*">

                    <?php
                    $clothTypeSelectQuiry = "SELECT * FROM cost_parameter WHERE para_type = 'image'";

                    // execute quiry and get the result
                    $costTypeResult = mysqli_query($con, $clothTypeSelectQuiry);

                    // fetch staff type
                    while ($paraTypeRowdata = mysqli_fetch_assoc($costTypeResult)) {
                        $paraname = $paraTypeRowdata['para_name'];
                        $paracost = $paraTypeRowdata['para_cost'];
                        // add staff types into drop down menu
                        echo "<p><strong>Cost pre one item:</strong> {$paracost}</p>";
                    }

                    //store fabric data in session
                    $_SESSION['para_image_cost'] = $paracost;
                    $_SESSION['fabric_Type_name'] =   $paraname;
                    ?>
                </div>

                <div class="col-md-6 py-2">
                    <label for="sample design" class="form-label">if any sample design (Optional):</label>
                    <input type="file" id="sample design" name="sample_design" class="form-control" accept="image/*">
                </div>

                <!-- Additional Text -->
                <div class="col-md-12 py-2 px-5">
                    <label for="additionalText" class="form-label">Additional Text to Print/Embroider (Optional):</label>
                    <textarea id="additionalText" name="additionalText" class="form-control" rows="4" placeholder="Enter any text you want to add..."></textarea>
                    <?php
                    $clothTypeSelectQuiry = "SELECT * FROM cost_parameter WHERE para_type = 'letter'";

                    // execute quiry and get the result
                    $costTypeResult = mysqli_query($con, $clothTypeSelectQuiry);

                    // fetch staff type
                    while ($paraTypeRowdata = mysqli_fetch_assoc($costTypeResult)) {
                        $paraname = $paraTypeRowdata['para_name'];
                        $paracost = $paraTypeRowdata['para_cost'];
                        // add staff types into drop down menu
                        echo "<p><strong>Cost pre one item:</strong> {$paracost}</p>";
                    }

                    //store fabric data in session
                    $_SESSION['para_letter_cost'] = $paracost;
                    $_SESSION['fabric_Type_name'] =   $paraname;
                    ?>
                </div>

                <!-- Date Required -->
                <div class="col-md-6 py-2">
                    <label for="dateRequired" class="form-label">Date Required:</label>
                    <input type="date" id="dateRequired" name="dateRequired" class="form-control" required>
                </div>

                <div class="col-md-12 py-2 px-5">
                    <label for="ideadetails" class="form-label">discribe your idea here (Optional):</label>
                    <textarea id="ideadetails" name="ideadetails" class="form-control" rows="5" placeholder="Enter any text in your mind how to design"></textarea>
                </div>
            </div>


            <!-- Submit Button -->
            <div class="col-12 text-center d-flex justify-content-around">
                <button type="submit" name="custome_confirm" class="btn mx-5 bg-success text-white">Submit Customization</button>
            </div>
        </form>
    </div>


    <!-- footer section -->
    <?php
    include('includes/footer.php');
    ?>
    <!-- footer end -->

</body>

</html>

<!-- close the DB connection -->
<?php
mysqli_close($con);
?>
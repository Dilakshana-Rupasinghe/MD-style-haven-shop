<?php
session_start();

// rederect user to the login if user not logingtothe system
if (!isset($_SESSION['staffId'])) {
    header('location:../home pages/staff-login.php');
    exit();
}
// include the database configaration file
include('../../database/config.php');

// check if user click add item button
if (isset($_POST['itemAdd'])) {

    // get user input from the form
    $itemName = $_POST['itemName'];

    $categoryId = $_POST['category'];
    $brand = $_POST['brand'];
    $description = $_POST['description'];
    $costPrice = $_POST['costPrice'];
    $sellPrice = $_POST['sellPrice'];
    $discount = $_POST['discount'];
    $material = $_POST['material'];
    $stockQty = $_POST['stockQty'];

    // Add item images 
    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];

    // access images temp names
    $tmp_image1 = $_FILES['image1']['tmp_name'];
    $tmp_image2 = $_FILES['image2']['tmp_name'];

    //check form filds not empty
    if ($itemName != '' and $categoryId != '' and $brand != '' and $description != '' and $costPrice != '' and $sellPrice != '' and $discount != '' and $material != '' and $stockQty != '') {
        move_uploaded_file($tmp_image1, "../../images/products/$image1");
        move_uploaded_file($tmp_image2, "../../images/products/$image2");

        $itemInsertQuiary = "INSERT INTO item (item_name, item_image1, item_image2, item_brand, item_material, item_description, item_sell_price, item_cost_price, item_stock_qty, item_discount, item_date_added, fk_category_id) VALUES ('$itemName', '$image1', '$image2', '$brand', '$material', '$description', '$sellPrice', '$costPrice', '$stockQty', '$discount', NOW(), $categoryId)";
        // insert new item to DB
        if (mysqli_query($con, $itemInsertQuiary)) {
            echo "<script>alert('new item is added successfully');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item management</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Material icons CSS link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/back-home-style.css">
    <link rel="stylesheet" href="../../css/back-style.css">
    <link rel="stylesheet" href="../../css/commen.css">
    <link rel="stylesheet" href="../../css/manage-button.css">
    <link rel="stylesheet" href="../../css/item.css">

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

                    <a href="item-management.php" class="back-button">Back</a>
                </div>

                <!--  BACK & Register button end -->
                <div class="container-item">
                    <h1>Add New Item</h1>
                    <!-- Form starts here -->
                    <form id="addItemForm" action="#" method="POST" enctype="multipart/form-data">

                        <!-- Item Details Section -->
                        <fieldset>
                            <legend>Item Details</legend>

                            <!-- Item Name -->
                            <label for="itemName">Item Name:</label>
                            <input type="text" id="itemName" name="itemName" required>

                            <!-- Category -->
                            <label for="category">Category:</label>
                            <select id="category" name="category" required>
                                <option selected value=''>Select Category</option>

                                <?php
                                $categorySelectQuery = "SELECT * FROM category ORDER BY category_name";
                                // Execute query and get the result
                                $result = mysqli_query($con, $categorySelectQuery);
                                // Fetch Category from database
                                while ($row_data = mysqli_fetch_assoc($result)) {
                                    // add category to dropdown menu
                                    echo "<option value='{$row_data['category_id']}'>{$row_data['category_name']}</option>";
                                }
                                ?>
                            </select>

                            <!-- Brand -->
                            <label for="brand">Brand:</label>
                            <input type="text" id="brand" name="brand" required>

                            <!-- description -->
                            <label for="description">description:</label>
                            <textarea style="height: 120px; width: 100%;" name="description" id="description" placeholder="Description" rows="3" required></textarea>
                        </fieldset>

                        <!-- Images Section -->

                        <fieldset>
                            <legend>Images</legend>

                            <!-- Main Image -->
                            <label for="mainImage">Main Image:</label>
                            <input class="" type="file" name="image1" id="image1" required>

                            <!-- Additional Images -->
                            <label for="additionalImages">Additional Images:</label>
                            <input class="" type="file" name="image2" id="image2" >
                            </fieldset>

                        <!-- Pricing Section -->
                        <fieldset>
                            <legend>Pricing</legend>

                            <!-- Price -->
                            <label for="price">Cost Price (Rs):</label>
                            <input type="number" id="price" name="costPrice" step="0.01" required>

                            <!-- Price -->
                            <label for="price">Sell Price (Rs):</label>
                            <input type="number" id="price" name="sellPrice" step="0.01" required>

                            <!-- Discount Price -->
                            <label for="discount">Discount:</label>
                            <input type="number" id="discount" name="discount" step="0.01">
                        </fieldset>


                        <!-- Fabric Options Section -->
                        <fieldset>
                            <legend>Fabric Options</legend>

                            <!-- Available Colors -->
                            <label>Available Colors:</label>
                            <div class="checkbox-group">
                                <label><input type="checkbox" name="colors[]" value="Black"> Black</label>
                                <label><input type="checkbox" name="colors[]" value="White"> White</label>
                                <label><input type="checkbox" name="colors[]" value="Red"> Red</label>
                                <label><input type="checkbox" name="colors[]" value="Light Blue"> Light Blue</label>
                                <label><input type="checkbox" name="colors[]" value="Gray"> Gray</label>
                                <!-- Add more color options as needed -->
                            </div>
                        </fieldset>

                        <!-- Sizes Section -->
                        <fieldset>
                            <legend>Sizes Available</legend>

                            <!-- Size Small -->
                            <div class="size-group" style="display: -webkit-box;">
                                <label><input type="checkbox" name="sizes[]" value="S"> Free size</label>
                                <div class="size-details">
                                    <label for="s_bust">Bust (cm):</label>
                                    <input type="number" id="s_bust" name="size_S_bust" min="0">

                                    <label for="s_waist">Waist (cm):</label>
                                    <input type="number" id="s_waist" name="size_S_waist" min="0">
                                    <!-- Add more measurements as needed -->
                                </div>
                                <label><input type="checkbox" name="sizes[]" value="S"> X Small (XS)</label>
                                <div class="size-details">
                                    <label for="s_bust">Bust (cm):</label>
                                    <input type="number" id="s_bust" name="size_S_bust" min="0">

                                    <label for="s_waist">Waist (cm):</label>
                                    <input type="number" id="s_waist" name="size_S_waist" min="0">
                                    <!-- Add more measurements as needed -->
                                </div>
                                <div>
                                    <label><input type="checkbox" name="sizes[]" value="S"> Small (XS)</label>
                                    <div class="size-details">
                                        <label for="s_bust">Bust (cm):</label>
                                        <input type="number" id="s_bust" name="size_S_bust" min="0">

                                        <label for="s_waist">Waist (cm):</label>
                                        <input type="number" id="s_waist" name="size_S_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>
                                </div>
                                <!-- Size Small -->
                                <div class="size-group">
                                    <label><input type="checkbox" name="sizes[]" value="S"> Small (S)</label>
                                    <div class="size-details">
                                        <label for="s_bust">Bust (cm):</label>
                                        <input type="number" id="s_bust" name="size_S_bust" min="0">

                                        <label for="s_waist">Waist (cm):</label>
                                        <input type="number" id="s_waist" name="size_S_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>
                                </div>

                                <!-- Size Large -->
                                <div class="size-group">
                                    <label><input type="checkbox" name="sizes[]" value="L"> Large (L)</label>
                                    <div class="size-details">
                                        <label for="l_bust">Bust (cm):</label>
                                        <input type="number" id="l_bust" name="size_L_bust" min="0">

                                        <label for="l_waist">Waist (cm):</label>
                                        <input type="number" id="l_waist" name="size_L_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>
                                </div>
                            </div>
                            <div class="size-group">

                                <!-- Size Extra Large -->
                                <div class="size-group">
                                    <label><input type="checkbox" name="sizes[]" value="XL"> Extra Large (XL)</label>
                                    <div class="size-details">
                                        <label for="xl_bust">Bust (cm):</label>
                                        <input type="number" id="xl_bust" name="size_XL_bust" min="0">

                                        <label for="xl_waist">Waist (cm):</label>
                                        <input type="number" id="xl_waist" name="size_XL_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>

                                    <!-- Size Extra Large -->
                                    <label><input type="checkbox" name="sizes[]" value="XL"> 2Extra Large (XXL)</label>
                                    <div class="size-details">
                                        <label for="xl_bust">Bust (cm):</label>
                                        <input type="number" id="xl_bust" name="size_XL_bust" min="0">

                                        <label for="xl_waist">Waist (cm):</label>
                                        <input type="number" id="xl_waist" name="size_XL_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>
                                </div>
                            </div>
                            <div class="size-group" style="display: -webkit-box;">

                                <!-- Size Extra Large -->
                                <div class="size-group">
                                    <label><input type="checkbox" name="sizes[]" value="XL"> 28 </label>
                                    <div class="size-details">
                                        <label for="xl_bust">Bust (cm):</label>
                                        <input type="number" id="xl_bust" name="size_XL_bust" min="0">

                                        <label for="xl_waist">Waist (cm):</label>
                                        <input type="number" id="xl_waist" name="size_XL_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>
                                </div>

                                <!-- Size Extra Large -->
                                <div class="size-group">
                                    <label><input type="checkbox" name="sizes[]" value="XL"> 30 </label>
                                    <div class="size-details">
                                        <label for="xl_bust">Bust (cm):</label>
                                        <input type="number" id="xl_bust" name="size_XL_bust" min="0">

                                        <label for="xl_waist">Waist (cm):</label>
                                        <input type="number" id="xl_waist" name="size_XL_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>
                                </div>
                                <!-- Size Extra Large -->
                                <div class="size-group">
                                    <label><input type="checkbox" name="sizes[]" value="XL"> 32 </label>
                                    <div class="size-details">
                                        <label for="xl_bust">Bust (cm):</label>
                                        <input type="number" id="xl_bust" name="size_XL_bust" min="0">

                                        <label for="xl_waist">Waist (cm):</label>
                                        <input type="number" id="xl_waist" name="size_XL_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>
                                </div>

                                <!-- Size Extra Large -->
                                <div class="size-group">
                                    <label><input type="checkbox" name="sizes[]" value="XL"> 34 </label>
                                    <div class="size-details">
                                        <label for="xl_bust">Bust (cm):</label>
                                        <input type="number" id="xl_bust" name="size_XL_bust" min="0">

                                        <label for="xl_waist">Waist (cm):</label>
                                        <input type="number" id="xl_waist" name="size_XL_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>
                                </div>

                                <!-- Size Extra Large -->
                                <div class="size-group">
                                    <label><input type="checkbox" name="sizes[]" value="XL"> 36 </label>
                                    <div class="size-details">
                                        <label for="xl_bust">Bust (cm):</label>
                                        <input type="number" id="xl_bust" name="size_XL_bust" min="0">

                                        <label for="xl_waist">Waist (cm):</label>
                                        <input type="number" id="xl_waist" name="size_XL_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>
                                </div>

                                <!-- Size Extra Large -->
                                <div class="size-group">
                                    <label><input type="checkbox" name="sizes[]" value="XL"> 38 </label>
                                    <div class="size-details">
                                        <label for="xl_bust">Bust (cm):</label>
                                        <input type="number" id="xl_bust" name="size_XL_bust" min="0">

                                        <label for="xl_waist">Waist (cm):</label>
                                        <input type="number" id="xl_waist" name="size_XL_waist" min="0">
                                        <!-- Add more measurements as needed -->
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Fabric Composition Section -->
                        <fieldset>
                            <legend>Fabric Composition</legend>

                            <label for="material">Material:</label>
                            <input type="text" id="material" name="material" placeholder="e.g., 95% Cotton, 5% Spandex" required>
                        </fieldset>

                        <!-- Stock Section -->
                        <fieldset>
                            <legend>Stock Management</legend>

                            <label for="stockQty">Stock Quantity:</label>
                            <input type="number" id="stockQty" name="stockQty" min="0" required>
                        </fieldset>

                        <!-- Submit Buttons -->
                        <div class="form-actions">
                            <button type="submit" class="save" name="itemAdd">Save</button>
                            <button type="reset" style="background-color: #333;">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- item add form section end -->
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
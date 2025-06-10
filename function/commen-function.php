 <?php
    // get item card
    function getItemCard($con, $itemSelectQuairy)
    {

        // exicute quairy and get result 
        $itemResult = mysqli_query($con, $itemSelectQuairy);
        $row_count = mysqli_num_rows($itemResult);

        if ($row_count > 0) {
            //fetch item details
            while ($row_data = mysqli_fetch_assoc($itemResult)) {
                $item_discount = (float)$row_data['item_discount'];
                $item_sell_price = (float)$row_data['item_sell_price'];

                $itemDiscountPrice = $item_sell_price * (100 - $item_discount) / 100; //calculation of getting discount

                // show discount if item has it
                if ($item_discount == 0) {
                    $showNone = 'd-none'; //applying bootstrap class as d-none
                } else {
                    $showNone = ''; //romove bootstrsp class d-none
                }

                // check item availability
                if ($row_data['item_stock_qty'] == '0') {
                    $avilabilty = 'Sold Out';
                    $avilabiltyShow = 'text-danger'; // bootstrap class
                } else {
                    $avilabilty = 'In Stock';
                    $avilabiltyShow = 'text-success'; //bootstrap class
                }

    ?>

             <!-- display item card -->
             <div class="col-sm-6 col-md-4  text-center mb-4">
                 <div class="card border-0 bg-light">
                     <img src="images/products/<?= $row_data['item_image1'] ?>" class="card-img-top p-3 position-relative" alt="<?= $row_data['item_image1'] ?>">
                     <!-- item discount percentage-->
                     <span class=" <?= $showNone ?> position-absolute top-50 start-0 badge bg-danger p-2">
                         -<?= $row_data['item_discount'] ?>%
                     </span>
                     <div class="card-body p-0 pb-2">
                         <div class="tool-tip">
                             <h6 class="product-name"> <?= $row_data['item_name'] ?> </h6>
                         </div>
                         <!-- item prices-->
                         <h6 class="<?= $showNone ?> text-decoration-line-through d-inline text-body-tertiary">Rs. <?= number_format($item_sell_price, 2) ?> </h6>
                         <h6 class="d-inline">Rs. <?= number_format($itemDiscountPrice, 2) ?> </h6>
                         <!-- item availability -->
                         <h6 class="<?= $avilabiltyShow ?> fw-bold "> <?= $avilabilty ?></h6>
                         <a href="product-view.php?productId=<?= $row_data['item_id'] ?>" class="btn btn-outline-warning btn-view btn-sm">View</a>
                     </div>
                 </div>
             </div>

 <?php

            }
        } else {
            echo "<h2>Not available products</h2>";
        }
    }
    ?>

 <!-- get no of item into cart badge -->

 <?php
    function getNoOfCartItem($con)
    {
        $cartSelectQuiry = "SELECT * FROM cart_item WHERE fk_cust_id= {$_SESSION['custId']}";

        $cartResult = mysqli_query($con, $cartSelectQuiry);
        return mysqli_num_rows($cartResult);
    }

    // remove cart item
    function removeCartItem($con, $cart_id, $item_id, $item_qty, $item_stock_qty)
    {
        if (isset($_POST['removeCartItem' . $cart_id])) {

            // delete from cart item table
            $cartItemDeletQuiry = "DELETE FROM cart_item WHERE cart_id = $cart_id";
            // exicute quairy
            if (mysqli_query($con, $cartItemDeletQuiry)) {
                $updateItemStock = $item_qty + $item_stock_qty;

                // update quairy
                $itemUpdateQuiry = "UPDATE item SET item_stock_qty = $updateItemStock WHERE item_id = $item_id";
                // exicute quiry
                if (mysqli_query($con, $itemUpdateQuiry)) {
                    echo "<script>alert('Delete item from cart successfully');</script>";
                    echo "<script>window.open('cart.php', '_self');</script>";
                }
            }
        }
    }

    // update cart
    function updateCartItem($con, $cart_id, $item_id, $item_qty, $item_stock_qty){

        if (isset($_POST['updateCartItem' . $cart_id])) {
            $updatedCartItemQty = (int)$_POST['cartQty'];
            if ($updatedCartItemQty != $item_qty) {
                // update quantity in user cart
                $cartUpdateQuery = "UPDATE cart_item SET item_qty=$updatedCartItemQty WHERE cart_id=$cart_id";
                if (mysqli_query($con, $cartUpdateQuery)) {
                    // update item stock quantity
                    $updatedItemStockQty = 0;
                    if ($updatedCartItemQty > $item_qty) {
                        // remove adding cart items from item stock
                        $updatedItemStockQty = $item_stock_qty - ($updatedCartItemQty - $item_qty);
                    } else {
                        // add removing item to item stock
                        $updatedItemStockQty = $item_stock_qty + ($item_qty - $updatedCartItemQty);
                    }
                    // update item table stock quntity 
                    $itemUpdateQuery = "UPDATE item SET item_stock_qty=$updatedItemStockQty WHERE item_id=$item_id";
                    if (mysqli_query($con, $itemUpdateQuery)) {
                        echo "<script>alert('Updated successfully');</script>";
                        echo "<script>window.open('cart.php', '_self');</script>";
                        exit();
                    }
                }
            }
        }
    }

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
             <div class="col-sm-6 col-md-4 col-lg-3 text-center mb-4">
                 <div class="card border-0 bg-light">
                     <img src="images/products/<?= $row_data['item_image1']?>" class="card-img-top p-3 position-relative" alt="<?= $row_data['item_image1'] ?>">
                     <!-- item discount percentage-->
                     <span class=" <?= $showNone?> position-absolute top-0 start-0 rounded-end-pill badge bg-success p-2">
                         -<?= $row_data['item_discount']?>%
                     </span>
                     <div class="card-body p-0 pb-2">
                         <div class="tool-tip">
                             <!-- <span class="tool-tip-text"> <?= $row_data['item_name'] ?> </span> -->
                             <h6 class="product-name"> <?= $row_data['item_name'] ?> </h6>
                         </div>
                         <!-- item prices-->
                         <h6 class="<?= $showNone?> text-decoration-line-through d-inline text-body-tertiary">Rs. <?= number_format($item_sell_price, 2)?> </h6>
                         <h6 class="d-inline">Rs. <?= number_format($itemDiscountPrice, 2)?> </h6>
                         <!-- item availability -->
                         <h6 class="<?= $avilabiltyShow?> fw-bold "> <?= $avilabilty?></h6>
                         <a href="#" class="btn btn-outline-warning btn-view btn-sm">View</a>
                     </div>
                 </div>
             </div>

 <?php

            }
        } else{
            echo "<h2>Not available products</h2>";
        }
    }
    ?>
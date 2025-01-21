<?php

// $getStaffDetails = 
$SelectQuary = "SELECT item_id, item_name, item_brand, item_stock_qty,item_discount FROM `item` 
ORDER BY item_discount DESC ";

$result = mysqli_query($con, $SelectQuary);

if ($result && mysqli_num_rows($result) > 0) {
    // Wrap the table inside a centered container
    echo '<div class="d-flex justify-content-center align-items-center me-3 mb-5" style="min-height: 50vh;">';
    echo '<table class="table table-bordered text-center w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>Item ID</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>QTY</th>
                            <th>Offers/Diescounts</th>
                        </tr>
                    </thead>
                    <tbody>';

    // Display data rows
    while ($row_data = mysqli_fetch_assoc($result)) {
        $item_id = $row_data['item_id'];
        $item_name = $row_data['item_name'];
        $item_brand = $row_data['item_brand'];
        $item_stock_qty = $row_data['item_stock_qty'];
        $item_discount = $row_data['item_discount'];

        echo "<tr>
                        <td>$item_id</td>
                        <td>$item_name</td>
                        <td>$item_brand</td>
                        <td>$item_stock_qty</td>
                        <td>$item_discount</td>
                      </tr>";
    }

    echo '</tbody>
                </table>
            </div>';
} else {
    echo "<h2 class='bg-danger text-center mt-5 mx-4 p-2'> No Report Data </h2>";
}

<?php

// $getStaffDetails = 
$SelectQuary = "SELECT fk_cust_id , order_total,order_date,order_status,
    COUNT(order_id) AS 'Total_Orders',
    SUM(order_total) AS 'Total_Spent',
    MAX(order_date) AS 'Last_Order_Date'
FROM 
    `order`
WHERE 
    order_status = 'pending'
    OR order_status = 'complete' -- Include only completed orders
GROUP BY 
    fk_cust_id
HAVING 
    COUNT(order_id) > 5 -- Customers with more than 5 orders
ORDER BY 
    COUNT(order_id) DESC, -- Sort by the number of orders
    SUM(order_total) DESC; -- Secondary sort by total spent";

$result = mysqli_query($con, $SelectQuary);

if ($result && mysqli_num_rows($result) > 0) {
    // Wrap the table inside a centered container
    echo '<div class="d-flex justify-content-center align-items-center me-3 mb-5" style="min-height: 50vh;">';
    echo '<table class="table table-bordered text-center w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>Customer ID</th>
                            <th>Last Order date</th>
                            <th>Total orders</th>
                            <th>Total Spent</th>
                        </tr>
                    </thead>
                    <tbody>';

    // Display data rows
    while ($row_data = mysqli_fetch_assoc($result)) {
        $order_id = $row_data['fk_cust_id'];
        $order_total = $row_data['order_total'];
        $Last_Order_Date = $row_data['Last_Order_Date'];
        $Total_Orders = $row_data['Total_Orders'];
        $Total_Spent = $row_data['Total_Spent'];

        echo "<tr>
                        <td>$order_id</td>
                        <td>$Last_Order_Date</td>
                        <td>$Total_Orders</td>
                        <td>$Total_Spent</td>
                      </tr>";
    }

    echo '</tbody>
                </table>
            </div>';
} else {
    echo "<h2 class='bg-danger text-center mt-5 mx-4 p-2'> No Report Data </h2>";
}

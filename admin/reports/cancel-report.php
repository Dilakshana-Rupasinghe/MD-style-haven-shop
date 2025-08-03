<h3 class="text-center">This Month Canceled Orders Report</h3>

<?php
$SelectQuary = "SELECT * FROM `order` 
WHERE order_status = 'cancelled' 
  AND MONTH(order_date) = MONTH(CURDATE())
  AND YEAR(order_date) = YEAR(CURDATE())
ORDER BY order_date DESC";

$result = mysqli_query($con, $SelectQuary);

if ($result && mysqli_num_rows($result) > 0) {
    echo '<div class="d-flex justify-content-center align-items-center me-3 mb-5" style="min-height: 50vh;">';
    echo '<table class="table table-bordered text-center w-100">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Order Details</th>
                    <th>Customer Name</th>
                    <th>Total Price (LKR)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';

    while ($row_data = mysqli_fetch_assoc($result)) {
        $order_id = $row_data['order_id'];
        $order_details = $row_data['order_details'];
        $order_total = number_format($row_data['order_total'], 2);
        $order_name = $row_data['order_fname'] . ' ' . $row_data['order_lname'];
        $order_date = $row_data['order_date'];
        $order_status = ucfirst($row_data['order_status']);

        echo "<tr>
                <td>$order_id</td>
                <td>$order_date</td>
                <td>$order_details</td>
                <td>$order_name</td>
                <td>Rs. $order_total</td>
                <td class='text-danger'>$order_status</td>
              </tr>";
    }

    echo '</tbody>
        </table>
    </div>';
} else {
    echo "<h2 class='bg-danger text-center mt-5 mx-4 p-2'> No Report Data </h2>";
}
?>

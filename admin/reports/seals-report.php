<h3 class="text-center">Monthly Sales Income Report</h3>

<?php
// Fetch monthly sales income
$sqlIncome = "SELECT 
                MONTH(payment_date) AS month, 
                SUM(payment_amount) AS total_income 
              FROM payment 
              WHERE payment_status IN ('Success', 'Downpayment_success', 'Full Payment Success')
                AND YEAR(payment_date) = YEAR(CURDATE())
              GROUP BY MONTH(payment_date) 
              ORDER BY MONTH(payment_date)";
              
$resultIncome = mysqli_query($con, $sqlIncome);

$months = [
    1 => "January", 2 => "February", 3 => "March", 4 => "April",
    5 => "May", 6 => "June", 7 => "July", 8 => "August",
    9 => "September", 10 => "October", 11 => "November", 12 => "December"
];

// Check if there is data
if ($resultIncome && mysqli_num_rows($resultIncome) > 0) {
    $incomeData = [];
    while ($row = mysqli_fetch_assoc($resultIncome)) {
        $incomeData[(int)$row['month']] = $row['total_income'];
    }

    echo '<div class="d-flex justify-content-center align-items-center me-3 mb-5" style="min-height: 50vh;">';
    echo '<table class="table table-bordered text-center w-100">
            <thead class="table-dark">
                <tr>
                    <th>Month</th>
                    <th>Total Income (LKR)</th>
                </tr>
            </thead>
            <tbody>';

    for ($i = 1; $i <= 12; $i++) {
        $income = isset($incomeData[$i]) ? number_format($incomeData[$i], 2) : "0.00";
        echo "<tr>
                <td>{$months[$i]}</td>
                <td>Rs. {$income}</td>
              </tr>";
    }

    echo '</tbody>
        </table>
    </div>';
} else {
    echo "<h2 class='bg-danger text-center mt-5 mx-4 p-2'> No Report Data </h2>";
}
?>

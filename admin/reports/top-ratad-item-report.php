<?php

$SelectQuary = "SELECT fk_item_id, item_name,item_brand,
    COUNT(rating_id) AS 'Total_Ratings',
    AVG(rating_value) AS 'Average_Rating'
    FROM 
    rating 
    INNER JOIN 
    `item`  ON rating.fk_item_id = item.item_id
GROUP BY 
    fk_item_id
ORDER BY 
    AVG(rating_value) DESC, -- Sort by the highest average rating
    COUNT(rating_id) DESC -- Secondary sort by the number of ratings
LIMIT 10 -- Adjust the limit for the top results";

$result = mysqli_query($con, $SelectQuary);

if ($result && mysqli_num_rows($result) > 0) {
    // Wrap the table inside a centered container
    echo '<div class="d-flex justify-content-center align-items-center me-3 mb-5" style="min-height: 50vh;">';
    echo '<table class="table table-bordered text-center w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Brand</th>
                            <th>Total rating</th>
                            <th>average rating</th>
                        </tr>
                    </thead>
                    <tbody>';

    // Display data rows
    while ($row_data = mysqli_fetch_assoc($result)) {
        $fk_item_id = $row_data['fk_item_id'];
        $Total_Ratings = $row_data['Total_Ratings'];
        $rating_value = $row_data['Average_Rating'];
        $item_name = $row_data['item_name'];
        $item_brand = $row_data['item_brand'];

        $avg_rating = number_format($rating_value,2);
        
        echo "<tr>
                        <td>$fk_item_id</td>
                        <td>$item_name</td>
                        <td>$item_brand</td>
                        <td>$Total_Ratings</td>
                        <td>$avg_rating</td>
                      </tr>";
    }

    echo '</tbody>
                </table>
            </div>';
} else {
    echo "<h2 class='bg-danger text-center mt-5 mx-4 p-2'> No Report Data </h2>";
}

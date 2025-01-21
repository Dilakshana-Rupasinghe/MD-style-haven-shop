<?php

// $getStaffDetails = 
        $deactiveStaffselectQuery = "SELECT * FROM staff 
        INNER JOIN staff_type ON staff.fk_staff_type_id = staff_type.staff_type_id
        WHERE staff_is_active = 0";
        $result = mysqli_query($con, $deactiveStaffselectQuery);

        if ($result && mysqli_num_rows($result) > 0) {
            // Wrap the table inside a centered container
            echo '<div class="d-flex justify-content-center align-items-center me-3 mb-5" style="min-height: 50vh;">';
            echo '<table class="table table-bordered text-center w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>Staff ID</th>
                            <th>Name</th>
                            <th>staff type</th>
                            <th>Email</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            // Display data rows
            while ($row_data = mysqli_fetch_assoc($result)) {
                $staff_id = $row_data['staff_id'];
                $staff_name = $row_data['staff_fname'] . ' ' . $row_data['staff_lname'];
                $staff_type = $row_data['staff_type_name'];
                $staff_email = $row_data['staff_email'];
                $staff_address = $row_data['staff_add_line1'] . ', ' . $row_data['staff_add_line2'] . ', ' . $row_data['staff_add_line3'] . ', ' . $row_data['staff_add_line4'];
        
                echo "<tr>
                        <td>$staff_id</td>
                        <td>$staff_name</td>
                        <td>$staff_type</td>
                        <td>$staff_email</td>
                        <td>$staff_address</td>
                      </tr>";
            }
        
            echo '</tbody>
                </table>
            </div>';
        }
    ?>
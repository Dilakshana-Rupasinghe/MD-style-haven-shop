<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Make sure session is started to access $_SESSION['staff_type_id']
}
// !!!  include database connection !!!
$con = mysqli_connect("localhost", "root", "", "md_style_haven");

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$current_page = basename($_SERVER['PHP_SELF']);


// Get the logged-in user's staff type ID from the session
$logged_in_staff_id = isset($_SESSION['staffId']) ? $_SESSION['staffId'] : null; // Here's the mismatch
$get_staff_type = "SELECT * FROM staff WHERE staff_id = '$logged_in_staff_id'";

$result = mysqli_query($con, $get_staff_type);
$row_count = mysqli_num_rows($result);
$row_data = mysqli_fetch_assoc($result);

$logged_in_staff_type_id = $row_data['fk_staff_type_id'];

// store staff type id in session 
$_SESSION ['fk_staff_type_id'] = $logged_in_staff_type_id;

?>
<h3 class="ms-4 mt-1"> MENU
    <span class="material-symbols-outlined">menu</span>
</h3>

<?php if ($logged_in_staff_type_id == 1001): ?>
<!-- Admin Dashboard -->
<div class="menu <?php echo ($current_page == 'admin-home.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">dashboard</span>
    <a href="../home pages/admin-home.php"> Dashboard</a>
</div>
<?php endif; ?>

<?php if (in_array($logged_in_staff_type_id, [1001, 1004])): ?>
<!-- Orders -->
<div class="menu <?php echo ($current_page == 'order-manage.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">orders</span>
    <a href="../order-management/order-manage.php"> Orders</a>
</div>
<?php endif; ?>

<?php if (in_array($logged_in_staff_type_id, [1001, 1002])): ?>
<!-- Inventory -->
<div class="menu <?php echo ($current_page == 'inventory-management.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">inventory</span>
    <a href="../inventory/inventory-management.php"> Inventory </a>
</div>
<?php endif; ?>

<?php if (in_array($logged_in_staff_type_id, [1001, 1004, 1006])): ?>
<!-- Customization -->
<div class="menu <?php echo ($current_page == 'customization-management.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">tune</span>
    <a href="../customization/customization-management.php"> Customization </a>
</div>
<?php endif; ?>

<?php if (in_array($logged_in_staff_type_id, [1001, 1004, 1005])): ?>
<!-- Inquiry -->
<div class="menu <?php echo ($current_page == 'inquary-manage.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">support_agent</span>
    <a href="../Inquary management/inquary-manage.php"> Inquiry </a>
</div>
<?php endif; ?>

<?php if (in_array($logged_in_staff_type_id, [1001, 1002])): ?>
<!-- Reports -->
<div class="menu <?php echo ($current_page == 'report-manage.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">report</span>
    <a href="../reports/report-manage.php"> Reports </a>
</div>
<?php endif; ?>

<?php if (in_array($logged_in_staff_type_id, [1001, 1004, 1005])): ?>
<!-- Customers -->
<div class="menu <?php echo ($current_page == 'customer-management.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">manage_accounts</span>
    <a href="../user management/customer-management.php"> Customer</a>
</div>
<?php endif; ?>

<?php if (in_array($logged_in_staff_type_id, [1001, 1005])): ?>
<!-- Feedback -->
<div class="menu <?php echo ($current_page == 'feedback-manage.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">feedback</span>
    <a href="../feedback-management/feedback-manage.php"> Feedbacks </a>
</div>
<?php endif; ?>

<?php if (in_array($logged_in_staff_type_id, [1001, 1003])): ?>
<!-- Feedback -->
<div class="menu <?php echo ($current_page == 'delivery-manage.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">delivery_truck_speed</span>
    <a href="../Delivery/delivery-manage.php"> Delivery </a>
</div>
<?php endif; ?>

<?php if ($logged_in_staff_type_id == 1001): ?>
<!-- Staff -->
<div class="menu <?php echo ($current_page == 'staff-management.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">group_add</span>
    <a href="../user management/staff-management.php"> Staff </a>
</div>

<!-- Cost -->
<div class="menu <?php echo ($current_page == 'cost-manage.php') ? 'bg-body-secondary' : ''; ?>">
    <span class="material-symbols-outlined">price_change</span>
    <a href="../cost management/cost-manage.php">Cost manage</a>
</div>
<?php endif; ?>
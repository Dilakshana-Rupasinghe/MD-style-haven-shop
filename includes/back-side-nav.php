<?php
$current_page = basename($_SERVER['PHP_SELF']); // to get current loded page in browser 
?>
<h3 class="ms-4 mt-1"> MENU
    <span class="material-symbols-outlined">
        menu
    </span>
</h3>
<div class="menu <?php echo($current_page == 'admin-home.php')? ' bg-body-secondary':'';?>">
    <span class="material-symbols-outlined">
        dashboard
    </span>
    <a class="" href="../home pages/admin-home.php"> Dashboard</a>
</div>
<div class="menu<?php echo($current_page == 'order-manage.php')? ' bg-body-secondary':'';?>">
    <span class="material-symbols-outlined">
        orders
    </span>
    <a href="../order-management/order-manage.php"> Orders</a>

</div>
<div class="menu <?php echo($current_page == 'inventory-management.php')? ' bg-body-secondary':'';?>">
    <span class="material-symbols-outlined">
        inventory
    </span>
    <a href="../inventory/inventory-management.php"> Inventory </a>

</div>
<div class="menu <?php echo($current_page == 'customization-management.php')? ' bg-body-secondary':'';?>">
    <span class="material-symbols-outlined">
        tune
    </span>
    <a href="../customization/customization-management.php"> Customization </a>

</div>
<div class="menu <?php echo($current_page == 'inquary-manage.php')? ' bg-body-secondary':'';?>">
    <span class="material-symbols-outlined">
        support_agent
    </span>
    <a href="../Inquary management/inquary-manage.php"> Inquary </a>
</div>
<div class="menu <?php echo($current_page == 'report-manage.php')? ' bg-body-secondary':'';?>">
    <span class="material-symbols-outlined">
        report
    </span>
    <a href="../reports/report-manage.php"> Reports </a>

</div>
<div class="menu <?php echo($current_page == 'staff-management.php')? ' bg-body-secondary':'';?>">
    <span class="material-symbols-outlined">
        group_add
    </span>
    <a href="../user management/staff-management.php"> Staff </a>

</div>
<div class="menu <?php echo($current_page == 'customer-management.php')? ' bg-body-secondary':'';?>">
    <span class="material-symbols-outlined">
        manage_accounts
    </span>
    <a href="../user management/customer-management.php"> Customer</a>

</div>
<div class="menu <?php echo($current_page == 'feedback-manage.php')? ' bg-body-secondary':'';?>">
    <span class="material-symbols-outlined">
        feedback
    </span>
    <a href="../feedback-management/feedback-manage.php"> feedbacks </a>

</div>

<div class="menu <?php echo($current_page == 'cost-manage.php')? ' bg-body-secondary':'';?>">
    <span class="material-symbols-outlined">
        price_change
    </span>
    <a href="../cost management/cost-manage.php">Cost manage</a>
</div>


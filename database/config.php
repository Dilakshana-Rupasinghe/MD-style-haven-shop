<?php
// database connection creation 
define("dbServerName", "localhost");
define("dbUserName", "root");
define("dbPassword", "");
define("dbName", "md_style_haven");

$con = mysqli_connect(dbServerName, dbUserName, dbPassword, dbName);

// check the database connection
if (!$con){
    die(mysqli_connect_errno($con));
    
}
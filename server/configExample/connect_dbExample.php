<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "your-password";
$db_name = "your-db-name";
$connection = "";

try {
    $connection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
} catch (mysqli_sql_exception) {
    mysqli_error($connection);
    die("Connection failded");
}
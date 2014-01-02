<?php
require_once  'classes/DatabaseConnectionInfo.php';
$Database = new DatabaseConnectionInfo();
$server = $Database->server;
$username = $Database->username;
$password = $Database->password;
$db = $Database->database;

date_default_timezone_set('Asia/Colombo');  // Set timezone.
$con = mysqli_connect("$server", "$username", "$password", "$db");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
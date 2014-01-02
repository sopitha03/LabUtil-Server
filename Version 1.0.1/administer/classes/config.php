<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once  'DatabaseConnectionInfo.php';
/**
 * Description of config
 *
 * @author Test
 */
class config {
   

    //put your code here
    public $connection;
    function __construct() {
$Database = new DatabaseConnectionInfo();
$server = $Database->server;
$username = $Database->username;
$password = $Database->password;
$db = $Database->database;
        date_default_timezone_set('Asia/Colombo');
        $this->connection = mysqli_connect("$server", "$username", "$password", "$db");
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
    }
}

?>

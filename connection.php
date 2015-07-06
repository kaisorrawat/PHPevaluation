<?php

//$servername="localhost";
//$username="root";
//$password="root";
// DEFINE('DB_USER', 'root');
// DEFINE('DB_PASSWORD', 'root');
// DEFINE('DB_HOST', 'localhost');
// DEFINE('DB_NAME', 'test_data_xampp');


//Create Connection ���������������������������������������������������
// $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$objConnect = mysql_connect("localhost","root","root");

//Create Connection Table ���������������������������������������������������������������������������������������	
$connDB = mysql_select_db("test_data_xampp");

//Create utf8 ������������������������������������������������������������������������������������
mysql_query("set names utf8")

//Check Connection ������������������������������������������������������������������������
// if(mysqli_connect_error()){
// 	die('Connection failed : (' .mysqli_connect_errno().')'.mysqli_connect_error());
// }
// echo "Connected successfully.";
// $mysqli->close();

?>
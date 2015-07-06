<?php

session_start ();
include 'connection.php';

$loginSQL = "SELECT * FROM employee WHERE e_code = '" . mysql_real_escape_string ( $_POST ['Username'] ) . "' AND pass = '" . mysql_real_escape_string ( $_POST ['Password'] ) . "' ";

$loginSQLquery = mysql_query ( $loginSQL );
$loginSQLresult = mysql_fetch_array ( $loginSQLquery );

if (!$loginSQLresult) {
	?>
		
<script>alert("Username and Password Incorrect!");window.location="LoginEmployee.php"</script>

<?
echo "Username and Password Incorrect!";

}else {
	$_SESSION["e_code"] = $loginSQLresult["e_code"];
	session_write_close();
	?><script>alert("Username and Password Success");window.location="IndexEmployee.php"</script><?
	// header("location:IndexEmployee.php");
}

?>

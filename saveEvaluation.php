<?
	session_start();
	include 'connection.php';
	
	for($i=1;$i<=6;$i++)
	{
		if($_POST["radionNo".$i] != "")
		{
	
			// INSERT TABLE calendar
		$strSQL2 = "INSERT INTO answer1_evaluation  ";
		$strSQL2 .="(code_employee,id_question,score,suggestion,evaluation_employee) VALUES ('".$_GET['code']."','". $i ."','".$_POST["radionNo".$i]."','".$_POST["suggestion1"]."','".$_GET['Ecode']."')";
				mysql_query($strSQL2);
		}
	}
	
	for($j=7;$j<=13;$j++)
	{
		if($_POST["radionNoJ".$j] != "")
		{
	
		// INSERT TABLE calendar
		$strSQL2 = "INSERT INTO answer2_evaluation  ";
		$strSQL2 .="(code_employee,id_question,score,suggestion,evaluation_employee) VALUES ('".$_GET['code']."','". $j ."','".$_POST["radionNoJ".$j]."','".$_POST["suggestion2"]."','".$_GET['Ecode']."')";
					mysql_query($strSQL2);
		}
	}
	
	$strSQL = "UPDATE employee_status SET status = 1 WHERE evaluation_e = '".$_GET['Ecode']."' AND e_code = '".$_GET['code']."' ";
	mysql_query($strSQL);
	
	?>
	<script>alert("Success Evaluation");window.location="IndexEmployee.php"</script>
<?
?>

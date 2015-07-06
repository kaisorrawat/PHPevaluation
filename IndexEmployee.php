<?php 
	session_start();
	include 'connection.php';
	
	$loginSQL = "SELECT * FROM employee WHERE e_code = '".$_SESSION['e_code']."' ";
	$loginSQLquery = mysql_query($loginSQL);
	$loginSQLresult = mysql_fetch_array($loginSQLquery);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Evaluation</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-static-top translucent">
		<div class="container">
			<b class="navbar-brand"><?=$loginSQLresult['e_code'] ?></b><a class="navbar-brand" href="LoginEmployee.php"> <b>[Sign Out]</b></a>
			<!-- ทำตัว navHeaderCollapse -->
			<div class="collapse navbar-collapse navHeaderCollapse ">
				<!-- Start tag ul -->
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#">HOME</a></li>
					<li><a href="">EVALUATION</a></li>
					<li><a href="">REPORT</a></li>
					<!-- ทำให้ Start tag li เป็น dropdown -->
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Social Media <b class="caret"></b></a> 
						<!-- ทำตัว dropdown Start tag ul -->
						<ul class="dropdown-menu">
							<li><a href="#">Twitter</a></li>
							<li><a href="#">Facebook</a></li>
							<li><a href="#">Google+</a></li>
							<li><a href="#">Instagram</a></li>
						</ul> 
						<!-- End tag ul -->
					</li>
					<!-- End tag li -->
				</ul>
				<!-- End tag ul -->
			</div>
		</div>
	</div>
	<div class="row">
		<table align="center" border="1">
			<tr>
				<td>No</td>
				<td>Code</td>
				<td>Name Employee</td>
				<td>Status Evaluation</td>
			</tr>
			<?php 
				include 'connection.php';
				$i = 1;
				$searchEmployee = "SELECT * FROM `employee`,`employee_status`,`status_evaluation` WHERE status_evaluation.`status` = `employee_status`.`status` AND employee_status.`evaluation_e` = employee.`e_code` ";
				
				$searchEmployeeQuery = mysql_query($searchEmployee) or die('Query Failed :' .mysql_errno());
				
				while ($data = mysql_fetch_array($searchEmployeeQuery, MYSQL_ASSOC)){
					
				if($data['e_code'] == $loginSQLresult['e_code']){
				
			?>
			<tr>
				<td align="center"><?=$i?></td>
				<td><?=$data['evaluation_e']?></td>
				<td><?=$data['name']?></td>
				<td align="center"><?if($data['status'] == "1" ){?>
						ผ่าน
				<?}else{?>
						ไม่ผ่าน
				<?}?></td>
				<td><a href="EvaluationEmployee.php?codeE=<?=$data['evaluation_e'] ?>">Evaluation</a></td>
				<td><a href="ReportEmployee.php?codeR=<?=$data['evaluation_e'] ?>&nameR=<?=$data['name'] ?>">Report</a></td>
			</tr>
			<?php 
				$i++;
				}
				}
			?>
		</table>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
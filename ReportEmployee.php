<?php 
	session_start();
	include 'connection.php';
	
	$loginSQL = "SELECT * FROM employee WHERE e_code = '".$_SESSION['e_code']."' ";
	$loginSQLquery = mysql_query($loginSQL);
	$loginSQLresult = mysql_fetch_array($loginSQLquery);
	
	$codeR = $_GET['codeR'];
	$nameR = $_GET['nameR'];

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
    <style type="text/css">
    .font-center{
    	max-width: 85%;
    	margin-left: auto;
    	margin-right: auto;
    	vertical-align: middle;
    }
    .evaluation-bonder{
    	-webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 3px solid #e5e5e5;
    }
    .evaluation-bonder p{
    	margin-top:-13px;
    	margin-left: 10px;
    }
    </style>
    
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-static-top translucent">
		<div class="container">
			<b class="navbar-brand"><?=$loginSQLresult['e_code'] ?></b><a class="navbar-brand" href="LoginEmployee.php"> <b>[Sign Out]</b></a>
			<!-- ทำตัว navHeaderCollapse -->
			<div class="collapse navbar-collapse navHeaderCollapse ">
				<!-- Start tag ul -->
				<ul class="nav navbar-nav navbar-right">
					<li><a href="IndexEmployee.php">HOME</a></li>
					<li><a href="">EVALUATION</a></li>
					<li class="active"><a href="#">REPORT</a></li>
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
		<div class="font-center">
			<p><b><font size="5"><?=$nameR ?> &nbsp; '& Charater Report</font></b></p>
			
			
			<form action="" method="post">
			<div class="evaluation-bonder"><p>Job Satisfaction Review</p>
				<table  style="margin-left: 5px;" >
				
				<tr>
					<td></td>
					<td align="center">Total</td>
					<td align="center">Average</td>
				</tr>
				
				<?
				include 'connection.php';
				
				$query = "SELECT question_evaluation.*,answer1_evaluation.`id_question`, sum(answer1_evaluation.`score`) as qtyscore, count(employee.`e_code`) AS qtyperson, answer1_evaluation.`evaluation_employee`,answer1_evaluation.`suggestion` FROM question_evaluation,answer1_evaluation,employee WHERE '".$codeR."' = answer1_evaluation.`evaluation_employee` AND question_evaluation.`id` = answer1_evaluation.`id_question` GROUP BY  answer1_evaluation.`id_question`";
				
				$querySQL = mysql_query($query) or die(mysql_errno());
				
				while ($result = mysql_fetch_array($querySQL)) {
				
				$person = $result['qtyperson'] / 2;
				
				?>
				
				<tr>
					<td width="800"><?=$result['question'] ?></td>
					<td width="100" align="center"><?=$result['qtyscore'] ?></td>
					<td width="100" align="center"><?=number_format(($result['qtyscore'] / $person),2)  ?></td>
				</tr>
				<? }  ?>
			</table>
			
			<hr>
			<label style="margin-left: 5px;">Suggestion</label><br>
				<table>
				<? 
				$i = 1;
				$suggestion = "SELECT * FROM answer1_evaluation WHERE '".$codeR."' = answer1_evaluation.`evaluation_employee` ";
				$suggestionSQL = mysql_query($suggestion) or die(mysql_errno());
				while ($sug = mysql_fetch_array($suggestionSQL)) {
					
				
				
				?>
					<tr>
						<td><?=$i ?></td>
						<td>&nbsp;<?=$sug['suggestion'] ?></td>
					</tr>
					<? 
						$i++;
						} ?>
				</table>
			</div>
			<br>
			<div class="evaluation-bonder"><p>Job Performance Review</p>
				<table style="margin-left: 5px;" >
				<tr>
					<td></td>
					<td align="center">Total</td>
					<td align="center">Average</td>
				</tr>
				<?
				$query2 = "SELECT question_evaluation.*,answer2_evaluation.`id_question`, SUM(answer2_evaluation.`score`) as qtyscore, count(employee.`e_code`) AS qtyperson, answer2_evaluation.`evaluation_employee`,answer2_evaluation.`suggestion` FROM question_evaluation,answer2_evaluation,employee WHERE '".$codeR."' = answer2_evaluation.`evaluation_employee` AND question_evaluation.`id` = answer2_evaluation.`id_question` GROUP BY  answer2_evaluation.`id_question`";
				
				$querySQL2 = mysql_query($query2) or die(mysql_errno());
				
				while ($result2 = mysql_fetch_array($querySQL2)) {
					
				$person2 = $result2['qtyperson'] / 2;
				
				?>
				
				<tr>
					<td width="800"><?=$result2['question'] ?></td>
					<td width="100" align="center"><?=$result2['qtyscore'] ?></td>
					<td width="100" align="center"><?=number_format(($result2['qtyscore'] / $person2),2)  ?></td>
				</tr>
				
				<? } ?>
			</table>
			
			<hr>
			<label style="margin-left: 5px;">Suggestion</label><br>
				<table>
				<? 
				$j = 1;
				$suggestion2 = "SELECT * FROM answer2_evaluation WHERE '".$codeR."' = answer2_evaluation.`evaluation_employee` ";
				$suggestionSQL2 = mysql_query($suggestion2) or die(mysql_errno());
				while ($sug2 = mysql_fetch_array($suggestionSQL2)) {
					
				
				
				?>
					<tr>
						<td><?=$j ?></td>
						<td>&nbsp;<?=$sug2['suggestion'] ?></td>
					</tr>
					<? 
						$j++;
						} ?>
				</table>
			</div>
			<br>
			<div align="right">
				<button type="submit" class="btn btn-success">Success</button>
			</div>
			
			
			</form>
		</div>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
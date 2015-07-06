<?php 
	session_start();
	include 'connection.php';
	
	$loginSQL = "SELECT * FROM employee WHERE e_code = '".$_SESSION['e_code']."' ";
	$loginSQLquery = mysql_query($loginSQL);
	$loginSQLresult = mysql_fetch_array($loginSQLquery);
	
	$codeE = $_GET['codeE'];

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
					<li class="active"><a href="">EVALUATION</a></li>
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
		<div class="font-center">
			<b>Please rank your responses to the following questions</b>
			<p>1 -Poor,2 -Fair,3 -Good,4 -Very Good,5 -Excellent</p>
			
			<form action="saveEvaluation.php?code=<?=$_SESSION['e_code'] ?>&Ecode=<?=$codeE ?>" method="post">
			<div class="evaluation-bonder"><p>Job Satisfaction Review</p>
				
				<table style="margin-left: 5px;">
				<?php 
				include 'connection.php';
				
				$questionSQL = "SELECT * FROM question_evaluation LIMIT 0,6";
				$questionSQLquery = mysql_query($questionSQL);
				$question_Rows = mysql_num_rows($questionSQLquery);
				$i=1;
				while ($result = mysql_fetch_array($questionSQLquery)){
					$id_chk = $result['id'];
					$name = $result['question'];
				?>
				<tr>
					<td width="50%"><?=$name ?></td>
					<td width="6%"><input type="radio" name="radionNo<?=$i;?>" value="1">&nbsp;1</td>
					<td width="6%"><input type="radio" name="radionNo<?=$i;?>" value="2">&nbsp;2</td>
					<td width="6%"><input type="radio" name="radionNo<?=$i;?>" value="3">&nbsp;3</td>
					<td width="6%"><input type="radio" name="radionNo<?=$i;?>" value="4">&nbsp;4</td>
					<td width="6%"><input type="radio" name="radionNo<?=$i;?>" value="5">&nbsp;5</td>
				</tr>
				
				<?php 
					$i++;
				}
				?>
				
			</table>
			
			<hr>
			<label style="margin-left: 5px;">Suggestion</label><br>
			<textarea name="suggestion1" rows="5" cols="100" style="margin-left: 5px;"></textarea>
			</div>
			<br>
			<div class="evaluation-bonder"><p>Job Performance Review</p>
				<table style="margin-left: 5px;">
				<?php 
				$questionSQL2 = "SELECT * FROM question_evaluation LIMIT 6,13";
				$questionSQLquery2 = mysql_query($questionSQL2);
				$question_Rows2 = mysql_num_rows($questionSQLquery2);
				$j=7;
				while ($result2 = mysql_fetch_array($questionSQLquery2)){
					$id_chk2 = $result2['id'];
					$name2 = $result2['question'];
				?>
			
				<tr>
					<td width="50%"><?=$name2 ?></td>
					<td width="6%"><input type="radio" name="radionNoJ<?=$j;?>" value="1">&nbsp;1</td>
					<td width="6%"><input type="radio" name="radionNoJ<?=$j;?>" value="2">&nbsp;2</td>
					<td width="6%"><input type="radio" name="radionNoJ<?=$j;?>" value="3">&nbsp;3</td>
					<td width="6%"><input type="radio" name="radionNoJ<?=$j;?>" value="4">&nbsp;4</td>
					<td width="6%"><input type="radio" name="radionNoJ<?=$j;?>" value="5">&nbsp;5</td>
				</tr>
				
				<?php 
					$j++;
				}
				?>
			</table>
			
			<hr>
			<label style="margin-left: 5px;">Suggestion</label><br>
			<textarea name="suggestion2" rows="5" cols="100"  style="margin-left: 5px;"></textarea>
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
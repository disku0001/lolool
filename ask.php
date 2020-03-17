<? 
session_start();
include_once"function/config.php";
	
	$query = mysql_query("SELECT board FROM admin") or die(mysql_error());
	$info = mysql_fetch_array($query);
	
	// CHECK IP EXISTS
	if(isset($_POST['checkip'])){
	$ipaddress = $_POST['ipaddress'];
	$check_if_ipexists = mysql_query("SELECT * FROM `members` WHERE `ip` = '$ipaddress'");   
	if(mysql_num_rows($check_if_ipexists) == 0){
		$error_output2.='<span style="color: green">Congrt! You CAN use this IP address!</span>'; }
	else {
		$error_output2.="Oops! You CAN NOT use this IP address!!!";
	}}

	if(isset($_POST['regRequester'])) {
		$requester = $_POST['requester'];
		$yahoo = $_POST['yahoo'];
		$banks = $_POST['banks'];
		if($requester == NULL || $yahoo == NULL || $banks == NULL) {
			$final_report.="Please input all fields !";
		} else {
			if(strlen($requester) <= 2 || strlen($requester) >= 11){
				$final_report.="Your ID must be between 3 and 10 characters";
			} else { 
				$checkReq = mysql_query("SELECT name FROM requesters WHERE name = '$requester'");   
				if(mysql_num_rows($checkReq) != 0){
					$final_report.="The ID is already in use!";  
				}else{
					$queryReg = mysql_query("INSERT INTO requesters(id,name,yahoo,banks) VALUES('','$requester','$yahoo','$banks')") or die(mysql_error());
					$final_report.= 'Register successfully !<br><span style="color: green">You can use this name for cashout.</span>';
				}
			}
		}
	}

?>

<?php include("function/includes.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title><?php echo $title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <style type="text/css">
	@font-face{font-family:Calibri;src:url(../function/Calibri.ttf), url(../function/Calibrib.ttf)}
	body{color:#555;font-family:Calibri,Tahoma,sans-serif;font-size:12px;height:100%;margin:0;padding:0}
	#wrapper{width:900px;margin:0 auto}
	#content{background:none repeat scroll 0 0 #FFF;box-shadow:0 0 4px #000;overflow:hidden;z-index:89;position:relative;width:880px;margin:20px 0 0;padding:20px 10px}
	#content h3{background:none repeat scroll 0 0 #9BB50B;color:#FFF;font-family:Calibri,Tahoma,sans-serif;font-size:18px;text-align:center;text-shadow:1px 1px 0 #333;text-transform:uppercase;margin:10px 0 0;padding:5px 0}
	#content h4{color:#0093E0;font-family:Calibri,Tahoma,sans-serif;font-size:18px;text-transform:uppercase;text-align:center;margin:10px 0 0}
	th{background-color:#333;color:#EEE;text-align:left;padding:3px; font-family: Arial, Tahoma, sans-serif}
	td{border-bottom:1px dashed #999;font-family:Tahoma, sans-serif;vertical-align:top;margin:0;padding:2px 5px}
	textarea{height:100px;min-height:100px;width:500px;max-width:500px;min-width:500px;border:none;background-color:#EEE;padding:10px}
	.btn{background-color:#0093E0;border:none;width:150px;box-shadow:0 0 2px #999;color:#FFF;font-size:15px;font-weight:700;text-transform:uppercase;font-family:Calibri, sans-serif;margin:5px 0;padding:3px}
	.txt{width:200px;font-size:15px;font-family:Calibri, sans-serif;margin:5px 0 0;padding:1px}
	.label{font-family:Calibri, sans-serif;font-weight:700;font-size:15px;width:50px;display:block;float:left;margin:5px 0 0;padding:2px}
	.board textarea{background-color:#FF9;font-size:14px;font-family:Calibri,sans-serif}
	textarea:focus { background-color: #FFFF99}
	.right{float:right;background-color:#EEE;border:1px solid #CCC;width:300px;height:300px;padding:0 10px 10px}
	.error{color:#F10000;font-weight:700;margin:0 0 5px;padding:3px}
	.left,.left table{width:520px}
  </style>
</head>

<body>
<div id="wrapper">
         
    <div id="content">
		
		<div class="right">
			<div>
				<h3>Register ID for cashout</h3>
				<form action="" method="post">
					<label for="name" class="label">ID</label> <input type="text" name="requester" class="txt" value="Viet khong dau! (3 den 10 ki tu)" onclick="if ( value == 'Viet khong dau! (3 den 10 ki tu)' ) { value = ''; }"/><br>
					<label for="yahoo" class="label">Yahoo</label> <input type="text" name="yahoo" class="txt" value="" /><br>
					<label for="banks" class="label">Banks</label> <input type="text" name="banks" class="txt" value="Ten Bank: So TK" onclick="if ( value == 'Ten Bank: So TK' ) { value = ''; }"/><br>
					<input type="submit" name="regRequester" value="Register" class="btn" />
				</form>
				<?php if($final_report !=""){?>
				<p class="error">
					<?php echo $final_report;?>
				</p>
				<?php } ?>
			</div>
			
			<div>
				<h3>Check IP address</h3>
				<form action="#" method="POST">
						<input name="ipaddress" class="txt" value="Ip address" onclick="if ( value == 'Ip address' ) { value = ''; }"/>
						<input type="submit" name="checkip" value="Check IP" tabindex="3" class="btn" />
				</form>
				<?php if($error_output2 !=""){?>
				<p class="error">
					<?php echo $error_output2;?>
				</p>
				<?php } ?>
			</div>
		</div>

		<div class="left">
			<div class="board">
				<h3>Notice Board</h3>
				<textarea><?php echo $info['board'];?></textarea>
			</div>
		</div>	
		<div class="left">
			<h3>Check Requester Points</h3>
			<form action="" method="post">
				<label for="name" class="label">List</label><textarea name="listReq"><? echo $_POST['listReq'];?></textarea><br>
				<input type="submit" name="checkReq" value="Check" class="btn" />
			</form>
			<?php if($final_report1 !=""){?>
			<p class="error">
				<? echo $final_report1;?>
			</p>
			<?php } ?>
			<table cellspacing="0" cellpadding="3">
				<thead>
					<tr>
						<th>Requester</th>
						<th>Yahoo</th>
						<th>Banks</th>
						<th>Points</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if(isset($_POST['checkRequester'])) {
							$requester = $_POST['requester'];
							if($requester == NULL) {
								$final_report1.="Please input requester name !";
							} else {
								$queryRequester = mysql_query("SELECT * FROM requesters WHERE name='".$requester."'") or die(mysql_error());
								$info = mysql_fetch_array($queryRequester);
								$yahoo = $info['yahoo'];
								$banks = $info['banks'];
								$queryPoints = mysql_query("SELECT SUM(points) FROM members WHERE requester='".$requester."' GROUP BY requester") or die(mysql_error());
								$p = mysql_fetch_array($queryPoints);
								$points = $p['SUM(points)'];
								echo '<tr><td>'.$requester.'</td><td>'.$yahoo.'</td><td>'.$banks.'</td><td>'.$points.'</td></tr>';	
							}
						}
						
						if(isset($_POST['checkReq'])) {
							$listReqters = trim($_POST['listReq']);
							//explode all separate lines into an array
							$reqAr = explode("\r\n", $listReqters);
							//trim all lines contained in the array.
							$reqAr = array_filter($reqAr, 'trim');		
							$uarray = array_unique($reqAr);
							//Tong point
							$total_point ='';		
							foreach ($uarray as $req)
							{	
								$queryReqter = mysql_query("SELECT * FROM requesters WHERE name='{$req}'") or die(mysql_error());
								if($queryReqter){
									while ($requester = mysql_fetch_array($queryReqter))
									{
										$requestername = $requester['name'];
										echo '<tr>';
										echo '<td><b>' . $requestername. '</b></td>';
										echo '<td>' . $requester['yahoo'] . '</td>';
										echo '<td>' . $requester['banks'] . '</td>';
										$queryPoints = mysql_query("SELECT SUM(points) FROM members WHERE requester='".$requestername."' GROUP BY requester") or die(mysql_error());
										$p = mysql_fetch_array($queryPoints);
										$points = $p['SUM(points)'];
										echo '<td>' . $points. '</td>';
										echo '</tr>';
										$total_point +=$points;
									}
								} else {
									echo mysql_error();
								}
							}
							echo '<tr><td></td><td></td><td><b>Total:</b></td><td>';
							echo '<span style="font-weight: bold; color: green;">'.$total_point . '</span>';
							echo '</td></tr>';			
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="left">
			<h3>Check User Points</h3>
			<form action="" method="POST">
				<textarea name="userslist"><? echo $_POST['userslist'];?></textarea><br>
				<input type="submit" name="checkpoints" value="Check Points" class="btn" />
			</form>
			<br>
			<table cellspacing="0" cellpadding="3">
				<thead>
					<tr>
						<th>Username</th>
						<th>Date</th>
						<th>Points</th>
					</tr>
				</thead>
				<tbody>
					<?php
						//Check user points from textarea
						if ($_POST['checkpoints'])
						{
							//trim off excess whitespace off the whole
							$text = trim($_POST['userslist']);
							//explode all separate lines into an array
							$textAr = explode("\r\n", $text);
							//trim all lines contained in the array.
							$textAr = array_filter($textAr, 'trim');			
							$uarray = array_unique($textAr);
							//Tong point
							$total_point ='';		
							$total_acc ='';
							foreach ($uarray as $line)
							{	
								$get_textarea_user = mysql_query("SELECT username, points, date FROM `members` WHERE username='{$line}'") or die(mysql_error());
								if($get_textarea_user){
									while ($row = mysql_fetch_array($get_textarea_user))
									{
										$username = $row['username'] ;
										echo '<tr>';
										echo '<td><span style="color: red; font-weight: bold">' . $username . '</span></td>';
										echo '<td><b>' . $row['date'] . '</b></td>';
										echo '<td><b>' . $row['points'] . '</b></td>';
										echo '</tr>';
										$getOffers = mysql_query("SELECT * FROM leads WHERE userName='{$username}'") or die(mysql_error());
										if($getOffers){
											while ($off = mysql_fetch_array($getOffers)){
												echo '<tr>';
												if ($off['offerName']=="#") {
													echo '<td>'. $off['offerNwk'] .'</td>';
												} else {
													echo '<td>'. $off['offerName'] .'</td>';
												}
												echo '<td>' . $off['ip'] . '</td>';
												echo '<td>' . $off['points'] . '</td>';
												echo '</tr>';
											}
										}
										$total_point +=$row['points'];
										$total_acc += 1;
									}
								} else {
									echo mysql_error();
								}
							}
							echo '<tr><td><b>Total:</b></td><td><span style="font-weight: bold; color: green;">'.$total_acc.' accounts</span></td><td>';
							echo '<span style="font-weight: bold; color: green;">'.$total_point . ' points</span>';
							echo '</td></tr>';			
						}
					?>
				</tbody>
			</table>
		</div>
	
	</div>
	

</div>
</body>
</html>
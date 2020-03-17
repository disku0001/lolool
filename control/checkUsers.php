<?php
session_start();
include_once"../function/config.php";
include("../function/fnc.php");
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 
	header("Location: login.php"); 
	} 

date_default_timezone_set('America/New_York');
$error_output = "";
$error_output2 = "";


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel : Check Users</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
  <link rel="stylesheet" href="../jquery/style.css" />
  <script type="text/javascript" src="../jquery/calc-func.js">
  </script>
</head>

<?php include('header.php') ?>
   
    <div id="content">
		
			<div class="box userlists">
				<div class="calc">
				<h2>Mini Calculator</h2>
			<table>
			<tr><td>
				<form name="calci" onsubmit="return false">
				<table cellpadding=0 cellspacing=0 >
				<tr><td>
					<input class="disp" name="result" type="text"  readonly></input>
				</td></tr>
		
				<tr><td>
					<table cellpadding=0 cellspacing=0>
					<tr><td>
						<input class=butt title="Clear" type=button name=clear onClick="change(this)" value="AC"></input>
					</td><td>
						<input class=butt title="go back" type=button name=back onClick="change(this)" value="<"></input>
					</td><td>
						<input class=butt type=button title="factorial" name=fact onClick="change(this)" value="x!"></input></td>
					</td><td>
						<input class=butt type=button title="Add" name=add onClick="change(this)" value="+"></input>
					</td></tr>
					</table>
				</td></tr>
		
		<tr><td>
			<table cellpadding=0 cellspacing=0>
			<tr><td>
				<input class=butt type=button title="one" name=one onClick="change(this)" value=1></input>
			</td><td>
				<input class=butt type=button title="two" name=two onClick="change(this)" value=2></input>
			</td><td>
				<input class=butt type=button title="three" name=three onClick="change(this)" value=3></input>
			</td><td>
				<input class=butt type=button title="Subtract" name=subtract onClick="change(this)" value="-"></input>
			</td></tr>
			</table>
		</td></tr>
		
		<tr><td>
			<table cellpadding=0 cellspacing=0>
			<tr><td>
				<input class=butt type=button title="four" name=four onClick="change(this)" value=4></input>
			</td><td>
				<input class=butt type=button title="five" name=five onClick="change(this)" value=5></input>
			</td><td>
				<input class=butt type=button title="six" name=six onClick="change(this)" value=6></input>
			</td><td>
				<input class=butt type=button title="Multiply By" name=multiply onClick="change(this)" value="*"></input>
			</td></tr>
			</table>
		</td></tr>
		
		<tr><td>
			<table cellpadding=0 cellspacing=0>
			<tr><td>
				<input class=butt type=button title="seven" name=seven onClick="change(this)" value=7></input>
			</td><td>
				<input class=butt type=button title="eight" name=eight onClick="change(this)" value=8></input>
			</td><td>
				<input class=butt type=button title="nine" name=nine onClick="change(this)" value=9></input>
			</td><td>
				<input class=butt type=button title="Divide By" name=dby onClick="change(this)" value="/"></input>
			</td></tr>
			</table>
		</td></tr>

		<tr><td>
			<table cellpadding=0 cellspacing=0>
			<tr><td>
				<input class=butt title="Zero" type=button name=zero onClick="change(this)" value=0></input>
			</td><td>
				<input class=butt title="dot" type=button name=dot onClick="change(this)" value="."></input>
			</td><td>
				<input class=butt title="EQUALS" type=button name=equals onClick="change(this)" value="="></input>
			</td><td>
				<a style="text-decoration:none;" href="http://www.hscripts.com"><input class=butt type=button name=lin value="H"></a>
			</td></tr>
			</table>
		</td></tr>
		</table>
	</form>
	</td></tr>
	</table>
		</div>
			
				<!-- GET USERNAMES LIST ( WITHOUT REQUESTER )  -->
				<h2>GET USERNAMES LIST *WITHOUT REQUESTER*</h2>
				<form action="#" method="POST">
					<input type="submit" name="getUsernames" class="btn" value="GET LIST" tabindex="3" />
					<span class="error"><?php echo $error_output1?></span><br>
				</form>
				
				<table cellspacing="0">
					<thead>
						<tr>
							<th width="150">Username Lists</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if (isset($_POST['getUsernames'])) {						
							$queryUsers = mysql_query("SELECT userName FROM members WHERE (requester='' AND points>0)") or die(mysql_error());
								while($user = mysql_fetch_assoc($queryUsers)) {
									echo '<tr><td>' . $user['userName'] . '</td></tr>';
								}
						}
						?>
					</tbody>
				</table>

			</div>
			
			<div class="usercheck point"><!-- CHECK USER POINTS -->	
				<h2>Check Points</h2>
				<div class="form">
					<form action="" method="POST">
						<textarea class="textarea" name="userList1"><? echo $_POST['userList1'];?></textarea><br>
						<input class="btn" type="submit" name="checkpoints" value="OK" />
					</form>
				</div>
				<table cellspacing="0">
					<thead>
						<tr>
							<th>Username</th>
							<th>Password</th>
							<th>Email</th>
							<th width="100">IP</th>
							<th width="70">CC</th>
							<th width="40">Offers</th>
							<th width="40">Points</th>
							<th width="40">Paid</th>
						</tr>
					</thead>
					<tbody>
					<?php
						//Check user points from textarea
						if ($_POST['checkpoints']) {
							//trim off excess whitespace off the whole
							$text = trim($_POST['userList1']);
							//explode all separate lines into an array
							$textAr = explode("\r\n", $text);
							//trim all lines contained in the array.
							$textAr = array_filter($textAr, 'trim');		
							$uarray = array_unique($textAr);							
							//Tong point
							$total_point ='';
							$total_acc = '';
							foreach ($uarray as $line){
								$get_textarea_user = mysql_query("SELECT userName, userPassword, email, status, points, port, ip, leadedOffers FROM `members` WHERE userName='{$line}'");
								if($get_textarea_user){
									while ($row = mysql_fetch_array($get_textarea_user)){
										if($row['points'] == 0){ continue; }
										$cc = checkcc($row['ip']);
										echo '<tr>';
										echo '<td>' . $row['userName'] . '</td>';
										echo '<td>' . $row['userPassword'] . '</td>';
										echo '<td>' . $row['email'] . '</td>';
										echo '<td>' . $row['ip'] . '</td>';	
										echo '<td>' . $cc . '</td>';
										echo '<td>' . $row['leadedOffers'] . '</td>';		
										echo '<td>' . $row['points'] . '</td>';										
										echo '<td>';
											if($row['points'] <= 0)
											{
												echo '<span style="color: red; font-weight: bold;">Paid</span>';
											} else {
												echo '<span style="color: green;">unPaid</span>';
											}
										echo '</td>';
										echo '</tr>';
										$total_point +=$row['points'];
										$total_acc += 1;
									}
								} else{
									echo mysql_error();
								}
							}
							echo '<tr><td></td><td></td><td></td><td><b>Total:</b> </td><td><span style="font-weight: bold; color: red; font-size: 14px;">'.$total_acc.' acc</span></td><td></td><td><span style="font-weight: bold; color: red; font-size: 14px;">'.$total_point.'</span></td><td></td></tr>';
						} ?>
					</tbody>	
				</table>
			</div>
			
			<div class="usercheck point"><!-- CHECK USER POINTS  by REQUESTERS LIST-->	
				<h2>Check Points - by Requesters</h2>
				<div class="form">
					<form action="" method="POST">
						<textarea class="textarea" name="requesterslist1"><? echo $_POST['requesterslist1'];?></textarea><br>
						<input class="btn" type="submit" name="checkpointsReq" value="OK" />
					</form>
				</div>
				<table cellspacing="0">
					<thead>
						<tr>
							<th>Username</th>
							<th>Password</th>
							<th>Email</th>
							<th width="100">IP</th>
							<th width="70">Type</th>
							<th width="40">Offers</th>
							<th width="40">Points</th>
							<th width="40">Paid</th>
						</tr>
					</thead>
					<tbody>
					<?php
						//Check user points from textarea
						if ($_POST['checkpointsReq']) {
							//trim off excess whitespace off the whole
							$text = trim($_POST['requesterslist1']);
							//explode all separate lines into an array
							$textAr = explode("\r\n", $text);
							//trim all lines contained in the array.
							$textAr = array_filter($textAr, 'trim');	
							$uarray = array_unique($textAr);
							$all_acc = '';
							$all_points = '';
							foreach ($uarray as $req){
								echo '<tr><td colspan="8"><b>Requester:</b><span style="font-weight: bold; color: red; font-style: italic"> ' . $req . '</span></td></tr>';
								$queryUsersbyReq = mysql_query("SELECT userName FROM members WHERE requester='".$req."'") or die(mysql_error());
								while($user = mysql_fetch_assoc($queryUsersbyReq)) {
										$username = $user['userName'];
										$getUserInfo = mysql_query("SELECT userName, userPassword, email, status, points, port, ip, leadedOffers FROM `members` WHERE userName='{$username}'");
										if($getUserInfo){
											while ($row = mysql_fetch_array($getUserInfo)){
												if($row['points'] == 0) { continue;}
												echo '<tr>';
												echo '<td>' . $row['userName'] . '</td>';
												echo '<td>' . $row['userPassword'] . '</td>';
												echo '<td>' . $row['email'] . '</td>';
												echo '<td>' . $row['ip'] . '</td>';	
												echo '<td>' . $row['port'] . '</td>';
												echo '<td>' . $row['leadedOffers'] . '</td>';		
												echo '<td>' . $row['points'] . '</td>';										
												echo '<td>';
													if($row['points'] <= 0)
													{
														echo '<span style="color: red; font-weight: bold;">Paid</span>';
													} else {
														echo '<span style="color: green;">unPaid</span>';
													}
												echo '</td>';
												echo '</tr>';
												$all_acc += 1;
												$all_points +=$row['points'];
											}
										} else{
											echo mysql_error();
										}										
								}
								$qtotalpoints = mysql_query("SELECT SUM(points) AS totalpoints FROM members WHERE requester='".$req."'") or die(mysql_error());
								$result = mysql_fetch_array($qtotalpoints);
								$totalpoints = $result['totalpoints'];
								$qtotalacc = mysql_query("SELECT COUNT(id) AS totalacc FROM members WHERE (requester='".$req."' AND points>0)") or die(mysql_error());
								$result = mysql_fetch_array($qtotalacc);
								$totalacc = $result['totalacc'];							
								echo '<tr><td></td><td></td><td></td><td><b>Total:</b> </td><td><span style="font-weight: bold; color: red; font-size: 14px;">'.$totalacc.' acc</span></td><td></td><td><span style="font-weight: bold; color: red; font-size: 14px;">'.$totalpoints.'</span></td><td></td></tr>';								
							}
							echo '<tr><td></td><td></td><td></td><td><b>All:</b> </td><td><span style="font-weight: bold; color: #0093E0; font-size: 14px;">'.$all_acc.' acc</span></td><td></td><td><span style="font-weight: bold; color: #0093E0; font-size: 14px;">'.$all_points.'</span></td><td></td></tr>';
						} 
						?>
					</tbody>	
				</table>
			</div>
			
			<div class="usercheck point"><!-- CHECK OFFER LEADED BY USERNAME LIST -->	
				<h2>Check Offers</h2>
				<div class="form">
					<form action="" method="POST">
						<textarea class="textarea" name="userlist2"><? echo $_POST['userlist2'];?></textarea><br>
						<input class="btn" type="submit" name="checkOffbyUsers" value="OK" />
					</form>
				</div>
				<table cellspacing="0">
					<thead>
						<tr>
							<th width="70">Date</th>
							<th width="200">Offer</th>
							<th width="30">Points</th>
							<th width="100">IP</th>
							<th width="50">Type</th>
							<th width="30">Country</th>
							<th>Network</th>
							<th>ID</th>
						</tr>
					</thead>
					<tbody>
					<?php
						//Check user points from textarea
						if ($_POST['checkOffbyUsers']) {
							//trim off excess whitespace off the whole
							$usernameslist = trim($_POST['userlist2']);
							//explode all separate lines into an array
							$textAr = explode("\r\n", $usernameslist);
							//trim all lines contained in the array.
							$textAr = array_filter($textAr, 'trim');	
							$uarray = array_unique($textAr);							
							foreach ($uarray as $user){
								$getOffers = mysql_query("SELECT * FROM leads WHERE userName='{$user}'") or die(mysql_error());
								if($getOffers){
									$getReq = mysql_query("SELECT requester FROM members WHERE userName='".$user."'") or die(mysql_error());
									$req  = mysql_fetch_array($getReq);
									echo '<tr><td colspan="2"><b>Username:</b> <span style="color: red; font-weight: bold;">'.$user.'</span></td><td colspan="6"><b>Requester:</b> <span style="color: red; font-weight: bold;">'.$req['requester'].'</span></td></tr>';
									while ($row = mysql_fetch_array($getOffers)){
										echo '<tr>';
										echo '<td>' . $row['date'] . '</td>';
										echo '<td>'. $row['offerName'] .'</td>';
										echo '<td>' . $row['points'] . '</td>';
										echo '<td>'. $row['ip'] .'</td>';
										echo '<td>' . $row['port'] . '</td>';
										echo '<td>' . $row['offerCC'] . '</td>';
										echo '<td>' . $row['offerNwk'] . '</td>';
										echo '<td>' . $row['offerId'] . '</td>';
										echo '</tr>';
									}
								} 
							}
						} 
						?>
					</tbody>	
				</table>
			</div>
			
			<div class="usercheck point"><!-- CHECK OFFER LEADED BY REQUESTERS LIST -->	
				<h2>Check Offers by Requesters</h2>
				<div class="form">
					<form action="" method="POST">
						<textarea class="textarea" name="requesterlist2"><? echo $_POST['requesterlist2'];?></textarea><br>
						<input class="btn" type="submit" name="checkOffbyReq" value="OK" />
					</form>
				</div>
				<table cellspacing="0">
					<thead>
						<tr>
							<th width="70">Date</th>
							<th width="200">Offer</th>
							<th width="30">Points</th>
							<th width="100">IP</th>
							<th width="50">Type</th>
							<th width="30">Country</th>
							<th>Network</th>
							<th>ID</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//Check user points from textarea
						if ($_POST['checkOffbyReq']) {
							//trim off excess whitespace off the whole
							$reqlist = trim($_POST['requesterlist2']);
							//explode all separate lines into an array
							$textAr = explode("\r\n", $reqlist);
							//trim all lines contained in the array.
							$textAr = array_filter($textAr, 'trim');	
							$uarray = array_unique($textAr);
							foreach ($uarray as $req){
								echo '<tr><td colspan="8"><b>Requester:</b><span style="font-weight: bold; color: #0093E0; font-style: italic"> ' . $req . '</span></td></tr>';
								$queryUsersbyReq = mysql_query("SELECT userName FROM members WHERE requester='".$req."'") or die(mysql_error());
								while($user = mysql_fetch_assoc($queryUsersbyReq)) {
										$username = $user['userName'];										
										$getOffers = mysql_query("SELECT * FROM leads WHERE userName='{$username}'") or die(mysql_error());
										if(mysql_num_rows($getOffers) == 0){
											continue;
										} else {
											echo '<tr><td colspan="8">Username: <span style="color: red; font-weight: bold;">'.$username.'</span></td></tr>';
											while ($row = mysql_fetch_array($getOffers)){
												echo '<tr>';
												echo '<td>' . $row['date'] . '</td>';
												echo '<td>'. $row['offerName'] .'</td>';
												echo '<td>' . $row['points'] . '</td>';
												echo '<td>'. $row['ip'] .'</td>';
												echo '<td>' . $row['port'] . '</td>';
												echo '<td>' . $row['offerCC'] . '</td>';
												echo '<td>' . $row['offerNwk'] . '</td>';
												echo '<td>' . $row['offerId'] . '</td>';
												echo '</tr>';
											}
										} 
								}
							}
						} 
						?>
					</tbody>	
				</table>
			</div>
			
			

    </div>
</div>
<?php include("guidebtn.php");?>
</body>
</html>
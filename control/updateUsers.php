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
if(isset($_POST['updated'])){
	$username1 = $_POST['username1'];
	$points1 = $_POST['points1'];
	$check_if_userexists = mysql_query("SELECT * FROM `members` WHERE `username` = '$username1'");   
	if(mysql_num_rows($check_if_userexists) == 0){
		$error_output.="Username does not exist !"; 
	}
	else {
	$error_output = '<span style="color: green;">Points for '.$username1.' were successfully updated</span>';
	$updateuserpoints = mysql_query("UPDATE `members` SET `points` = '$points1' WHERE `username`= '$username1'") or die(mysql_error());
	}
}
 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel : Update Users</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
</head>

<?php include('header.php') ?>
   
    <div id="content">	
			<div class="userupdate"><!-- UPDATE USER PAID STATUS AND RESET POINT -->
				<h2>Update Paid - by Usernames</h2>
				<div class="form">
					<form action="" method="POST">
						<textarea class="textarea" name="usernames1"><? echo $_POST['usernames1'];?></textarea><br>
						<input class="btn" type="submit" name="paidUsername" value="Update" />
					</form>
				</div>
				<?php
					//Check user points from textarea
					if ($_POST['paidUsername'])
					{
						//trim off excess whitespace off the whole
						$username = trim($_POST['usernames1']);
						//explode all separate lines into an array
						$textAr = explode("\r\n", $username);
						//trim all lines contained in the array.
						$textAr = array_filter($textAr, 'trim');
						foreach ($textAr as $user)
						{
							$updateuserpoints = mysql_query("UPDATE members SET points = '0', leadedOffers = '0' WHERE userName= '$user'") or die(mysql_error());
						}
						echo '<br><span class="error">Update successfully!</span>';
					}
				?>
			</div>
		
			<div class="userupdate">
				<h2>Update Paid - by Requesters</h2>
				<div class="form">
					<form action="" method="POST">
						<textarea class="textarea" name="requesters1"><? echo $_POST['requesters1'];?></textarea><br>
						<input class="btn" type="submit" name="paidRequester" value="Update" />
					</form>
				</div>
					<?php
						if ($_POST['paidRequester'])
						{
							//trim off excess whitespace off the whole
							$requesters = trim($_POST['requesters1']);
							//explode all separate lines into an array
							$textAr = explode("\r\n", $requesters);
							//trim all lines contained in the array.
							$textAr = array_filter($textAr, 'trim');
							foreach ($textAr as $req)
							{
								$updatePaid = mysql_query("UPDATE members SET points = '0', leadedOffers = '0' WHERE requester= '$req'") or die(mysql_error());
							}
							echo '<br><span class="error">Update successfully!</span>';
						}
					?>
			</div>
			
			<div class="userupdate"><!-- UPDATE REQUESTER FOR USERNAME -->
				<h2>Update Requester for Users</h2>
				<div class="form">
					<form action="" method="POST">
						<textarea class="textarea" name="usernameslist">usernames list ...</textarea><br>
						<label for="name" class="label">Requester</label> 
						<input class="txt" title="requester" name="requester" class="txt" />
						<input class="btn" type="submit" name="updateRequester" value="Update" />
					</form>
				</div>
				<?php
					//Check user points from textarea
					if ($_POST['updateRequester'])
					{
						$requester = $_POST['requester'];
						//trim off excess whitespace off the whole
						$usernameslist = trim($_POST['usernameslist']);
						//explode all separate lines into an array
						$textAr = explode("\r\n", $usernameslist);
						//trim all lines contained in the array.
						$textAr = array_filter($textAr, 'trim');
						foreach ($textAr as $user)
						{
							$updateRequester = mysql_query("UPDATE members SET requester='".$requester."' WHERE userName= '$user'") or die(mysql_error());
						}
						echo '<br><span class="error">Update successfully!</span>';
					}
				?>
			</div>
			
			<div class="userupdate updateUserPoint">
				<h2>Update User Points</h2>
				<div class="form">
					<form action="#" method="POST">
								<label for="name" class="label">Username</label> 
								<input class="txt" title="username1" name="username1" class="txt" />
								<label for="point" class="label">Points</label> 
								<input class="txt" name="points1" type="text" class="txt" title="points1" />
								<input class="btn" type="submit" name="updated" class="submit" value="Update" tabindex="3" />
								<br><span class="error"><?php echo $error_output?></span>
					</form>
				</div>
			</div>		

		
    </div>
</div>
<?php include("guidebtn.php");?>
</body>
</html>

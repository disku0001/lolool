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
  <title>Admin cPanel : Charge Back</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
</head>

<?php include('header.php') ?>
   
    <div id="content">	

			<div class="userupdate"><!-- CHARGE BACK by USERNAME LISTS-->
				<h2>Charge back by Username lists</h2>
				<div class="form">
					<form action="" method="POST">
						<textarea class="textarea" name="usernameslist"><? echo $_POST['usernameslist'];?></textarea><br>
						<input class="txt" title="name" name="offerName" style="width: 100%" value="<? echo !empty($_POST['offerName'])?$_POST['offerName']:'Offer Name';?>"/>
						<select name="network" style="width: 100%">
							<option value="">Network</option>
							<?
							$network = mysql_query("SELECT * FROM networks") or die(mysql_error());
								while($nwk = mysql_fetch_array($network)) {
							?>
							<option value="<? echo $nwk['name'];?>" <? if($nwk['name']==$_POST['network']) { echo 'selected="selected"';}?>><? echo $nwk['name'];?></option>
							<? }
							$wall = mysql_query("SELECT * FROM walls") or die(mysql_error());
								while($w = mysql_fetch_array($wall)) {
							?>
							<option value="<? echo $w['name'];?>" <? if($w['name']==$_POST['network']) { echo 'selected="selected"';}?>><? echo $w['name'];?></option>
							<? } ?>
						</select><br>
						<label for="name" class="label">Points</label> 
						<input class="txt" title="points" name="points" value="<? echo $_POST['points'];?>"/>
						<input class="btn" type="submit" name="chargePoints" value="Charge" />
					</form>
				</div>
				<?php
					//Check user points from textarea
					if ($_POST['chargePoints'])
					{
						$points = $_POST['points']*(-1);
						$offerName = $_POST['offerName'];
						$offerNwk = $_POST['network'];
						$date = date("Y-m-d H:i:s");
						//trim off excess whitespace off the whole
						$usernameslist = trim($_POST['usernameslist']);
						//explode all separate lines into an array
						$textAr = explode("\r\n", $usernameslist);
						//trim all lines contained in the array.
						$textAr = array_filter($textAr, 'trim');
						foreach ($textAr as $user)
						{
							$charge1 = mysql_query("UPDATE members SET points=points+".$points." WHERE userName ='".$user."'") or die(mysql_error());	
							$charge2 = mysql_query("UPDATE members SET leadedOffers=leadedOffers-1 WHERE userName ='".$user."'") or die(mysql_error());
							//mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','','','$offerName','$points','','$offerNwk','','','','','','$user','$date')");
						}
						echo '<br><span class="error">Charge-back successfully!</span>';
					}
				?>
			</div>


		
    </div>
</div>
<?php include("guidebtn.php");?>
</body>
</html>
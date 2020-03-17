<?php
session_start();
include_once("../function/config.php");
include("../function/fnc.php");
include("../function/includes.php");
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 
	header("Location: login.php"); 
	} 
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel : Users Report</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
		<script type="text/javascript" src="../jquery/jquery-1.9.1.min.js"></script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript">
	// DatePicker
	$(function() {
    $( "#from" ).datepicker({
      defaultDate: "-1w",
	  dateFormat: "yy-mm-dd",
      changeMonth: true,
	  changeYear: true,
	  showOtherMonths: true,
      selectOtherMonths: true,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "",
	  dateFormat: "yy-mm-dd",
      changeMonth: true,
	  changeYear: true,
	  showOtherMonths: true,
      selectOtherMonths: true,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
	// DatePicker
	
</script>
</head>

<?php include("header.php") ?>
   
    <div id="content">
		<div class="box usersReport">
			<h2>Completed Offers by Network</h2>
			<div class="filterdata">
				<form action="#" method="POST">
				<label class="label" for="from">Start Date</label>
				<input type="text" id="from" name="from" /><br>
				<label class="label" for="to">End Date</label>
				<input type="text" id="to" name="to" /><br>
				<label class="label" for="network">Network</label>
				<select name="network">
					<option value=""></option>
					<? 
					$queryNwk = mysql_query("SELECT name FROM networks") or die(mysql_error());
					while($nwk = mysql_fetch_array($queryNwk)) {
					?>
					<option value="<? echo $nwk['name'];?>"><? echo $nwk['name'];?></option>
					<? } ?>
					<? 
					$queryWall = mysql_query("SELECT name FROM walls") or die(mysql_error());
					while($wall = mysql_fetch_array($queryWall)) {
					?>
					<option value="<? echo $wall['name'];?>"><? echo $wall['name'];?></option>
					<? } ?>
				</select><br>
				<input type="submit" name="getList" value="Get Completed Offers List" />&nbsp;<a href="completedOffers.php">Reset Filter</a>
				</form>
			</div>
			
			<div class="clear"></div>
			<table cellspacing="0" class="tablesorter">
				<thead>
					<tr>
						<th>Offer ID</th>
						<th>Completed Offers</th>
					</tr>
				</thead>
				<tbody>
					<?php
							if(isset($_POST['getList'])) {
								if($_POST['network']==NULL) {
									$message2 .= '<span style="color: #F00;">Please select network!</span>';
								} else {
									if ($_POST['from']==NULL || $_POST['to']==NULL) {
										$nwk = $_POST['network'];
										$query = mysql_query("SELECT offerName,offerId FROM leads WHERE offerNwk='".$nwk."' GROUP BY offerName") or die(mysql_error());
										$message2 .= '<span style="color: #0093E0;">All Time</span>';
									} else {
										$nwk = $_POST['network'];
										$f = $_POST['from'];
										$t = $_POST['to'];
										$query = mysql_query("SELECT offerName,offerId FROM leads WHERE (offerNwk='".$nwk."' AND DATE(date)>='".$f."' AND DATE(date)<='".$t."') GROUP BY offerName") or die(mysql_error());
										$message2 .= 'From: <span style="color: #0093E0;">'.$f.'</span>  To: <span style="color: #0093E0;">'.$t.'</span>';
									}
								}
								while($off = mysql_fetch_array($query)) {
									echo '<tr><td>'.$off['offerId'].'</td><td>'.$off['offerName'].'</td></tr>';
								}
							}				
							if($message2 !=""){
								echo '<tr><td><b>'.$_POST['network'].'</b></td><td>'.$message2.'</td></tr>';
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
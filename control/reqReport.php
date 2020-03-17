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
			<h2>Requester Report</h2>
			<div class="filterdata">
				<form action="#" method="POST">
				<label class="label" for="from">Start Date</label>
				<input type="text" id="from" name="from" value="<? echo $_POST['from'];?>" /><br>
				<label class="label" for="to">End Date</label>
				<input type="text" id="to" name="to" value="<? echo $_POST['to'];?>" /><br>
				<label class="label" for="network">Network</label>
				<select name="network">
					<option value=""></option>
					<? 
					$queryNwk = mysql_query("SELECT name FROM networks") or die(mysql_error());
					while($nwk = mysql_fetch_array($queryNwk)) {
					?>
					<option value="<? echo $nwk['name'];?>" <? if($nwk['name']==$_POST['network']) { echo 'selected="selected"'; }?>><? echo $nwk['name'];?></option>
					<? } ?>
					<? 
					$queryWall = mysql_query("SELECT name FROM walls") or die(mysql_error());
					while($wall = mysql_fetch_array($queryWall)) {
					?>
					<option value="<? echo $wall['name'];?>" <? if($wall['name']==$_POST['network']) { echo 'selected="selected"'; }?>><? echo $wall['name'];?></option>
					<? } ?>
				</select><br>
				<textarea class="textarea" name="requestersList"><? echo $_POST['requestersList'];?></textarea><br>
				<input type="submit" name="filterReq" value="Filter Data" />
				</form>
			</div>
			
			<div class="clear"></div>
			<table cellspacing="0" class="tablesorter">
				<thead>
					<tr>
						<th>Requester</th>
						<th>Network</th>
						<th>Points</th>
						<th>Accounts</th>
					</tr>
				</thead>
				<tbody>
						<?php
							if(isset($_POST['filterReq'])) {
								if($_POST['from']==NULL || $_POST['to']==NULL || $_POST['network']==NULL) {
									$message2 .= '<span style="color: #F00;">Please input all fields!</span>';
								} else {
									$network = $_POST['network'];
									$from = $_POST['from'];
									$to = $_POST['to'];
									$text = trim($_POST['requestersList']);
									//explode all separate lines into an array
									$textAr = explode("\r\n", $text);
									//trim all lines contained in the array.
									$textAr = array_filter($textAr, 'trim');		
									$uarray = array_unique($textAr);							
									//Tong point
									
									foreach ($uarray as $req){
										$totalpoints ='';
											$totalacc = '';
										$queryUsersbyReq = mysql_query("SELECT userName FROM members WHERE requester='".$req."'") or die(mysql_error());
										while($user = mysql_fetch_assoc($queryUsersbyReq)) {
											
											$username = $user['userName'];
											$query = mysql_query("SELECT SUM(points) AS userPoints FROM leads WHERE (userName='".$username."' AND offerNwk='".$network."' AND DATE(date) >= '".$from."' AND DATE(date) <='".$to."') GROUP BY userName") or die(mysql_error());
												while($result = mysql_fetch_array($query)) {
													$totalacc +=1;
													$totalpoints += $result['userPoints'];
												}
										}
										echo '<tr><td>'.$req.'</td><td>'.$network.'</td><td>'.$totalpoints.'</td><td>'.$totalacc.'</td></tr>';
									}
									$message2 .= 'From: <span style="color: #0093E0;">'.$from.'</span>  To: <span style="color: #0093E0;">'.$to.'</span>';
								}
								if($message2 !=""){
									echo '<tr><td colspan="4">';
									echo $message2;
									echo '</td></tr>';
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
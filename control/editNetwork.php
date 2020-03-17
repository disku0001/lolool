<?php
session_start();	
include_once("../function/config.php");
include("../function/fnc.php");
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 		
	header("Location: login.php"); 		
} 	

	if(isset($_POST['editNwk'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$ip = $_POST['ip'];
		$status = $_POST['status'];
		$editWalls = mysql_query("UPDATE `networks` SET `name`='$name', `ip`='$ip', `status`='$status' WHERE id='".$id."'") or die(mysql_error()); 				
		$final_report1.="<meta http-equiv='Refresh' content='0; URL=networks.php'/>"; 						
	}

	$getID = $_GET['id'];
	$query = mysql_query("SELECT * FROM networks WHERE id='".$getID."'") or die(mysql_error());	
	$getnwk = mysql_fetch_assoc($query);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
  <link rel="stylesheet" href="../jquery/style.css" />
  <script type="text/javascript" src="../function/calc-func.js">
  </script>
</head>

<?php include("header.php") ?>
   
    <div id="content">
		 
		 <div class="box nwkadding">
			<h2>Edit Network</h2>
			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $getnwk['id'];?>"/>
				<label for="name" class="label">Name</label> <input type="text" name="name" class="txt" value="<?php echo $getnwk['name'];?>" />
				<label for="ip" class="label">IP</label> <input type="text" name="ip" class="txt" value="<?php echo $getnwk['ip'];?>" />
				<label for="status" class="label">Status</label> 
				<select name="status">
					<option value=""></option>
					<option value="ON"<?php if($getnwk['status'] == "ON") { echo 'selected="selected"';}?>>ON</option>
					<option value="OFF"<?php if($getnwk['status'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
				</select>
				<input type="submit" name="editNwk" value="Edit" class="btn"/>
			</form>
			<?php if($final_report1 !=""){?>			
			<p class="error">				
			<? echo $final_report1;?>			
			</p>			
			<?php } ?>	
		 </div>
		
    </div>
</div>
<?php include("guidebtn.php");?>
</body>
</html>
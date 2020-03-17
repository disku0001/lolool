<?php
session_start();
include_once("../function/config.php");
include("../function/includes.php");
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 
	header("Location: login.php"); 
	} 
	
	$query = mysql_query("SELECT * FROM admin") or die(mysql_error());
	$admin = mysql_fetch_array($query);
	

	// Edit Ratio
	if(isset($_POST['editRatio'])){
	$ratio = $_POST['ratio'];
		if($ratio == NULL){
			$final_report3.= "Please input ratio!";
			}else{
				if(strlen($ratio) <= 1 || strlen($ratio) >= 4 || $ratio < 10){
					$final_report3.="Ratio must be between 2 and 3 characters and minimum is 10!";
				} else {
				$updateRatio = mysql_query("UPDATE admin SET ratio='".$ratio."'") or die(mysql_error());   
				$final_report3.= '<span style="color: green;">Edit ratio successfully!</span>';
				echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
				}
			}
	}

	// Edit VC Name
	if(isset($_POST['editVCName'])){
	$vcName = $_POST['vcName'];
		if($vcName == NULL){
			$final_report3.= "Please input VC Name!";
			}else{
				if(strlen($vcName) <= 1 || strlen($vcName) >= 11){
					$final_report1.='<span style="color: green;">VC Name must be between 2 and 10 characters!</span>';
				} else {
				$updateVCName = mysql_query("UPDATE admin SET vcName='".$vcName."'") or die(mysql_error());   
				$final_report1.= '<span style="color: green;">Edit VC Name successfully!</span>';
				echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
				}
			}
	}

	// ProxStop
	if(isset($_POST['editProxstop'])){
		$api = $_POST['api'];
		$score = $_POST['score'];
		$proxstop = $_POST['proxstop'];
		$proxWall = $_POST['proxWall'];
		$updateProxstop = mysql_query("UPDATE admin SET proxstopAPI='".$api."', score='".$score."', proxstop='".$proxstop."', proxWall='".$proxWall."'") or die(mysql_error());   
		$final_report4.= '<span style="color: green;">Edit ProxStop successfully!</span>';
		echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
	}
	
	// IP Quality Score
	if(isset($_POST['editIPQC'])){
		$IPQCKey = $_POST['IPQCKey'];
		$IPQC = $_POST['IPQC'];
		$updateProxstop = mysql_query("UPDATE admin SET IPQC='".$IPQC."', IPQCKey='".$IPQCKey."'") or die(mysql_error());   
		$final_report11.= '<span style="color: green;">Edit ProxStop successfully!</span>';
		echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
	}
	
	// Lock Offers Page
	if(isset($_POST['editLockOffers'])){
		if($_POST['passOffers'] == NULL) {
			$lockOffers = $_POST['lockOffers'];
			$lockWalls = $_POST['lockWalls'];
			$updateLockOffers = mysql_query("UPDATE admin SET lockOffers='".$lockOffers."', lockWalls='".$lockWalls."'") or die(mysql_error());   
			$final_report8.= '<span style="color: green;">Edit successfully!</span>';
			echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
		} else {
			$pass = md5($_POST['passOffers']);
			$lockOffers = $_POST['lockOffers'];
			$lockWalls = $_POST['lockWalls'];
			$updateLockOffers = mysql_query("UPDATE admin SET passOffers='".$pass."', lockOffers='".$lockOffers."', lockWalls='".$lockWalls."'") or die(mysql_error());   
			$final_report8.= '<span style="color: green;">Edit successfully!</span>';
			echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
		}
	}
	
	// Stop 2 Ips
	if(isset($_POST['editStop2ip'])){
		$stop2ip = $_POST['stop2ip'];
		$updateStop2ip = mysql_query("UPDATE admin SET stop2ip='".$stop2ip."'") or die(mysql_error());   
		$final_report5.= '<span style="color: green;">Edit Stop 2 Ips successfully!</span>';
		echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
	}
	
	// Update Board
	if(isset($_POST['updateBoard'])){
		$board = addslashes($_POST['board']);
		$updateBoard = mysql_query("UPDATE admin SET board='$board'") or die(mysql_error());   
		$final_report6.= '<span style="color: green;">Update Notice Board successfully!</span>';
		echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
	}	

	// Edit Password
	if(isset($_POST['editPassword'])){
	$oldPassword = md5($_POST['oldPassword']);
	$newPassword = md5($_POST['newPassword']);
	$verPassword = md5($_POST['verPassword']);

	if($_POST['oldPassword'] == NULL OR $_POST['newPassword'] == NULL OR $_POST['verPassword'] == NULL){
		$final_report2.= "Please complete all fields!";
		}else{
			$check_old_password = mysql_query("SELECT adminPass FROM `admin` WHERE `adminPass` = '$oldPassword'") or die(mysql_error());   
			if(mysql_num_rows($check_old_password) != 0){
				if ($newPassword == $verPassword) {
					$editPassword = mysql_query("UPDATE admin SET adminPass='$newPassword'") or die(mysql_error());
					$final_report2.= '<span style="color: green;">Admin pasword has been changed!</span>';
					echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
				} else {
					$final_report2.= "Your new password does NOT match!";
				}
			} else {
				$final_report2.= "Wrong old password!";
			}
		}
	}
	
	// Show Stats in Members Page
	if(isset($_POST['editShowStats'])){
		$showStats= $_POST['showStats'];
		$updateStats = mysql_query("UPDATE admin SET showStats='".$showStats."'") or die(mysql_error());   
		$final_report9.= '<span style="color: green;">Update successfully!</span>';
		echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
	}
	// RESET IP
	if(isset($_POST['resetIP'])){
		$resetIP = mysql_query("UPDATE members SET port='', ip=''") or die(mysql_error());   
		$final_report10.= '<span style="color: green;">Reset IP successfully!</span>';
		echo "<meta http-equiv='Refresh' content='1; URL=setting.php'/>";
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel : Settings</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
</head>

<?php include('header.php') ?>
   
    <div id="content">
		
		<div class="setting">
			<h2>Edit Admin Password</h2>
			<div class="pass">
				<form action="" method="post">
					<label for="password" class="label">Old password</label>
					<input type="password" title="old_password" name="oldPassword" class="txt" />
					<label for="oldpassword" class="label">New password</label>
					<input type="password" title="new_password" name="newPassword" class="txt" />
					<label for="verpassword" class="label">Confirm password</label>
					<input type="password" title="ver_new_password" name="verPassword" class="txt"/>
					<input type="submit" name="editPassword" class="btn" value="OK" tabindex="3" />
				</form>
				<?php if($final_report2 !=""){?>
					<p class="error">
						<? echo $final_report2;?>
					</p>
					<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="clear"></div>
		<div class="setting">
			<h2>Edit Ratio</h2>
			<div class="normal">
				<form action="" method="post">
					<label for="ratio" class="label">Ratio</label>
					<input type="text" title="ratio" name="ratio" class="txt" value="<?php echo $admin['ratio'];?>"/>
					<input type="submit" name="editRatio" class="btn" value="OK" tabindex="3" />
				</form>
				<?php if($final_report3 !=""){?>
					<p class="error">
						<? echo $final_report3;?>
					</p>
					<?php } ?>
			</div>
		</div>
	<div class="clear"></div>
		<div class="setting">
			<h2>Edit Virtual Currency Name</h2>
		
			<div class="normal">
				<form action="" method="post">
					<label for="vcName" class="label">VC Name</label>
					<input type="text" title="vcName" name="vcName" class="txt" value="<?php echo $admin['vcName'];?>"/>
					<input type="submit" name="editVCName" class="btn" value="OK" tabindex="3" />
				</form>
				<?php if($final_report1 !=""){?>
					<p class="error">
						<? echo $final_report1;?>
					</p>
					<?php } ?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="setting">
			<h2>STOP 2 IPs</h2>	
			<div class="normal">
				<form action="" method="post">
					<label for="stop2ip" class="label">Stop 2 Ips?</label>
					<select name="stop2ip">
						<option value="ON" <?php if ($admin['stop2ip'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($admin['stop2ip'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
					</select>
					<input type="submit" name="editStop2ip" class="btn" value="OK" tabindex="3" />
				</form>
				<?php if($final_report5 !=""){?>
					<p class="error">
						<? echo $final_report5;?>
					</p>
					<?php } ?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="setting">
			<h2>ProxStop</h2>		
			<div class="proxy">
				<form action="" method="post">
					<label for="api" class="label">API Key</label>
					<input type="text" name="api" class="txt" value="<?php echo $admin['proxstopAPI'];?>"/>
					<label for="score" class="label">Lock Score ></label>
					<select name="score">
						<?php 
							$i = 0;
							while ($i<5) {							
						?>
						<option value="<?php echo $i;?>" <?php if ($admin['score'] == $i) { echo 'selected="selected"';}?>><?php echo $i;?></option>
						<?php 
							$i++;
							}
						?>
					</select>
					<div class="clear"></div>
					<label for="proxstop" class="label">Banner?</label>
					<select name="proxstop">
						<option value="ON" <?php if ($admin['proxstop'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($admin['proxstop'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
					</select>
					<div class="clear"></div>
					<label for="proxstop" class="label">Wall?</label>
					<select name="proxWall">
						<option value="ON" <?php if ($admin['proxWall'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($admin['proxWall'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
					</select>
					<input type="submit" name="editProxstop" class="btn" value="OK" tabindex="3" />
					<div class="clear"></div>
				</form>
				<?php if($final_report4 !=""){?>
					<p class="error">
						<? echo $final_report4;?>
					</p>
					<?php } ?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="setting">
			<h2>IP Quality Score</h2>		
			<div class="proxy">
				<form action="" method="post">
					<label for="api" class="label">API Key</label>
					<input type="text" name="IPQCKey" class="txt" value="<?php echo $admin['IPQCKey'];?>"/>
					<label for="proxstop" class="label">Lock?</label>
					<select name="IPQC">
						<option value="ON" <?php if ($admin['IPQC'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($admin['IPQC'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
					</select>

					<input type="submit" name="editIPQC" class="btn" value="OK" tabindex="3" />
					<div class="clear"></div>
				</form>
				<?php if($final_report11 !=""){?>
					<p class="error">
						<? echo $final_report11;?>
					</p>
					<?php } ?>
			</div>
		</div>
		<div class="clear"></div>
		<div class="setting">
			<h2>Notice Board</h2>			
			<div class="board">
				<form action="" method="POST">
					<textarea name="board"><?php echo $admin['board'];?></textarea>
					<input type="submit" name="updateBoard" value="Update" class="btn" />
				</form>
				<?php if($final_report6 !=""){?>
					<p class="error">
						<? echo $final_report6;?>
					</p>
					<?php } ?>
			</div><div class="clear"></div>
		</div>
		<hr>
		<div class="setting">
			<h2>Lock Offers Page</h2>		
			<div class="proxy">
				<form action="" method="post">
					<label for="passOffers" class="label">Password</label>
					<input type="password" name="passOffers" class="txt" value="<?php echo $admin['passOffers'];?>"/>
					<label for="lockStatus" class="label">Banner?</label>
					<select name="lockOffers">
						<option value="ON" <?php if ($admin['lockOffers'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($admin['lockOffers'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
					</select>
					<div class="clear"></div>
					<label for="lockStatus" class="label">Wall?</label>
					<select name="lockWalls">
						<option value="ON" <?php if ($admin['lockWalls'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($admin['lockWalls'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
					</select>
					<input type="submit" name="editLockOffers" class="btn" value="OK" tabindex="3" />
				</form>
				<?php if($final_report8 !=""){?>
					<p class="error">
						<? echo $final_report8;?>
					</p>
					<?php } ?>
			</div><div class="clear"></div>
		</div>
		
		<div class="setting">
			<h2>Show Website Stats</h2>	
			<div class="normal">
				<form action="" method="post">
					<label for="stop2ip" class="label">Show?</label>
					<select name="showStats">
						<option value="ON" <?php if ($admin['showStats'] == "ON") { echo 'selected="selected"';}?>>ON</option>
						<option value="OFF" <?php if ($admin['showStats'] == "OFF") { echo 'selected="selected"';}?>>OFF</option>
					</select>
					<input type="submit" name="editShowStats" class="btn" value="OK" tabindex="3" />
				</form>
				<?php if($final_report9 !=""){?>
					<p class="error">
						<? echo $final_report9;?>
					</p>
					<?php } ?>
			</div>
		</div>
		<div class="setting">
			<h2>Click OK to clear all IP</h2>	
			<div class="normal">
				<form action="" method="post">
					<input type="submit" name="resetIP" class="btn" value="OK" tabindex="3" />
				</form>
				<?php if($final_report10 !=""){?>
					<p class="error">
						<? echo $final_report10;?>
					</p>
					<?php } ?>
			</div>
		</div>
    </div>
</div>
<?php include("guidebtn.php");?>
</body>
</html>
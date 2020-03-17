<?php
session_start();
include_once("../function/config.php");
include("../function/includes.php");
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 
	header("Location: login.php"); 
	} 
	
	$query = mysql_query("SELECT * FROM ads") or die(mysql_error());
	$ad = mysql_fetch_array($query);
	
	// Update Board
	if(isset($_POST['updateAds'])){
		$topBannerUrl = addslashes($_POST['topBannerUrl']);
		$topBannerImageUrl = addslashes($_POST['topBannerImageUrl']);
		$bottomBannerUrl = addslashes($_POST['bottomBannerUrl']);
		$bottomBannerImageUrl = addslashes($_POST['bottomBannerImageUrl']);
		$updateBoard = mysql_query("UPDATE ads SET topUrl='".$topBannerUrl."', topImageUrl='".$topBannerImageUrl."', bottomUrl='".$bottomBannerUrl."', bottomImageUrl='".$bottomBannerImageUrl."'") or die(mysql_error());   
		$final_report.= '<span style="color: green;">Update successfully!</span>';
		echo "<meta http-equiv='Refresh' content='1; URL=ads.php'/>";
	}	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel : Advertising</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
</head>

<?php include('header.php') ?>
   
    <div id="content">
		<div class="setting">
			<h2>Banners Manager</h2>
			<div class="clear"></div>
			<div class="adbox">
				<form action="" method="POST">
					<p>Top Banner Url:</p>
					<textarea name="topBannerUrl"><? echo $ad['topUrl'];?></textarea>
					<p>Top Image Url: (468x60)</p>
					<textarea name="topBannerImageUrl"><? echo $ad['topImageUrl'];?></textarea>
					<p>Bottom Banner Url:</p>
					<textarea name="bottomBannerUrl"><? echo $ad['bottomUrl'];?></textarea>
					<p>Bottom Image Url: (728x90)</p>
					<textarea name="bottomBannerImageUrl"><? echo $ad['bottomImageUrl'];?></textarea>
					<input type="submit" name="updateAds" value="Update" class="btn" />
				</form>
				<?php if($final_report !=""){?>
					<p class="error">
						<? echo $final_report;?>
					</p>
					<?php } ?>
			</div>
		

		</div>
</div>
<?php include("guidebtn.php");?>
</body>
</html>
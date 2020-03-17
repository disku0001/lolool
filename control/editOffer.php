<?php
session_start();	
include_once("../function/config.php");
include("../function/fnc.php");
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 		
	header("Location: login.php"); 		
} 	

if(isset($_POST['editOffer'])){		
	$id = (int) $_POST['id'];		
	$offerId = $_POST['offerId'];
	$name = htmlentities($_POST['name'],ENT_QUOTES);
	$des = htmlentities($_POST['des'],ENT_QUOTES);
	$url = $_POST['url'];
	$image_url = $_POST['image_url'];
	$cc = $_POST['country'];
	$network = $_POST['network'];	
	$payout = $_POST['payout'];
	if(isset($_POST['globalRate']) && $_POST['globalRate'] == 'Yes') {
		$ratio = Ratio;
	} else {
		$ratio = $_POST['ratio'];
	}	
	if($offerId == NULL) {
		$final_report2.= "Please input Offer ID !";
	} else {
		if($name == NULL) {
			$final_report2.= "Please input Offer Name !";
		} else {
			if ($payout == NULL) {
				$final_report2.= "Please input Offer Payout !";
			} else {
				if($url == NULL) {	
					$final_report2.= "Please input Offer URL !";
				} else {
					if($cc == NULL) {
						$final_report2.= "Please input Offer Country !";
					} else {
						if($network == NULL) {
							$final_report2.= "Please input Offer Network !";
						} else {
							$update_offer = mysql_query("UPDATE offers SET offerId ='".$offerId."', name ='".$name."', des ='".$des."', payout ='".$payout."', ratio ='".$ratio."', url ='".$url."', imageUrl ='".$image_url."', country ='".$cc."', network ='".$network."' WHERE id ='".$id."'") or die(mysql_error()); 				
							$final_report2.= 'Offer edited successfully !<br><a href="offers.php">Come back</a> to offers list.';						
						}
					}	
				}
			}
		}
	}												
}	

$getID = $_GET['id'];
$query = mysql_query("SELECT * FROM offers WHERE id='".$getID."'") or die(mysql_error());	
$offer = mysql_fetch_assoc($query);

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
	<div class="box offeradding">			
		<h2>Edit Offer</h2>			
		<form action="" method="post">				
		<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />	
		<label for="id" class="label">Offer ID *</label> <input type="text" name="offerId" class="txt" value="<?php echo $offer['offerId'];?>" />			
		<label for="name" class="label">Name *</label> <input type="text" name="name" class="txt" value="<?php echo $offer['name'];?>" />				
		<label for="des" class="label">Description</label><textarea rows="4" cols="50" name="des"><?php echo $offer['des'];?></textarea>				
		<label for="payout" class="label">Payout *</label> <input type="text" name="payout" class="txt" value="<?php echo $offer['payout'];?>" />
		<label for="ratio" class="label">Rate</label> <input type="text" name="ratio" class="txt rate" id ="txtRate" value="" />
		<label for="globalrate" class="label globalrate">Global Rate?</label><input type="checkbox" name="globalRate" value="Yes" class="globalrate" onchange="document.getElementById('txtRate').disabled=this.checked;" checked="checked">		
		<div style="clear: both;"></div>
		<label for="url" class="label">Tracking URL *</label> <input type="text" name="url" class="txt" value="<?php echo $offer['url'];?>" />				
		<label for="imageurl" class="label">Image URL</label> <input type="text" name="image_url" class="txt" value="<?php echo $offer['imageUrl'];?>" />				
		<label for="country" class="label">Country *</label> 
		<select name="country">
			<option value=""></option>
		<?php
			$queryCountry = mysql_query("SELECT name, cc FROM countries ORDER BY name") or die(mysql_error());
			while($country = mysql_fetch_assoc($queryCountry)) {
				if ($country['cc'] == $offer['country']) {
		?>	
			<option value="<?php echo $country['cc'];?>" selected="selected"><?php echo $country['name'];?></option>
			<?php } else {?>
			<option value="<?php echo $country['cc'];?>"><?php echo $country['name'];?></option>
		<?php }} ?>
		</select><br>
		<label for="network" class="label">Network *</label>
		<select name="network">
			<option value=""></option>
		<?php
			$queryNetwork = mysql_query("SELECT name FROM networks ORDER BY name") or die(mysql_error());
			while($network = mysql_fetch_assoc($queryNetwork)) {
			if($network['name'] == $offer['network']) {
		?>	
			<option value="<?php echo $network['name'];?>" selected="selected"><?php echo $network['name'];?></option>
			<?php } else { ?>
			<option value="<?php echo $network['name'];?>"><?php echo $network['name'];?></option>
		<?php }} ?>
		</select><br>
		<input type="submit" name="editOffer" value="Edit Offer" class="btn"/>			
		</form>			
		<?php if($final_report2 !=""){?>			
		<p class="error">				
		<? echo $final_report2;?>			
		</p>			<?php } ?>		 
	</div>				    
</div>
</div>
<?php include("guidebtn.php");?>
</body>
</html>
<?php
/* 	
* 	Blvd-Media Group Postback Script	
* 	Support Contact: BlvdInstall@blvd-media.com		
* 	Widget: RewardTool
* 	Script: MyVoucherGeek
* 	Postback Version: 1.0.2	
*/

ob_start();session_start();
$hostname = "localhost"; //your hostname (normally localhost)
$data_username = "data_username"; //database username
$data_password = "data_password"; //database password
$data_basename = "data_basename"; //database name
$conn = mysql_connect("".$hostname."","".$data_username."","".$data_password."");  
mysql_select_db("".$data_basename."") or die(mysql_error());  

include("includes.php");

	$querypass = mysql_query("SELECT pass FROM walls WHERE id='1'") or die(mysql_error());
	$result = mysql_fetch_array($querypass);
	$bmgpass = $result['pass']; // Your Blvd-Media Password
	
	// Authenticate Session Via Password
	if ($bmgpass == $_GET['Validate']) {
		$userId 		= mysql_real_escape_string($_GET['SubId']); 	// Username of the user that earned the reward(s).
		$points 		= mysql_real_escape_string($_GET['Earn']); 		// Amount that the user has earned.
		$offerName 		= mysql_real_escape_string($_GET['CampaignName']); 		// Amount that the user has earned.
		$date = date("Y-m-d H:i:s");
		
		
		$query_checkRef = mysql_query("SELECT referralId from members WHERE userName= '".$userId."'") or die(mysql_error());
		//if(is_array($query_checkRef)) {
			foreach((array)mysql_fetch_array($query_checkRef) as $ref_id_user);
			if ($ref_id_user>=1)
			{
				mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
				mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
				mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$offerName','$points','#','BlvdMedia','#','#','#','#','#','$userId','$date')");
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','BlvdMedia','$points','$date','')");
				mysql_query("UPDATE members SET points=points+".$refer_points." WHERE id ='".$ref_id_user."'");
				mysql_close();
				echo "RewardTool&reg; Crediting Success: ".$userId." earned ".$points." points\n and is referred by".$ref_id_user;
			}
			else 
			{
				mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
				mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
				mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$offerName','$points','#','BlvdMedia','#','#','#','#','#','$userId','$date')");
				if(HIDE=="OFF"){
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','BlvdMedia','$points','$date','')");
				} else {
				mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','BlvdMedia','$points','$date','')");
				}
				mysql_close();
				echo "RewardTool&reg; Crediting Success: ".$userId." earned ".$points." points.";
			}	
		//}
	}
else {
	echo "Error: Validation Not Accepted";
	exit;
}
?>
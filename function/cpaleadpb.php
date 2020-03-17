<?php
	include("config.php");	include("includes.php");		
	$queryPass = mysql_query("SELECT pass FROM walls WHERE id='2'") or die(mysql_error());	
	$result = mysql_fetch_array($queryPass);
	$YOURPASSWORD = $result['pass']; //this is the password you set when creating your widget
	$password = $_REQUEST['password'];
	if ($password != $YOURPASSWORD) {
		echo "Error: IP Not Accepted";		exit;
	}

	/*
	 * For a complete variable list see: http://www.cpalead.com/postback-variables.php (You must be logged in to view).
	 */
	$userId = $_REQUEST['subid'];
	$offerName = $_REQUEST['survey'];	
	$offerId = $_REQUEST['survid'];
	$earn = $_REQUEST['earn'];
	$points = $_REQUEST['pdtshow'];
	$date = date("Y-m-d H:i:s");
	//$query_getuserid = mysql_query("SELECT id from members WHERE username= '".$userId."'") or die(mysql_error());
	//foreach(mysql_fetch_array($query_getuserid) as $userid);
	$query_checkRef = mysql_query("SELECT referralId from members WHERE userName= '".$userId."'") or die(mysql_error());
	//if(is_array($query_checkRef)) {
		foreach((array)mysql_fetch_array($query_checkRef) as $ref_id_user);
		if ($ref_id_user>=1)
		{
			mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
			mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");		
			mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','$offerId','#','$offerName','$points','#','CPAlead','#','#','#','#','#','$userId','$date')");
			mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','CPAlead','$points','$date','')");
			mysql_query("UPDATE members SET points=points+".$refer_points." WHERE id ='".$ref_id_user."'");
			mysql_close();
			echo "Success: ".$userId." earned ".$points." points\n and is referred by".$ref_id_user;
		} else {
			mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
			mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");		
			mysql_query("INSERT INTO leads(id, offerId, offerIdOffer, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','$offerId','#','$offerName','$points','#','CPAlead','#','#','#','#','#','$userId','$date')");
			if(HIDE=="OFF"){
			mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','CPAlead','$points','$date','')");
			} else {
			mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','','CPAlead','$points','$date','')");
			}
			mysql_close();
			echo "Success: ".$userId." earned ".$points." points\n and is referred by nobody";
		} 
	//}
?>
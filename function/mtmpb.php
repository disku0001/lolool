<?php
include("config.php");
include("includes.php");
	
	$queryKey = mysql_query("SELECT secretKey FROM walls WHERE id='6'") or die(mysql_error());
	$result = mysql_fetch_array($queryKey);
	
	$userId = $_REQUEST['user_id'];
	$ms = $_REQUEST['ms'];
	$points = $_REQUEST['currency'];
	$transaction_id = $_REQUEST['transaction_id'];
	$secret_key = $result['secretKey'];
	$date = date("Y-m-d H:i:s");
	
	$str = $transaction_id.':'.$secret_key;
	$hash = md5($str);
	if($hash == $ms) {
		//$query_getuserid = mysql_query("SELECT id from members WHERE username= '".$userId."'") or die(mysql_error());
		//foreach(mysql_fetch_array($query_getuserid) as $userid);
		$query_checkRef = mysql_query("SELECT referralId from members WHERE userName= '".$userId."'") or die(mysql_error());
		foreach((array)mysql_fetch_array($query_checkRef) as $ref_id_user);
		if ($ref_id_user>=1)
		{			
			mysql_query("UPDATE members SET points=points+".$points." WHERE userName='".$userId."'");
			mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE userName ='".$userId."'");
			mysql_query("INSERT INTO leads(id, offerId, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$points','#','Matomy','#','#','#','#','#','$userId','$date')");
			mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','Matomy','$points','$date','')");
			mysql_query("UPDATE members SET points=points+".$refer_points." WHERE id ='".$ref_id_user."'");
			echo 1;;// if user is credited successfully else echo 0
			mysql_close();			
		} else {
			mysql_query("UPDATE members SET points=points+".$points." WHERE username='".$userId."'");
			mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE username ='".$userId."'");
			mysql_query("INSERT INTO leads(id, offerId, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$points','#','Matomy','#','#','#','#','#','$userId','$date')");
			mysql_query("INSERT INTO shoutbox(id, userName, offerName, offerNwk, points, date, message) VALUES('','$userId','$offerName','Matomy','$points','$date','')");
			echo 1;// if user is credited successfully else echo 0
			mysql_close();
			
		}

	} else {
		echo 0;
		exit;
	}

?>

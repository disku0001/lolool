<?php

include("config.php");
include("includes.php");
	
	$queryKey = mysql_query("SELECT secretKey FROM walls WHERE id='10'") or die(mysql_error());
	$result = mysql_fetch_array($queryKey);
	
	$SECRET = $result['secretKey'];  ///this is you apps secret key get this from app info
	// make  a hash of our own to verify authenicc transaction	
		
    $userId = $_REQUEST['uuid'];      // this grabs the snuid from the url
    $points= $_REQUEST['amount'];     // this grabs total points super rewards has ever sent user
    $transaction = $_REQUEST['transaction'];//this grabs the taransaction id from super rewards
    $sidverify = $_REQUEST['signature'];  // this grabs the hashed info for you to authenticate with
	$date = date("Y-m-d H:i:s");
	
	$sig = md5($userId.$points.$transaction.$SECRET);
	
	if($sidverify == $sig){		
		
		//$query_getuserid = mysql_query("SELECT id from members WHERE username= '".$userId."'") or die(mysql_error());
		//foreach(mysql_fetch_array($query_getuserid) as $userid);

		$query_checkRef = mysql_query("SELECT referralId from members WHERE username= '".$userId."'") or die(mysql_error());
		foreach(mysql_fetch_array($query_checkRef) as $ref_id_user);
		if ($ref_id_user>=1)
		{		
			mysql_query("UPDATE members SET points=points+".$points." WHERE username='".$userId."'");
			mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE username ='".$userId."'");
			mysql_query("INSERT INTO leads(id, offerId, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$points','#','Jampp','#','#','#','#','#','$userId','$date')");
			mysql_query("UPDATE members SET points=points+".$refer_points." WHERE id ='".$ref_id_user."'");
			mysql_close();		
		}else {		
			mysql_query("UPDATE members SET points=points+".$points." WHERE username='".$userId."'");
			mysql_query("UPDATE members SET leadedOffers=leadedOffers+1 WHERE username ='".$userId."'");
			mysql_query("INSERT INTO leads(id, offerId, offerName, points, offerCC, offerNwk, ip, port, protocol, hostName, userAgent, userName, date) VALUES('','#','#','$points','#','Jampp','#','#','#','#','#','$userId','$date')");
			mysql_close();		
		} echo "1"; 
	} else {
		echo "Error: IP Not Accepted";
		exit;
	}
?>
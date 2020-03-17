<?php
include_once("function/config.php");
include("function/fnc.php");

	// Get Offer ID and User ID
	$getID = $_GET['id'];
	$userId = $_GET['userId'];
	// Get Offer Url
	$queryOffer = mysql_query("SELECT * FROM offers WHERE id='".$getID."'") or die(mysql_error());
	$offer = mysql_fetch_array($queryOffer);
	// Process tracking
	$trackingID = randString();
	$queryNwk = mysql_query("SELECT ip FROM networks WHERE name='".$offer['network']."'") or die(mysql_error());
	$nwk = mysql_fetch_array($queryNwk);
	if($nwk['ip']==NULL){
		$goUrl = $offer['url'].$trackingID;
	} else {
		$goUrl = $offer['url'] . $userId;
	}
	
	// Collect click information
	$offerIdOffer = $offer['id'];
	$offerId = $offer['offerId'];
	$offerName = $offer['name'];
	$offerCC = $offer['country'];
	$offerNwk = $offer['network'];
	$points = $offer['payout']*$offer['ratio'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$port = $_SERVER['REMOTE_PORT'];
	$protocol =$_SERVER['SERVER_PROTOCOL'];
	$hostName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$date = date("Y-m-d");

	$queryCollect = mysql_query("INSERT INTO clicks(id,offerId,offerIdOffer,offerName,offerCC,offerNwk,points,ip,port,protocol,hostName,userAgent,userName,date,trackingID) VALUES('','$offerId','$offerIdOffer','$offerName','$offerCC','$offerNwk','$points','$ip','$port','$protocol','$hostName','$userAgent','$userId','$date','$trackingID')") or die(mysql_error()); 

	// Go to Offer
	header("Location: $goUrl");
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75072341-1', 'auto');
  ga('send', 'pageview');

</script>

?>
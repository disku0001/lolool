<?php 
$fetch_users_data = mysql_fetch_object(mysql_query("SELECT * FROM `members` WHERE userName='".$_SESSION['userName']."'"));
$title= "websitetitle";  //your site title
$yourdomain="http://"; //your domain name where script is installed - do not use trailing slash
$tweetmsg="Get Amazon and ASOS gift vouchers for free at http://www.myvouchergeek.com"; //set text for tweet this button on homepage
$bonuspoints= 0;    //amount of bonus points to give to users
$refer_points=2; //amount of points a user receives if one of their referred users completes any survey
$ref_id=$fetch_users_data->id;
if(isset($_GET['join'])){
	$referral_ID = $_GET['join'];
	$referral_string= "?join=".$referral_ID;
}
$membername= $fetch_users_data->userName; //don't change
$memberpoints=$fetch_users_data->points; //don't change
$membersurveys=$fetch_users_data->leadedOffers; //don't change
$earnedpoints = $memberpoints - $bonuspoints;//if you want to display how many points user has earned (as opposed to bonus points)
$mainpointsneeded = 200; //total points needed before user can request a voucher
$pointsneeded= $mainpointsneeded - $memberpoints; //points left before they can request voucher
$contactemail = "YOUR_EMAIL_ADDRESS"; //contact form messages will be sent here
$requestemail = "THE_SAME_OR_ANOTHER_EMAIL_ADDRESS"; //request a voucher messages will be sent here
?>
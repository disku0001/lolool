<?php
session_start();
include_once"../function/config.php";
include_once"../function/fnc.php";
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 
	header("Location: login.php"); 
	} 
	
	$ratio = 100;
	$dollar = "$ ";
	$multi = 
	$today = date("Y-m-d");
	$thismonth = date("m");
	$thisyear = date("Y");
	$numdays = cal_days_in_month(CAL_GREGORIAN, $thismonth, $thisyear);
	$startday = date("Y-m-d", mktime(0,0,0,$thismonth,1,$thisyear)) ;
	$endday = date("Y-m-d", mktime(0,0,0,$thismonth,$numdays,$thisyear)) ;
	$yesterday = date("Y-m-d", mktime(0,0,0,date("m"),date("d")-1,date("Y"))) ;
	
	// All Time Clicks
	$queryAllTimeClicks = mysql_query("SELECT COUNT(id) as alltimeclick FROM clicks") or die(mysql_error());
	$result = mysql_fetch_array($queryAllTimeClicks);
	$alltimeclick = $result['alltimeclick'];
	// All Time NET Revenues
	$queryallrev = mysql_query("SELECT SUM(points) as allrev FROM leads") or die(mysql_error());
	$result = mysql_fetch_array($queryallrev);
	$allrev = round($result['allrev']/$ratio,2);
	
	// Today Clicks
	$querytodayClicks = mysql_query("SELECT COUNT(id) as todayclick FROM clicks WHERE date='$today'") or die(mysql_error());
	$result = mysql_fetch_array($querytodayClicks);
	$todayclick = $result['todayclick'];
	// Today leads
	$querytodayLeads = mysql_query("SELECT COUNT(id) as todaylead FROM leads WHERE DATE(`date`)='$today'") or die(mysql_error());
	$result = mysql_fetch_array($querytodayLeads);
	$todaylead = $result['todaylead'];
	// Today Net Revenues
	$querytodayrev = mysql_query("SELECT SUM(points) as todayrev FROM leads WHERE DATE(`date`)='$today'") or die(mysql_error());
	$result = mysql_fetch_array($querytodayrev);
	$todayrev = round($result['todayrev']/$ratio,2);
	
	// Yesterday Clicks
	$queryyesClicks = mysql_query("SELECT COUNT(id) as yesclick FROM clicks WHERE date='$yesterday'") or die(mysql_error());
	$result = mysql_fetch_array($queryyesClicks);
	$yesclick = $result['yesclick'];
	// Yesterday leads
	$queryyesLeads = mysql_query("SELECT COUNT(id) as yeslead FROM leads WHERE DATE(`date`)='$yesterday'") or die(mysql_error());
	$result = mysql_fetch_array($queryyesLeads);
	$yeslead = $result['yeslead'];
	// Yesterday Net Revenues
	$queryyesrev = mysql_query("SELECT SUM(points) as yesrev FROM leads WHERE DATE(`date`)='$yesterday'") or die(mysql_error());
	$result = mysql_fetch_array($queryyesrev);
	$yesrev = round($result['yesrev']/$ratio,2);
	
	// This Month Clicks
	$querymonthClicks = mysql_query("SELECT COUNT(id) as monthclick FROM clicks WHERE (date>='$startday' AND date<='$endday')") or die(mysql_error());
	$result = mysql_fetch_array($querymonthClicks);
	$monthclick = $result['monthclick'];
	// Today leads
	$querymonthLeads = mysql_query("SELECT COUNT(id) as monthlead FROM leads WHERE (DATE(`date`)>='$startday' AND DATE(`date`)<='$endday')") or die(mysql_error());
	$result = mysql_fetch_array($querymonthLeads);
	$monthlead = $result['monthlead'];
	// This Month NET Revenues
	$querymonthRev = mysql_query("SELECT SUM(points) as monthrev FROM leads WHERE (DATE(`date`)>='$startday' AND DATE(`date`)<='$endday')") or die(mysql_error());
	$result = mysql_fetch_array($querymonthRev);
	$monthrev = round($result['monthrev']/$ratio,2);
	
	// Total Requesters
	$queryRequester = mysql_query("SELECT COUNT(id) as totalreq FROM requesters") or die(mysql_error());
	$result = mysql_fetch_array($queryRequester);
	$totalreq = $result['totalreq'];
	// Requested Revenues
	$queryreqrev = mysql_query("SELECT SUM(points) as reqrev FROM members WHERE requester<>''") or die(mysql_error());
	$result = mysql_fetch_array($queryreqrev);
	$reqrev = round($result['reqrev']/$ratio,2);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel - Overviews</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />

</head>

<?php include('header.php'); ?>
   
    <div id="content">
		<div class="box snap">
			<h2>Website Overview</h2>
			<p class="label click">Today Clicks</p>
			<p class="txt click"><?php echo $todayclick;?></p>
			<p class="label">Today Leads</p>
			<p class="txt"><?php echo $todaylead;?></p>
			<p class="label rev">Today Earnings</p>
			<p class="txt rev"><?php echo $dollar.$todayrev;?></p>
			<p class="label click">Yesterday Clicks</p>
			<p class="txt click"><?php echo $yesclick;?></p>			
			<p class="label">Yesterday Leads</p>
			<p class="txt"><?php echo $yeslead;?></p>
			<p class="label rev">Yesterday Earnings</p>
			<p class="txt rev"><?php echo $dollar.$yesrev;?></p>
			<p class="label click">MTD Clicks</p>
			<p class="txt click"><?php echo $monthclick;?></p>
			<p class="label">MTD Leads</p>
			<p class="txt"><?php echo $monthlead;?></p>
			<p class="label rev">MTD Earnings</p>
			<p class="txt rev"><?php echo $dollar.$monthrev;?></p>
			<p class="label click">All Time Clicks</p>
			<p class="txt click"><?php echo $alltimeclick;?></p>			
			<p class="label rev">All Time Earnings</p>
			<p class="txt rev"><?php echo $dollar.$allrev;?></p>
			<p class="label">Requesters</p>
			<p class="txt"><?php echo $totalreq;?></p>
			<p class="label rev">Requested Earnings</p>
			<p class="txt rev"><?php echo $dollar.$reqrev;?></p>
		</div>
    </div>
</div>
<?php include("guidebtn.php");?>
</body>
</html>

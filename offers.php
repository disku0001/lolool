<?php 
session_start();
include_once"function/config.php";
include('function/fnc.php');

	// Check ProxStop status
	if(ProxStop == "ON") {
		callProxstop();
	}
	// Check IP Quality Score 
	if(IPQC == "ON") {
	$key = IPQCKey; // Account API Key
	$ip = $_SERVER['REMOTE_ADDR']; // IP to Lookup
	$result = file_get_contents('http://www.ipqualityscore.com/api/ip_lookup.php?KEY='.$key.'&IP='.$ip);
		if($result == 1) {
			header("Location: oops.php");
		}
	}
	// Check Session status
	if(!isset($_SESSION['userName']) || !isset($_SESSION['userPassword'])){
		header("Location: login.php");
	} else {
		$fetch_users_data = mysql_fetch_object(mysql_query("SELECT * FROM `members` WHERE userName='".$_SESSION['userName']."'"));	
	}
	$ref_id=$fetch_users_data->id;
	$query_refs = "SELECT COUNT(referralId) FROM members where referralId=".$ref_id."";  
	$result_refs = mysql_query($query_refs) or die(mysql_error()); 
	foreach(mysql_fetch_array($result_refs) as $total_referrals);
	
	// Check Stop2IP status
	$queryIP = mysql_query("SELECT ip FROM members WHERE userName='".$_SESSION['userName']."'") or die(mysql_error());
	$ip = mysql_fetch_array($queryIP);
	if(Stop2ip == "ON" && $ip['ip'] != $_SERVER['REMOTE_ADDR']) {
		header("Location: fairplay.php");
	}
	
	if(LockOffers == "ON") {
		if(!isset($_SESSION['passOffers'])){
			header("Location: gateOffers.php");
		}
	}
	
	if($_SESSION['passOffers'] != PassOffers && LockOffers == "ON") {
		header("Location: gateOffers.php");
	}
?>

<?php include("function/includes.php"); ?>
<?php include("header.php");?>
	<link rel="stylesheet" href="offers.css" type="text/css" />
</head>

<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75072341-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- START CONTENT -->
<div id="wrapper">
	<!-- START HEADER -->
    <div id="header">
        <a class="logo" href="index.php<?php echo $referral_string?>"></a>
        <div class="adbox">
			<? if(topImageUrl==NULL) {
			echo '';
			} else { ?>
				<a href="<? echo topUrl;?>" target="_blank"><img src="<? echo topImageUrl;?>" /></a>
			<?}?>
		</div>
	</div><!-- END HEADER -->
		
	<!-- START NAVIGATION -->
	<ul id="navigation">
		<span class="homebtn"><a href="home.php"><img src="images/homeicon.png"></a></span>
		<?php if(!isset($_SESSION['userName']) || !isset($_SESSION['userPassword'])){  ?>
		<li><a href="index.php<?php echo $referral_string?>">Home</a></li>
		<?php } ?> 
		<?php if(isset($_SESSION['userName']) && isset($_SESSION['userPassword'])){  ?>	
		<li><a href="members.php">Members</a></li>
		<?php if(isset($_SESSION['userName']) && isset($_SESSION['userPassword'])){  ?>	
		<li class="on"><a href="offers.php">+ Offers +</a></li>
		<?php } ?>
		<li>
			<a class="featuredOffers" href="#">Walls</a>
			<ul>
				<?php
				$queryWalls = mysql_query("SELECT name FROM walls WHERE status='ON'") or die(mysql_error());
				while($wall = mysql_fetch_array($queryWalls)) {
				?>
						<li><a href="wall.php?name=<?php echo $wall['name'];?>"><?php echo $wall['name'];?></a></li>
				<?php }?>
			</ul>
		</li>
		<?php } ?>
		<li><a href="rewards.php<?php echo $referral_string?>">Rewards</a></li>
		 <?php if(isset($_SESSION['userName']) && isset($_SESSION['userPassword'])){  ?>	
		<li class="signup"><a href="logout.php">Logout</a></li>
		<li class="signup"><a class="member" href="members.php">Hello, <?php echo $membername;?></a></li>
		<?php } ?>
		<?php if(!isset($_SESSION['userName']) || !isset($_SESSION['userPassword'])){  ?>
		<li class="signup"><a href="register.php<?php echo $referral_string?>">Sign Up Now!</a></li>
		<?php } ?> 
	</ul><!-- END NAVIGATION -->
    <div class="clear"></div>    
            
    <div id="content">
	<div id="offerslist">
		<h2>Featured Offers List</h2>
		<div class="searchbox">
			<form action="" method="POST">
				<label class="label">Offer Name</label>
				<input class="text" type="text" name="name" value="<? echo $_POST['name'];?>"/>
				<input type="submit" name="searchOffer" value="Search Offer" />
				&nbsp;<&nbsp;<a href="offers.php">Reset filter</a>&nbsp;>
			</form>
		</div>
		 <?php 
		 $showitemsperlist = 20;
		if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
		$start_from = ($page-1) * $showitemsperlist; 
		$ip = $_SERVER['REMOTE_ADDR'];
		$cc = checkcc($ip);
		if(isset($_POST['searchOffer']) && $_POST['name']!=NULL) {
			$name = htmlentities($_POST['name'],ENT_QUOTES);
			$queryoffers = mysql_query("SELECT offers.id as offerId, offers.name as offerName, offers.url, offers.payout, offers.ratio, offers.imageUrl, offers.des, offers.country, offers.network, networks.name as networkName, networks.status FROM offers, networks WHERE (offers.name LIKE '%".$name."%' AND offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON') ORDER BY offers.name LIMIT $start_from,$showitemsperlist") or die(mysql_error());
		} else {
			$queryoffers = mysql_query("SELECT offers.id as offerId, offers.name as offerName, offers.url, offers.payout, offers.ratio, offers.imageUrl, offers.des, offers.country, offers.network, networks.name as networkName, networks.status FROM offers, networks WHERE (offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON') ORDER BY offers.name LIMIT $start_from,$showitemsperlist") or die(mysql_error());
		}
		if(mysql_num_rows($queryoffers) == 0)
		{
			echo '<h3>Sorry! There are no offers in your country at the moment, please check again later!</h3>';
		} 
		else 
		{
			while($offer = mysql_fetch_assoc($queryoffers)) {
				$rewards = $offer['payout']*$offer['ratio'];
		?>
		
				<div class="offers"><p class="img"><img src="<?php echo $offer['imageUrl']; ?>" width="100" height="100" /></p>
				<span class="right"><table border="0" width="100%">
				<tr><td class="points"> <?php echo $rewards; ?></td></tr>
				<tr><td><?php echo vcName; ?></td></tr>
				</table></span>
				<h4><a href="goOffer.php?id=<?php echo $offer['offerId'];?>&userId=<?php echo $_SESSION['userName']; ?>"target="_blank"><?php echo $offer['offerName'];?></a></h4>
				<p class="des"><?php echo $offer['des'];?></p></div><!-- offer ending -->
		<?php
			}
		} 
		if(isset($_POST['searchOffer']) && $_POST['name']!=NULL) {
			$sql = mysql_query("SELECT COUNT(offers.id) FROM offers, networks WHERE (offers.name LIKE '%".$name."%' AND offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON')") or die(mysql_error());
		} else {
			$sql = mysql_query("SELECT COUNT(offers.id) FROM offers, networks WHERE (offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON')") or die(mysql_error()); 
		}
		$row = mysql_fetch_row($sql); 
		$total_records = $row[0]; 
		$total_pages = ceil($total_records / $showitemsperlist); 
		?>
		<div><p class="page txt">Page</p>
		<?php
		for ($i=1; $i<=$total_pages; $i++) { 
					echo "<a class='page' href='offers.php?page=".$i."'>".$i."</a> "; 
		}; 
		?>	 
		</div>
	</div>
 
	</div>      
</div>
    
 <?php include("footer.php");?>
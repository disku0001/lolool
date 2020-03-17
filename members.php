<?php 
session_start();
include_once"function/config.php";
include('function/fnc.php');
	
	// Check ProxStop status
/* 	if(ProxStop == "ON") {
		callProxstop();
	}
 */
	
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
	
	// Request Payout
	if(isset($_POST['requestPayout'])) {
		$requester = $_POST['requester'];
		$userId = $_SESSION['userName'];
		if($requester == NULL) {
			$final_report.="Please input Member Name !";
		} else {
			$checkRequester = mysql_query("SELECT name FROM requesters WHERE name='".$requester."'") or die(mysql_error());
			if(mysql_num_rows($checkRequester) == 0) {
				$final_report.="This requester name is invalid!";
			} else {
				$checkRequest = mysql_query("SELECT requester FROM members WHERE userName='".$userId."'") or die(mysql_error());
				$result = mysql_fetch_array($checkRequest);
				if($result['requester'] != NULL || $result['requester'] == $requester) {
					$final_report.="This username has been requested before!";
				} else {
					$updateRequest = mysql_query("UPDATE members SET requester='".$requester."' WHERE userName='".$userId."'") or die(mysql_error());
					$final_report.='<span style="color: green">Request successfully!</span>';
				} 
			}
		}
	}
?>
<?php include("function/includes.php");?>
<?php include("header.php");?>
</head>

<body>
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
		<?php if(isset($_SESSION['userName']) && isset($_SESSION['userPassword'])){  ?>
		<span class="homebtn"><a href="home.php"><img src="images/homeicon.png"></a></span>
		<?php } ?> 
		<?php if(!isset($_SESSION['userName']) || !isset($_SESSION['userPassword'])){  ?>
		<li><a href="index.php<?php echo $referral_string?>">Home</a></li>
		<?php } ?> 
		<?php if(isset($_SESSION['userName']) && isset($_SESSION['userPassword'])){  ?>	
		<li class="on"><a href="members.php">Members</a></li>
		<?php if(isset($_SESSION['userName']) && isset($_SESSION['userPassword'])){  ?>	
		<li><a href="offers.php">+ Offers +</a></li>
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
		<li class="signup"><a class="member" href="members.php">Hi, <?php echo $membername;?></a></li>
		<?php } ?>
		<?php if(!isset($_SESSION['userName']) || !isset($_SESSION['userPassword'])){  ?>
		<li class="signup"><a href="register.php<?php echo $referral_string?>">Sign Up Now!</a></li>
		<?php } ?> 
	</ul><!-- END NAVIGATION -->
    <div class="clear"></div>        
	
    <div id="content">
		<div class="req">
			<ul>
				<?php if ($pointsneeded <= 0){?>
				<li><a  class="reqRewards" href="request.php">Request Rewards</a></li>
				<?php } else { ?>
				<li><a  class="reqRewards" href="#">Request Rewards</a></li>
				<?php } ?>
				<li><a href="#" class="reqPayout">.: Request Payout :.</a></li>
				<li>
					<form action="" method="POST">
					<input type="text" name="requester" value="requester id" onclick="if ( value == 'requester id' ) { value = ''; }" class="boxName"/>
					<input type="submit" name="requestPayout" value="OK" class="btnReq" />
					</form>
					<?php if($final_report !=""){?>
					<p class="error">
						<? echo $final_report;?>
					</p>
					<?php } ?>
				</li>
			</ul>

		</div>
		<div class="memStats">
			<h2>Members - <?php echo $membername;?></h2>
				<p class="name"><?php echo vcName;?> Balance</p>
				<p class="value"><?php echo $memberpoints; ?></p>
				<p class="name">Completed Offers</p>
				<p class="value"><?php echo $membersurveys; ?></p>
				<p class="name"><?php echo vcName;?> needed for payout</p>
				<p class="value"><?php echo ($pointsneeded <= 0) ? '<a href="request.php">Request Payout</a>' : $pointsneeded; ?></p>
				<p class="name">Referrals</td>
				<p class="value"><?php echo $total_referrals ?></p>
				<p class="url"><?php echo $yourdomain ?>?join=<?php echo $ref_id ?></p>
			<div class="clear"></div>
			<h3>Completed Offers List</h3>
					<p class="listLeft title">Offer</p>
					<p class="listRight title"><?php echo vcName;?></p>
				<?php
				$queryCompletedOffers = mysql_query("SELECT offerName, points, offerNwk FROM leads WHERE userName= '".$_SESSION['userName']."'") or die(mysql_error());
				while($lead = mysql_fetch_assoc($queryCompletedOffers)) {
				?>
					<? 
					if($lead['offerName']=="#") {
					?>
					<p class="listLeft offer"><?php echo $lead['offerNwk'];?></p>
					<p class="listRight offer"><?php echo $lead['points'];?></p>
					<? } else {?>
					<p class="listLeft offer"><?php echo $lead['offerName'];?></p>
					<p class="listRight offer"><?php echo $lead['points'];?></p>
				<?php }} ?>				
			</table>

		</div>
		<div class="clear"></div>
		<?php
		if(ShowStats == 'ON') {
		?>
		<div class="siteStats">
			<h3>Website Stats</h3>
			<div class="box lastLeads">
				<h4>Latest Credits</h4>
				<table cellspacing="0">
					<thead>
						<tr>
							
							<th>Offer</th>
							<th><? echo vcName; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php getLeadsStats();?>
					</tbody>
				</table>
			</div>
			
			<div class="box lastOffers">
				<h4>Latest Offers</h4>
				<table cellspacing="0">
					<thead>
						<tr>
							<th>Offer</th>
							<th><? echo vcName; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php getOffersStats();?>
					</tbody>
				</table>
			</div>
			
			<div class="box topMem">
				<h4>Top Members</h4>
				<table cellspacing="0">
					<thead>
						<tr>
							<th>Username</th>
							<th><? echo vcName; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php getTopUsers();?>
					</tbody>
				</table>
			</div>
		</div>
		<?php }?>
    </div>
</div>
<?php include("footer.php");?>
<? 
session_start();
include_once"function/config.php";
include('function/fnc.php');
if(isset($_POST['login'])){
$userName= trim($_POST['userName']);
$userPassword = trim($_POST['userPassword']);
if($userName == NULL OR $userPassword == NULL){
$final_report.="Please complete both fields";
}else{
$check_user_data = mysql_query("SELECT * FROM `members` WHERE `userName` = '$userName'") or die(mysql_error());
if(mysql_num_rows($check_user_data) == 0){
$final_report.="This username does not exist";
}else{
$get_user_data = mysql_fetch_array($check_user_data);
if($get_user_data['userPassword'] == $userPassword){
$start_idsess = $_SESSION['userName'] = "".$get_user_data['userName']."";
$start_passsess = $_SESSION['userPassword'] = "".$get_user_data['userPassword']."";
$start_ipsess = $_SESSION['ip'] = "".$get_user_data['ip']."";
$final_report.="<meta http-equiv='Refresh' content='0; URL=members.php'/>";
}}}}
	 if(isset($_SESSION['userName']) && isset($_SESSION['userPassword'])){ 
	header("Location: home.php");
	}
	
?> 
<?php include("function/includes.php");?>
<?php include("header.php");?>
  
	<?  if(Template=="SOFT") {  ?>
	<script type="text/javascript">
		function refreshShoutbox () {
			var code = document.getElementById('shoutbox');
			code.src = code.src; // that is the essence here
		}
	</script>
	<? } ?>
</head>

<body>
<!-- START CONTENT -->
<div id="wrapper">
	<!-- START HEADER -->
    <div id="header">
        <a class="logo" href="index.php<?php echo $referral_string?>"></a>
        <div class="login_box">
				<?php if(!isset($_SESSION['userName']) || !isset($_SESSION['userPassword'])){  ?>	   
				<?php if($final_report !=""){
					header("Location: login.php");
				} ?>
			   <form action="" method="post">
					<input name="userName" type="text" title="username" class="log username" value="Username" onclick="if ( value == 'Username' ) { value = ''; }"/>
					<input name="userPassword" type="password" class="log password" title="password" value="Password" onclick="if ( value == 'Password' ) { value = ''; }"/>
					<input type="Submit" name="login" class="log_submit" value="login" tabindex="3" />
				</form>	
        
			<?php } ?>
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
		<li><a href="members.php">Members</a></li>
		<?php } ?>
		<li><a href="rewards.php<?php echo $referral_string?>">Rewards</a></li>
		 <?php if(isset($_SESSION['userName']) && isset($_SESSION['userPassword'])){  ?>	
		<li><a href="logout.php">Logout</a></li>
		<?php } ?>
		<?php if(!isset($_SESSION['userName']) || !isset($_SESSION['userPassword'])){  ?>
		<li class="signup"><a href="register.php<?php echo $referral_string?>">Sign Up Now!</a></li>
		<?php } ?> 
	</ul><!-- END NAVIGATION -->
    <div class="clear"></div>        
	<!-- START CONTENT -->
    <div id="content">
		<h4>Help Section</h4>
        <p><br>
     
        <a href="#how-does-it-work"><b>Q: How does <?php echo $title ?> work?</b></a><br/> 
		<a href="#points"><b>Q: What are points, and how do I earn them?</b></a><br/> 
		<a href="#referral"><b>Q: Can I get points without filling in surveys and offers?</b></a><br/> 
        <a href="#what-are-points-worth"><b>Q: What are points worth?</b></a><br/> 
        <a href="#vouchers-for-free"><b>Q: How can <?php echo $title ?> give away vouchers for free?</b></a><br/> 
        <a href="#points-problem"><b>Q: I completed a survey but never received the points, how come?</b></a><br/>
        <a href="#request-a-voucher"><b>Q: How do I request a voucher?</b></a><br/> 
		<a href="#contact"><b>Q: How can I contact <?php echo $title ?>?</b></a><br/> 
		<br><br><br>
        </p>
		<p>
		1. <b>Register:</b> The sign up process takes about 10 seconds, and we'll even give you <font color=#fcbc0c><b><?php echo $bonuspoints ?> FREE BONUS POINTS</b></font> when you <a href="register.php"><b>register</b></a>.<br><br>
2. <b>Earn points:</b> To be able to offer our users FREE gift vouchers to use at online stores such as Amazon and ASOS, you need to earn points. Earning these points are FREE, and you just need to complete a few surveys to get enough points to claim a free voucher. You can also earn points by signing up to some trial offers, but we recommend you stick to the free surveys for now.<br><br>
3. <b>Get a Free voucher:</b> Once you have earned <?php echo $mainpointsneeded ?> points on <?php echo $title?> you can swap them for REAL cash vouchers, which can be used at online stores/communities. Basically, you can request ANY voucher, as long as we can buy it online and send to you via email. The possibilities are endless........
		</p>
		
        <h4 id="points">Q: What are points, and how do I earn them?</h4>
		<p><br>
		On <?php echo $title?>, points equate to REAL money. Once you have enough points, you can swap them for a voucher, redeemable at a store/website of your choice! You can earn points by filling quick surveys that take around 1 minute. <br><br>You have the option to fill in surveys, trial offers, or purchase offers. ALternatively, you can easily use paypal to make up those extra few points so you can claim your voucher!<br><br>
		</p>
			<br>
			      <h4 id="referral">Q: Can I get points without filling in surveys and offers?</h4>
		<p><br>
	Yes! <?php echo $title?> has a referral system in place. Once you sign up, go to the members area and you'll find your special referral link. Give this out to friends, family and colleagues, or promote online. We'll then give you 2 points for EVERY survey that they complete!  
		</p>
		<br>
			
        <h4 id="what-are-points-worth">Q: What are points worth?</h4>
		<p><br>
		10 points = $1.00/&pound;0.50<br>
		50 points = $5.00/&pound;2.50<br>
		100 points = $10.00/&pound;5.00<br>
		200 points = $20.00/&pound;10.00
		<br><br>
		You need <?php echo $mainpointsneeded?> points before you can redeem them for <a href="vouchers.php">gift vouchers</a>.
		</p>
		
        <h4 id="vouchers-for-free">Q: How can <?php echo $title ?> give away vouchers for free?</h4>
		<p><br>
		To be able to offer our users FREE gift vouchers to use at online stores such as Amazon and ASOS, you need to earn points. You just need to complete a few surveys to get enough points to claim a free voucher. You can also earn points by signing up to some trial offers, but we recommend you stick to the free surveys for now. </a>
		</p>
			<br>
		
        <h4 id="points-problem">Q: I completed a survey but never received the points, how come?</h4>
		<p><br>
	If you have tried completing any of these surveys and you did not receive any points, it is due to one of the following reasons:<br><br>
1. Advertiser did not find the information you provided useful.<br>

2. You did not match the advertiser's targeted demographic.<br>

3. Your cookies are not enabled.<br>

4. You did not complete the survey all-the-way.<br><br>

Some advertiser's are pickier than others. We suggest if one survey does not reward you, to just move onto the next. This is the nature of the free surveys and the incentive CPA industry. 

		</p>
		<br>
		
        <h4 id="request-a-voucher">Q: How can I request a voucher?</h4><p><br>
		Once you earn <?php echo $mainpointsneeded?> points a link will be enabled in the members area, which will enable you to contact us with your request. From here you can choose which voucher you'd like us to send you.
		</p>
        <h4 id="contact">Q: How can I contact <?php echo $title ?>?</h4><p><br>
		If you need more information it's simple - just <a href="contact.php">click here</a> to contact us.</p>
		
		<p><br>&nbsp;<br></p>

    </div><!-- END CONTENT -->
</div><!-- END WRAPPER -->
<?php include("footer.php");?>
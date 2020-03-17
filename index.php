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
	<?  if(Template=="HARD") {  ?>
	<!-- START JQUERY SLIDER -->
	 <!--
	  jQuery library
	-->
	<script type="text/javascript" src="slider/jquery-1.2.3.pack.js"></script>
	<!--
	  jCarousel library
	-->
	<script type="text/javascript" src="slider/jquery.jcarousel.pack.js"></script>
	<!--
	  jCarousel core stylesheet
	-->
	<link rel="stylesheet" type="text/css" href="slider/jquery.jcarousel.css" />
	<!--
	  jCarousel skin stylesheet
	-->
	<link rel="stylesheet" type="text/css" href="slider/skins.css" />

	<script type="text/javascript">
	function mycarousel_initCallback(carousel)
	{
		// Disable autoscrolling if the user clicks the prev or next button.
		carousel.buttonNext.bind('click', function() {
			carousel.startAuto(0);
		});

		carousel.buttonPrev.bind('click', function() {
			carousel.startAuto(0);
		});

		// Pause autoscrolling if the user moves with the cursor over the clip.
		carousel.clip.hover(function() {
			carousel.stopAuto();
		}, function() {
			carousel.startAuto();
		});
	};

	jQuery(document).ready(function() {
		jQuery('#mycarousel').jcarousel({
			auto: 3,
			wrap: 'last',
			scroll: 1,
			initCallback: mycarousel_initCallback
		});
	});
	function MM_preloadImages() { //v3.0
	  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
		var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
		if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
	}

	function MM_swapImgRestore() { //v3.0
	  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
	}

	function MM_findObj(n, d) { //v4.01
	  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
	  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
	  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
	  if(!x && d.getElementById) x=d.getElementById(n); return x;
	}

	function MM_swapImage() { //v3.0
	  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
	   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
	}
	</script>
	<!-- END JQUERY SLIDER -->
	<? } ?>
</head>

<body <?  if(Template=="HARD") {  ?> onload="MM_preloadImages('slider/1Roll.jpg','slider/2Roll.jpg','slider/3Roll.jpg','slider/4Roll.jpg','slider/5Roll.jpg','slider/6Roll.jpg','slider/7Roll.jpg','slider/8Roll.jpg','slider/9Roll.jpg')"<?}?>>
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
		<?  if(Template=="HARD") {  ?>
		<!-- START SLIDER -->
		<div id="wrap">
		<ul id="mycarousel" class="jcarousel-skin-tango">
			<li><a href="http://www.apple.com/macbookpro/" target="_blank"><img src="slider/1.jpg" alt="" name="a" width="195" height="125" id="a" onmouseover="MM_swapImage('a','','slider/1Roll.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></li>
			<li><a href="http://www.apple.com/ipodtouch/" target="_blank"><img src="slider/2.jpg" alt="" name="b" width="195" height="125" id="b" onmouseover="MM_swapImage('b','','slider/2Roll.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></li>

			<li><a href="http://www.apple.com/imac/" target="_blank"><img src="slider/3.jpg" alt="" name="c" width="195" height="125" id="c" onmouseover="MM_swapImage('c','','slider/3Roll.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></li>
			<li><a href="http://www.apple.com/macbookair/" target="_blank"><img src="slider/4.jpg" alt="" name="d" width="195" height="125" id="d" onmouseover="MM_swapImage('d','','slider/4Roll.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></li>
			<li><a href="http://www.apple.com/iphone/" target="_blank"><img src="slider/5.jpg" alt="" name="e" width="195" height="125" id="e" onmouseover="MM_swapImage('e','','slider/5Roll.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></li>
			<li><a href="http://www.apple.com/macpro/" target="_blank"><img src="slider/6.jpg" alt="" name="f" width="195" height="125" id="f" onmouseover="MM_swapImage('f','','slider/6Roll.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></li>
			<li><a href="http://www.apple.com/ipodnano/" target="_blank"><img src="slider/7.jpg" alt="" name="g" width="195" height="125" id="g" onmouseover="MM_swapImage('g','','slider/7Roll.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></li>
			<li><a href="http://www.apple.com/macbook/" target="_blank"><img src="slider/8.jpg" alt="" name="h" width="195" height="125" id="h" onmouseover="MM_swapImage('h','','slider/8Roll.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></li>
			<li><a href="http://www.apple.com/ipodclassic/" target="_blank"><img src="slider/9.jpg" alt="" name="i" width="195" height="125" id="i" onmouseover="MM_swapImage('i','','slider/9Roll.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></li>
		</ul>
		</div>
		<!-- END SLIDER -->
		<? } ?>
		<div class="home">
			<?  if(Template=="SOFT") {  ?>
			<div id="shoutwrap" class="boxoutter">
				<iframe name="shoutbox" id="shoutbox" src="shout.php" scrolling="yes" class="shoutbox"></iframe> 
				<a href="javascript:refreshShoutbox();" class="f5-btn">Refresh!</a>
			</div>
			<? } ?>
			<? echo htmlspecialchars_decode(heading2,ENT_QUOTES);?><br><br>
			
			<? echo htmlspecialchars_decode(paragraph,ENT_QUOTES);?>
			
			<br />
			<? echo htmlspecialchars_decode(heading3,ENT_QUOTES);?>
			<br />
			<div class="clear"></div>
			 <ul class="steps">
				<li><a class="one" href="register.php">JOIN FREE</a></li>
				<li><a class="two" href="members.php">COMPLETE OFFERS</a></li>
				<li><a class="three" href="rewards.php">GET VOUCHERS</a></li>
			 </ul>
			 <br>
			 <br>
			 
			<br><br>
			
			<? echo htmlspecialchars_decode(heading4,ENT_QUOTES);?>
			<div class="rewards-logo"></div>
			<div class="benefits">
				<ul>
					<li><? echo htmlspecialchars_decode(f1,ENT_QUOTES);?></li>
					<li><? echo htmlspecialchars_decode(f2,ENT_QUOTES);?></li>
					<li><? echo htmlspecialchars_decode(f3,ENT_QUOTES);?></li>
				</ul>	
				<ul>
					<li><? echo htmlspecialchars_decode(f4,ENT_QUOTES);?></li>
					<li><? echo htmlspecialchars_decode(f5,ENT_QUOTES);?></li>
					<li><? echo htmlspecialchars_decode(f6,ENT_QUOTES);?></li>
				</ul>		
				<div class="clear"></div>
			</div>
			<br />
			<?  if(Template=="SOFT") {  ?>
			<div class="offerwalls"> 
				<div class="lastestOffers">
					<table cellspacing="0">
					<thead>
						<tr><th>Latest Offers</th>
						<th><? echo vcName;?></th>
						<th>Country</th></tr>
					</thead>
					<tbody>
					<?
						get5Offers() 
					?>
					</tbody>
					</table>
				</div>
				<div class="sitestats">
					<img src="images/vouchers.jpg" alt="Vouchers" />
				</div>
				
			</div>
			<? } else {  ?>
			<h5>EARN POINTS WITH OUR SELECTION OF THE BEST PAYING OFFER WALLS ...</h5>
			<div class="offerwalls"> 
				<img class="shopping" src="images/shopping.png">
			</div>
			<? } ?>
			<?  if(Template=="SOFT") {  ?>
			<div class="clear"></div>
			<div class="sponsors">
			<? if(bottomImageUrl==NULL) {
			echo 'advertise here';
			} else { ?>
				<a href="<? echo bottomUrl;?>" target="_blank"><img src="<? echo bottomImageUrl;?>" /></a>
			<?}?>
			
			</div>			
			<? }?>
			
		</div>
    </div><!-- END CONTENT -->
</div><!-- END WRAPPER -->
<?php include("footer.php");?>
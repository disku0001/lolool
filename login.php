<? 
session_start();
include_once"function/config.php";
if(isset($_POST['login'])){
$userName= trim($_POST['userName']);
$userPassword = trim($_POST['userPassword']);
if($userName == NULL OR $userPassword == NULL){
$final_report.="Please complete both fields";
}else{
$check_user_data = mysql_query("SELECT * FROM `members` WHERE `userName` = '".$userName."'") or die(mysql_error());
if(mysql_num_rows($check_user_data) == 0){
$final_report.="This username does not exist";
}else{
$get_user_data = mysql_fetch_array($check_user_data);
if($get_user_data['userPassword'] == $userPassword){
$start_idsess = $_SESSION['userName'] = "".$get_user_data['userName']."";
$start_passsess = $_SESSION['userPassword'] = "".$get_user_data['userPassword']."";
$final_report.="<meta http-equiv='Refresh' content='0; URL=members.php'/>";
}}}}

if(isset($_SESSION['userName']) && isset($_SESSION['userPassword'])){ 
	header("Location: home.php");
	}

?> 

<?php include("function/includes.php"); ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php echo $title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>
<div id="wrapper">

    <div id="header">
        <a class="logo" href="index.php<?php echo $referral_string?>"></a>
        <div class="login_box">
		</div>
	</div>
		

	<ul id="navigation">
		<li class="on"><a href="index.php<?php echo $referral_string?>">Home</a></li>
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
	</ul>
    <div class="clear"></div>        
    <!-- START CONTENT -->
    <div id="content" class="special">
		<div class="form_page">
			<h3>Login Form</h3>
			<form action="" method="post">
                <input name="userName" type="text" title="username" class="log username" value="Username" onclick="if ( value == 'Username' ) { value = ''; }"/>
                <input name="userPassword" type="password" class="log password" title="password" value="Password" onclick="if ( value == 'Password' ) { value = ''; }"/>
                <input type="Submit" name="login" class="log_submit" value="login" tabindex="3" />
			</form>
			<?php if($final_report !=""){?>
			<p class="error">
				<? echo $final_report;?>
			</p>
			<?php } ?>
		</div>
	
    </div>
	<!-- END CONTENT -->
</div>
<?php include("footer.php");?>
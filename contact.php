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
	<h4>Contact Us</h4>
        <p>
        <br>
         <?php if(isset($_SESSION['username']) && isset($_SESSION['password']) && $pointsneeded<0){  ?>	
         <FONT color="red">You have enough points to request a voucher, please <a href="request.php">click here</a> instead of using this contact form.</font><br><br><?php }?>
        If you need any help, please don't hesistate to get in touch. Note: this cannot be used to request vouchers. Once you've hit the point threshold, the 'request voucher' link will be visible in the members section.<br><br>
        <?php 
    $to = $contactemail;

/* From email address, in case your server prohibits sending emails from addresses other than those of your 
own domain (e.g. email@yourdomain.com). If this is used then all email messages from your contact form will appear 
from this address instead of actual sender. */

$from = '';

/* This will be appended to the subject of contact form message */
$subject_prefix = 'Contact Form';


/* Form width in px or % value */
$form_width = '70%';

/* Form background color */
$form_background = '#F7F8F7';

/* Form border color */
$form_border = '#9bb50b';

/* Form border style. Examples - dotted, dashed, solid, double */
$form_border_style = 'solid';

/* Empty/Invalid fields will be highlighted in this color */
$field_error_color = '#FF0000';

/* Thank you message to be displayed after the form is submitted. Can include HTML tags. Write your message 
between <!-- Start message --> and <!-- End message --> */
$thank_you_message = <<<EOD
<!-- Start message -->
<p>We have received your message. If required, we'll get back to you as soon as possible.</p><br /><br /><br /><br /><br /><br /><br /><br />
<!-- End message -->
EOD;

/* URL to be redirected to after the form is submitted. If this is specified, then the above message will 
not be shown and user will be redirected to this page after the form is submitted */
/* Example: $thank_you_url = 'http://www.yourwebsite.com/thank_you.html'; */

$thank_you_url = 'thanks_contact.php';

/*******************************************************************************
 *	Do not change anything below, unless of course you know very well 
 *	what you are doing :)
*******************************************************************************/

$name = array('Name','name',NULL,NULL);
$email = array('Email','email',NULL,NULL,NULL);
$subject = array('Subject','subject',NULL,NULL);
$message = array('Message','message',NULL,NULL);
$yourusername = $membername;
$publickey = $captcha_publickey;
$privatekey = $captcha_privatekey;
$error_message = '';
$resp = null;
$error2 = null;
if (!isset($_POST['submit'])) {

  showForm();

} else { //form submitted
$error = 0;
  if(!empty($_POST['check'])) die("Invalid form access");
  $resp = recaptcha_check_answer ($privatekey,
                                  $_SERVER["REMOTE_ADDR"],
                                  $_POST["recaptcha_challenge_field"],
                                  $_POST["recaptcha_response_field"]);

    
  if(!empty($_POST['name'])) {
  	$name[2] = clean_var($_POST['name']);
  	if (function_exists('htmlspecialchars')) $name[2] = htmlspecialchars($name[2], ENT_QUOTES);
  }
  else {
    $error = 1;
    $name[3] = 'color:#FF0000;';
  }
  
  if(!empty($_POST['email'])) {
  	$email[2] = clean_var($_POST['email']);
  	if (!validEmail($email[2])) {
  	  $error = 1;
  	  $email[3] = 'color:#FF0000;';
  	  $email[4] = '<strong><span style="color:#FF0000;">Invalid email</span></strong>';
	  }
  }
  else {
    $error = 1;
    $email[3] = 'color:#FF0000;';
  }
  
  if(!empty($_POST['subject'])) {
  	$subject[2] = clean_var($_POST['subject']);
  	if (function_exists('htmlspecialchars')) $subject[2] = htmlspecialchars($subject[2], ENT_QUOTES);  	
  }
  else {
  	$error = 1;
    $subject[3] = 'color:#FF0000;';
  }  

  if(!empty($_POST['message'])) {
  	$message[2] = clean_var($_POST['message']);
  	if (function_exists('htmlspecialchars')) $message[2] = htmlspecialchars($message[2], ENT_QUOTES);
  }
  else {
    $error = 1;
    $message[3] = 'color:#FF0000;';
  }      

  if ($error == 1) {
    $error_message = '<span style="font-weight:bold;font-size:90%;">Please correct/enter field(s) in red.</span>';

    showForm();

  } else {
  	if ($resp->is_valid) {  
  	if (function_exists('htmlspecialchars_decode')) $name[2] = htmlspecialchars_decode($name[2], ENT_QUOTES);
  	if (function_exists('htmlspecialchars_decode')) $subject[2] = htmlspecialchars_decode($subject[2], ENT_QUOTES);
  	if (function_exists('htmlspecialchars_decode')) $message[2] = htmlspecialchars_decode($message[2], ENT_QUOTES);  	
  	
    $message = "Username:$membername\r\nPoints:$memberpoints\r\nName:$name[2]\r\nEmail:$email[2]\r\n\r\nMessage:\r\n$message[2]\r\n";
    
    if (!$from) $from_value = $email[2];
    else $from_value = $from;
    
    $headers = "From: $from_value" . "\r\n" . "Reply-To: $email[2]";
    
    mail($to,"$subject_prefix - $subject[2]", $message, $headers);
    
    if (!$thank_you_url) {
    
      
      echo $GLOBALS['thank_you_message'];
      echo "\n";
      
	  }
	  else {
	  	header("Location: $thank_you_url");
	  }
       	
  }else {
  $error2 = $resp->error;
  showform(); } 
  
} //else submitted

}
function showForm()

{

global $name, $email, $subject,$error2,$resp, $message, $captcha_publickey, $form_width, $form_background, $form_border, $form_border_style; 	

echo $GLOBALS['error_message'];  
echo <<<EOD
<div style="width:{$form_width};vertical-align:top;text-align:left;background-color:{$form_background};border: 1px {$form_border} {$form_border_style};overflow:visible;" id="formContainer">
<form method="post" class="contactForm">
<fieldset style="border:none;">
<p><label for="{$name[1]}" style="font-weight:bold;{$name[3]};width:25%;float:left;display:block;">{$name[0]}</label> <input type="text" name="{$name[1]}" value="{$name[2]}" /></p>
<p><label for="{$email[1]}" style="font-weight:bold;{$email[3]}width:25%;float:left;display:block;">{$email[0]}</label> <input type="text" name="{$email[1]}" value="{$email[2]}" /> {$email[4]}</p>
<p><label for="{$subject[1]}" style="font-weight:bold;{$subject[3]}width:25%;float:left;display:block;">{$subject[0]}</label> <input type="text" name="{$subject[1]}" value="{$subject[2]}" /></p>
<p><label for="{$message[1]}" style="font-weight:bold;{$message[3]}width:25%;float:left;display:block;">{$message[0]}</label> <textarea name="{$message[1]}" cols="40" rows="6">{$message[2]}</textarea></p>
<p><span style="font-weight:bold;font-size:90%;">All fields are required.</span></p>
EOD;
echo <<<EOD
<br>

<input type="hidden" name="question" value="{$question}">
<input type="hidden" name="check" value="">
<input type="submit" name="submit" value="Submit" style="border:1px solid #999;background:#E4E4E4;margin-top:5px;" />
</fieldset>
</form>
</div>
<br>
<div style="width:{$form_width};text-align:right;font-size:80%;">
</div> 
EOD;

}

function clean_var($variable) {
    $variable = strip_tags(stripslashes(trim(rtrim($variable))));
  return $variable;
}

/**
Email validation function. Thanks to http://www.linuxjournal.com/article/9585
*/
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && function_exists('checkdnsrr'))
      {
      	if (!(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
         // domain not found in DNS
         $isValid = false;
       }
      }
   }
   return $isValid;
}

?>
    </div><!-- END CONTENT -->
</div><!-- END WRAPPER -->
<?php include("footer.php");?>
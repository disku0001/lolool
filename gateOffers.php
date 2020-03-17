<? 
session_start();
include_once"function/config.php";

	if(isset($_POST['passRequired'])){
		$passOffers= md5($_POST['passOffers']);
		if($passOffers == NULL){
			$final_report.="Password is required!";
		} else {
			$getPass = mysql_query("SELECT passOffers FROM admin") or die(mysql_error());
			$pass = mysql_fetch_array($getPass);
			if($pass['passOffers'] == $passOffers){
				$start_passofferssess = $_SESSION['passOffers'] = "".$pass['passOffers']."";
				$final_report.="<meta http-equiv='Refresh' content='0; URL=offers.php'/>";
			} else {
				$final_report.="Password is wrong!";
			}
		}
	}
	
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php echo $title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <style type="text/css">
		body{background:url(images/bg_2.png) repeat scroll left top transparent;color:#555;font-family:Calibri,Tahoma,sans-serif;font-size:12px;height:100%;margin:0;padding:0}
		.box {
			margin: 0 auto; width: 220px;
		}
		.box h3 {
			background:none repeat scroll 0 0 #9BB50B;color:#FFF;font-family:Calibri,Tahoma,sans-serif;font-size:18px;text-align:center;text-shadow:1px 1px 0 #333;text-transform:uppercase;margin:10px 0 0;padding:5px 0
		}
		.box input.txt {background-color: #EEEEEE;border: medium none;margin: 5px 0 3px;padding: 5px;text-align: left;width: 210px;}
		.box input.txt:focus { background-color: #FF9}
		.box input.btn {background:none repeat scroll 0 0 #0092E0;border:1px solid #999;color:#FFF;font-family:Impact,Calibri,Tahoma,serif;font-size:18px;text-shadow:1px 1px 0 #000;text-transform:uppercase;margin-top:3px;width:100%}
		.box .error {color: red; font-weight: bold; text-align: center; font-size: 14px}
  </style>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75072341-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body>
<div id="wrapper">

     
    <!-- START CONTENT -->
    <div id="content">
		<div class="box">
			<h3>Password Required</h3>
			<form action="" method="post">
                <input name="passOffers" type="password" class="txt" title="password" />
                <input type="Submit" name="passRequired" class="btn" value="OK" tabindex="3" />
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
</body>
</html>
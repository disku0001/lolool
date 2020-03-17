<? 
session_start();
include_once"../function/config.php";
include("../function/includes.php");
if(isset($_POST['login'])){
	$admin= $_POST['username'];
	$pass = md5($_POST['password']);
	if($admin == NULL OR $pass == NULL){
		$final_report.="Please complete both fields";
		} else {
			$query = mysql_query("SELECT * FROM `admin` WHERE `adminName` = '$admin'") or die(mysql_error());
			if(mysql_num_rows($query) == 0){
				$final_report.="This username is invalid!";
				} else {
					$admin = mysql_fetch_array($query);
					if($admin['adminPass'] == $pass){
						$_SESSION['adminName'] = $admin['adminName'];
						$_SESSION['adminPass'] = $admin['adminPass'];
						$final_report.="<meta http-equiv='Refresh' content='0; URL=index.php'/>";
					} else {
						$final_report.="Wrong Email / Password combination!";
					}
				}
		}
}

if(isset($_SESSION['adminName']) && isset($_SESSION['adminPass'])){ 
	header("Location: index.php");
	}

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />

</head>

<?php include('header.php'); ?>
         
    <div id="content">
         <div class="box login">
			<h2>Admin Login Form</h2>
			<form action="" method="post">
				<label for="admin" class="label">Admin</label>
                <input name="username" type="text" title="username" class="txt" />
				<label for="pass" class="label">Password</label>
                <input name="password" type="password" class="txt" title="password" />
                <input type="Submit" name="login" class="btn" value="login" tabindex="3" />
			</form>
			<?php if($final_report !=""){?>
			<p class="error">
				<? echo $final_report;?>
			</p>
			<?php } ?>
		</div>
    </div>
</div>
</body>
</html>
<? 
// This simple PHP / Mysql membership script was created by www.funkyvision.co.uk
// You are free to use this script at your own risk
// Please visit our website for more updates..
session_start();
include_once"function/config.php";;
session_unset();
session_destroy();
echo "<meta http-equiv='Refresh' content='3; URL=index.php'/>";
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Respect the Rule! </title>
<style type="text/css">
	html { border-top: 2px solid #F10000; }
	body {
		background: url("images/bg_2.png") repeat scroll 0 0 transparent;
		margin: 0 auto;
		padding: 0;
		border-top: 5px dashed #F10000;
		width: 100%;
	}
	#respect {
		background: url("images/respect.png") no-repeat scroll 0 0 transparent;
		width: 371px;
		height: 96px;
		margin: 250px auto 0;
	}
</style>
</head>

<body>
<div id="respect">
</div>
</body>
</html>
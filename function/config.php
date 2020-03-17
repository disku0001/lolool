<? 
ob_start();session_start();
$hostname = "localhost"; //your hostname (normally localhost)
$data_username = "mobi_share"; //database username
$data_password = "123qw"; //database password
$data_basename = "molo_share"; //database name
$conn = mysql_connect("".$hostname."","".$data_username."","".$data_password."");  
mysql_select_db("".$data_basename."") or die(mysql_error());  
$bonuspoints=0; //bonus points awarded for new users
$mainpointsneeded=200; //max number of points needed before user can request voucher
?>
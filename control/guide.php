<?php
session_start();
include_once"../function/config.php";
include_once"../function/fnc.php";
if(!isset($_SESSION['adminName']) || !isset($_SESSION['adminPass'])){ 
	header("Location: login.php"); 
	} 
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Admin cPanel</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="admin.css" type="text/css" />
  <link rel="stylesheet" href="../jquery/style.css" />
  <script type="text/javascript" src="../function/calc-func.js">
  </script>
</head>

<?php include('header.php'); ?>
   
    <div id="content">
    	<div class="guide">
	<h3>Hướng dẫn sử dụng code W3GPT</h3>
	<h4>Members</h4>
	<p>
		<b>*** Tính năng *** </b><br>
		+ Chuyển tất cả số point kiếm được của mỗi username về 1 ID (requester).<br>
		+ Lọc featured offers theo từng quốc gia.<br>
		+ Thể hiện danh sách completed offer trong trang members.<br>
		+ Bật/Tắt Website Status > Cập nhật offer mới, top username, offer mới lead qua trang members.<br>
		+ Kiểm tra IP trùng, kiểm tra số points, completed offers từng username, requesters, cập nhật thông báo từ admin thông qua trang ask.php<br>
	</p>
	<h4>Admin</h4>
	<h4>1. Setting</h4>
	<p>
		1.1 <b>EDIT ADMIN PASSWORD</b>: Thay đổi Admin password<br>
		1.2 <b>POSTBACK SECURITY</b>: Đặt password khóa hệ thống postback khỏi hành vi gian lận.<br>
		1.3 <b>EDIT RATIO</b>: Cài đặt Ratio cho Featured Offers<br>
		1.4 <b>EDIT VIRTUAL CURRENCY NAME</b>: Cài đặt tên VC cho Featured Offers<br>
		1.5 <b>STOP 2 IPS</b>: Bật/Tắt chức năng ngăn chặn việc members sử dụng 2IPs trên 1 account.<br>
		1.6 <b>PROXSTOP</b>: Bật/Tắt chức năng ProxStop cho Featured Offers, Offer Wall.<br>
		1.7 <b>LOCK OFFERS PAGR</b>: Bật/Tắt chức năng yêu cầu password mỗi khi truy cập vào Featured Offers, Offer Wall.<br>
		1.8 <b>NOTICE BOARD</b>: Bảng cập nhật thông báo cho members. ( Thông báo được thể hiện trên trang check của member)<br>
		1.9 <b>SHOW WEBSITE STATS</b>: Thể hiện Website Stats trong Members<br>
		1.10 <b>CLEAR IP ADDRESSES</b>: Reset IP addresses trong database<br>
		1.11 <b>IP Quality Score (NEW)</b>: Tích hợp dịch vụ check proxy, VPN free từ IP Quality Score.<br>
		*** Hướng dẫn cài đặt IP Quality Score ***<br>
		a. Truy cập vào website ipqualityscore.com > Create Free Account<br>
		b. Kiểm tra email để lấy API Key mà IPQualityScore gửi tới. Copy API KEY > Dán vào ô Api Key > chọn ON > bấm OK. DONE!
		
	</p>
	<h4>2.1. Networks</h4>
	<p>
		2.1.1. <b>ADD NETWORK</b>: Thêm network cho Featured Offers<br>
		2.1.1.3 <b>STATUS</b>: Bật/Tắt network. Nếu status ON thì tất cả những offer thuộc network có status ON sẽ hiện hiển thị trên trang Featured Offers và ngược lại.<br>
		2.1.2. <b>NETWORK MANAGER</b>: Quản lý networks, chỉnh sửa<br>
		2.1.3. <b>GLOBAL POSTBACK URL</b>: Danh sách postback url sử dụng cho từng platform<br>
	</p>
	<h4>2.2. Offer Wall</h4>
	<p>
		2.2.1 <b>ADD Offer Wall</b>: Thêm network offer wall<br>
		2.2.2 <b>Offer Wall MANAGER</b>: Quản lý network Offer wall<br>
		2.2.2.0 <b>Hướng dẫn cập nhật thông tin offer wall</b>:<br>
		2.2.2.1 <b>Iframe</b>: Sử dụng Iframe code network cung cấp và chỉnh sửa lại như sau theo từng offer wall:<br>
		+ BLVD: <b>&subid=XXX</b><br>
		+ SR: <b>&uid=XXX</b><br>
		+ Sonic: <b>&applicationUserId=XXX</b><br>
		+ Radium: <b>&userId=XXX</b><br>
		+ Matomy: <b>&user_id=XXX</b><br>
		+ OfferWalls: <b>&uid=XXX</b><br>
		+ CPAlead: ( Riêng CPAlead thì không có iframe code, vì vậy bạn cần copy lấy startGateway code để bỏ vào Iframe field này. Ví dụ: <b>startGateway('NDg0NzEz');</b><br>
		2.2.2.2 <b>Key</b>: Sử dụng secret Key của offer wall (nếu có). Riêng CPAlead: sử dụng Publisher ID ở đây. Ví dụ: <b>170xxx</b>, <b>xxxxxx</b><br>
		2.2.2.3 <b>Pass</b>: Sử dụng secret password của offer wall (nếu có).<br>
		2.2.2.4 <b>Status</b>: Bật/Tắt offer wall.<br>
		2.2.3. <b>Offer Wall POSTBACK URL</b>: Postback url sử dụng cho từng network offer wall<br>
	</p>
	<h4>3.1. Users</h4>
	<h4>3.2. Check Lead/Points</h4>
	<p>
		3.2.1 Kiểm tra points theo Usernames list và Requesters List.<br>
		3.2.2 Kiểm tra Completed Offers theo Usernames list và Requesters List.<br>
	</p>
	<h4>3.3. Update Paid/Points</h4>
	<p>
		3.3.1 Cập nhật trình trạng đã thanh toán, reset points cho Usernames list. <br> 
		3.3.2 Cập nhật trình trạng đã thanh toán, reset points cho Requesters list. <br> 
		3.3.3 Cập nhật danh sách Usernames cho requester bất kỳ. <br> 
		3.3.4 Cập nhật points cho Username bất kỳ. <br> 
	</p>
	<h4>4.1. Offers</h4>
	<p>
		4.1.0 Quản lý, chỉnh sửa, xóa offers.
	</p>
	<h4>4.2. Add Offers</h4>
	<p>
		4.2.1 <b>Offer Id</b>: Id của offer lấy từ network<br>
		4.2.2 <b>Name</b>: Tên của offer lấy từ network<br>
		4.2.3 <b>Description</b>: Mô tả của offer lấy từ network<br>
		4.2.4 <b>Payout</b>: payout của offer lấy từ network ( tính theo đơn vị dollar)<br>
		4.2.5 <b>Ratio</b>: Tùy chỉnh rate của offer theo ý muốn. Nếu muốn sử dụng ratio chung (đã được cài đặt trước đó trong setting) thì tick vào checkbox. Nếu muốn sử dụng rate riêng cho offer bất kỳ thì uncheck vào checkbox và nhập ratio mong muốn vào  textbox.<br>
		4.2.6 <b>Tracking Url</b>: url của offer lấy từ network. Riêng offer lấy từ network sử dụng platform hasoffer ( ksix,...) thì thêm đoạn code này "&aff_sub=" vào cuối link url.<br>
		4.2.7 <b>Image Url</b> <br>
		4.2.8 <b>Country</b><br>
		4.2.9 <b>Network</b><br>
		4.2.10 *: field có dấu * là field bắt buộc.
	</p>
	<h3>Cảm ơn bạn đã chọn và sử dụng W3GPT - Cần hổ trợ vui lòng liên hệ Y! w3offers (sau 21h)</h3>
	</div>
    </div>
</div>

</body>
</html>
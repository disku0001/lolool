
<body>
<div id="wrapper">
    <div id="header">
		<?php if(isset($_SESSION['adminName']) && isset($_SESSION['adminPass'])){ ?>
		<ul class="nav">
			<?php if(isset($_SESSION['adminName']) && isset($_SESSION['adminPass'])){ ?>
			<li><a class="logout icon" href="logout.php"><img src="../images/logout.png" alt="Exit"/></a><a class="logout" href="logout.php">Log Out</a></li>
			<?php } ?>
			<li>
				<a href="setting.php">Setting</a>
				<ul>
					<li><a href="ads.php">Advertising</a></li>
					<li><a href="template.php">Template</a></li>
					<li><a href="news.php">News</a></li>
				</ul>
			</li>
			<li>
				<a href="networks.php">Networks</a>
				<ul>
					<li><a href="walls.php">Offer Walls</a></li>
				</ul>				
			</li>
			<li>
				<a href="users.php">Users</a>
				<ul>
					<li><a href="checkUsers.php">Check Users</a></li>
					<li><a href="updateUsers.php">Update Users</a></li>
					<li><a href="chargeback.php">Chargeback </a></li>
				</ul>
			</li>
			<li>
				<a href="offers.php">Offers</a>
				<ul>
					<li><a href="addOffer.php">Add Offer</a></li>
					<li><a href="import.php">Import Offer</a></li>
				</ul>
			</li>
			<li>
				<a href="#">Reports</a>
				<ul>
					<li><a href="clicksReport.php">Clicks</a></li>
					<li><a href="leadsReport.php">Leads</a></li>
					<li><a href="offersReport.php">Offers</a></li>
					<li><a href="completedOffers.php">Completed Offers</a></li>
					<li><a href="networksReport.php">Networks</a></li>
					<li><a href="usersReport.php">Usernames</a></li>
					<li><a href="reqReport.php">Requesters</a></li>
					<li><a href="shoutReport.php">ShoutBox</a></li>
				</ul>
			</li>
			<li>
				<a href="requests.php">Requests</a>
				<ul>
					<li><a href="requesters.php">Requesters</a></li>
				</ul>				
			</li>
			<li><a href="index.php">Overview</a></li>
		</ul>
		<?php } ?>
        <div class="logo">
			<h2>Admin Control Panel</h2>
        </div>
		<div class="clear"></div>
	</div>
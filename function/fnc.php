<?php
	include('config.php'); // include database information
	$infoAdmin = mysql_query("SELECT * FROM admin") or die(mysql_error());
	$info = mysql_fetch_array($infoAdmin);
	define('Ratio',$info['ratio']);
	define('vcName',$info['vcName']);
	define('ProxStop',$info['proxstop']);
	define('ProxWall',$info['proxWall']);
	define('API',$info['proxstopAPI']);
	define('LockScore',$info['score']);
	define('Stop2ip',$info['stop2ip']);
	define('Hash',$info['hash']);
	define('LockOffers',$info['lockOffers']);
	define('LockWalls',$info['lockWalls']);
	define('PassOffers',$info['passOffers']);
	define('ShowStats',$info['showStats']);
	define('IPQCKey',$info['IPQCKey']);
	define('IPQC',$info['IPQC']);
	
	$infoTemplate = mysql_query("SELECT * FROM template") or die(mysql_error());
	$temp = mysql_fetch_array($infoTemplate);
	define('Template',$temp['template']);
	define('Title',$temp['title']);
	define('Des',$temp['des']);
	define('bgColor',$temp['bgColor']);
	define('logo',$temp['logo']);
	define('heading2',$temp['heading2']);
	define('heading3',$temp['heading3']);
	define('heading4',$temp['heading4']);
	define('paragraph',$temp['paragraph']);
	define('f1',$temp['f1']);
	define('f2',$temp['f2']);
	define('f3',$temp['f3']);
	define('f4',$temp['f4']);
	define('f5',$temp['f5']);
	define('f6',$temp['f6']);
	
	$queryAds = mysql_query("SELECT * FROM ads") or die(mysql_error());
	$ad = mysql_fetch_array($queryAds);
	define('topUrl',$ad['topUrl']);
	define('topImageUrl',$ad['topImageUrl']);
	define('bottomUrl',$ad['bottomUrl']);
	define('bottomImageUrl',$ad['bottomImageUrl']);
	
	define('HIDE','OFF');
	
	function callProxstop() {
		$apiUrl = 'http://api.proxstop.com/ip.xml';
		$apiKey = API; // Replace with your API key
		$ip = $_SERVER['REMOTE_ADDR']; // Fully qualified IP address
		$ref = 'ProxStop'; // A personal note / comment

		$result = file_get_contents($apiUrl.'?key='.$apiKey.'&ip='.$ip.'&ref='.$ref);
		$result = simplexml_load_string($result);

		if(isset($result->error_code))
		{
			echo 'The lookup failed with the error "'.$result->error_code.': '.$result->error_msg.'"';
		}
		else if(!isset($result->score))
		{
			echo 'The service seems to be temporarily unavailable.';
		}
		else if((string)$result->score>LockScore)
		{
			// Do what you need here
			header("Location: oops.php");
		}
		else
		{
			// Do what you need here
			//echo 'The IP is safe.';
			return 1;
		}
	}
	
	// Get Offers for Featured Offers Page
	function getOffer() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$cc = checkcc($ip);
		$queryoffers = mysql_query("SELECT offers.id as offerId, offers.name as offerName, offers.url, offers.payout, offers.ratio, offers.imageUrl, offers.des, offers.country, offers.network, networks.name as networkName, networks.status FROM offers, networks WHERE (offers.country='".$cc."' AND offers.network=networks.name AND networks.status = 'ON')") or die(mysql_error());
		if(mysql_num_rows($queryoffers) == 0)
		{
			echo '<h3>Sorry! There are no offers in your country at the moment, please check again later!</h3>';
		} 
		else 
		{
			while($offer = mysql_fetch_assoc($queryoffers)) {
				$rewards = $offer['payout']*$offer['ratio'];
				echo	'<div class="offers"><p class="img"><img src="' . $offer['imageUrl'] . '" width="100" height="100" /></p>';
				echo '<span class="right"><table border="0" width="100%">';
				echo '<tr><td class="points">' . $rewards .'</td></tr>';
				echo '<tr><td>' . vcName .'</td></tr>';
				echo '</table></span>';
				echo '<h4><a href="goOffer.php?id=' .$offer['offerId']. '&userId=' . $_SESSION['userName'] . '"target="_blank">' . $offer['offerName'] . '</a></h4>';
				echo '<p class="des">' . $offer['des'] .'</p></div><!-- offer ending -->';
			}
		}
	}
	// Get Offers Manager for Offers Admin cPanel
	function getOffersManager() {
		$queryoffers = mysql_query("SELECT * FROM offers") or die(mysql_error());
		while($offer = mysql_fetch_assoc($queryoffers)) {
			echo '<tr><td>' .$offer['id'] .'<span class="idcheckbox"><input name="id[]" type="checkbox" value="'.$offer['id'].'"/></span></td>';
			echo '<td>' . $offer['name'] .'</td><td>' . $offer['payout'] .'</td><td>' . $offer['ratio'] .'</td><td>' . $offer['payout']*$offer['ratio'] .'</td><td>'; 
				if($offer['country']=="GB" || $offer['country']=="UK") {
				echo 'United Kingdom';
				} else {
					$queryCC = mysql_query("SELECT name FROM countries WHERE cc='".$offer['country']."'") or die(mysql_error());
					$cc = mysql_fetch_array($queryCC);
					echo $cc['name'];
				}
			echo '</td><td>' . $offer['network'] .'</td><td>' . $offer['offerId'] .'</td>';
			echo '<td class="action">';
			echo '<a href="editOffer.php?id='.$offer['id'].'"><img src="../images/edit.png" alt="Delete"/></a>';
			echo '&nbsp;';
			echo '<a href="deleteOffer.php?id='.$offer['id'].'"><img src="../images/del.png" alt="Delete"/></a>';
			echo '</td></tr>';
		}
	}
	
	function getNetworks() {
		$querynetwork = mysql_query("SELECT * FROM networks") or die(mysql_error());
		while($nwk = mysql_fetch_assoc($querynetwork)) {
			echo '<tr><td>' .$nwk['name'] .'</td><td>' . $nwk['ip'] .'</td><td>' . $nwk['status'] .'</td>';
			echo '<td><a href="editNetwork.php?id='.$nwk['id'].'"><img src="../images/edit.png" alt="Edit"/></a></td></tr>';
		}
	}
	
	function deleteNetwork($id) {
		$id = (int) $id;
		$query = mysql_query("DELETE FROM networks WHERE id = '".$id."'") or die(mysql_error());
		header("Location: networks.php");
	}
	
	function getWalls() {
		$queryWalls = mysql_query("SELECT * FROM walls") or die(mysql_error());
		while($wall = mysql_fetch_assoc($queryWalls)) {
			echo '<tr><td>' .$wall['name'] .'</td><td>' . $wall['iframe'] .'</td><td>' . $wall['secretKey'] .'</td><td><input type="password" value="' . $wall['pass'] .'" /></td><td>' . $wall['status'] .'</td>';
			echo '<td><a href="editWall.php?id='.$wall['id'].'"><img src="../images/edit.png" alt="Delete"/></a></td></tr>';
		}
	}

	function getLeadsReport() {
		$query = mysql_query("SELECT * FROM leads") or die(mysql_error());
		while($lead = mysql_fetch_assoc($query)) {
			echo '<tr>';
			echo '<td>'. $lead['id'] . '</td>';
			echo '<td>'. $lead['date'] . '</td>';
			echo '<td>'. $lead['userName'] .'</td>';
			echo '<td>'. $lead['offerName'] .'</td>';
			echo '<td>'. $lead['points'] .'</td>';
			echo '<td>'. $lead['offerCC'] . '</td>';
			echo '<td>'. $lead['offerNwk'] .'</td>';
			echo '<td>'. $lead['ip'] .'</td>';
			echo '<td>'. $lead['port'] .'</td>';
			echo '<td>'. $lead['protocol'] .'</td>';
			echo '<td>'. $lead['hostName'] .'</td>';
			echo '<td>'. $lead['userAgent'] .'</td>';
			echo '</tr>';
		}
	}	
	
	// Get Offers Report for Report Section in Admin cPanel
	function getOffersReport() {
		$queryoffers = mysql_query("SELECT * FROM offers") or die(mysql_error());
		while($offer = mysql_fetch_assoc($queryoffers)) {
			echo '<tr><td>' .$offer['id'] .'</td><td>' . $offer['name'] .'</td><td>' . $offer['payout']*$offer['ratio'] .'</td><td>' . $offer['country'] .'</td><td>' . $offer['network'] .'</td>';
			echo '<td class="action">' . countClick($offer['id']) .'</td><td>' . countLead($offer['id']) .'</td></tr>';
		}
	}
	
	// Count Clicks for Leads Section in Admin Cpanel
	function countClick($id,$f,$t) {
		if($f==0 && $t==0) {
			$queryClicks = mysql_query("SELECT COUNT(id) as CountClicks FROM clicks WHERE offerIdOffer='".$id."'") or die(mysql_error());
		} else {
			$queryClicks = mysql_query("SELECT COUNT(id) as CountClicks FROM clicks WHERE (offerIdOffer='".$id."' AND date>='".$f."' AND date<='".$t."')") or die(mysql_error());
		}
		$result = mysql_fetch_array($queryClicks);
		return $result['CountClicks'];
	}
	// Count Leads for Leads Section in Admin Cpanel
	function countLead($id,$f,$t) {
		if($f==0 && $t==0) {
			$queryLeads = mysql_query("SELECT COUNT(id) as CountLeads FROM leads WHERE offerIdOffer='".$id."'") or die(mysql_error());
		} else {
			$queryLeads = mysql_query("SELECT COUNT(id) as CountLeads FROM leads WHERE (offerIdOffer='".$id."' AND DATE(date)>='".$f."' AND DATE(date)<='".$t."')") or die(mysql_error());
		}
		$result = mysql_fetch_array($queryLeads);
		return $result['CountLeads'];
	}
	
	// GET OFFER ID
	function getOfferId($id) {
		$queryOfferId = mysql_query("SELECT offerId FROM offers WHERE id='$id'") or die(mysql_error());
		$result = mysql_fetch_array($queryOfferId);
		$ID = $result['offerId'];
		return $ID;
	}
	// GET OFFER NETWORK
	function getOfferNwk($id) {
		$queryOfferNwk = mysql_query("SELECT offerNwk FROM offers WHERE id='$id'") or die(mysql_error());
		$result = mysql_fetch_array($queryOfferNwk);
		$ID = $result['offerNwk'];
		return $ID;
	}
	// GET OFFER CC
	function getOfferCC($id) {
		$queryOfferCC = mysql_query("SELECT offerCC FROM offers WHERE id='$id'") or die(mysql_error());
		$result = mysql_fetch_array($queryOfferCC);
		$ID = $result['offerCC'];
		return $ID;
	}

	function deleteOffer($id) {
		$id = (int) $id;
		$query = mysql_query("DELETE FROM offers WHERE id = '".$id."'") or die(mysql_error());
		header("Location: offers.php");
	}
	

	
	function getRewards() {
		$queryrewards = mysql_query("SELECT * FROM rewards") or die(mysql_error());
		if(mysql_num_rows($queryrewards) == 0 )
		{
			echo '<h3>Sorry! There are no rewards for you at the moment, please check again later!</h3>';
		} 
		else 
		{
			while($reward = mysql_fetch_assoc($queryrewards)) {
				echo	'<!-- Rewards starting --><div class="rewards"><table cellspacing="0" sellpadding="0">';
				echo '<tr><td class="type">' . $reward['type'] .'</td><td class="amounts">$ ' .$reward['amounts']. '</td></tr>';
				echo '</table></div>';
			}
		}
	}
	
	function getUsers() {
		$query = mysql_query("SELECT * FROM members") or die(mysql_error());
		while($user = mysql_fetch_assoc($query)) {
			echo '<tr>';
			echo '<td>'. $user['id'] .'</td>';
			echo '<td>'. $user['userName'] .'</td>';
			echo '<td>'. $user['email'] .'</td>';
			echo '<td>'. $user['userPassword'] .'</td>';
			echo '<td>'. $user['points'] .'</td>';
			echo '<td>' . $user['leadedOffers'] . '</td>';
			echo '<td>' . $user['ip'] . '</td>';
			echo '<td>' . $user['port'] . '</td>';
			echo '<td>' . $user['date'] . '</td>';
			echo '<td>' . $user['requester'] . '</td>';
			echo '<td>';
				if($user['points'] <= 0){
					echo '<span style="color: red; font-weight: bold;">Paid</span>';
				} else {
					echo '<span style="color: green;">unPaid</span>';
				}
			echo '</td>';
			echo '</tr>';
		}
	}
	
	

	function getClicksReport() {
		$query = mysql_query("SELECT * FROM clicks ORDER BY id DESC") or die(mysql_error());
		while($click = mysql_fetch_assoc($query)) {
			echo '<tr>';
			echo '<td>' . $click['id'] . '</td>';
			echo '<td>' . $click['date'] . '</td>';
			echo '<td>'. $click['userName'] .'</td>';
			echo '<td>'. $click['offerName'] .'</td>';
			echo '<td>'. $click['points'] .'</td>';
			echo '<td>'. $click['offerCC'] .'</td>';
			echo '<td>'. $click['offerNwk'] .'</td>';
			echo '<td>'. $click['ip'] .'</td>';
			echo '<td>'. $click['port'] .'</td>';
			echo '<td>'. $click['protocol'] .'</td>';
			echo '<td>'. $click['hostName'] .'</td>';
			echo '<td>'. $click['userAgent'] .'</td>';
			echo '</tr>';
		}
	}
	
	// Get Leads, Offers, Top User information for Member Area page
	function getLeadsStats() {
		$queryLeads = mysql_query("SELECT id, userName, offerName, offerNwk, points FROM leads ORDER BY id DESC LIMIT 0,7") or die(mysql_error());
		while($lead = mysql_fetch_array($queryLeads)) {
			echo '<tr><td>';
			if($lead['offerName']=="#") {
				echo $lead['offerNwk'].'</td><td>'.$lead['points'].'</td></tr>';
			} else {
				echo $lead['offerName'].'</td><td>'.$lead['points'].'</td></tr>';
			}
		}
	}
	
	function getOffersStats() {
		$queryOffers = mysql_query("SELECT name, payout, ratio FROM offers ORDER BY id DESC LIMIT 0,7") or die(mysql_error());
		while($offer = mysql_fetch_array($queryOffers)) {
			echo '<tr><td>'.$offer['name'].'</td><td>'.$offer['payout']*$offer['ratio'].'</td></tr>';
		}
	}
	
	function getTopUsers() {
		$queryUsers = mysql_query("SELECT userName, points FROM members ORDER BY points DESC LIMIT 0,7") or die(mysql_error());
		while($user = mysql_fetch_array($queryUsers)) {
			echo '<tr><td>'.$user['userName'].'</td><td>'.$user['points'].'</td></tr>';
		}
	}
	
	// Get Requesters and Requesting for Admin cPanel
	function getRequests() {
		$queryRequests = mysql_query("SELECT SUM(points), requester FROM members GROUP BY requester") or die(mysql_error());
		while($req = mysql_fetch_array($queryRequests)) {
			if ($req['requester'] == NULL) {
				echo '<tr style="font-weight: bold"><td style="color: red"># unRequested #</td><td>'.$req['SUM(points)'].'</td><td>#</td><td>#</td><td>#</td></tr>';
			} else {
				echo '<tr><td>'.$req['requester'].'</td><td>'.$req['SUM(points)'].'</td>';
				$checkRequester = mysql_query("SELECT yahoo, banks FROM requesters WHERE name='".$req['requester']."'") or die(mysql_error());
				while($info = mysql_fetch_array($checkRequester)) {
					echo '<td>'.$info['yahoo'].'</td><td>'.$info['banks'].'</td>';
					if($req['SUM(points)'] <= 0) {
						echo '<td style="color: red;">Paid</td>';
					} else {
						echo '<td style="color: green;">unPaid</td>';
					}
					echo '</tr>';
				}
			}
		}
	}
	
	function getRequesters() {
		$queryRequesters = mysql_query("SELECT * FROM requesters") or die(mysql_error());
		while($req = mysql_fetch_array($queryRequesters)) {
			echo '<tr><td>'.$req['id'].'</td><td>'.$req['name'].'</td><td>'.$req['yahoo'].'</td><td>'.$req['banks'].'</td></tr>';
		}
	}	
	
	// Process IP Area
	function checkcc2($ip) {
		//$ip = $_SERVER['REMOTE_ADDR'];
		// remember chmod 0777 for folder 'cache'
		$url = 'http://api.easyjquery.com/ips/?ip='.$ip;
		$country = file_get_contents($url);
		$cc = json_decode($country,true);
		return $cc['Country'];
		
	}
	
	function checkcc3($ip) {		
		$country = exec("whois $ip  | grep -i country"); 
		// Run a local whois and get the result back		
		//$country = strtolower($country); 
		// Make all text lower case so we can use str_replace happily		
		// Clean up the results as some whois results come back with odd results, this should cater for most issues		
		$country = str_replace("country:", "", "$country");		
		$country = str_replace("Country:", "", "$country");		
		$country = str_replace("Country :", "", "$country");		
		$country = str_replace("country :", "", "$country");		
		$country = str_replace("network:country-code:", "", "$country");		
		$country = str_replace("network:Country-Code:", "", "$country");		
		$country = str_replace("Network:Country-Code:", "", "$country");		
		$country = str_replace("network:organization-", "", "$country");		
		$country = str_replace("network:organization-usa", "us", "$country");		
		$country = str_replace("network:country-code;i:us", "us", "$country");		
		$country = str_replace("eu#countryisreallysomewhereinafricanregion", "af", "$country");		
		$country = str_replace("", "", "$country");		
		$country = str_replace("countryunderunadministration", "", "$country");		
		$country = str_replace(" ", "", "$country");		
		return $country;	
	}
	
	function checkcc($ip) {		
		$api = "d0b4afa65ae195132e9f814df806075496372ce3da7900a5d92d0a16255d2a9b";
		// http://api.ipinfodb.com/v3/ip-country/?key=<your_api_key>&ip=74.125.45.100&format=json
		$url = 'http://api.ipinfodb.com/v3/ip-country/?key='.$api.'&ip='.$ip.'&format=json';
		$country = file_get_contents($url);
		$cc = json_decode($country,true);
		return $cc['countryCode'];
	}
	
	function printcc() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$cc = checkcc($ip);
		echo $cc;
	}
	
	function checkIp() {
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$port = $_SERVER['REMOTE_PORT'];
		$protocol = $_SERVER['SERVER_PROTOCOL'];
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		echo 'IP: '.$ip_address .'<br />';
		echo 'Port: '.$port .'<br />';
		echo 'Protocol: '.$port .'<br />';
		echo 'Hostname: '.$hostname .'<br />';
		echo 'User agent: '.$useragent .'<br />';
	}
	
	function getcName($cc) {
		$cname = mysql_query("SELECT name FROM countries WHERE cc='".$cc."'") or die(mysql_error());
		$c = mysql_fetch_array($cname);
		return $c['name'];
	}
	
	function randString() {  
		$s= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		$l = 15;
		srand((double)microtime()*1000000);  
		for($i=0; $i<$l; $i++) {  
			$rand.= $s[rand()%strlen($s)];  
		}  
		return $rand;  
	}
	
	function get5Offers() {
		$queryOffers = mysql_query("SELECT * FROM offers ORDER BY id DESC LIMIT 5") or die(mysql_error());
		while($off = mysql_fetch_array($queryOffers)) {
			if(HIDE=='ON') {
				echo '<tr><td>Featured Offer</td>';
			} else {
				echo '<tr><td>'.$off['name'].'</td>';
			}
			echo '<td>'.$off['payout']*$off['ratio'].'</td>';
			echo	'<td>'.getcName($off['country']).'</td></tr>';
		}
	}
	
?>
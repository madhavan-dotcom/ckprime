<?php 
$url = "https://api.mastergst.com/einvoice/authenticate?email=xxxxxxxx%40gmail.com";

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		$headers = array(
		   "accept: */*",
		   "username: mastergst",
		   "password: Malli#123",
		   "ip_address: 192.168.0.104",
		   "client_id: e05ac7b6-ddcf-4294-80d4-453827fba2cf",
		   "client_secret: 1c1ade41-e062-499d-be41-1d89a1b29de2",
		   "gstin: 29AABCT1332L000",
		);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		//for debug only!
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		
		$resp = curl_exec($curl);
		curl_close($curl);
		var_dump($resp);


?>

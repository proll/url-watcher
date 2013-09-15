<?php
error_reporting(E_ALL);
include_once 'lib/jabber.php';
error_reporting(E_ALL);

//
	/**
	 */
	function getData()
	{
		$endpoint = 'https://www.dvlottery.state.gov/';
 
		// create the cURL request
		$ch = curl_init($endpoint);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
		// execute the cURL request and fetch response data
		$response = curl_exec($ch);
		$errno    = curl_errno($ch);
		$errmsg   = curl_error($ch);
		curl_close($ch);
 
		// ensure the request succeeded
		if ($errno != 0) {
			throw new Exception($errmsg, $errno);
		}
 
		// // ensure response data was a valid JSON string
		// if (!is_object($data)) {
		// 	throw new Exception('Invalid response data');
		// }

		// build the response array with the returned data
		return $response;
	}
 


	// verify the receipt
	try {
		$info = getReceiptData();
		echo $info;
 		
	}
	catch (Exception $ex) {
		echo '{"error":"'.$ex->getMessage().'"}';
		die();
	}
?>

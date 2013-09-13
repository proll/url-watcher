<?php
include_once 'lib/jabber.php';

//
	/**
	 */
	function getData()
	{
		$endpoint = 'https://www.dvlottery.state.gov/';
 		
		// echo "start"."<br>";
 
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

		// echo "curl"."<br>";
 
		// ensure the request succeeded
		if ($errno != 0) {
			throw new Exception($errmsg, $errno);
		}
 
		// parse the response data
		$data = $response;
		
		// // ensure response data was a valid JSON string
		// if (!is_object($data)) {
		// 	throw new Exception('Invalid response data');
		// }
 
		// if (isset($data->status) && $data->status == 21007) {
		// 	throw new Exception('Sandbox');
		// }

		// // ensure the expected data is present
		// if (!isset($data->status) || $data->status != 0) {
		// 	throw new Exception('Invalid receipt');
		// }

		// echo "prereturn"."<br>";
 
		// build the response array with the returned data
		return $data;

		// 	array(
		// 	'quantity'       =>  $data->receipt->quantity,
		// 	'product_id'     =>  $data->receipt->product_id,
		// 	'transaction_id' =>  $data->receipt->transaction_id,
		// 	'purchase_date'  =>  $data->receipt->purchase_date,
		// 	'app_item_id'    =>  $data->receipt->app_item_id,
		// 	'bid'            =>  $data->receipt->bid,
		// 	'bvrs'           =>  $data->receipt->bvrs
		// );
	}
 


	// verify the receipt
	try {
		// соединение с базой
		// $db = new DataBaseConnect();
		// $db->connect();

		$info = getReceiptData();

		echo $info;

		// $quantity 		= $info["quantity"];
		// $product_id 	= $info["product_id"];
		// $transaction_id = $info["transaction_id"];
		// $purchase_date 	= $info["purchase_date"];
		// $app_item_id 	= $info["app_item_id"];
		// $bid 			= $info["bid"];
		// $bvrs 			= $info["bvrs"];

		// // check purchase for unique
		// $res = $db->query("SELECT `id`
		// FROM `pusher_purchase` 
		// WHERE
		// 	`receipt` 			= '$receipt' AND
		// 	`product_id` 		= '$product_id 'AND
		// 	`transaction_id` 	= '$transaction_id' AND
		// 	`app_item_id` 		= '$app_item_id'");

		// if ($row = $db->fetch_row($res)) {
		// 	$purchase_id = $row[0];

		// 	$sql = 
		// 	"UPDATE `pusher_purchase` 
		// 	SET 
		// 		`quantity` 	= $quantity,
		// 		`bid` 		= '$bid',
		// 		`bvrs` 		= '$bvrs'
		// 	WHERE 
		// 		`id` = $purchase_id" ;

		// 	$db->query($sql) or die($sql);
		// 	echo '{"success":"already"}';

		// } else {
		// 	$sql = 
		// 	"INSERT INTO `pusher_purchase` 
		// 			(
		// 				`receipt`, `quantity`, `product_id`, `transaction_id`, 
		// 				`purchase_date`, `app_item_id` , `bid`, `bvrs`
		// 			) 
		// 	VALUES 
		// 			(
		// 				'$receipt', $quantity, '$product_id', '$transaction_id', 
		// 				'$purchase_date', '$app_item_id', '$bid', '$bvrs'
		// 			)" ;

		// 	$db->query($sql) or die($sql);

		// 	echo '{"success":"success"}';
		// 	die();
		// }
 		
	}
	catch (Exception $ex) {
		echo '{"error":"'.$ex->getMessage().'"}';
		die();
	}
?>

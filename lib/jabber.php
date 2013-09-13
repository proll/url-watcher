<?php
// error_reporting(E_ALL & E_STRICT);
include_once 'XMPPHP/XMPP.php';


class Jabber{
		function send($msg){
			$conn = new XMPPHP_XMPP('talk.google.com', 5222, 'almazcinema', 'ZbYSPQsftH636JF0BWJ1', 'xmpphp', 'gmail.com', $printlog=false, $loglevel=XMPPHP_Log::LEVEL_INFO);
			try {
				$conn->connect();
				$conn->processUntil('session_start');
				$conn->presence();
				$conn->message('gpolushkin@gmail.com', $msg);
				$conn->disconnect();
			} catch(XMPPHP_Exception $e) {
				die($e->getMessage());
			}
		}
}
?>
<?php


function runRateLimiter(){

    date_default_timezone_set('Australia/Brisbane');
	session_start();
	
	//rate limit 1000 calls per 24 hours
	$rateLimiter = new RateLimiter($_SERVER["REMOTE_ADDR"]);
	$limit = 1000;				    //connection per minutes
	$minutes = 1 * 1440;			//1 day
	$seconds = floor($minutes * 1);	//retry after 1 day
	try {
		$rateLimiter->limitRequestsInMinutes($limit, $minutes);
	} catch (RateExceededException $e) {
		header("HTTP/1.1 429 Too Many Requests");
		header(sprintf("Retry-After: %d", $seconds));
		$data = 'Rate Limit Exceeded ';
		die (json_encode($data));
	}

	//rate limit 1 call per second
	if (isset($_SESSION['LAST_CALL'])) {
		$last = strtotime($_SESSION['LAST_CALL']);
		$curr = strtotime(date("Y-m-d h:i:s"));
		$sec =  abs($last - $curr);
		if ($sec <= 1) {
		  $data = 'Rate Limit Exceeded';  // rate limit
		  header('Content-Type: application/json');
		  die (json_encode($data));        
		}
	}
	$_SESSION['LAST_CALL'] = date("Y-m-d h:i:s");


}
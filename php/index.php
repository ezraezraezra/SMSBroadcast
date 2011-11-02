<?php
/*
 * Project:     SMS Broadcast
 * Description: Broadcast an SMS reminder with link to mobile page with more info
 * Website:     http://ezraezraezra.com/smsbroadcast
 * 
 * Author:      Ezra Velazquez
 * Website:     http://ezraezraezra.com
 * Date:        November 2011
 * 
 */
header('Content-type: application/json; charset=utf-8');
require 'server.php';
$from_number = $_REQUEST['From'];
$from_body = $_REQUEST['Body'];

/*
 * 1)  Create app object
 * 2)  Connect to database & Twilio
 * 3a) If client SMS, check message
 * 3b) If admin, add message to MySQL
 * 3c) If mobile, load message data 
 * 4)  Close database connection
 */

// 1
$yolo_app = new Server($from_number);
// 2
$yolo_app->startApp();
// 3a
if ($_GET['type'] == 'admin') {
	$s_title = $_GET['s_title'];
	$s_cat = $_GET['s_cat'];
	$s_date = $_GET['s_date'];
	$s_time = $_GET['s_time'];
	$s_desc = $_GET['s_desc'];
	$s_loc = $_GET['s_loc'];
	$s_note = $_GET['s_note'];
	
	$result = $yolo_app->addEntry($s_title, $s_cat, $s_date, $s_time, $s_desc, $s_loc, $s_note);
	$output = json_encode($result);
	echo $output;
}
// 3c
else if($_GET['type'] == 'mobile') {
	$m_id = $_GET['id'];
	$result = $yolo_app->getEntry($m_id);
	
	$output = json_encode($result);
	echo $output;
}
// 3b
else {
	$yolo_app->userOpt($from_body);
}
// 4
$yolo_app->closeApp();
?>
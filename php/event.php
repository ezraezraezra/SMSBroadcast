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
    $event_id = $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Yolo Events</title>
		<link rel="stylesheet" href="../css/jquery.mobile-1.0rc2.min.css" />
		<link rel="stylesheet" href="../css/mobile.css" />
		<script src="../js/jquery-1.5.1.min.js"></script>
		<script src="../js/jquery.mobile-1.0rc2.min.js"></script>
		<script src="../js/mobile.js" type="text/javascript"></script>
		<script type="text/javascript">
			var number = <?php echo $event_id; ?>;
			mobile(number);
		</script>
		<!--
 ________  ________  ______                     _                _   
/  ___|  \/  /  ___| | ___ \                   | |              | |  
\ `--.| .  . \ `--.  | |_/ /_ __ ___   __ _  __| | ___  __ _ ___| |_ 
 `--. \ |\/| |`--. \ | ___ \ '__/ _ \ / _` |/ _` |/ __|/ _` / __| __|
/\__/ / |  | /\__/ / | |_/ / | | (_) | (_| | (_| | (__| (_| \__ \ |_ 
\____/\_|  |_|____/  \____/|_|  \___/ \__,_|\__,_|\___|\__,_|___/\__|
		-->
	</head>
	<body>
		<div data-role="page">
			<div data-role="header" id="header">
				<h1>Yolo Event</h1>
			</div>
			<div data-role="content" id="content">
				<p>Loading Content...</p>
			</div>
			<div data-role="footer" id="footer">
				<h4>Code by Ezra^3</h4>
			</div>
		</div>
	</body>
</html>
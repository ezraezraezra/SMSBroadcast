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
?>
<html>
	<head>
		<script type="text/javascript" src="../js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="../js/admin.js"></script>
		<link rel="stylesheet" href="../css/admin.css" type="text/css">
		<link rel="stylesheet" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" type="text/css">
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
		<div id="dialog" title="Yolo Events Notification">
				<p>SMS has been sent</p>
			</div>
		<div id="container">
			<div id="container_header">
				Yolo Basin Foundation SMS Event Page
			</div>
			<div id="container_center">
				<div id="container_center_left">
					<div class="center_header">Add an Event</div>
					<div class="entry_container">
						<div class="entry_left">
							<label for="add_title">Title:</label>
						</div>
						<div class="entry_right">
							<input type="text" id="add_title" class="inputs"/>
						</div>
					</div>
					<div class="entry_container">
						<div class="entry_left">
							<label for="add_category">Category:</label>
						</div>
						<div class="entry_right">
							<select name="add_category" id="add_category" class="inputs">
								<option value="Festivals">Festivals</option>
								<option value="Flyaway Nights">Flyaway Nights</option>
								<option value="Working Group Meetings">Working Group Meetings</option>
								<option value="Teacher Wprkshops">Teacher Workshops</option>
								<option value="Volunteer Training">Volunteer Training</option>
								<option value="Public Tours">Public Tours</option>
								<option value="Fundraisers">Fundraisers</option>
							</select>
						</div>
					</div>
					<div class="entry_container">
						<div class="entry_left">
							<label for="add_date">Date:</label>
						</div>
						<div class="entry_right">
							<input type="text" name="add_date" id="datepicker" class="inputs">
						</div>
					</div>
					<div class="entry_container">
						<div class="entry_left">
							<label for="add_time">Time:</label>
						</div>
						<div class="entry_right">
							<select name="add_times" id="time_hour" class="inputs">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select> : 
							<select name="add_times" id="time_minutes" class="inputs">
								<option value="00">00</option>
								<option value="15">15</option>
								<option value="30">30</option>
								<option value="45">45</option>
							</select>
							<select name="add_times" id="time_12" class="inputs">
								<option value="am">AM</option>
								<option value="pm">PM</option>
							</select>
						</div>
					</div>
					<div class="entry_container entry_container_more_space">
						<div class="entry_left center_vertical">
							<label for="add_description">Description:</label>
						</div>
						<div class="entry_right">
							<textarea name="add_description" id="add_description" rows="10"  cols="37" class="inputs"></textarea>
						</div>
					</div>
					<div class="entry_container entry_container_more_space">
						<div class="entry_left center_vertical">
							<label for="add_location">Meeting Location:</label>
						</div>
						<div class="entry_right">
							<textarea name="add_location" id="add_location" rows="10"  cols="37" class="inputs"></textarea>
						</div>
					</div>
					<div class="entry_container entry_container_more_space">
						<div class="entry_left center_vertical">
							<label for="add_note">Notes:</label>
						</div>
						<div class="entry_right">
							<textarea name="add_note" id="add_note" rows="10"  cols="37" class="inputs"></textarea>
						</div>
					</div>
					<div class="button_holder">
						<button type="button" id="admin_submit" class="inputs">Submit</button>
					</div>
				</div>
				<div id="container_center_right">
					
				</div>
			</div>
			<div id="container_footer">
			</div>
		</div>
	</body>
</html>
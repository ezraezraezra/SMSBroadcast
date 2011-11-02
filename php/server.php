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
require 'info.php';
require "../lib/Services/Twilio.php";

class Server {
	// GLOBAL VARS GO HERE
	var $connection;
	var $db_selected;
	var $client;
	
	var $client_number;
	var $outgoing_message;
	
	var $server_number = "415-599-2671";
	
	var $info_object;
	
	function Server($user_number) {
		// INITIALIZE HERE
		$this->info_object = new info();
		$this->client_number = $user_number;
	}
	
	function startApp() {
		$this->connection = mysql_connect($this->info_object->hostname, $this->info_object->user, $this->info_object->pwd);
		if(!$this->connection) {
			die("Error ".mysql_errno()." : ".mysql_error());
		}
		
		$this->db_selected = mysql_select_db($this->info_object->database, $this->connection);
		if(!$this->db_selected) {
			die("Error ".mysql_errno()." : ".mysql_error());
		}
		
		$this->client = new Services_Twilio($this->info_object->AccountSid, $this->info_object->AuthToken);
	}
	
	function closeApp() {
		mysql_close($this->connection);
	}
	
	function userOpt($client_message) {
		switch($client_message) {
			case "opt-in":
				$this->outgoing_message = "You've been added to Yolo Events. Type 'opt-out' to stop messages";
				$this->modifyClients("add");
				break;
			case "opt-out":
				$this->outgoing_message = "You've been removed from Yolo Events. Type 'opt-in' to receive messages again";
				$this->modifyClients("remove");
				break;
			default:
				$this->outgoing_message = "That is not an option. Please type 'opt-in' to join Yolo Events";
				break;
		}
		
		// Confirm message with client
		$sms = $this->client->account->sms_messages->create($this->server_number, $this->client_number, $this->outgoing_message);
	}
	
	function informClients($url, $title) {
		$request = "SELECT * FROM event_app_clients WHERE accept_messages='1'";
		$request = $this->submit_info($request, $this->connection, true);
		
		while(($rows[] = mysql_fetch_assoc($request)) || array_pop($rows));
		$counter = 0;
		foreach ($rows as $row):
			$client[$counter] =  "{$row['phone_number']}";
			$counter = $counter + 1;
		endforeach;
		
		//TWILIO MESSAGE HERE
		foreach($client as $key => $value) {
			$sms = $this->client->account->sms_messages->create($this->server_number, $value, "YOLO: ".$title." More at ".$url);
		}
	}
	
	function modifyClients($action) {
		echo "<br/>$action is: ".$action;
		switch($action) {
			case "add":
				echo "modify Clients :: add";
				$request = "INSERT INTO event_app_clients (phone_number, accept_messages) VALUES('$this->client_number', 1 )";
				break;
			case "remove":
				$request = "UPDATE event_app_clients SET accept_messages=0 WHERE phone_number ='$this->client_number'";
				break;
			default:
				// Do nothing, this is an internal command
				break;
		}	
		$request = $this->submit_info($request, $this->connection, true);
	}
	
	function addEntry($title, $category, $date, $time, $description, $location, $note) {
		// Add entry to mySQL table for deliver at specified time
		
		$insert = "INSERT INTO event_app_messages (title, category, date, time, description, location, note) VALUES('$title','$category','$date','$time','$description','$location','$note')";
		$insert = $this->submit_info($insert, $this->connection, true);
		$entry_id = mysql_insert_id();
		
		$arr = array('status'=>'200');
		
		$this->shortenURL($entry_id);
		return $arr;
	}
	
	function getEntry($id) {
		$request = "SELECT * FROM event_app_messages WHERE id='$id'";
		$request = $this->submit_info($request, $this->connection, true);
		while(($rows[] = mysql_fetch_assoc($request)) || array_pop($rows));
		foreach ($rows as $row):
			$title =  "{$row['title']}";
			$category =  "{$row['category']}";
			$date =  "{$row['date']}";
			$time =  "{$row['time']}";
			$description =  "{$row['description']}";
			$location =  "{$row['location']}";
			$note =  "{$row['note']}";
		endforeach;
		
		$arr = array('status'=>'200', 'title'=>$title, 'category'=>$category, 'date'=>$date, 'time'=>$time, 'description'=>$description, 'location'=>$location, 'note'=>$note);
		
		return $arr;
		
	}
	
	function shortenURL($entry_id) {
		$ch = curl_init();
		$apiURL = "https://www.googleapis.com/urlshortener/v1/url?key=AIzaSyDmk1VbHsX2oyj2lehE09EBwXhkwiil03s";
		$url = "http://ezraezraezra.com/mt/midterm/php/event.php?id=".$entry_id;
		
		$parameters = '{"longUrl": "' . $url . '"}';
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch,CURLOPT_URL,$apiURL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$result = curl_exec($ch);
		curl_close($ch);
		$result_decode = json_decode($result, true);
		
		$this->addShortURL($result_decode['id'], $entry_id);
	}
	
	function addShortURL($url,$entry_id) {
		$update = "UPDATE event_app_messages SET url='$url' WHERE id='$entry_id'";
		$update = $this->submit_info($update, $this->connection, false);
		
		/*
		 * TODO: Admin should decide when to send event
		 *       Currently doing automatically
		 */
		$request = "SELECT * FROM event_app_messages WHERE id='$entry_id'";
		$request = $this->submit_info($request, $this->connection, true);
		while(($rows[] = mysql_fetch_assoc($request)) || array_pop($rows));
		foreach ($rows as $row):
			$title =  "{$row['title']}";
		endforeach;
		$this->informClients($url, $title);
	}
	
	function submit_info($data, $conn, $return) {
		$result = mysql_query($data,$conn);
		if(!$result) {
			die("Error ".mysql_errno()." : ".mysql_error());
		}
		else if($return == true) {
			return $result;
		}
	}
}

?>
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
var mobile = function(entry_id) {
	$(document).ready(function() {
	$.get("index.php", {
		type : 'mobile',
		id   : entry_id
		},
		function(data) {
			$("#content").html("<h3>"+data.title+"</h3><span class='mobile_titles'>Category:</span> "+data.category+""+
							   "<p><span class='mobile_titles'>Date:</span> "+data.date+
							   "<br/><span class='mobile_titles'>Time:</span> "+data.time+"</p>"+
							   "<p><span class='mobile_titles'>Location:</span> "+data.location+"</p>"+
							   "<p><span class='mobile_titles'>Description:</span> "+data.description+"</p>"+
							   "<p><span class='mobile_titles'>Notes:</span> "+data.note+"</p>");
	});
	});
};

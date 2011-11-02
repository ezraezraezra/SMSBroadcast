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
var ADMIN = function() {
	
	$(document).ready(function() {
		$( "#dialog" ).dialog({ autoOpen: false, close: function(event, ui) {
			$("#add_title").val("");
			$("#datepicker").val("");
			$("#add_description").val("");
			$("#add_location").val("");
			$("#add_note").val("");
		} });
		$("#admin_submit").click(function() {
			
			var s_title = $("#add_title").val();
			var s_category = $("#add_category").val();
			var s_date = $("#datepicker").val();
			var s_time = $("#time_hour").val() + ":" + $("#time_minutes").val() + " "+$("#time_12").val();
			var s_desc = $("#add_description").val();
			var s_loc = $("#add_location").val();
			var s_note = $("#add_note").val();
			
			$.get("index.php",
					{type : "admin",
					 s_title : s_title,
					 s_cat : s_category,
					 s_date : s_date,
					 s_time : s_time,
					 s_desc : s_desc,
					 s_loc : s_loc,
					 s_note : s_note},
					function(data) {
			});
			// Once its sent to the server, we can assume it was successfully sent
			$("#dialog").dialog('open');
			
			
			
		});
		// Datepicker plugin from jQueryUI
		$(function() {
			$("#datepicker").datepicker();
		});
	});
	
}();

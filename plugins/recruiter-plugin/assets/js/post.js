"use strict";

jQuery(function($) {
	var tblPost = $('#tblPost').DataTable({
		"ajax": {
			"url": ajax_var.url,
			"type": 'POST',
			"dataType": 'json',
			"data": {
				"action": 'action_load_all_post',
				"nonce": ajax_var.nonce
			},
			"dataSrc": ""
		},
		"paging": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"columns": [
			{data: 'title'},
			{data: 'place_text'},
			{data: 'posted_date'},
			{data: 'status_name'},
			{
				data: 'id',
				render: function(data){
					return ('<button type="button" class="btn btn-link" onclick="editPost('+ data +')">' + lang.label_edit + '</button><button type="button" class="btn btn-link" onclick="deletePost('+ data +')">' + lang.label_delete + '</button>');
				}
			}
		]
	});
	
	$('#bntPostNow').on('click', function() {
		window.location.href = admin_url.url + "?page=" + post_var.url;
	});
});

function editPost(id) {
	window.location.href = admin_url.url + "?page=" + post_var.url +"&id=" + id;
}

function deletePost(id) {
	
}
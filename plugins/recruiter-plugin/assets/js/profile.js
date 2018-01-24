"use strict";

jQuery(function($) {
	$('#driving_license').autocomplete({
		source: function(request, response) {
			$.ajax({
				url: ajax_var.url,
				dataType: 'json',
				method: 'POST',
				data: {
					name: request.term,
					nonce: ajax_var.nonce,
					action: 'autocomplete_driving_licesine'
				},
				success: function(data) {
					response(data);
				}
			});
		},
		minLength: 1,
		select: function(event, ui) {
			return true;
		}
	});

	$('#driving_license').on('keydown', function(event, ui) {
		if (13 == event.which) {
			var txt = $('#driving_license').val();
			var id = Date.now();

			if ('' !== $.trim(txt)) {

				var html = '<span class="badge" id="list-driving-license-item-'+ id + '">';
				html += txt;
				html += '&nbsp;&nbsp;<a href="javascript:void(0);" onclick="removeTag(\'list-driving-license-item-'+ id + '\')">';
				html += '&nbsp;&nbsp;<i class="fa fa-remove"></i>';
				html += '</a></span>';
				html += '<input type="hidden" name="driving_license[]" value="'+ txt +'" />';
				
				$('#list-driving-license').append(html);
				$('#driving_license').val('');
			}
		}
	});
	
	$('#btnAddDrivingLicense').on('click', function() {
		var txt = $('#driving_license').val();
		var id = Date.now();

		if ('' !== $.trim(txt)) {

			var html = '<span class="badge" id="list-driving-license-item-'+ id + '">';
			html += txt;
			html += '&nbsp;&nbsp;<a href="javascript:void(0);" onclick="removeTag(\'list-driving-license-item-'+ id + '\')">';
			html += '&nbsp;&nbsp;<i class="fa fa-remove"></i>';
			html += '</a></span>';
			html += '<input type="hidden" name="driving_license[]" value="'+ txt +'" />';
			
			$('#list-driving-license').append(html);
			$('#driving_license').val('');
		}
	});

	$('#occupation').autocomplete({
		source: function(request, response) {
			$.ajax({
				url: ajax_var.url,
				dataType: 'json',
				method: 'POST',
				data: {
					name: request.term,
					nonce: ajax_var.nonce,
					action: 'autocomplete_occupation'
				},
				success: function(data) {
					response(data);
				}
			});
		},
		minLength: 1,
		select: function(event, ui) {
			return true;
		}
	});
	
	$('#occupation').on('keydown', function(event, ui) {
		if (13 == event.which) {
			var txt = $('#occupation').val();
			var id = Date.now();

			if ('' !== $.trim(txt)) {

				var html = '<span class="badge" id="list-occupation-item-'+ id + '">';
				html += txt;
				html += '<a href="javascript:void(0);" onclick="removeTag(\'list-occupation-item-'+ id + '\')">';
				html += '&nbsp;&nbsp;<i class="fa fa-remove"></i>';
				html += '</a></span>';
				html += '<input type="hidden" name="occupations[]" value="'+ txt +'" />';
				
				$('#list-user-occupation').append(html);
				$('#occupation').val('');
			}
		}
	});

	$('#btnAddOccupation').on('click', function() {
		var txt = $('#occupation').val();
		var id = Date.now();

		if ('' !== $.trim(txt)) {

			var html = '<span class="badge" id="list-occupation-item-'+ id + '">';
			html += txt;
			html += '<a href="javascript:void(0);" onclick="removeTag(\'list-occupation-item-'+ id + '\')">';
			html += '&nbsp;&nbsp;<i class="fa fa-remove"></i>';
			html += '</a></span>';
			html += '<input type="hidden" name="occupations[]" value="'+ txt +'" />';
			
			$('#list-user-occupation').append(html);
			$('#occupation').val('');
		}
	});

	$('#level').autocomplete({
		source: function(request, response) {
			$.ajax({
				url: ajax_var.url,
				dataType: 'json',
				method: 'POST',
				data: {
					name: request.term,
					nonce: ajax_var.nonce,
					action: 'autocomplete_level'
				},
				success: function(data) {
					response(data);
				}
			});
		},
		minLength: 1,
		select: function(event, ui) {
			return true;
		}
	});
	
	$('#level').on('keydown', function(event, ui) {
		if (13 == event.which) {
			var txt = $('#level').val();
			var id = Date.now();

			if ('' !== $.trim(txt)) {

				var html = '<span class="badge" id="list-level-item-'+ id + '">';
				html += txt;
				html += '<a href="javascript:void(0);" onclick="removeTag(\'list-level-item-'+ id + '\')">';
				html += '&nbsp;&nbsp;<i class="fa fa-remove"></i>';
				html += '</a></span>';
				html += '<input type="hidden" name="levels[]" value="'+ txt +'" />';
				
				$('#list-user-level').append(html);
				$('#level').val('');
			}
		}
	});

	$('#btnAddLevel').on('click', function() {
		var txt = $('#level').val();
		var id = Date.now();

		if ('' !== $.trim(txt)) {

			var html = '<span class="badge" id="list-level-item-'+ id + '">';
			html += txt;
			html += '<a href="javascript:void(0);" onclick="removeTag(\'list-level-item-'+ id + '\')">';
			html += '&nbsp;&nbsp;<i class="fa fa-remove"></i>';
			html += '</a></span>';
			html += '<input type="hidden" name="levels[]" value="'+ txt +'" />';
			
			$('#list-user-level').append(html);
			$('#level').val('');
		}
	});
	
	$('#btnChooseFile').on('click', function() {
		$(this).next().trigger('click');
	});
	
} );

function removeTag(childId) {
	jQuery('#' + childId).remove();
}
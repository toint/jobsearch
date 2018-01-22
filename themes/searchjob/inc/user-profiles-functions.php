<?php

add_action( 'show_user_profile', 'add_civil_profiles' );
add_action( 'edit_user_profile', 'add_civil_profiles' );

function add_civil_profiles() {
?>
<h2><?php echo __('Civil Status');?></h2>
<table class="form-table">
	<tr>
		<th><label for="driving_license"><?php echo __('Driving License');?></label></th>
		<td>
			<input type="text" class="regular-text" name="driving_license" id="driving_license" />
			<span class="description"><button class="button" type="button" id="btnAddDrivingLicense"><?php echo __('Add');?></button></span>
		</td>
	</tr>
	<tr>
		<th></th>
		<td>
			<ul id="list-driving-license"></ul>
		</td>
	</tr>
</table>

<h2><?php echo __('Occupations you are looking for');?></h2>
<table class="form-table">
	<tr>
		<th><label for="occupation"><?php echo __('Occupation');?></label></th>
		<td>
			<input type="text" class="regular-text" name="occupation" id="occupation" />
			<span class="description"><button class="button" type="button" id="btnAddOccupation"><?php echo __('Add');?></button></span>
		</td>
	</tr>
	<tr>
		<th></th>
		<td>
			<ul id="list-user-occupation"></ul>
		</td>
	</tr>
	
	<tr>
		<th><label for="level"><?php echo __('Level');?></label></th>
		<td>
			<input type="text" class="regular-text" name="level" id="level" />
			<span class="description"><button class="button" type="button" id="btnAddLevel"><?php echo __('Add');?></button></span>
		</td>
	</tr>
	<tr>
		<th></th>
		<td>
			<ul id="list-user-level"></ul>
		</td>
	</tr>
</table>
<?php 
}

add_action( 'personal_options_update', 'save_user_profiles' );
add_action( 'edit_user_profile_update', 'save_user_profiles' );

function save_user_profiles( $user_id ) {
    
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
        
        update_usermeta( $user_id, 'pic', $_POST['pic'] );
        update_usermeta( $user_id, 'Facebook', $_POST['Facebook'] );
        update_usermeta( $user_id, 'Twitter', $_POST['Twitter'] );
}

function user_profiles_js() {
    
?>
<script type="text/javascript">
	jQuery(function($) {

		$('#driving_license').autocomplete({
			source: function(request, response) {
				$.ajax({
					url: ajax_var.url,
					dataType: 'json',
					method: 'GET',
					data: {
						name: request.term,
						nonce: ajax_var.nonce,
						action: 'action_search_driving_license'
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

		$('#btnAddDrivingLicense').on('click', function() {
			var txt = $('#driving_license').val();
			var id = Date.now();

			if ('' !== $.trim(txt)) {

				var html = '<li class="list-group-item" id="list-driving-license-item-'+ id +'">';
				html += '<span class="badge"><a href="javascript:void(0);" onclick="remove_list_group(\'list-driving-license-item-'+ id + '\')">';
				html += lang.label_delete;
				html += '</a></span>';
				html += txt;
				html += '<input type="hidden" name="driving_license[]" value="'+ txt +'" /></li>';
				
				$('#list-driving-license').append(html);
				$('#driving_license').val('');
			}
		});

		$('#occupation').autocomplete({
			source: function(request, response) {
				$.ajax({
					url: ajax_var.url,
					dataType: 'json',
					method: 'GET',
					data: {
						name: request.term,
						nonce: ajax_var.nonce,
						action: 'action_search_occupation'
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

		$('#btnAddOccupation').on('click', function() {
			var txt = $('#occupation').val();
			var id = Date.now();

			if ('' !== $.trim(txt)) {

				var html = '<li class="list-group-item" id="list-occupation-item-'+ id +'">';
				html += '<span class="badge"><a href="javascript:void(0);" onclick="remove_list_group(\'list-occupation-item-'+ id + '\')">';
				html += lang.label_delete;
				html += '</a></span>';
				html += txt;
				html += '<input type="hidden" name="occupations[]" value="'+ txt +'" /></li>';
				
				$('#list-user-occupation').append(html);
				$('#occupation').val('');
			}
		});

		$('#level').autocomplete({
			source: function(request, response) {
				$.ajax({
					url: ajax_var.url,
					dataType: 'json',
					method: 'GET',
					data: {
						name: request.term,
						nonce: ajax_var.nonce,
						action: 'action_search_level'
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

		$('#btnAddLevel').on('click', function() {
			var txt = $('#level').val();
			var id = Date.now();

			if ('' !== $.trim(txt)) {

				var html = '<li class="list-group-item" id="list-occupation-item-'+ id +'">';
				html += '<span class="badge"><a href="javascript:void(0);" onclick="remove_list_group(\'list-level-item-'+ id + '\')">';
				html += lang.label_delete;
				html += '</a></span>';
				html += txt;
				html += '<input type="hidden" name="levels[]" value="'+ txt +'" /></li>';
				
				$('#list-user-level').append(html);
				$('#level').val('');
			}
		});
		
	} );
</script>
<?php 
}
add_action('admin_head','user_profiles_js');

?>















<?php

add_action( 'show_user_profile', 'add_civil_profiles' );
add_action( 'edit_user_profile', 'add_civil_profiles' );

function add_civil_profiles() {
    $user = wp_get_current_user();
    
    $driving_license = get_user_meta($user->ID, 'DRIVING_LICENSE');
    $occupations = get_user_meta($user->ID, 'OCCUPATION');
    $levels = get_user_meta($user->ID, 'LEVEL');
    
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
			<div id="list-driving-license">
				<?php 
				if (!empty($driving_license)) { 
				    $licenses = json_decode($driving_license[0]);
				    for ($i = 0; $i < count($licenses); $i++) {
				    ?>
				<span class="badge" id="list-driving-license-item-<?php echo $i;?>"><?php echo $licenses[$i];?>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="removeTag('list-driving-license-item-<?php echo $i;?>')">&nbsp;&nbsp;<i class="fa fa-remove"></i></a></span><input type="hidden" name="driving_license[]" value="<?php echo $licenses[$i];?>">
				<?php 
				} }
				?>
			</div>
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
			<div id="list-user-occupation">
			<?php 
				if (!empty($occupations)) { 
				    $occps = json_decode($occupations[0]);
				    for ($i = 0; $i < count($occps); $i++) {
				    ?>
				<span class="badge" id="list-occupation-item-<?php echo $i;?>"><?php echo $occps[$i];?>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="removeTag('list-occupation-item-<?php echo $i;?>')">&nbsp;&nbsp;<i class="fa fa-remove"></i></a></span><input type="hidden" name="occupations[]" value="<?php echo $occps[$i];?>">
				<?php 
				} }
				?>
			</div>
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
			<div id="list-user-level">
			<?php 
				if (!empty($levels)) { 
				    $levelj = json_decode($levels[0]);
				    for ($i = 0; $i < count($levelj); $i++) {
				    ?>
				<span class="badge" id="list-level-item-<?php echo $i;?>"><?php echo $levelj[$i];?>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="removeTag('list-level-item-<?php echo $i;?>')">&nbsp;&nbsp;<i class="fa fa-remove"></i></a></span><input type="hidden" name="levels[]" value="<?php echo $levelj[$i];?>">
				<?php 
				} }
				?>
			</div>
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
     
    $drivings = array();
    $occupations = array();
    $levels = array();
    
    delete_user_meta($user_id, 'DRIVING_LICENSE');
    delete_user_meta($user_id, 'OCCUPATION');
    delete_user_meta($user_id, 'LEVEL');
    
    if (isset($_POST['driving_license'])) {
        $drivings = $_POST['driving_license'];
        if (!empty($drivings)) {
            update_usermeta( $user_id, 'DRIVING_LICENSE', json_encode($drivings) );
        }
        
    }
    
    if (isset($_POST['occupations'])) {
        $occupations = $_POST['occupations'];
        if (!empty($occupations)) {
            update_usermeta( $user_id, 'OCCUPATION', json_encode($occupations) );
        }
    }
    
    if (isset($_POST['levels'])) {
        $levels = $_POST['levels'];
        if (!empty($levels)) {
            update_usermeta( $user_id, 'LEVEL', json_encode($levels) );
        }
    }
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
		
	} );

	function removeTag(childId) {
		jQuery('#' + childId).remove();
	}
</script>
<?php 
}
add_action('admin_head','user_profiles_js');

?>















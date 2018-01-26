<?php
function civil_page() {
    $user = wp_get_current_user();
    $user_id = $user->ID;
    
    $driving_licenses = '';
    $occupations = '';
    $levels = '';
    $avatar_url = '';
    
    if (!is_user_logged_in()) {
        return;
    }
    
    if (isset($_POST['driving_licenses'])) {
        $driving_licenses = $_POST['driving_licenses'];
    }
    if (isset($_POST['occupations'])) {
        $occupations = $_POST['occupations'];
    }
    if (isset($_POST['levels'])) {
        $levels = $_POST['levels'];
    }
    if (isset($_POST['avatar_url'])) {
        $avatar_url = $_POST['avatar_url'];
    }
    if (isset($_POST['driving_licenses']) && isset($_POST['occupations']) && isset($_POST['levels']) && isset($_POST['avatar_url'])) {
        
        delete_user_meta($user_id, 'DRIVING_LICENSE');
        delete_user_meta($user_id, 'OCCUPATION');
        delete_user_meta($user_id, 'LEVEL');
        
        if (!empty($driving_licenses)) {
            update_user_meta( $user->ID, 'DRIVING_LICENSE', json_encode($driving_licenses) );
        }
        if (!empty($occupations)) {
            update_user_meta( $user->ID, 'OCCUPATION', json_encode($occupations) );
        }
        if (!empty($levels)) {
            update_user_meta( $user->ID, 'LEVEL', json_encode($levels) );
        }
        if (!empty($avatar_url)) {
            update_user_meta( $user->ID, 'avatar_url', $avatar_url );
        }
    }
    
    $driving_licenses = get_user_meta($user_id, 'DRIVING_LICENSE');
    $occupations = get_user_meta($user_id, 'OCCUPATION');
    $levels = get_user_meta($user_id, 'LEVEL');
    $avatar_url = get_user_meta($user_id, 'avatar_url');
    
    
    
?>
<br/>
<div class="container page-container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo __('Curriculum Vitae');?>
		</div>
		<div class="panel-body">
			<form method="POST" id="frmCivil">
				<div class="row">
					<div class="col-md-9">
						<div class="form-group">
        					<label for="driving_license"><?php echo __('Driving License');?></label>
    						<div class="row">
        						<div class="col-md-9">
            						<input type="text" id="driving_license" name="driving_license" class="form-control" placeholder="<?php echo __('Search ...');?>" />
        						</div>
        						<div class="col-md-3">
        							<button class="btn btn-default" id="btnAddDrivingLicense" type="button"><?php echo __('Add');?></button>  
        						</div>
    						</div>
        					<p id="list-driving-license" class="list-badge">
        					<?php 
        					if (!empty($driving_licenses)) {
        					    $arr_driving = json_decode($driving_licenses[0]);
        					    for($i = 0; $i < count($arr_driving); $i++) {
        					?>
        					<span class="badge" id="list-driving-license-item-<?php echo $i;?>">
        						<?php echo $arr_driving[$i];?>
        						&nbsp;&nbsp;<a href="javascript:void(0);" onclick="removeTag('list-driving-license-item-<?php echo $i;?>')">&nbsp;&nbsp;<i class="fa fa-remove"></i></a>
        						<input type="hidden" name="driving_licenses[]" value="<?php echo $arr_driving[$i];?>" />
        					</span>
        					
        					<?php 
        					} }
        					?>
        					</p>
        				</div>
        				<div class="form-group">
        					<label for="occupation"><?php echo __('Occupation');?></label>
    						<div class="row">
    							<div class="col-md-9">
    								<input type="text" id="occupation" name="occupation" class="form-control" placeholder="<?php echo __('Search ...');?>"/>
    							</div>
    							<div class="col-md-3">
    								<button class="btn btn-default" id="btnAddOccupation" type="button"><?php echo __('Add');?></button>
    							</div>
    						</div>
    						<p id="list-user-occupation" class="list-badge">
    						<?php 
        					if (!empty($occupations)) {
        					    $arr_occupation = json_decode($occupations[0]);
        					    for($i = 0; $i < count($arr_occupation); $i++) {
        					?>
        					<span class="badge" id="list-occupation-item-<?php echo $i;?>">
        						<?php echo $arr_occupation[$i];?>
        						&nbsp;&nbsp;<a href="javascript:void(0);" onclick="removeTag('list-occupation-item-<?php echo $i;?>')">&nbsp;&nbsp;<i class="fa fa-remove"></i></a>
        						<input type="hidden" name="occupations[]" value="<?php echo $arr_occupation[$i];?>" />
        					</span>
        					
        					<?php 
        					} }
        					?>
    						</p>
        				</div>
        				<div class="form-group">
        					<label for="level"><?php echo __('Level');?></label>
        					<div class="row">
        						<div class="col-md-9">
        							<input type="text" id="level" name="level" class="form-control" placeholder="<?php echo __('Search ...');?>"/>
        						</div>
        						<div class="col-md-3">
        							<button class="btn btn-default" id="btnAddLevel" type="button"><?php echo __('Add');?></button>
        						</div>
        					</div>
    						<p id="list-user-level" class="list-badge">
    						<?php 
        					if (!empty($levels)) {
        					    $arr_level = json_decode($levels[0]);
        					    for($i = 0; $i < count($arr_level); $i++) {
        					?>
        					<span class="badge" id="list-level-item-<?php echo $i;?>">
        						<?php echo $arr_level[$i];?>
        						&nbsp;&nbsp;<a href="javascript:void(0);" onclick="removeTag('list-level-item-<?php echo $i;?>')">&nbsp;&nbsp;<i class="fa fa-remove"></i></a>
        						<input type="hidden" name="levels[]" value="<?php echo $arr_level[$i];?>" />
        					</span>
        					
        					<?php 
        					} }
        					?>
    						</p>
        				</div>
					</div>
					<div class="col-md-3">
					<?php 
					if (!empty($avatar_url)) {
					?>
						<a href="javascript:void(0);" id="btnChooseFile"><img src="<?php echo $avatar_url[0];?>" class="img-thumbnail col-sm-8" id="img-avatar" /></a>
					<?php 
					} else {
					?>
						<a href="javascript:void(0);" id="btnChooseFile"><img src="<?php echo plugin_dir_url(__FILE__) . '/images/pic.png';?>" class="img-thumbnail col-sm-8" id="img-avatar" /></a>
					<?php 
					}
					?>
					<input type="file" name="avatar" id="avatar" class="hidden" accept=".png, .jpg, .jpeg, .gif"/>
					<input type="hidden" name="avatar_url" id="avatar_url" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<button type="button" class="btn btn-default" id="btnSaveCivil"><?php echo __('Save');?></button>
					</div>
				</div>
				
			</form>
		</div>
	</div>
	
	<!-- Work History -->
	<?php 
	require_once( CANDIDATE__PLUGIN_DIR . 'section-work-history-page.php' );
	require_once( CANDIDATE__PLUGIN_DIR . 'section-education-history-page.php' );
	?>
	
	
	
	
</div>
<?php 
}
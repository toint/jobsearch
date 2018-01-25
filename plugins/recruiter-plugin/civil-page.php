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
    
    /**
     * Update Employer History
     */
    $position = '';
    $company = '';
    $work_from_month = '';
    $work_to_month = '';
    $current_job = '';
    $work_description = '';
    
    if (isset($_POST['position'])) {
        $position = $_POST['position'];
    }
    if (isset($_POST['company'])) {
        $company = $_POST['company'];
    }
    if (isset($_POST['workFromMonth'])) {
        $work_from_month = $_POST['workFromMonth'];
    }
    if (isset($_POST['workToMonth'])) {
        $work_to_month = $_POST['workToMonth'];
    }
    if (isset($_POST['currentJob'])) {
        $current_job = $_POST['currentJob'];
    }
    if (isset($_POST['workDescription'])) {
        $work_description = $_POST['workDescription'];
    }
    if (isset($_POST['position']) && isset($_POST['company']) 
        && isset($_POST['workFromMonth']) && isset($_POST['workToMonth']) 
        && isset($_POST['currentJob']) && isset($_POST['workDescription'])) {
        $work_history = array(
            'position' => $position,
            'company' => $company,
            'work_from_month' => $work_from_month,
            'work_to_month' => $work_to_month,
            'current' => $current_job,
            'description' => $work_description
        );
        $id = microtime(true);
        
        $work_data = array(0 => array('id' => $id, 'data' => $work_history));
        update_user_meta( $user->ID, 'WORK_HISTORY', json_encode($work_data) );
    }
    
    $list_work_history = get_user_meta($user_id, 'WORK_HISTORY');
    
?>
<br/>
<div class="container">
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
        					<p id="list-driving-license">
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
    						<p id="list-user-occupation">
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
    						<p id="list-user-level">
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
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo __('Employment History');?>
		</div>
		<div class="panel-body">
			<?php 
			if (!empty($list_work_history) && NULL != $list_work_history) {
			    $work_his_data = json_decode($list_work_history[0]);
			    if (!empty($work_his_data)) {
    			    foreach ($work_his_data as $work_datas) {
    			        $work_id = $work_datas->id;
    			        $work_data = $work_datas->data;
			?>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<h3><?php echo $work_data['position'];?></h3>
				</div>
			</div>
			<?php 
			         }
			    }
			}
			?>
			
			<form id="frmExperience" method="POST">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
    						<label for="position"><font color="red">*</font><?php echo __('Position');?></label>
    						<input type="text" class="form-control" name="position" required="required" maxlength="50" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
    						<label for="company"><font color="red">*</font><?php echo __('Company');?></label>
    						<input type="text" class="form-control" name="company" required="required" maxlength="50" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5 col-sm-5">
						<div class="form-group">
    						<label for="workFromMonth"><?php echo __('From Month');?></label>
    						<input type="text" class="form-control" name="workFromMonth" id="workFromMonth" />
						</div>
					</div>
					<div class="col-md-5 col-sm-5">
						<div class="form-group">
    						<label for="workToMonth"><?php echo __('To Month');?></label>
    						<input type="text" class="form-control" name="workToMonth" id="workToMonth" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
					<br/>
						<div class="checkbox">
                            <label>
                              <input type="checkbox" name="currentJob"> <?php echo __('Current Job');?>
                            </label>
                      </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
    						<label for="workDescription"><?php echo __('Description');?></label>
    						<textarea rows="6" class="form-control" name="workDescription"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<button type="button" class="btn btn-default" id="btnSaveWorkHistory"><?php echo __('Save');?></button>  
					</div>
					<div class="col-md-6 col-sm-6">
						 <?php echo __('(<font color="red">*</font>) is required field');?>  
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo __('Education History');?>
		</div>
		<div class="panel-body">
			<form id="frmEducation">
				<div class="row">
					<div class="col-md-12 col-sm-12">
        				<div class="form-group">
        					<label for="subjectEducation"><font color="red">*</font><?php echo __('Subject');?></label>
        						<input type="text" name="subject" class="form-control" value="" />
        				</div>
    				</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
        				<div class="form-group">
        					<label for="school"><font color="red">*</font><?php echo __('School');?></label>
        						<input type="text" name="school" class="form-control" value="" />
        				</div>
    				</div>
    				<div class="col-md-6 col-sm-6">
        				<div class="form-group">
        					<label for="quanlification"><font color="red">*</font><?php echo __('Quanlification');?></label>
    						<input type="text" name="quanlification" class="form-control" value="" />
        				</div>
    				</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
    						<label for="fromMonth"><?php echo __('From Month');?></label>
    						<input type="text" id="fromMoth" name="fromMonth" class="form-control" />
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
    						<label for="toMonth"><?php echo __('From Month');?></label>
    						<input type="text" id="toMonth" name="fromMonth" class="form-control" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label for="achievements"><?php echo __('Achievements');?></label>
							<textarea rows="3" id="achievements" name="achievements" class="form-control"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<button type="button" class="btn btn-default" id="btnSaveEducationHistory"><?php echo __('Save');?></button>  
					</div>
					<div class="col-md-6 col-sm-6">
						 <?php echo __('(<font color="red">*</font>) is required field');?>  
					</div>
				</div>
			</form>
		</div>
	</div>
	
	
</div>
<?php 
}
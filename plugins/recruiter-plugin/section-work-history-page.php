<?php 
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
    && isset($_POST['workDescription'])) {
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
				<h3><?php echo $work_data->position;?></h3>
			</div>
		</div>
		<?php 
		         }
		    }
		}
		?>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo __('Employment History');?>
	</div>
	<div class="panel-body">

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
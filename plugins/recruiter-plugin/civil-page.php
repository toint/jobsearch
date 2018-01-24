<?php
function civil_page() {
    $driving_license = '';
    $occupation = '';
    $level = '';
?>
<br/>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo __('Curriculum Vitae');?>
		</div>
		<div class="panel-body">
			<form method="POST">
				<div class="row">
					<div class="col-md-9">
						<div class="form-group">
        					<label for="driving_license"><?php echo __('Driving License');?></label>
    						<div class="row">
        						<div class="col-md-9">
            						<input type="text" id="driving_license" name="driving_license" class="form-control" value="<?php echo $driving_license;?>" placeholder="<?php echo __('Search ...');?>" />
        						</div>
        						<div class="col-md-3">
        							<button class="btn btn-default" id="btnAddDrivingLicense" type="button"><?php echo __('Add');?></button>  
        						</div>
    						</div>
        					<p id="list-driving-license"></p>
        				</div>
        				<div class="form-group">
        					<label for="occupation"><?php echo __('Occupation');?></label>
    						<div class="row">
    							<div class="col-md-9">
    								<input type="text" id="occupation" name="occupation" class="form-control" value="<?php echo $occupation;?>" placeholder="<?php echo __('Search ...');?>"/>
    							</div>
    							<div class="col-md-3">
    								<button class="btn btn-default" id="btnAddOccupation" type="button"><?php echo __('Add');?></button>
    							</div>
    						</div>
    						<p id="list-user-occupation"></p>
        				</div>
        				<div class="form-group">
        					<label for="level"><?php echo __('Level');?></label>
        					<div class="row">
        						<div class="col-md-9">
        							<input type="text" id="level" name="level" class="form-control" value="<?php echo $level;?>" placeholder="<?php echo __('Search ...');?>"/>
        						</div>
        						<div class="col-md-3">
        							<button class="btn btn-default" id="btnAddLevel" type="button"><?php echo __('Add');?></button>
        						</div>
        					</div>
    						<p id="list-user-level"></p>
        				</div>
					</div>
					<div class="col-md-3">
						<a href="javascript:void(0);" id="btnChooseFile"><img src="<?php echo plugin_dir_url(__FILE__) . '/images/no-img.png';?>" class="img-thumbnail col-sm-8" /></a>
						<input type="file" name="avatar" id="avatar" class="hidden" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<button type="button" class="btn btn-default"><?php echo __('Save');?></button>
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
			<form id="frmExperience">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
    						<label for="position"><font color="red">*</font><?php echo __('Position');?></label>
    						<input type="text" class="form-control" name="position" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
    						<label for="position"><font color="red">*</font><?php echo __('Company');?></label>
    						<input type="text" class="form-control" name="company" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5 col-sm-5">
						<div class="form-group">
    						<label for="position"><?php echo __('From Month');?></label>
    						<input type="text" class="form-control" name="workFromMonth" id="workFromMonth" />
						</div>
					</div>
					<div class="col-md-5 col-sm-5">
						<div class="form-group">
    						<label for="position"><?php echo __('To Month');?></label>
    						<input type="text" class="form-control" name="workToMonth" id="workToMonth" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
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
    						<textarea rows="6" type="text" class="form-control" name="workDescription"></textarea>
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
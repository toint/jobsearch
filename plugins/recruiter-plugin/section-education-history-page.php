<?php

?>

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
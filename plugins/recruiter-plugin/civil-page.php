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
			<form class="form-horizontal" method="POST">
				<div class="form-group">
					<label for="driving_license" class="col-sm-2 control-label"><?php echo __('Driving License');?></label>
					<div class="col-sm-6">
						<input type="text" id="driving_license" name="driving_license" class="form-control" value="<?php echo $driving_license;?>" />
						<p class="list-driving-license"></p>
					</div>
				</div>
				<div class="form-group">
					<label for="driving_license" class="col-sm-2 control-label"><?php echo __('Occupation');?></label>
					<div class="col-sm-6">
						<input type="text" id="occupation" name="occupation" class="form-control" value="<?php echo $occupation;?>" />
						<p class="list-user-occupation"></p>
					</div>
				</div>
				<div class="form-group">
					<label for="driving_license" class="col-sm-2 control-label"><?php echo __('Level');?></label>
					<div class="col-sm-6">
						<input type="text" id="level" name="level" class="form-control" value="<?php echo $level;?>" />
						<p class="list-user-level"></p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" id="btnSave"><?php echo __('Post Now'); ?></button>
                    </div>
				</div>
			</form>
		</div>
		<div class="panel-footer"></div>
	</div>
</div>
<?php 
}
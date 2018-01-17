<?php
function new_post_page() {
    $offer_id  = '';
    $post_id = '';
    $txt_place_code = '';
    $txt_place_name = '';
    $txt_job_title = '';
    $txt_post_content = '';
    $txt_salary = '';
    
?>
<br/>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo __('Post New Now');?>
		</div>
		<div class="panel-body">
			<form id="frm" method="post" class="form-horizontal">
				<input type="hidden" name="id" value="<?php echo $offer_id; ?>" /> 
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" /> 
				<div class="form-group">
                    <label for="place" class="col-sm-2 control-label"><?php echo __('Job Place'); ?></label>
                    <div class="col-sm-6">
                        <input type="text" name="placeName" id="placeName" class="form-control" readonly="readonly" value="<?php echo $txt_place_name;?>"/>
                        <input type="hidden" name="placeCode" id="placeCode" value="<?php echo $txt_place_code; ?>" />
                    </div>
                    <div class="col-sm-4">
                    <button type="button" class="btn btn-default full-width" id="btnPlace"><?php echo __('Choose on map'); ?></button>
                    </div>
                </div>
                <div class="form-group">
                	<label for="jobTitle" class="col-sm-2 control-label"><?php echo __('Job Title');?></label>
                	<div class="col-sm-10">
                		<input type="text" value="<?php echo $txt_job_title;?>" name="jobTitle" class="form-control" maxlength="250" placeholder="<?php echo __('Enter Title');?>" />
                	</div>
                </div>
                <div class="form-group">
                    <label for="salary" class="col-sm-2 control-label"><?php echo __('Salary'); ?></label>
                    <div class="col-sm-10">
                        <input value="<?php echo $txt_salary;?>" type="text" name="salary" id="salary" class="form-control" placeholder="<?php echo __('Enter Salary');?>" />
                    </div>
                </div>
                <div class="form-group">
                	<label for="postContent" class="col-sm-2 control-label"><?php echo __('Post Content');?></label>
                    <div class="col-sm-10">
                    	<textarea rows="3" cols="1" class="form-control" name="postContent" id="postContent" placeholder="<?php echo __('Enter Post Content'); ?>"><?php echo $txt_post_content;?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" id="btnSave"><?php echo __('Post Now'); ?></button>
                    </div>
                </div>
			</form>
		</div>
		<div class="panel-footer"></div>
	</div>
</div>

<div id="vector-map-modal" title="Map">
    <div id="map-viet-nam" style="width: 320px; height: 360px;"></div>
</div>
<?php 
}
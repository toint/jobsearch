<?php
function new_post_page() {
    $offer_id  = '';
    $post_id = '';
    $txt_place_code = '';
    $txt_place_name = '';
    $txt_job_title = '';
    $txt_post_content = '';
    $txt_salary = '';
    $user = wp_get_current_user();
    $msg_err = '';
    if (isset($_GET['id'])) {
        $offer_id = $_GET['id'];
        $post = new Post();
        $posts = $post->search(array('id' => $offer_id));
        if (!empty($posts)) {
            $offer = $posts[0];
            $post_id = $offer->post_id;
            $txt_job_title = $offer->title;
            $txt_place_code = $offer->place_code;
            $txt_place_name = $offer->place_text;
            $txt_post_content = $offer->post_content;
            $txt_salary = $offer->salary;
        }
    }
    
    if (isset($_POST['placeName']) && isset($_POST['placeCode']) 
    		&& isset($_POST['jobTitle']) && isset($_POST['salary']) 
    		&& isset($_POST['postContent'])) {
    			$txt_place_name = $_POST['placeName'];
    			$txt_place_code = $_POST['placeCode'];
    			$txt_job_title = $_POST['jobTitle'];
    			$txt_salary = $_POST['salary'];
    			$txt_post_content = $_POST['postContent'];
    			$offer_id = $_POST['id'];
    			$post_id = $_POST['post_id'];
    			
    			if (!empty($txt_job_title) && !empty($txt_place_code) && !empty($txt_place_name) && !empty($txt_salary) && !empty($txt_post_content)) {
    				$offer_data = array('place_code' => $txt_place_code, 
    						'place_text' => $txt_place_name, 
    						'salary' => $txt_salary,
    						'version' => '1.0',
    						'user_id' => $user->ID,
    				        'posted_date' => date('Y-m-d h:m:s'),
    						'updated_date' => date('Y-m-d h:m:s'),
    				        'status' => 1,
    						'type' => 1,
    				        'post_id' => 0
    				);
    				
    				$post_data = array('post_title' => wp_strip_all_tags($txt_job_title),
    						'post_content' => $txt_post_content,
    						'post_status' => 'publish',
    						'post_author'=> $user->ID,
    						'post_category' => array(1, 1)
    				);
    				$post = new Post();
    				
    				if ($offer_id != '' && $offer_id > 0 && $post_id != '' && $post_id > 0) {
    				    $offer_data['post_id'] = $post_id;
    				    $post_data['ID'] = $post_id;
    				    $post->update($offer_data, $post_data, $offer_id);
    				} else {
        				$offer_id = $post->insert($offer_data, $post_data);
        				$post_id = $offer_data['post_id'];
    				}
    				
    				if ($offer_id != FALSE) {
    				    $msg_err = __('Update Successfully.');
    				} else {
    				    $msg_err = __('Update Failed.');
    				}
    				
    			} else {
    			    $msg_err = __('All fields is required.');
    			}
    }
    
?>
<br/>
<?php 
if ($msg_err != '') {
?>
<div class="container">
    <div class="alert alert-danger" role="alert">
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      		<span aria-hidden="true">&times;</span>
    	</button>
    	<?php echo $msg_err;?>
    </div>
</div>
<?php 
}
?>
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
                    	<textarea rows="3" cols="1" class="form-control" maxlength="250" name="postContent" id="postContent" placeholder="<?php echo __('Enter Post Content'); ?>"><?php echo $txt_post_content;?></textarea>
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

<div id="vector-map-modal" title="Map">
    <div id="map-viet-nam" style="width: 320px; height: 360px;"></div>
</div>
<?php 
}
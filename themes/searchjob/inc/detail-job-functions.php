<?php
function the_detail_post($args) {
    global $wpdb;
    $sql = "SELECT a.id as offer_id, b.name com_name, a.place_text, b.description as com_des, a.salary, a.type, a.posted_date from " . $wpdb->prefix . "new_offer a ";
    $sql .= " LEFT JOIN " .$wpdb->prefix . "company b on a.user_id = b.user_id ";
    $sql .= " WHERE a.post_id = " . get_the_ID();
    
    $query = $wpdb->get_results($sql);
    $offer = null;
    
    if (!empty($query)) { 
    	$offer = $query[0]; 
    	$sql = "SELECT a.name, a.code FROM " . $wpdb->prefix . "offer_meta a ";
    	$sql .= " JOIN " . $wpdb->prefix . "new_offer_meta b on a.id = b.meta_id and b.offer_id = " . $offer->offer_id;
    	$offer_metas = $wpdb->get_results($sql);
?>
<div class="page-view-background"></div>
<div class="page-detail">
    <div class="page-detail-title">
    	<div class="page-title-container container">
            <div class="row">
            	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            		<div class="thumbnail col-md-12">
            			<img src="<?php echo get_template_directory_uri() . '/assets/images/no-img.png' ?>" />
            		</div>
            	</div>
            	<div class="view-title col-lg-8 col-md-8 col-sm-8 col-xs-8">
            		<h3><?php the_title(); ?></h3>
            		<h5><?php echo $offer->com_name;?> - <?php echo $offer->place_text;?></h5>
            		<h5 class="orange"><b><?php echo __('From'); ?>: <?php echo $offer->salary;?></b></h5>
            	</div>
            	<div class="view-btn col-lg-2 col-md-2 col-sm-2 col-xs-2">
            		<button type="button" class="btn btn-warning btn-lg"><?php echo __('Apply Now');?></button>
            	</div>
            </div>
        </div> 
    </div>
    <br/>
    <div class="page-detail-content">
    	<div class="container">
        	 <ul class="nav nav-tabs" role="tablist">
        	 	<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo __('JOB INFO');?></a></li>
        	 	<?php if ($offer->type == '0') {?>
        	 	<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php echo __('COMPANY INFO');?></a></li>
        	 	<?php }?>
        	 </ul>
    	</div>
    	 <div class="content-container container">
    	 	<div class="tab-content">
        	 	<div role="tabpanel" class="tab-pane active" id="home">
        	 		<div class="row">
        	 			<div class="col-md-8">
                	 		<div class="title"><?php echo __('JOB DESCRIPTION');?></div>
                	 		
                	 		<?php 
                	 		$job_activity = '';
                	 		$job_skill = '';
                	 		$job_level = '';
                	 		$job_language = '';
                	 		if (!empty($offer_metas)) {
                	 		    foreach ($offer_metas as $meta) {
                	 		        if ($meta->code == 'JOB_ACTIVITY') {
                	 		            $job_activity .= '<li>' . $meta->name . '</li>';
                	 		        }
                	 		        elseif ($meta->code == 'IT_SKILL') {
                	 		            $job_skill .= '<span>' . $meta->name . '</span><br/>';
                	 		        }
                	 		        elseif ($meta->code == 'LEVEL') {
                	 		            $job_level .= '<span>' . $meta->name . '</span><br/>';
                	 		        }
                	 		        elseif ($meta->code == 'LANGUAGE') {
                	 		            $job_language .= '<span>' . $meta->name . '</span><br/>';
                	 		        }
                	 		    }
                	 		}?>
                	 		
                	 		<?php 
                	 		if ($job_activity != '') {
            	 		        echo '<ul class="list-activity">'. $job_activity . '</ul>';
                	 		}
            	 		    ?>
                	 		
                	 		<div class="row">
                	 			<div class="col-md-12">
                	 				<?php the_content();?>
                	 			</div>
                	 		</div>
        	 			</div>
        	 			<div class="col-md-4">
        	 				<div class="the-post-time">
            	 				<div class="row the-post-line">
            	 					<div class="col-sm-2">
            	 						<i class="fa fa-calendar"></i>
            	 					</div>
            	 					<div class="col-sm-10">
            	 						<span><?php echo __('POSTED DATE')?></span>
            	 						<br/>
            	 						<span><b><?php echo $offer->posted_date;?></b></span>
            	 					</div>
            	 				</div>
            	 				<div class="row the-post-line">
            	 					<div class="col-sm-2">
            	 						<i class="fa fa-files-o"></i>
            	 					</div>
            	 					<div class="col-sm-10">
            	 						<span><?php echo __('JOB LEVEL')?></span>
            	 						<br/>
            	 						<span><b><?php echo $job_level;?></b></span>
            	 					</div>
            	 				</div>
            	 				<div class="row the-post-line">
            	 					<div class="col-sm-2">
            	 						<i class="fa fa-book"></i>
            	 					</div>
            	 					<div class="col-sm-10">
            	 						<span><?php echo __('JOB CATEGORY')?></span>
            	 						<br/>
            	 						<span><b></b></span>
            	 					</div>
            	 				</div>
            	 				<div class="row the-post-line">
            	 					<div class="col-sm-2">
            	 						<i class="fa fa-flag"></i>
            	 					</div>
            	 					<div class="col-sm-10">
            	 						<span><?php echo __('SKILL')?></span>
            	 						<br/>
            	 						<span><b><?php echo $job_skill;?></b></span>
            	 					</div>
            	 				</div>
            	 				<div class="row the-post-line">
            	 					<div class="col-sm-2">
            	 						<i class="fa fa-language"></i>
            	 					</div>
            	 					<div class="col-sm-10">
            	 						<span><?php echo __('PREFERRED LANGUAGE')?></span>
            	 						<br/>
            	 						<span><b><?php echo $job_language;?></b></span>
            	 					</div>
            	 				</div>
        	 				</div>
        	 			</div>
        	 		</div>
        	 	</div>
        	 	<?php if ($offer->type == '0') {?>
        	 	<div role="tabpanel" class="tab-pane" id="profile">
        	 		<div class="detail-profile">
        	 			<?php echo $offer->com_des;?>
        	 		</div>
        	 	</div>
        	 	<?php } ?>
        	 	<br/>
        	 </div>
		</div>
    </div>
</div>
<?php     
} }

add_filter('the_detail_post', 'the_detail_post');
<?php
function all_post_page() {
    global $wpdb;
?>
<br/>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-default" type="button"><?php echo __('Post Now');?></button>
		</div>
	</div>
	<br/>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
            	<div class="panel-heading">
            		<?php echo __('All Post');?>
            	</div>
            	<div class="panel-body">
            		<table id="tblPost" class="display" width="100%">
            			<thead>
            				<tr>
            					<td><?php echo __('Title')?></td>
            					<td><?php echo __('Job Place')?></td>
            					<td><?php echo __('Job Type')?></td>
            					<td><?php echo __('Post date')?></td>
            					<td><?php echo __('Action');?></td>
            				</tr>
            			</thead>
            			<tfoot>
            				<tr>
            					<td><?php echo __('Title')?></td>
            					<td><?php echo __('Job Place')?></td>
            					<td><?php echo __('Job Type')?></td>
            					<td><?php echo __('Post date')?></td>
            					<td><?php echo __('Action');?></td>
            				</tr>
            			</tfoot>
            		</table>
            	</div>
            	<div class="panel-footer">
            	
            	</div>
            </div>
		</div>
	</div>
</div>
<?php 
}
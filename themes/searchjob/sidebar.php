<div class="main-sidebar">
    <nav class="navbar navbar-default">
    	<div class="container-fluid">
    		<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-menubar" aria-expanded="false">
					<span class="sr-only">Toogle navigation</span>
					<span class="icon-bar"></button>
					<span class="icon-bar"></button>
					<span class="icon-bar"></button>
				</button>
				<?php the_custom_logo(); ?>
			</div>
			<div class="collapse navbar-collapse" id="bs-menubar">
	    		<ul class="nav navbar-nav navbar-right">
	    			<?php if (!is_user_logged_in()) {?>
	    			<li><a href="#myModalLogin" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> <?php echo __('Login');?></a></li>
	    			<li><a href="#myModalRegister" data-toggle="modal"><?php echo __('Register');?></a></li>
	    			<?php } else {?>
	    			<li><a href="#" data-toggle="modal"><span class="glyphicon glyphicon-log-out"></span> <?php echo __('Logout');?></a></li>
	    			<?php }?>
	    		</ul>
    		</div>
    	</div>
    </nav>
</div>
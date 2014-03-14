<link rel="stylesheet" href="<?php WWW_ROOT ?>/assets/css/font-awesome.min.css" />
<div id="conmain" style="height:360px;">
	<div class="well well-small">
		<h2>Welcome to <?php echo CMPNY ?></h2>
	</div>
	<?php if( $this->Session->read( 'Auth.User.is_admin' ) ) { ?>
	<div class="row-fluid">
		<div class="span6">
			<h3 class="header smaller lighter green">
				<i class="icon-bullhorn"></i>
				Alerts
			</h3>
			<?php if( $videos == 0 ) {  ?>
				<div class="alert alert-block alert-error">
					<p>
						<strong>
							<i class="icon-remove"></i>
							Oh snap!
						</strong>
							No Videos Uploaded yet!!!
						<br>
					</p>
					<p>
						<a class="btn btn-danger btn-small" type="button" href="<?php echo $this->Xyz->u( 'videos', 'upload' ); ?>" >Upload Now</a>
					</p>
				</div>
			<?php } else { ?>
				<div class="alert alert-block alert-error">
					<p>
						<strong>
							<i class="icon-remove"></i>
							Heads up!
						</strong>
							you have <?php echo $videos; ?>!!!
						<br>
					</p>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php } else { ?>
		
	<?php } ?>
</div>

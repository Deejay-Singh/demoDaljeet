<div class="well well-small">
	<h2>View Video</h2>
</div>
<div class="row-fluid">
	<div class="span4">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h4 class="smaller">
					<i class="icon-quote-left smaller-80"></i>
					Description for <?php echo ucwords( $video['Video']['name'] )?>
				</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row-fluid">
						<blockquote>
							<p><?php echo ucfirst( $video['Video']['description'] ) ?></p>

							<small>
								Video by
								<cite title="Source Title"><?php echo CMPNY ?></cite>
							</small>
						</blockquote>
					</div>

					<hr>
					<address>
						<strong><?php echo CMPNY?></strong>

						<br>
						Uploded On
						<br>
						<?php echo $this->Xyz->beautifulDate( $video['Video']['created'] ); ?>
						<br>
					</address>

					<address>
						<strong>Contact Admin</strong>

						<br>
						<a href="mailto:#"><?php echo ADMIN_EMAIL ?></a>
					</address>
				</div>
			</div>
		</div>
	</div>

	<div class="span8">
		<div class="row-fluid">
			<div class="widget-box">
				<div class="widget-header widget-header-flat">
					<h4 class="smaller">Video</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<video width="320" height="240" controls>
						  <source src="http://demo.daljeet.com/vids/Sample.mp4" type="video/mp4">
						Your browser does not support the video tag.
						</video>
					</div>
				</div>
			</div>
		</div>

		<div class="space-6"></div>
	</div>
</div>
    <script>
		videojs.options.flash.swf = "/js/video_js/video-js.swf";
	</script>

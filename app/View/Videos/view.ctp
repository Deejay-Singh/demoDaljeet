<?php $ext = explode( '.', $video['Video']['file_name'] )[1]; ?>
<div class="well well-small">
	<h2>View Video</h2>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="widget-box">
				<div class="widget-header widget-header-flat">
					<h4 class="smaller">Video</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<?php if ( $ext == 'html' ) { ?>
							<Iframe src="/app/webroot/vids/<?php echo $video['Video']['folder_name'] . '/' . $video['Video']['file_name'] ?>" width="1000" height="630"></Iframe>
						<?php } else { ?>
							<video width="685" height="500" controls preload="none">
								<source src="/app/webroot/vids/<?php echo $video['Video']['folder_name'] . '/' . $video['Video']['file_name'] ?>" type="video/mp4">
								<source src="/app/webroot/vids/<?php echo $video['Video']['folder_name'] . '/' . $video['Video']['file_name'] ?>" type="video/ogv">
								<source src="/app/webroot/vids/<?php echo $video['Video']['folder_name'] . '/' . $video['Video']['file_name'] ?>" type="video/webm">
								Your browser does not support the video tag.
							</video>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span12">
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
</div>


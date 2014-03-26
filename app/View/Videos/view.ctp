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
						<object width="700" height="700" title="bn" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-44953540000">
							<param value="/vids/<?php echo $video['Video']['file_name'] ?>" name="movie">
							<param value="high" name="quality">
							<param value="transparent" name="wmode">
							<embed width="700" height="700" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" quality="high" src="/vids/<?php echo $video['Video']['file_name'] ?>">
						</object>  
					</div>
				</div>
			</div>
		</div>

		<div class="space-6"></div>
	</div>
</div>


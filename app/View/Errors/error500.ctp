<?php $this->layout = null;?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>500 Error Page - <?php echo CMPNY ?></title>

		<meta name="description" content="500 Error Page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="<?php WWW_ROOT ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php WWW_ROOT ?>/assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php WWW_ROOT ?>/assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="<?php WWW_ROOT ?>/assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php WWW_ROOT ?>/assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="<?php WWW_ROOT ?>/assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<div class="error-container">
								<div class="well">
									<h1 class="grey lighter smaller">
										<span class="blue bigger-125">
											<i class="icon-random"></i>
											500
										</span>
										Something Went Wrong
									</h1>

									<hr />
									<h3 class="lighter smaller">
										But we are working
										<i class="icon-wrench icon-animated-wrench bigger-125"></i>
										on it!
									</h3>

									<div class="space"></div>

									<div>
										<h4 class="lighter smaller">Meanwhile, try one of the following:</h4>

										<ul class="unstyled spaced inline bigger-110">
											<li>
												<i class="icon-hand-right blue"></i>
												Read the faq
											</li>

											<li>
												<i class="icon-hand-right blue"></i>
												Give us more info on how this specific error occurred!
											</li>
										</ul>
									</div>

									<hr />
									<div class="space"></div>

									<div class="row-fluid">
										<div class="center">
											<a onClick=" window.history.back();" class="btn btn-grey">
												<i class="icon-arrow-left"></i>
												Go Back
											</a>

											<a href="<?php echo $this->Html->url(array('controller' => 'dashboard', 'action' => 'index'), true); ?>" class="btn btn-primary">
												<i class="icon-dashboard"></i>
												Dashboard
											</a>
										</div>
									</div>
								</div>
							</div>

							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
	</body>
</html>

<?php
if (Configure::read('debug') > 0 ):
	echo $this->element('exception_stack_trace');
endif;
?>

<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo ucwords($this->request->params['controller']) . ' : ' . ucwords($this->request->params['action']) ; ?> | <?php echo CMPNY ?>
    </title>
    <?php
        echo $this->Html->meta(array("name"=>"viewport","content"=>"width=device-width,  initial-scale=1.0"));
        echo $this->Html->meta('icon');
        echo $this->Html->css( array('assets/ace.min', 'assets/ace-responsive.min', 'assets/prettify', 'bootstrap', 'bootstrap-responsive', 'comb', 'style', 'style-responsive' ) );
        if( $this->Session->read( 'SKIN' ) == '1' ) echo $this->Html->css( array('assets/ace.min', 'assets/ace-responsive.min', 'assets/prettify', 'video-js/video-js') );
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->Html->script( array( 'jquery.min', 'modernizr.min', 'bootstrap.min', 'jquery.validate', 'jquery.validate.min', 'jquery-ui.min', 'common','ace-elements.min', 'ace.min', 'video-js/video', 'flash' ) );
		echo $this->fetch('script');
    ?>
	<script>
		videojs.options.flash.swf = "/video-js.swf";
	</script>
</head>
<body data-spy="scroll" data-target=".subnav" data-offset="50">
    <header><?php echo $this->element('header');?></header>
    <div class="container" style="min-height:97%">
        <div <?php if( $this->params['action'] != 'login' ) { ?> class="hero-unit" <?php } ?> >
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>
    <footer class="footer"><?php echo $this->element('footer');?></footer>
    <?php echo $this->element('sql_dump'); ?>
</body>
</html>

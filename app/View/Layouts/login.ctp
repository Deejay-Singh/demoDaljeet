<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo CMPNY; ?> : <?php echo $title_for_layout; ?>
    </title>
        <!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->
        <!--[if !IE]>-->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>
        <!--<![endif]-->
        <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="/assets/js/bootstrap.min.js"></script>

        <!--page specific plugin scripts-->

        <!--ace scripts-->

        <script src="/assets/js/ace-elements.min.js"></script>
        <script src="/assets/js/ace.min.js"></script>

        <!--inline scripts related to this page-->

        <script type="text/javascript">
            function show_box(id) {
             $('.widget-box.visible').removeClass('visible');
             $('#'+id).addClass('visible');
            }
        </script>

    <?php
        echo $this->Html->meta(array("name"=>"viewport","content"=>"width=device-width,  initial-scale=1.0"));
        echo $this->Html->meta('icon');
        echo $this->Html->css( array('bootstrap', 'bootstrap-responsive', 'comb', 'style', 'style-responsive') );
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->Html->script( array( 'jquery.min', 'jquery.validate', 'jquery.validate.min', 'jquery-ui.min', 'common' ) );
        echo $this->fetch('script');
    ?>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300" />

        <!--ace styles-->
        <?php echo $this->Html->css( array('assets/ace.min', 'assets/ace-responsive.min', 'assets/prettify', 'bootstrap', 'bootstrap-responsive', 'comb', 'style', 'style-responsive' ) );?>
</head>
<body class="login-layout" data-spy="scroll" data-target=".subnav" data-offset="50">
    <div class="main-container container-fluid">
        <div class="main-content" >
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>
</body>
</html>

<div class="row-fluid">
    <div class="span12">
        <div class="login-container">
            <div class="row-fluid">
                <div class="center">
                    <h1>
                        <i class="icon-leaf green"></i>
                        <span class="red"><?php echo CMPNY ?></span>
                        <span class="white">APP</span>
                    </h1>
                </div>
            </div>

            <div class="space-6"></div>

            <div class="row-fluid">
                <div class="position-relative">
                    <div id="login-box" class="login-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header blue lighter bigger">
                                    <i class="icon-coffee green"></i>
                                    Please Enter Your Information
                                </h4>

                                <div class="space-6"></div>

                                <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal">
                                    <fieldset>
                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" class="span12" placeholder="Username" name="data[User][user_name]" />
                                                <i class="icon-user"></i>
                                            </span>
                                        </label>

                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" class="span12" placeholder="Password" autocomplete='off' name="data[User][user_pass]" />
                                                <i class="icon-lock"></i>
                                            </span>
                                        </label>

                                        <div class="space"></div>

                                        <div class="clearfix">
                        <!--                    <label class="inline">
                                                <input type="checkbox" />
                                                <span class="lbl"> Remember Me</span>
                                            </label>
                            -->

                                            <button class="width-35 pull-right btn btn-small btn-primary">
                                                <i class="icon-key"></i>
                                                Login
                                            </button>
                                        </div>

                                        <div class="space-4"></div>
                                    </fieldset>
                                </form>
                            </div><!--/widget-main-->

                            <div class="toolbar clearfix">
                                <div>
                                    <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'reset'), true); ?>" onclick="show_box('forgot-box'); return false;"class="forgot-password-link">
                                        <i class="icon-arrow-left"></i>
                                        I forgot my password
                                    </a>
                                </div>
<!--
                                <div>
                                    <a href="#" onclick="show_box('signup-box'); return false;" class="user-signup-link">
                                        I want to register
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </div>
-->
                            </div>
                        </div><!--/widget-body-->
                    </div><!--/login-box-->

                    <div id="forgot-box" class="forgot-box widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header red lighter bigger">
                                    <i class="icon-key"></i>
                                    Retrieve Password
                                </h4>

                                <div class="space-6"></div>
                                <p>
                                    Enter details to receive password
                                </p>

                                <form method="POST" id="ResetPassword" action="users/reset" accept-charset="UTF-8" class="form-horizontal">
                                    <fieldset>
                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input type="email" class="span12 required email" placeholder="Email" name="email" />
                                                <i class="icon-envelope"></i>
                                            </span>
                                        </label>
                                        
                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" class="span12 required number" placeholder="Contact Number" maxlength="10" minlength="10" name='mobile' />
                                                <i class="icon-phone"></i>
                                            </span>
                                        </label>

                                        <div class="clearfix">
                                            <button class="width-35 pull-right btn btn-small btn-danger">
                                                <i class="icon-lightbulb"></i>
                                                Send Me!
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div><!--/widget-main-->

                            <div class="toolbar center">
                                <a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                                    Back to login
                                    <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div><!--/widget-body-->
                    </div><!--/forgot-box-->
<!--
                    <div id="signup-box" class="signup-box widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header green lighter bigger">
                                    <i class="icon-group blue"></i>
                                    New User Registration
                                </h4>

                                <div class="space-6"></div>
                                <p> Enter your details to begin: </p>

                                <form />
                                    <fieldset>
                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input type="email" class="span12" placeholder="Email" />
                                                <i class="icon-envelope"></i>
                                            </span>
                                        </label>

                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" class="span12" placeholder="Username" />
                                                <i class="icon-user"></i>
                                            </span>
                                        </label>

                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" class="span12" placeholder="Password" />
                                                <i class="icon-lock"></i>
                                            </span>
                                        </label>

                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" class="span12" placeholder="Repeat password" />
                                                <i class="icon-retweet"></i>
                                            </span>
                                        </label>

                                        <label>
                                            <input type="checkbox" />
                                            <span class="lbl">
                                                I accept the
                                                <a href="#">User Agreement</a>
                                            </span>
                                        </label>

                                        <div class="space-24"></div>

                                        <div class="clearfix">
                                            <button type="reset" class="width-30 pull-left btn btn-small">
                                                <i class="icon-refresh"></i>
                                                Reset
                                            </button>

                                            <button onclick="return false;" class="width-65 pull-right btn btn-small btn-success">
                                                Register
                                                <i class="icon-arrow-right icon-on-right"></i>
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                            <div class="toolbar center">
                                <a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                                    <i class="icon-arrow-left"></i>
                                    Back to login
                                </a>
                            </div>
                        </div><!--/widget-body
                    </div><!--/signup-box-->
                </div><!--/position-relative-->
            </div>
        </div>
    </div><!--/.span-->
</div><!--/.row-fluid-->

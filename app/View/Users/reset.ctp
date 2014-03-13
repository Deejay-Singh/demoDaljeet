<div class="row-fluid">
    <div class="span12">
        <div class="login-container">
            <div class="row-fluid">
                <div class="center">
                    <h1>
                        <i class="icon-leaf green"></i>
                        <span class="red">Order</span>
                        <span class="white">Gully</span>
                    </h1>
                </div>
            </div>

            <div class="space-6"></div>
<?php if( !$user ) { ?>
            <div class="row-fluid">
                <div class="position-relative">
                    <div id="forgot-box" class="forgot-box visible widget-box no-border">
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
                        </div><!--/widget-body-->
                    </div><!--/forgot-box-->
                </div><!--/position-relative-->
            </div>
<?php } else { ?>
        <div class="row-fluid">
                <div class="position-relative">
                    <div id="forgot-box" class="forgot-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header red lighter bigger">
                                    <i class="icon-key"></i>
                                    Retrieve Password
                                </h4>

                                <div class="space-6"></div>
                                <p>
                                    Enter details to change password
                                </p>

                                <form method="POST" name="resetPassword" id="UserSignupForm" action="" accept-charset="UTF-8" class="form-horizontal">
                                    <fieldset>
                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input class="span12 required" placeholder="Username" type="text" name="user_name" readonly value="<?php echo $user['User']['user_name']?>"/>
                                                <i class="icon-user"></i>
                                            </span>
                                        </label>
                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" class="span12 required" placeholder="Password" name='user_pass' id='password' minlength="5" autocomplete='off' />
                                                <i class="icon-lock"></i>
                                            </span>
                                        </label>
                                        <label>
                                            <span class="block input-icon input-icon-right">
                                                <input class="span12" placeholder="Repeat Password" autocomplete='off' type="password" name="confirm_password">
                                                <i class="icon-retweet"></i>
                                            </span>
                                        </label>
                                        <div class="clearfix">
                                            <button class="width-35 pull-right btn btn-small btn-danger">
                                                <i class="icon-unlock"></i>
                                                Submit
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div><!--/widget-main-->
                        </div><!--/widget-body-->
                    </div><!--/forgot-box-->
                </div><!--/position-relative-->
            </div>
<?php } ?>
        </div>
    </div><!--/.span-->
</div><!--/.row-fluid-->

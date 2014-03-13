<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
    <div class="container">
        <div class="pull-left"><h1 style="line-height:16px;"><strong><span class="red"><?php echo CMPNY ?></span><span class="white">App</span></strong></h1></div>
        <div class="pull-right">
            <ul class="nav">
                <li><a href="<?php echo $this->Xyz->u('dashboard', 'index');?>">Dashboard</a></li>
                <?php if( $this->Session->read( 'Auth.User.is_admin' ) ) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><strong style=" margin-left:10px;">Users</strong>
								<ul style="list-style:none; margin:0px;">
									<li><a href="<?php echo $this->Xyz->u( 'users', 'index' );?>">View All</a></li>
									<li><a href="<?php echo $this->Xyz->u( 'users', 'addUser' );?>">Create a User</a></li>
								</ul> 
							</li>
						</ul>
					</li>
				<?php } ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><font color = "white" ><i class="icon-user icon-white"></i> Welcome <?php echo $this->Session->read('Auth.User.user_name');?> !</font><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $this->Xyz->u( 'users', 'view', $this->Session->read('Auth.User.id') );?>">My Account</a></li>
                        <li><a href="<?php echo $this->Xyz->u( 'users', 'logout' );?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    </div>
</div>

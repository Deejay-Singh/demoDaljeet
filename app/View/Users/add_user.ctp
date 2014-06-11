<div class="well well-small">
    <h2>Add User<span class="label label-important pull-right"><sup> * </sup>FIELDS ARE MANDATORY </span></h2>
</div>
<form name="registration" action="" method="post" enctype="multipart/form-data" id="UserSignupForm">
    <div class="form-horizontal well">
        <div class="breadcrumb">
            <h3>Personal Information:</h3>
        </div>
        <fieldset style="width:90%;">
            <div class="control-group input-append" >
                <label for="role_id" class="control-label">Select User:<font color = "red"><sup>*</sup></font></label>
                <div class="controls">
                    <?php echo $this->Form->input('', array('type' => 'select', 'options' => array( '0' => 'Client', '1' => 'Admin' ), 'name' => 'is_admin', 'id' => 'id', 'empty' => 'User Type', 'class' => 'required' )); ?>
                </div>
            </div>
            <div class="control-group pull-right">
                <label for="organisation_name" class="control-label">Company Name:</label>
                <div class="controls">
                    <input type = "text" name='company_name' id='company_name'>
                </div>
            </div>
            <div class="control-group input-append">
                <label for="first_name" class="control-label">Name:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <input type = "text" name='first_name' id='first_name' class="required alphabet">
                </div>
            </div>
            <div class="control-group pull-right">
                <label for="mobile" class="control-label">Expiry:<font color="red"><sup>*</sup></font><br/></label>
                <div class="controls">
                    <div class="input-prepend input-append"><input class="required date datepicker" type='text' autocomplete='off' name='valid_till'></div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="form-horizontal well">
        <div class="breadcrumb">
            <h3>Login Information:</h3>
        </div>
        <fieldset>
            <div class="control-group">
                <label for="user_name" class="control-label">User Name:<font color="red"><sup>*</sup></font><br/></label>
                <div class="controls">
                    <input type = "text"  autocomplete='off' class="required" minlength="5" name='user_name'>
                </div>
            </div>
            <div class="control-group">
                <label for="user_pass" class="control-label">Password:<font color="red"><sup>*</sup></font><br/></label>
                <div class="controls">
                    <input type="password"  name='user_pass' id='password' class="required" minlength="5" autocomplete='off'>
                </div>
            </div>
            <div class="control-group">
                <label for="confirm_password" class="control-label">Confirm Password:<font color="red"><sup>*</sup></font><br/></label>
                <div class="controls">
                    <input type="password"  name='confirm_password' class="required" autocomplete='off'>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="loginstrbtn">
        <input type = "hidden" name='created_by' value="<?php echo $this->Session->read( 'Auth.User.id' ); ?>" >
        <input type="submit" id="Usersubmit" value="Add User" class="btn btn-success pull-right">
    </div>
</form>
</br/></br/>

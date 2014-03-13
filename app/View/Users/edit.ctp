<div class="well well-small">
    <h2>Add User<span class="label label-important pull-right"><sup> * </sup>FIELDS ARE MANDATORY </span></h2>
</div>
<form name="registration" action="" method="post" id="UserSignupForm">
    <div class="form-horizontal well">
        <div class="breadcrumb">
            <h3>Personal Information:</h3>
        </div>
        <fieldset style="width:90%;">
            <div class="control-group input-append" >
                <label for="role_id" class="control-label">Select Role:<font color = "red"><sup>*</sup></font></label>
                <div class="controls">
                    <?php echo $this->Form->input('', array('type' => 'select', 'options' => $roleId, 'name' => 'role_id', 'value' => $user['User']['role_id'], 'id' => 'id', 'empty' => 'Select Role', 'class' => 'required' )); ?>
                </div>
            </div>
            <div class="control-group pull-right">
                <label for="organisation_name" class="control-label">Organisation Name:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <input type = "text" name='organisation_name' id='organisation_name' class="required" value="<?php echo $user['User']['organisation_name']?>">
                </div>
            </div>
            <div class="control-group input-append">
                <label for="first_name" class="control-label">First Name:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <input type = "text" name='first_name' id='first_name' class="required alphabet" value="<?php echo $user['User']['first_name']?>">
                </div>
            </div>
            <div class="control-group pull-right">
                <label for="last_name" class="control-label">Last Name:</label>
                <div class="controls">
                    <input type="text"  name='last_name' class="alphabet" value="<?php echo $user['User']['last_name']?>">
                </div>
            </div>
            <div class="control-group input-append">
                <label for="address" class="control-label">Address:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <textarea name='address' class="required" cols='5' rows='5'><?php echo $user['User']['address']?></textarea>
                </div>
            </div>
            <div class="control-group pull-right">
                <label for="city" class="control-label">City:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <input type='text' name='city' class="required alphabet" value="<?php echo $user['User']['city']?>">
                </div>
            </div>
            <div class="control-group input-append">
                <label for="state" class="control-label">State:<font color = "red"><sup>*</sup></font></label>
                <div class="controls">
                    <?php echo $this->Form->input('', array('type' => 'select', 'options' => $states, 'name' => 'state', 'value' => $user['User']['state'], 'empty' => 'Select State', 'class' => 'required' )); ?>
                </div>
            </div>
            <div class="control-group pull-right">
                <label for="pin" class="control-label">Pin:<font color = "red"><sup>*</sup></font></label>
                <div class="controls">
                    <input type='text'  name='pin' class="number required" minlength="6" maxlength="6" value="<?php echo $user['User']['pin']?>">
                </div>
            </div>
            <div class="control-group input-append">
                <label for="mobile" class="control-label">Mobile Number:<font color="red"><sup>*</sup></font><br/></label>
                <div class="controls">
                    <div class="input-prepend input-append"><span class="add-on">+91-</span><input class="span2 required number" type='text' autocomplete='off' maxlength="10" minlength="10" name='mobile' value="<?php echo $user['User']['mobile']?>"></div>
                </div>
            </div>
            <div class="control-group pull-right">
                <label for="email" class="control-label">Email Address:<font color="red"><sup>*</sup></font><br/></label>
                <div class="controls">
                    <input type='email' autocomplete='off' class="required email" id="email" name='email' value="<?php echo $user['User']['email']?>">
                </div>
            </div>
        </fieldset>
    </div>
    <div class="form-horizontal well hide" id='loginDetails' >
        <button id = 'login_hide' aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
        <div class="breadcrumb">
            <h3>Login Information:</h3>
        </div>
        <fieldset>
            <div class="control-group">
                <label for="user_name" class="control-label">User Name:<font color="red"><sup>*</sup></font><br/></label>
                <div class="controls">
                    <input type = "text"  autocomplete='off' class="required" minlength="5" name='user_name' value="<?php echo $user['User']['user_name']?>">
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
        <input type = "hidden" name='parent_id' value="<?php echo $user['User']['parent_id'] ?>" >
        <input type = "hidden" name='created_by' value="<?php echo $user['User']['created_by'] ?>" >
        <input type = "hidden" name='id' value="<?php echo $user['User']['id'] ?>" >
        <input type = "hidden" name='is_active' value="<?php echo $user['User']['is_active'] ?>" >
        <a class="btn btn-info pull-left" id="logininfo">Change Password</a>
        <input type="submit" id="Usersubmit" value="Update" class="btn btn-success pull-right">
    </div>
</form>
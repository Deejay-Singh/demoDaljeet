<div class="well well-small">
    <h2>Upload Video<span class="label label-important pull-right"><sup> * </sup>FIELDS ARE MANDATORY </span></h2>
</div>
<form name="registration" action="" method="post" id="UserSignupForm" enctype="multipart/form-data">
    <div class="form-horizontal well">
        <div class="breadcrumb">
            <h3>Video Information:</h3>
        </div>
        <fieldset style="width:90%;">
            <div class="control-group input-append" >
                <label for="role_id" class="control-label">Select User:<font color = "red"><sup>*</sup></font></label>
                <div class="controls">
                    <?php echo $this->Form->input('', array('type' => 'select', 'options' => $users, 'name' => 'user_id', 'id' => 'id', 'empty' => 'Select user name', 'class' => 'required' )); ?>
                </div>
            </div>
            <div class="control-group pull-right">
                <label for="organisation_name" class="control-label">Name:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <input type = "text" name='name' id='name' class="required">
                </div>
            </div>
            <div class="control-group input-append">
                <label for="first_name" class="control-label">Description:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <textarea col='5' rows='5' class="required" name="description" ></textarea>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="form-horizontal well" >
        <div class="breadcrumb">
            <h3>Upload:</h3>
        </div>
        <fieldset>
            <div class="control-group">
                <label for="confirm_password" class="control-label">Choose File:<font color="red"><sup>*</sup></font><br/></label>
                <div class="controls">
                    <input type='file' class="required" name='file_name'>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="loginstrbtn">
        <input type = "hidden" name='created_by' value="<?php echo $this->Session->read( 'Auth.User.id' ); ?>" >
        <input type="submit" id="submit" value="Update" class="btn btn-success pull-right">
    </div>
</form>
<br/>
<br/>

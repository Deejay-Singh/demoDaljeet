<div class="breadcrumb" style="width:400px; margin:0px auto;">
<legend>Enter your OTP</legend>
    <?php echo $this->Form->create('User', array('action' => 'otp', 'class' => 'form-horizontal'));?> 
        <?php echo $this->Form->input('otp', array( 'label' => array('class' => 'control-label' ), 'div' => 'control-group', 'autocomplete' => 'off', 'between' => '<div class="controls">' ) );?> </div>
        <div class="control-group"> <div class="controls"><?php echo $this->Form->submit('Submit', array( 'class' => 'btn btn-success', 'div' => false ) );?>
        <a class='btn' href="<?php echo $this->Xyz->u('users', 'logout')?> "> Cancel</a> </div></div>
    <?php echo $this->Form->end(); ?> 
</div> 
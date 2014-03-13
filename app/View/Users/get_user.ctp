<?php if( $task['Checklist'] ) { ?>
<option value="<?php $this->Bestylish->getUserName( $task['Checklist']['user_id'] ) ?>"><?php echo $this->Bestylish->getUserName( $task['Checklist']['user_id'] ); ?></option>
<?php  } else { ?>
<option value="">Select User</option>
<?php 
foreach($user as $key => $val) {?>
  <option value="<?php echo $val['User']['id']; ?>"><?php echo $val['User']['first_name'] . " " . $val['User']['last_name']; ?></option>
<?php } } ?>
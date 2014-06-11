<div class="well well-small">
<h2>View Users</h2>
</div>

<div class="table">    
<?php
if($users != null) { ?> 
    <table width="800" border="0" cellspacing="1" cellpadding="0" class="table">
        <thead>    
        <tr>
            <th>Name</th>
            <th>Company Name</th>
            <th>Contact #</th>
            <th>Email</th>
            <th>Type</th>
            <th>Expiry</th>
            <th>Created By</th>
            <th>Created</th>
            <th>Active</th>
            <th>Action</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($users as $detail) {
            ?>
            <tr class="adddealertdcol" id="<?php echo 'tr_' . $detail['User']['id']?>">
                <td><a href="<?php echo $this->Xyz->u('users', 'view', $detail['User']['id']);?>" ><?php echo ucfirst( $detail['User']['first_name'] ) . " " . ucfirst ( $detail['User']['last_name'] ); ?></a></td>
                <td><?php echo ucwords( $detail['User']['company_name'] ); ?></td>
                <td><?php echo $detail['User']['mobile']; ?></td>
                <td><?php echo $detail['User']['email']; ?></td>
                <td><span class="label label-info"><?php echo $detail['User']['is_admin'] ? 'Admin':'Client' ?></span></td>
                <td><?php echo $detail['User']['is_admin'] ? 'N.A' : $this->Xyz->beautifulDate( $detail['User']['valid_till'] ); ?></td>
                <td><?php echo isset( $usersList[$detail['User']['created_by']] ) ? ucwords( $usersList[$detail['User']['created_by']] ) : 'SYSTEM' ; ?></td>
                <td><?php echo $this->Xyz->beautifulDate( $detail['User']['created'] ); ?></td>
                <td>					
                    <?php if( $detail['User']['is_active'] == 1) { ?> 
                    <span id = 'span_<?php echo $detail['User']['id']; ?>' class="label label-success">YES</span>
                    <?php } else { ?> 
                    <span id = 'span_<?php echo $detail['User']['id']; ?>' class="label label-important">NO</span>
                    <?php } ?> 
                </td>
                <?php 
                if( $detail['User']['is_active'] == 1) { ?>
                    <td ><a id = 'action_<?php echo $detail['User']['id']; ?>_users' class="btn btn-danger btn-small jquery_action_users" rel=0 >Deactivate</a>
                <?php 
                } else { ?>
                    <td><a id = 'action_<?php echo $detail['User']['id']; ?>_users' class="btn btn-success btn-small jquery_action_users" rel=1  >Activate</a>
                <?php } ?>
                </td>
                <td><a class="btn-danger btn btn-small jquery_delete_user" rel="<?php echo 'delete_' . $detail['User']['id']?>" href="#"><span class="glyphicon glyphicon-envelope"></span></a></td>
            </tr>
            <?php 
        } ?>
        </tbody>
    </table>
<?php } else { ?>
    <div id='error'><center><p class="text-error">No data found. Please try again!!</p></center></div>
<?php } ?>
</div>

<script>
jQuery(document).ready(function(){
	jQuery('.jquery_delete_user').click(function(){
		var btn = jQuery(this).attr('rel');
        var d = btn.split('_');
        var id = d[1];
        var setUrl = '/users/delete/'+ id;
        jQuery.ajax({
            type: "GET",
            url: setUrl,
            success: function(data) {
                jQuery('#tr_'+id).hide();
            }
        });
	});
});
</script>

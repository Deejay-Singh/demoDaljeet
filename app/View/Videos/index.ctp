<div class="well well-small">
	<h2>Uploded Videos <?php if( $this->Session->read( 'Auth.User.is_admin' ) ) { ?> <a class="btn btn-success btn-small pull-right" type="button" href="<?php echo $this->Xyz->u( 'videos', 'upload' ); ?>" >Upload More</a> <?php } ?></h2>
</div>
<div class="table">    
<?php
if($vids != null) { 
if( $this->Session->read( 'Auth.User.is_admin' ) ) {  ?>
    <table width="800" border="0" cellspacing="1" cellpadding="0" class="table">
        <thead>    
        <tr>
            <th>Video Name</th>
            <th>File Name</th>
            <th>Company Name</th>
            <th>Uploded By</th>
            <th>Created</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($vids as $video) {
            ?>
            <tr class="adddealertdcol">
                <td><?php echo $video['Video']['name'] ?></td>
                <td><?php echo $video['Video']['folder_name'] . '/' . $video['Video']['file_name'] ?></td>
                <td><?php echo ucwords( $cmpny[$video['Video']['user_id']] ) ?></td>
                <td><?php echo ucwords( $users[$video['Video']['created_by']] ) ?></td>
                <td><?php echo $this->Xyz->beautifulDate( $video['Video']['created'] ) ?></td>
                <td><a class="btn btn-info btn-small" type="button" href="<?php echo $this->Xyz->u( 'videos', 'view', $video['Video']['id'] ); ?>" >View</a></td>
                <td><a class="btn btn-danger btn-small" type="button" href="<?php echo $this->Xyz->u( 'videos', 'delete', $video['Video']['id'] ); ?>" >Delete</a></td>
            </tr>
            <?php 
        } ?>
        </tbody>
    </table>
   <?php } else { ?>
   <table width="800" border="0" cellspacing="1" cellpadding="0" class="table">
        <thead>    
        <tr>
            <th>Name</th>
            <th>Uploded On</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($vids as $video) {
            ?>
            <tr class="adddealertdcol">
                <td><?php echo $video['Video']['name'] ?></td>
                <td><?php echo $this->Xyz->beautifulDate( $video['Video']['created'] ) ?></td>
                <td><a class="btn btn-info btn-small" type="button" href="<?php echo $this->Xyz->u( 'videos', 'view', $video['Video']['id'] ); ?>" >View</a></td>
            </tr>
            <?php 
        } ?>
        </tbody>
    </table>
   <?php } ?>
<?php } else { ?>
    <div id='error'><center><p class="text-error">No data found. Please try again!!</p></center></div>
<?php } ?>
</div>

<div class="well well-small">
   <h2>Details for <?php echo ucfirst( $userView['User']['first_name'] ) . " " . ucfirst( $userView['User']['last_name'] ); ?><a class="btn btn-info pull-right" href="<?php echo $this->Xyz->u('users', 'edit', $userView['User']['id'])?>"> Edit</a></h2>
</div>
<table name="personal" class="table table-bordered">
    <tr>
         <ul class="breadcrumb">
            <li class="active"><h4>Personal Information:</h4></li>
        </ul>
    </tr>
    <tr>
        <td width="22%"><strong>First Name</strong></td>
        <td width="36%"><?php echo $userView['User']['first_name']; ?></td>
        <td width="22%"><strong>Last Name</strong></td>
        <td width="36%"><?php echo $userView['User']['last_name']; ?></td>
    </tr>
    <tr>
        <td><strong>Mobile Number</strong></td>
        <td>+91-<?php echo $userView['User']['mobile']; ?></td>
        <td><strong>Email Address</strong></td>
        <td><?php echo $userView['User']['email']; ?></td>
    </tr>
    <tr>
        <td><strong>Organisation Name</strong></td>
        <td><?php echo $userView['User']['company_name']; ?></td>
        <td><strong>Admin</strong></td>
        <td><?php echo $userView['User']['is_admin'] ? 'Yes': 'No'; ?></td>
    </tr>
    <tr>
        <td width="22%"><strong>User Name</strong></td>
        <td width="36%"><?php echo $userView['User']['user_name']; ?></td>
        <td><strong>Expire On</strong></td>
        <td><?php echo $userView['User']['is_admin'] ? 'N.A' : $this->Xyz->beautifulDate( $userView['User']['valid_till'] ) ; ?></td>
    </tr>
</table>

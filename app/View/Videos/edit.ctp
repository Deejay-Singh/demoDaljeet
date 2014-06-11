<div class="well well-small">
    <h2>Edit Video<span class="label label-important pull-right"><sup> * </sup>FIELDS ARE MANDATORY </span></h2>
</div>
<form name="registration" action="" method="post" id="UserSignupForm" enctype="multipart/form-data">
    <div class="form-horizontal well">
        <div class="breadcrumb">
            <h3>Video Information:</h3>
        </div>
        <fieldset style="width:90%;">
            <div class="control-group pull-right">
                <label for="organisation_name" class="control-label">Video Name:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <input type = "text" name='name' id='name' value="<?php echo $video['Video']['name'] ?>" class="required">
                </div>
            </div>
            <div class="control-group input-append">
                <label for="first_name" class="control-label">Description:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <textarea col='5' rows='5' class="required" name="description" ><?php echo $video['Video']['description'] ?></textarea>
                </div>
            </div>
            <div class="control-group pull-right">
                <div class="controls">
                </div>
            </div>
            <div class="control-group input-append" id="uploadDiv">
                <label for="first_name" class="control-label">File Name:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <input type = "text" name='file_name' value="<?php echo $video['Video']['file_name'] ?>" id='file_name' class="required">
                    <!--<input style="height: 30px;position: absolute;" type="button" id="upload" value="Upload File" class="btn btn-danger pull-right">!-->
                </div>
            </div>
            <div class="control-group" >
                <label for="folder" class="control-label">Folder name:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <input type = "text" name='folder_name' value="<?php echo $video['Video']['folder_name'] ?>" id='folder_name' class="required">
                </div>
            </div>
            <div class="control-group input-append hide" id="enterDiv">
                <label for="first_name" class="control-label">Upload File:<font color="red"><sup>*</sup></font></label>
                <div class="controls">
                    <input type='file' class="required" name='upload_file'>
                    <input style="height: 30px;position: absolute;" type="button" id="enter" value="Enter File name" class="btn btn-danger pull-right">
                </div>
            </div>
        </fieldset>
    </div>
    <div class="loginstrbtn">
        <input type = "hidden" name='id' value="<?php echo $video['Video']['id'] ?>" id='id'>
        <input type="Submit" id="submit" value="Edit" class="btn btn-success pull-right">
    </div>
</form>
<br/>
<br/>

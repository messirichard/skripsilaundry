
<section class='content'>
    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Users_groups <?php echo $button ?></h2>
        </div>
        <div class='box-body'>
        <?php echo form_open()?>
	    <div class="form-group">
            <label for="int">User Id <?php echo form_error('user_id') ?></label>
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="mediumint">Group Id <?php echo form_error('group_id') ?></label>
            <input type="text" class="form-control" name="group_id" id="group_id" placeholder="Group Id" value="<?php echo $group_id; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('users_groups') ?>" class="btn btn-default">Cancel</a>
	 <?php echo form_close()?>
</div>
</div>
</section>
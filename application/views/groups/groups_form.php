
<section class='content'>
    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Groups <?php echo $button ?></h2>
        </div>
        <div class='box-body'>
        
        <?php echo form_open($action)?>
	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Description <?php echo form_error('description') ?></label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('groups') ?>" class="btn btn-default">Cancel</a>
	 <?php echo form_close()?>
</div>
</div>
</section>
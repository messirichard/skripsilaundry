
<section class='content'>
    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Transfers_report <?php echo $button ?></h2>
        </div>
        <div class='box-body'>
        
        <?php echo form_open($action)?>
	    <div class="form-group">
            <label for="int">User Id <?php echo form_error('user_id') ?></label>
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
        </div>
	    <!--<div class="form-group">-->
     <!--       <label for="int">Examiner Id <?php echo form_error('examiner_id') ?></label>-->
     <!--       <input type="text" class="form-control" name="examiner_id" id="examiner_id" placeholder="Examiner Id" value="<?php echo $examiner_id; ?>" />-->
     <!--   </div>-->
	    <div class="form-group">
            <label for="tinyint">Type <?php echo form_error('type') ?></label>
            <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="<?php echo $type; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Transaction Id <?php echo form_error('transaction_id') ?></label>
            <input type="text" class="form-control" name="transaction_id" id="transaction_id" placeholder="Transaction Id" value="<?php echo $transaction_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="image">Image <?php echo form_error('image') ?></label>
            <textarea class="form-control" rows="3" name="image" id="image" placeholder="Image"><?php echo $image; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="tinyint">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Created On <?php echo form_error('created_on') ?></label>
            <input type="text" class="form-control" name="created_on" id="created_on" placeholder="Created On" value="<?php echo $created_on; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Processed On <?php echo form_error('processed_on') ?></label>
            <input type="text" class="form-control" name="processed_on" id="processed_on" placeholder="Processed On" value="<?php echo $processed_on; ?>" />
        </div>
	    <input type="hidden" name="transfer_report_id" value="<?php echo $transfer_report_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('transfers_report') ?>" class="btn btn-default">Cancel</a>
	 <?php echo form_close()?>
</div>
</div>
</section>
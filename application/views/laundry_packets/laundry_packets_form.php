
<section class='content'>
    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Buat Jenis Laundry</h2>
        </div>
        <div class='box-body'>
        <?= validation_errors() ?>
        <?php echo form_open($action)?>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Harga <?php echo form_error('price') ?></label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" />
        </div>

	    <input type="hidden" name="laundry_packet_id" value="<?php echo $laundry_packet_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('laundry_packets') ?>" class="btn btn-default">Batal</a>
	 <?php echo form_close()?>
</div>
</div>
</section>
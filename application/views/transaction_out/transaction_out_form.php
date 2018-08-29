
<section class='content'>
    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Transaction_out <?php echo $button ?></h2>
        </div>
        <div class='box-body'>
        
        <?php echo form_open($action)?>
	    <div class="form-group">
            <label for="varchar">Nama Barang <?php echo form_error('nama_barang') ?></label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Tanggal <?php echo form_error('tanggal') ?></label>
            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Harga <?php echo form_error('harga') ?></label>
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Quantity <?php echo form_error('quantity') ?></label>
            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="<?php echo $quantity; ?>" />
        </div>

	    <input type="hidden" name="transaction_out_id" value="<?php echo $transaction_out_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('transaction_out') ?>" class="btn btn-default">Cancel</a>
	 <?php echo form_close()?>
</div>
</div>
</section>
<section class='content'>
    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Transactions <?php echo $button ?></h2>
        </div>
        <div class='box-body'>
            <?php echo form_open('transactions/status_update_action'); ?>


            <div class="form-group">
                <label for="int">Status </label>
                <input type="hidden" name="transaction_id" value="<?php echo $this->uri->segment(3) ?>">
                <select name="status" class="form-control">
                    <option value="0">Menunggu Pembayaran</option>
                    <option value="1">Proses</option>
                    <option value="2">Selesai</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('transactions') ?>" class="btn btn-default">Cancel</a>
            <?php echo form_close() ?>
        </div>
    </div>
</section>

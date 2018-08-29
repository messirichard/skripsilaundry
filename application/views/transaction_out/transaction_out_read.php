
<section class='content'>
<div class='box'>
<div class='box-header'>
        <h2 style="margin-top:0px">Transaction_out Read</h2>
        </div>
        <div class='box-body'>
        <table class="table">
	    <tr><td>Nama Barang</td><td><?php echo $nama_barang; ?></td></tr>
	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td>Harga</td><td><?php echo number_format($harga, 2, ",", "."); ?></td></tr>
	    <tr><td>Quantity</td><td><?php echo $quantity; ?></td></tr>
	    <tr><td>Harga Total</td><td><?php echo number_format($harga_total, 2, ",", "."); ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('transaction_out') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div>
</div>
     </section>
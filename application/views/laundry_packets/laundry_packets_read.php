
<section class='content'>
<div class='box'>
<div class='box-header'>
        <h2 style="margin-top:0px">Laundry_packets Read</h2>
        </div>
        <div class='box-body'>
        <table class="table">
	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>Price</td><td><?php echo number_format($price, 2, ",", "."); ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td>Update At</td><td><?php echo $update_at; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('laundry_packets') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div>
</div>
     </section>
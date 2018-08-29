
<section class="content">
        <div class='box'>
        <div class='box-header with-border'>
        <h2 style="margin-top:0px">Jenis Laundry</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('laundry_packets/create'), 'Buat', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('laundry_packets/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                            if ($q <> '') {
                                ?>
                                    <a href="<?php echo site_url('laundry_packets'); ?>" class="btn btn-default">Reset</a>
                                    <?php

                                }
                                ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div class='box-body'>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
		<th>Harga</th>
		<th>Action</th>
            </tr><?php
                foreach ($laundry_packets_data as $laundry_packets) {
                    ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $laundry_packets->name ?></td>
			<td><?php echo number_format($laundry_packets->price, 2, ",", ".") ?></td>
			<td style="text-align:center" width="200px">
				<?php 
    echo anchor(site_url('laundry_packets/read/' . $laundry_packets->laundry_packet_id), 'Read');
    echo ' | ';
    echo anchor(site_url('laundry_packets/update/' . $laundry_packets->laundry_packet_id), 'Update');
    echo ' | ';
    echo anchor(site_url('laundry_packets/delete/' . $laundry_packets->laundry_packet_id), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
    ?>
			</td>
		</tr>
                <?php

            }
            ?>
        </table>
        </div>
        <div class='box-footer'>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
          
</div>
 </section>
<section class='content'>
    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Detail Transaksi</h2>
        </div>
        <div class='box-body'>
            <table class="table">
                <tr>
                    <td>Employee Id</td>
                    <td><?php echo $employee_id; ?></td>
                </tr>
                <tr>
                    <td>User Id</td>
                    <td><?php echo $user_id; ?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td>Laundry Packet Id</td>
                    <td><?php echo $laundry_packet_id; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php echo $status_pembayaran; ?></td>
                </tr>
                <tr>
                    <td>Kuantitas</td>
                    <td><?php echo $weight_total; ?></td>
                </tr>
                 <tr>
                    <td>Weight Total</td>
                    <td><?php echo $weight_total; ?></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><?php echo number_format($price, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td>Retreived At</td>
                    <td><?php echo $retreived_at; ?></td>
                </tr>
                <tr>
                    <td>Taken Out At</td>
                    <td><?php echo $taken_out_at; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-6 pull-left">
                   <div class="form-group">
                       <a href="<?php echo site_url('transactions') ?>" class="btn btn-default">Back</a>
                   </div>
                </div>
                <div class="col-md-6 text-right">
<!--                    <div class="form-group">-->
<!--                        <a href="--><?php //echo site_url('transactions') ?><!--" class="btn btn-danger">Batalkan Transaksi</a>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class='box'>
        <div class='box-header with-border'>
            <h2 style="margin-top:0px">Bukti Transfer</h2>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                    <form action="<?php echo site_url('transfers_report/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                            <?php
                            if ($q <> '') {
                                ?>
                                <a href="<?php echo site_url('transfers_report'); ?>" class="btn btn-default">Reset</a>
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
                    <th>Nama Member</th>
                    <th>Jenis Transaksi</th>
                    <th>Image</th>
                    <th>Tanggal Upload</th>
                    <th>Status Verifikasi</th>
                    <th>Action</th>
                </tr><?php
                foreach ($transfers_report_data as $transfers_report) {
                    ?>
                    <tr>
                        <td width="80px"><?php echo ++$start ?></td>
                        <td>
                            <a href="<?= site_url('users/read/'.$transfers_report->user_id) ?>">
                                <?php
                                $user = $this->Users_model->get_by_id($transfers_report->user_id);
                                echo $user->first_name . " " . $user->last_name;
                                ?>
                            </a>
                        </td>
                        <td>
                            <p>
                                <?php
                                    switch ($transfers_report->type) {
                                        case TOPUP_SALDO:
                                            echo "Top up Saldo";
                                            break;
                                        case PEMBAYARAN_TRANSFER:
                                            echo "Transfer";
                                            break;
                                    }
                                ?>
                            </p>
                        </td>

                        <td>
                            <a href="<?php echo base_url($transfers_report->image) ?>" data-lightbox="<?php echo $transfers_report->transaction_id?>" alt="">
                                <img src="<?php echo base_url($transfers_report->image)?>" height="150" width="auto" alt="">
                            </a>
                        </td>
                        <td><?php echo $transfers_report->created_on ?></td>
                        <td>
                            <?php
                                switch ($transfers_report->status) {
                                    case "0":
                                        echo "Belum Terverifikasi";
                                        break;
                                    case "1":
                                        echo "Terverifikasi";
                                        break;
                                }
                            ?>
                        </td>
                        <td style="text-align:center" width="200px">
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <?php if ($transfers_report->status): ?>
                                    <a href="<?php echo site_url('transfers_report/verifikasi/' . $transfers_report->transfer_report_id)?> " class="btn btn-danger">Batalkan Verifikasi</a>
                                <?php else: ?>
                                    <a href="<?php echo site_url('transfers_report/verifikasi/' . $transfers_report->transfer_report_id)?> " class="btn btn-success">Verifikasi</a>
                                <?php endif;?>
                                <a href="<?php echo site_url('transfers_report/read/' . $transfers_report->transfer_report_id)?> " class="btn btn-default"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo site_url('transfers_report/delete/' . $transfers_report->transfer_report_id)?> " class="btn btn-default"><i class="fa fa-trash"></i></a>
                            </div>
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
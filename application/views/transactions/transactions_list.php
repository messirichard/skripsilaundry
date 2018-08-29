<?php

?>

<section class="content">
    <div class='box'>
        <div class='box-header with-border'>
            <h2 style="margin-top:0px">Laporan Transaksi</h2>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                    <?php echo anchor(site_url('transactions/create'), 'Buat', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?php echo $this->session->userdata('message') != '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                    <form action="<?php echo site_url('transactions/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                            <?php
                            if ($q != '') {
                                ?>
                                <a href="<?php echo site_url('transactions'); ?>" class="btn btn-default">Reset</a>
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
                    <th>No Nota</th>
                    <th>Nama Pelanggan</th>
                    <th>Jenis Cucian</th>
                    <th>Layanan</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Status Cucian</th>
                    <th>Diambil</th>
                    <td></td>
                </tr><?php foreach ($transactions_data as $transactions) {
                        $laundry_packet = $this->Laundry_packets_model->get_by_id($transactions->laundry_packet_id);
                        ?>
                    <tr>
                        <td width="80px"><?php echo $transactions->transaction_id ?></td>
                        <td>
                            <?php if ($transactions->user_id) : ?>
                                <a href="<?= site_url('users/read/' . $transactions->user_id) ?>">
                                    <?php echo $transactions->name ?>
                                </a>
                            <?php else : ?>
                                <a href="<?= site_url('users/read/' . $transactions->user_id) ?>">
                                    <?php echo $transactions->name ?>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $laundry_packet->name ?></td>
                        <td><?php echo ($transactions->user_id) ? "Member" : "Regular" ?></td>
                        <td><?php echo $transactions->weight_total ?></td>
                        <td><?php echo number_format($transactions->price, 2, ",", ".") ?></td>
                        <td>
                            <div class="form-group">
                                <?php
                                switch ($transactions->payment_type) {
                                    case "1":
                                        echo "Tunai";
                                        break;
                                    case "2":
                                        echo "Saldo";
                                        break;
                                    case "3":
                                        echo "Transfer";
                                        break;
                                    default:
                                        echo "Tidak Valid";
                                        break;
                                }
                                ?>
                            </div>
                        </td>
                        <td>
                            <p>
                                <?php
                                switch ($transactions->status_pembayaran) {
                                    case '1':
                                        echo "Lunas";
                                        break;
                                    default:
                                        echo "Belum Lunas";
                                        break;
                                }
                                ?>
                            </p>
                        </td>
                        <td>
                            <?php if ($transactions->status_laundry == 0) : ?>
                                <input type="checkbox" class="laundryProcessToggle"
                                       data-transaction="<?= $transactions->transaction_id ?>" data-toggle="toggle"
                                       data-on="Selesai" data-off="Proses" data-size="small" data-onstyle="success"
                                       data-offstyle="danger">
                            <?php else : ?>
                                <input type="checkbox" class="laundryProcessToggle"
                                       data-transaction="<?= $transactions->transaction_id ?>" checked
                                       data-toggle="toggle" data-on="Selesai" data-off="Proses" data-size="small"
                                       data-onstyle="success" data-offstyle="danger">
                            <?php endif; ?>
                        </td>
                         <td>
                            <?php if ($transactions->status_pengambilan == 0) : ?>
                                <input type="checkbox" class="diambilToggle"
                                       data-transaction="<?= $transactions->transaction_id ?>" data-toggle="toggle"
                                       data-on="Sudah" data-off="Belum" data-size="small" data-onstyle="success"
                                       data-offstyle="danger" <?= ((!$transactions->status_pembayaran) or (!$transactions->status_laundry)) ? 'disabled' : ''; ?>>
                            <?php else : ?>
                                <input type="checkbox" class="diambilToggle"
                                       data-transaction="<?= $transactions->transaction_id ?>" checked
                                       data-toggle="toggle" data-on="Sudah" data-off="Belum" data-size="small"
                                       data-onstyle="success" data-offstyle="danger">
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <a href=<?= site_url('transactions/read/' . $transactions->transaction_id) ?> class="btn
                                   btn-default"><i class="fa fa-eye"></i></a>
                                <a href=<?= site_url('transactions/delete/' . $transactions->transaction_id) ?> class="btn
                                   btn-danger"><i class="fa fa-trash"></i></a>
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
                    <?php echo anchor(site_url('transactions/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    $(".laundryProcessToggle").on('change', function () {
        $transactionID = $(this).data('transaction');
        console.log(this.checked);
        $.post('transactions_api/set_laundry_status', {
            'transaction_id': $transactionID
        }, function (data) {
            console.log(data);
        })

    })

      $(".diambilToggle").on('change', function () {
        $transactionID = $(this).data('transaction');
        console.log(this.checked);
        $.post('transactions_api/set_laundry_taken_status', {
            'transaction_id': $transactionID
        }, function (data) {
            console.log(data);
        })
    })
</script>

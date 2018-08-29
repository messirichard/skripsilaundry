<section class='content'>
    <div class="row">
        <div class="col-md-6">
            <div class='box'>
                <div class='box-header'>
                    <h3>Catat transaksi keluar</h3>
                </div>
                <div class='box-body row'>

                    <?php echo form_open(site_url('transaction_out/create_action')) ?>
                    <div class="form-group col-md-12">
                        <label for="varchar">Nama Barang <?php echo form_error('nama_barang') ?></label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                               placeholder="Nama Barang" value=""/>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="datetime">Tanggal <?php echo form_error('tanggal') ?></label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal"
                               value=""/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="float">Harga <?php echo form_error('harga') ?></label>
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value=""/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="int">Quantity <?php echo form_error('quantity') ?></label>
                        <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity"
                               value=""/>
                    </div>

                    <div class="form-group col-md-12">
                        <input type="hidden" name="transaction_out_id" value=""/>
                        <button type="submit" class="btn btn-primary">Buat</button>
                        <a href="<?php echo site_url('transaction_out') ?>" class="btn btn-default">Cancel</a>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3>Akumulasi </h3>
                </div>
                <div class="box-body row">
                    <div class="form">
                        <div class="form-group col-md-6">
                            <label for="int">Tanggal Awal</label>
                            <input name="start_date" type="date" class="form-control" id="tgl_awal" placeholder="Tanggal Awal"
                                   value=""/>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="int">Tanggal Akhir</label>
                            <input name="end_date" type="date" class="form-control" id="tgl_akhir" placeholder="Tanggal Akhir"
                                   value=""/>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="int">Total Pengeluaran</label>
                            <h3 id="total_pengeluaran_view">Rp0</h3>
                        </div>
                        <div class="form-group col-md-12">
                            <button id="btn_akumulasi" type="submit" class="btn btn-primary">Total</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#btn_akumulasi").on('click', function() {
            akumulasiPengeluaran();
        });

       function akumulasiPengeluaran() {
           $.post("transaction_out/akumulasi", {
               "start_date": $("#tgl_awal").val(),
               "end_date": $("#tgl_akhir").val()
           }, function (response) {
               $akumulasi = JSON.parse(response).akumulasi;
               $("#total_pengeluaran_view").html("Rp" + $akumulasi);
           })
       }
    </script>
</section>

<section class="content">
    <div class='box'>
        <div class='box-header with-border'>
            <h2 style="margin-top:0px">Laporan Transaksi Keluar</h2>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                    <!--<?php echo anchor(site_url('transaction_out/create'), 'Create', 'class="btn btn-primary"'); ?>-->
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                    <form action="<?php echo site_url('transaction_out/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                            <?php
                            if ($q <> '') {
                                ?>
                                <a href="<?php echo site_url('transaction_out'); ?>" class="btn btn-default">Reset</a>
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
                    <th>Nama Barang</th>
                    <th>Tanggal</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th>Harga Total</th>
                    <th>Action</th>
                </tr><?php
                    foreach ($transaction_out_data as $transaction_out) {
                        ?>
                    <tr>
                        <td width="80px"><?php echo ++$start ?></td>
                        <td><?php echo $transaction_out->nama_barang ?></td>
                        <td><?php echo date('d-m-Y', strtotime($transaction_out->tanggal)) ?></td>
                        <td><?php echo number_format($transaction_out->harga, 2, ",", ".") ?></td>
                        <td><?php echo $transaction_out->quantity ?></td>
                        <td><?php echo number_format($transaction_out->harga_total, 2, ",", ".") ?></td>
                        <td style="text-align:center" width="200px">
                            <?php
                            echo anchor(site_url('transaction_out/read/' . $transaction_out->transaction_out_id), 'Read');
                            echo ' | ';
                            echo anchor(site_url('transaction_out/update/' . $transaction_out->transaction_out_id), 'Update');
                            echo ' | ';
                            echo anchor(site_url('transaction_out/delete/' . $transaction_out->transaction_out_id), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
                    <?php echo anchor(site_url('transaction_out/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
        </div>

    </div>
</section>
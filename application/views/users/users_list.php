<section class="content">
    <div class='box'>
        <div class='box-header with-border'>
            <h2 style="margin-top:0px">Daftar Pelanggan</h2>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-4">
                    <?php echo anchor(site_url('users/create'), 'Buat', 'class="btn btn-primary"'); ?>
                </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                    <form action="<?php echo site_url('users/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                            <?php
                            if ($q <> '') {
                                ?>
                                <a href="<?php echo site_url('users'); ?>" class="btn btn-default">Reset</a>
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
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Tanggal Bergabung</th>
                    <th>Saldo</th>
                    <th style="text-align: center">Action</th>
                </tr><?php
                    foreach ($users_data as $users) {
                        ?>
                    <tr>
                        <td width="80px"><?php echo ++$start ?></td>
                        <td><?php echo $users->first_name . " " . $users->last_name ?></td>
                        <td><?php echo $users->address ?></td>
                        <td><?php echo $users->phone ?></td>
                        <td><?php echo $users->created_at; ?></td>
                        <td><?php echo number_format($users->balance, 2, ",", ".") ?></td>

                        <td style="text-align:center" width="200px">
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <a href=<?= site_url('transactions/create/' . $users->id) ?> class="btn btn-default">Buat Transaksi</a>
                                <a href=<?= site_url('users/read/' . $users->id) ?> class="btn btn-default"><i class="fa fa-eye"></i></a>
                                <a href=<?= site_url('users/update/' . $users->id) ?> class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                <a href=<?= site_url('users/delete/' . $users->id) ?> class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
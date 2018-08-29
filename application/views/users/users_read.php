<section class='content'>
    <div class='box'>
        <div class='box-header with-border'>
            <h2 style="margin-top:0px">Detail User</h2>

        </div>
        <div class='box-body'>

            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <td>Username</td>
                            <td><?php echo $username; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $first_name; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $last_name; ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $phone; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $address; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Saldo</label>
                        <h2 style="margin-top: 0">Rp<?php echo $balance; ?></h2>
                    </div>
                    <?= form_open('users/add_saldo'); ?>
                    <label for="">Tambah Saldo</label>
                    <div class="input-group">
                        <input type="hidden" name="user_id" value=<?= $id ?>>
                        <input type="number" class="form-control" name="jumlah_saldo" placeholder="Tambah Saldo">
                        <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Tambah</button>
                            </span>
                    </div><!-- /input-group -->
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
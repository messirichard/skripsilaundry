<section class='content'>
    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Buat Pengguna</h2>
        </div>
        <div class='box-body'>

            
            <?php echo form_open($action) ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="varchar">Nama Awal <?php echo form_error('first_name') ?></label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Nama Awal"
                               value="<?php echo $first_name; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Akhir <?php echo form_error('last_name') ?></label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Nama Akhir"
                               value="<?php echo $last_name; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nomor Handphone <?php echo form_error('phone') ?></label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone"
                               value="<?php echo $phone; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat <?php echo form_error('address') ?></label>
                        <textarea class="form-control" rows="3" name="address" id="address"
                                  placeholder="Address"><?php echo $address; ?></textarea>
                    </div>

                    <?php
                    $userRole = $this->ion_auth->get_users_groups($this->ion_auth->users()->row()->id)->result()[0]->name;
                    if ( ($userRole == 'admin' || $userRole == 'karyawan') && $button == "Create"): ?>

                        <div class="form-group">
                            <label for="address">Saldo Awal <?php echo form_error('balance') ?></label>
                            <input type="number" class="form-control" rows="3" name="balance" id="balance" placeholder="Saldo Awal"
                                   value="<?php echo $balance; ?>">
                        </div>

                    <?php endif; ?>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="varchar">Username <?php echo form_error('username') ?></label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                               value="<?php echo $username; ?>"/>
                    </div>


                    <?php if ($button == 'Create' || $button == 'Create Employee'): ?>
                        <div class="form-group">
                            <label for="varchar">Password <?php echo form_error('password') ?></label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                                   value="<?php echo $password; ?>"/>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="varchar">Email <?php echo form_error('email') ?></label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                               value="<?php echo $email; ?>"/>
                    </div>

                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a>
            <?php echo form_close() ?>
        </div>
    </div>
</section>
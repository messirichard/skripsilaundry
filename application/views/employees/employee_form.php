
<section class='content'>
    <div class='box'>
        <div class='box-header'>
            <h2 style="margin-top:0px">Employee <?php echo $button ?></h2>
        </div>
        <div class='box-body'>
            <?php echo form_open($action)?>

            <div class="form-group">
                <label for="varchar">Username <?php echo form_error('username') ?></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
            </div>

            
            <?php if ($button == 'Create'): ?>

            <div class="form-group">
                <label for="varchar">Password <?php echo form_error('password') ?></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
            </div>

            <?php endif; ?>

            <div class="form-group">
                <label for="varchar">Email <?php echo form_error('email') ?></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
            </div>

            <div class="form-group">
                <label for="varchar">First Name <?php echo form_error('first_name') ?></label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $first_name; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Last Name <?php echo form_error('last_name') ?></label>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>" />
            </div>

            <div class="form-group">
                <label for="varchar">Phone <?php echo form_error('phone') ?></label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone; ?>" />
            </div>
            <div class="form-group">
                <label for="address">Address <?php echo form_error('address') ?></label>
                <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"><?php echo $address; ?></textarea>
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            <a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a>
            <?php echo form_close()?>
        </div>
    </div>
</section>
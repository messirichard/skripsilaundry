<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $user->first_name . " " . $user->last_name ?></p>
                <a href="#"><?php echo strtoupper($user_group->name)?></a>
            </div>
        </div>
        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">-->
        <!--    <div class="input-group">-->
        <!--        <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
        <!--        <span class="input-group-btn">-->
        <!--            <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>-->
        <!--        </span>-->
        <!--    </div>-->
        <!--</form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php if($this->ion_auth->in_group('admin')):?>
            <?php endif;?>
            
            <!--<li>-->
            <!--    <a href="<?= site_url('users') ?>">-->
            <!--        <i class="fa fa-dashboard"></i> <span>Members</span>-->
            <!--    </a>-->
            <!--</li>-->

            <li>
              
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Transaksi Masuk</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= site_url('users') ?>"><i class="fa fa-plus"></i>Transaksi Member</a></li>
                    <li><a href="<?= site_url('transactions/create') ?>"><i class="fa fa-plus"></i>Transaksi Non Member</a></li>
                    <li><a href="<?= site_url('transactions') ?>"><i class="fa fa-circle-o"></i>Laporan Transaksi Masuk</a></li>
                </ul>
            </li>
            </li>

            <li>
                <a href="<?= site_url('transaction_out') ?>">
                    <i class="fa fa-dashboard"></i> <span>Laporan Pengeluaran</span>
                </a>
            </li>

            <li>
                <a href="<?= site_url('transfers_report') ?>">
                    <i class="fa fa-dashboard"></i> <span>Bukti Transfer</span>
                </a>
            </li>

            <?php if($this->ion_auth->in_group('admin')):?>
                <li>
                <a href="<?= site_url('laundry_packets') ?>">
                    <i class="fa fa-dashboard"></i> <span>Paket Laundry</span> 
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Pegawai</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= site_url('employee') ?>"><i class="fa fa-circle-o"></i>Manage</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= site_url('groups') ?>">
                    <i class="fa fa-dashboard"></i> <span>User Group</span>
                </a>
            </li>
            <?php endif;?>
            <li class="header">SETTINGS</li>
            <li>
                <a href="#">
                    <i class="fa fa-th"></i> <span>Account Settings</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
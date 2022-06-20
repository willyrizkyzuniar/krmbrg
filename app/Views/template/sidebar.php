<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->

    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Master</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-tachometer-alt text-primary"></i>
                        <p class="text">Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= site_url('kategori/index'); ?>" class="nav-link">
                        <i class="nav-icon fa fa-tasks text-warning"></i>
                        <p class="text">Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('satuan/index'); ?>" class="nav-link">
                        <i class="nav-icon fa fa-angle-double-right text-info"></i>
                        <p class="text">Satuan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('barang/index'); ?>" class="nav-link">
                        <i class="nav-icon fa fa-box text-success"></i>
                        <p class="text">Barang</p>
                    </a>
                </li>

                <li class="nav-header">Transaksi</li>
                <li class="nav-item">
                    <a href="<?= site_url('barangmasuk/index'); ?>" class="nav-link">
                        <i class="nav-icon fa fa-arrow-circle-down text-light"></i>
                        <p class="text">Barang Masuk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-sign-out-alt text-danger"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
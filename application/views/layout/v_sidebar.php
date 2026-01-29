<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('home') ?>" class="brand-link">
        <img src="<?= base_url() ?>template/dist/img/logo.png" alt="CleanMap Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">MinnersMap</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Menu yang sudah ada -->
                <li class="nav-item">
                    <a href="<?= base_url('home') ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Tambang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('tambang/add') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Input Data Tambang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('tambang') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Tambang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('tambang/gallery') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Galery Tambang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('aktivitas/') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aktifitas Tambang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Authentication Links -->
                <li class="nav-item mt-auto">
                    <?php if (!$this->session->userdata('logged_in')): ?>
                        <a href="<?= base_url('auth/login') ?>" class="nav-link">
                            <i class="nav-icon fas fa-sign-in-alt"></i>
                            <p>Login</p>
                        </a>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p><?= $this->session->userdata('username') ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('auth/logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
</aside>
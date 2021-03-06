<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#home" aria-expanded="false" aria-controls="home">
                    <i class="icon-monitor menu-icon"></i>
                    <span class="menu-title">HOME</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="home">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>/homenoadmin">Beranda</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>/profilenoadmin">Profile</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>/gantipassnoadmin">Ganti Password</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#master" aria-expanded="false" aria-controls="master">
                    <i class="icon-grid-2 menu-icon"></i>
                    <span class="menu-title">MASTER</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="master">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>/barangnoadmin">Barang</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#trans_masuk" aria-expanded="false" aria-controls="trans_masuk">
                    <i class="icon-file-add menu-icon"></i>
                    <span class="menu-title">MASUK</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="trans_masuk">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>/brgmnadmin">Material Barang</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>/logmasukcair">Logistik Cair</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#trans_keluar" aria-expanded="false" aria-controls="trans_keluar">
                    <i class="icon-delete menu-icon"></i>
                    <span class="menu-title">KELUAR</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="trans_keluar">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>/brgknadmin">Material & Cair</a></li>
                    </ul>
                </div>
            </li>
            <!--
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="false" aria-controls="report">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">LAPORAN</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="report">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?php //echo base_url(); ?>/lapstoknadm">Stok</a></li>
                    </ul>
                </div>
            </li>
            -->
        </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">
<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">

            <ul class="nav nav-primary">
                <li class="nav-item <?php echo active("dashboard"); ?>">
                    <a href="?page=dashboard">
                        <i class="fas fa-chart-bar"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item  <?php echo active("transaksi_timbangan"); ?>">
                    <a href="?page=transaksi_timbangan">
                        <i class="fas  fa-bars"></i>
                        <p>Transaksi Timbangan</p>
                        <span class="badge badge-info"><?php echo jumlah_timbangan('all'); ?></span>
                    </a>
                </li>

                <li class="nav-item  <?php echo active("transaksi_pembelian"); ?>">
                    <a href="?page=transaksi_pembelian">
                        <i class="fas fa-money-check-alt"></i>
                        <p>Transaksi Pembelian</p>
                        <span class="badge badge-info"><?php echo jumlah_timbangan('Penerimaan'); ?></span>
                    </a>
                </li>
                <li class="nav-item  <?php echo active("transaksi_penjualan"); ?>">
                    <a href="?page=transaksi_penjualan">
                        <i class="fas  fa-shopping-cart"></i>
                        <p>Transaksi Penjualan</p>
                        <span class="badge badge-info"><?php echo jumlah_timbangan('Pengiriman'); ?></span>
                    </a>
                </li>


                <li class="nav-item  <?php echo active("report_timbangan"); ?>">
                    <a href="?page=report_timbangan">
                        <i class="fas  fa-file-excel"></i>
                        <p>Report Timbangan</p>
                    </a>
                </li>


                <li class="nav-item  <?php echo active("system_timbangan"); ?>">
                    <a href="?page=system_timbangan">
                        <i class="fas  fa-truck"></i>
                        <p>System Timbangan</p>
                    </a>
                </li>

                <?php
                if ($_SESSION['level'] == 'Admin') {
                    ?>
                    <li class="nav-item  <?php echo active("pengguna"); ?>">
                        <a href="?page=pengguna">
                            <i class="fas fa-users-cog"></i>
                            <p>Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item  <?php echo active("pengaturan"); ?>">
                        <a href="?page=pengaturan">
                            <i class="fas fa-cogs"></i>
                            <p>Pengaturan</p>
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
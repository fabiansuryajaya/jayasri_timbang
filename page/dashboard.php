<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2"><?php echo judul(); ?></h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                    </div>
                </div>
            </div>
        </div>

        <?php
            $data = array();
            $qry = "SELECT mode_timbang,SUM(timbang1) AS jm_timbang1,SUM(timbang2) AS jm_timbang2, ABS(SUM(timbang1)-SUM(timbang2)) AS netto,  IF(mode_timbang='Penerimaan',(ABS(SUM(timbang1)-SUM(timbang2))-(ABS(SUM(timbang1)-SUM(timbang2))*0.1)),0) AS stok_produksi   FROM tb_weighing_scale WHERE rowstatus=1 AND timbang1 > 0 AND timbang2 > 0 GROUP BY mode_timbang  ORDER BY mode_timbang ASC";
            $getData = mysqli_query($k, $qry);
            while ($row = mysqli_fetch_assoc($getData)) {
                $data[] = $row;
            }
        ?>


        <div class="page-inner mt--5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-stats card-info card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-cubes"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Stok Produksi</p>
                                        <h4 class="card-title"><?= number_format($data[0]['stok_produksi']); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card card-stats card-secondary card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Stok Penjualan</p>
                                        <h4 class="card-title"><?= number_format($data[1]['netto']); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stats card-success card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-list"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Stok Akhir</p>
                                        <h4 class="card-title">
                                            <?= number_format($data[0]['stok_produksi'] - $data[1]['netto']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->

                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title"> </div>
                            <h5>Penerimaan Harian (7 Hari Terakhir)</h5>

                            <div class="chart-container">
                                <canvas id="penerimaanHarian" style="width: 50%; height: 50%"></canvas>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title"> </div>
                            <h5>Penerimaan Bulanan</h5>

                            <div class="chart-container">
                                <canvas id="penerimaanBulanan" style="width: 50%; height: 50%"></canvas>
                            </div>

                        </div>
                    </div>
                </div>

                <!--  -->

                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title"> </div>
                            <h5>Penjualan Harian (7 Hari Terakhir)</h5>

                            <div class="chart-container">
                                <canvas id="penjualanHarian" style="width: 50%; height: 50%"></canvas>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title"> </div>
                            <h5>Penjualan Bulanan</h5>

                            <div class="chart-container">
                                <canvas id="penjualanBulanan" style="width: 50%; height: 50%"></canvas>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">


        const day = '<?= date('d'); ?>';
        const month = '<?= date('M'); ?>';
        const year = '<?= date('Y'); ?>';



        // Pemnerimaan Harian

        const tonase_penerimaan_harian = {
        };
        fetch('Ajax/dashboard.php?data=tonase_penerimaan_harian')
            .then(response => response.json())
            .then(data => {
                const labelsz = data.map(item => item.tanggal);
                const dataValuesz = data.map(item => item.netto);

                const chartData = {
                    labels: labelsz,
                    datasets: [{
                        label: 'Daily Netto',
                        data: dataValuesz,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false,
                    }]
                };

                const penjualanHarian = document.getElementById('penerimaanHarian').getContext('2d');
                const myChart = new Chart(penjualanHarian, {
                    type: 'line',
                    data: chartData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function (value) {
                                        return new Intl.NumberFormat('en-US', {
                                            style: 'decimal',
                                            useGrouping: true
                                        }).format(value);
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed.y !== null) {
                                            label += new Intl.NumberFormat('en-US', {
                                                style: 'decimal',
                                                useGrouping: true
                                            }).format(context.parsed.y);
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));

        // Bulanan

        const total_penerimaan_per_month = {
        };
        const labelsx = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const dataValuesx = labelsx.map((label, index) => {
            const month = (index + 1).toString().padStart(2, '0');
            return total_penerimaan_per_month[`${year}-${month}`] || 0;
        });

        fetch('Ajax/dashboard.php?data=total_penerimaan_per_month')
            .then(response => response.json())
            .then(total_penerimaan_per_month => {
                const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const dataValuesx = labels.map((label, index) => {
                    const month = (index + 1).toString().padStart(2, '0');
                    return total_penerimaan_per_month[`${year}-${month}`] || 0;
                });
                // Format numbers with grouped digits
                const formatter = new Intl.NumberFormat('en-US', {
                    style: 'decimal',
                    useGrouping: true
                });
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Total Harga Jual',
                        data: dataValues,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false,
                    }]
                };

                penjualanBulanan = document.getElementById('penerimaanBulanan').getContext('2d');

                const myChart = new Chart(penjualanBulanan, {
                    type: 'line',
                    data: data,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function (value) {
                                        return formatter.format(value);  // Format y-axis labels
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed.y !== null) {
                                            label += formatter.format(context.parsed.y);
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
        // ======================================


        // Penjualan Harian

        const tonase_penjualan_harian = {
        };
        fetch('Ajax/dashboard.php?data=tonase_penjualan_harian')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.tanggal);
                const dataValues = data.map(item => item.netto);

                const chartData = {
                    labels: labels,
                    datasets: [{
                        label: 'Daily Netto',
                        data: dataValues,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false,
                    }]
                };

                const penjualanHarian = document.getElementById('penjualanHarian').getContext('2d');
                const myChart = new Chart(penjualanHarian, {
                    type: 'line',
                    data: chartData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function (value) {
                                        return new Intl.NumberFormat('en-US', {
                                            style: 'decimal',
                                            useGrouping: true
                                        }).format(value);
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed.y !== null) {
                                            label += new Intl.NumberFormat('en-US', {
                                                style: 'decimal',
                                                useGrouping: true
                                            }).format(context.parsed.y);
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));

        // Bulanan

        const total_harga_per_month = {
        };
        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const dataValues = labels.map((label, index) => {
            const month = (index + 1).toString().padStart(2, '0');
            return total_harga_per_month[`${year}-${month}`] || 0;
        });

        fetch('Ajax/dashboard.php?data=total_harga_per_month')
            .then(response => response.json())
            .then(total_harga_per_month => {
                const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const dataValues = labels.map((label, index) => {
                    const month = (index + 1).toString().padStart(2, '0');
                    return total_harga_per_month[`${year}-${month}`] || 0;
                });
                // Format numbers with grouped digits
                const formatter = new Intl.NumberFormat('en-US', {
                    style: 'decimal',
                    useGrouping: true
                });
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Total Harga Jual',
                        data: dataValues,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false,
                    }]
                };

                penjualanBulanan = document.getElementById('penjualanBulanan').getContext('2d');

                const myChart = new Chart(penjualanBulanan, {
                    type: 'line',
                    data: data,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function (value) {
                                        return formatter.format(value);  // Format y-axis labels
                                    }
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed.y !== null) {
                                            label += formatter.format(context.parsed.y);
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</div>
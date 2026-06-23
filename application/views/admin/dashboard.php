<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        Dashboard Sales Order
    </h1>

    <div class="row">

        <!-- Total Pendapatan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pendapatan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp<?= number_format($total_pendapatan ?? 0, 0, ',', '.'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave stat-card-icon text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendapatan Bulan Ini -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Pendapatan Bulan Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp<?= number_format($pendapatan_bulan_ini ?? 0, 0, ',', '.'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt stat-card-icon text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Order -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Sales Order
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $total_order ?? 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-invoice-dollar stat-card-icon text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Stok Produk -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Stok Produk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $total_stok_produk ?? 0; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box stat-card-icon text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <!-- Grafik Pendapatan -->
        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">
                        Pendapatan Bulanan
                    </h6>
                </div>

                <div class="card-body">
                    <?php
                        $total_nilai_chart = array_sum($chart_pendapatan['values'] ?? []);
                    ?>
                    <?php if ($total_nilai_chart > 0): ?>
                        <canvas id="chartDashboard"></canvas>
                    <?php else: ?>
                        <div class="chart-empty-state">
                            <i class="fas fa-chart-line"></i>
                            <p>Belum ada data penjualan</p>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

        </div>

        <!-- Statistik -->
        <div class="col-lg-4">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">
                        Ringkasan Data
                    </h6>
                </div>

                <div class="card-body">

                    <h6 class="font-weight-bold text-gray-800">
                        Manajemen Data
                    </h6>

                    <div class="status-row">
                        <span class="text-gray-600">Jumlah Produk</span>
                        <strong><?= $jumlah_produk ?? 0; ?></strong>
                    </div>
                    <div class="status-row">
                        <span class="text-gray-600">Jumlah Pelanggan</span>
                        <strong><?= $jumlah_pelanggan ?? 0; ?></strong>
                    </div>
                    <div class="status-row">
                        <span class="text-gray-600">Jumlah Sales</span>
                        <strong><?= $jumlah_sales ?? 0; ?></strong>
                    </div>

                    <hr>

                    <h6 class="font-weight-bold text-gray-800">
                        Status Sales Order
                    </h6>

                    <div class="status-row">
                        <span class="badge-status badge-status-draft">Draft</span>
                        <strong><?= $order_draft ?? 0; ?></strong>
                    </div>
                    <div class="status-row">
                        <span class="badge-status badge-status-dikirim">Dikirim</span>
                        <strong><?= $order_dikirim ?? 0; ?></strong>
                    </div>
                    <div class="status-row">
                        <span class="badge-status badge-status-selesai">Selesai</span>
                        <strong><?= $order_selesai ?? 0; ?></strong>
                    </div>
                    <div class="status-row">
                        <span class="badge-status badge-status-dibatalkan">Dibatalkan</span>
                        <strong><?= $order_dibatalkan ?? 0; ?></strong>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php if (($total_nilai_chart ?? 0) > 0): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartDashboard');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($chart_pendapatan['labels'] ?? []); ?>,
        datasets: [{
            label: 'Pendapatan',
            data: <?= json_encode($chart_pendapatan['values'] ?? []); ?>,
            borderColor: '#10b981',
            backgroundColor: 'rgba(16,185,129,0.1)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#10b981',
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                ticks: {
                    callback: function(value) {
                        return 'Rp' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>
<?php endif; ?>
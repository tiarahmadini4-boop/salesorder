<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Manager</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan (Selesai)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp<?= number_format($total_pendapatan, 0, ',', '.') ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-money-bill-wave fa-2x text-success"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Sales Order</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_order ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-file-alt fa-2x text-primary"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Sales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_sales ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users fa-2x text-info"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_produk ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-box fa-2x text-warning"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="<?= site_url('manager/laporan') ?>" class="btn btn-success btn-lg">
            <i class="fas fa-chart-bar mr-2"></i> Lihat Laporan Penjualan
        </a>
    </div>
</div>
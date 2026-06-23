<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Penjualan</h1>

    <!-- Filter -->
    <div class="card shadow mb-4">
        <div class="card-header font-weight-bold text-success">Filter Laporan</div>
        <div class="card-body">
            <form method="get" action="<?= site_url('admin/laporan') ?>">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tanggal Dari</label>
                            <input type="date" name="tanggal_dari" class="form-control" value="<?= $tanggal_dari ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tanggal Sampai</label>
                            <input type="date" name="tanggal_sampai" class="form-control" value="<?= $tanggal_sampai ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sales</label>
                            <select name="id_sales" class="form-control">
                                <option value="">-- Semua Sales --</option>
                                <?php foreach ($list_sales as $s): ?>
                                    <option value="<?= $s->id_sales ?>" <?= $filter_sales == $s->id_sales ? 'selected' : '' ?>>
                                        <?= $s->nama ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Produk</label>
                            <select name="id_produk" class="form-control">
                                <option value="">-- Semua Produk --</option>
                                <?php foreach ($list_produk as $pr): ?>
                                    <option value="<?= $pr->id_produk ?>" <?= $filter_produk == $pr->id_produk ? 'selected' : '' ?>>
                                        <?= $pr->nama_produk ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <a href="<?= site_url('admin/laporan') ?>" class="btn btn-secondary btn-sm">Reset</a>
                <a href="<?= site_url('admin/laporan_cetak')
                    . '?tanggal_dari=' . $tanggal_dari
                    . '&tanggal_sampai=' . $tanggal_sampai
                    . '&id_sales=' . $filter_sales
                    . '&id_produk=' . $filter_produk ?>"
                   class="btn btn-danger btn-sm" target="_blank">
                    <i class="fas fa-file-pdf mr-1"></i> Export PDF
                </a>
            </form>
        </div>
    </div>

    <!-- Laporan Per Sales -->
    <div class="card shadow mb-4">
        <div class="card-header font-weight-bold text-success">Laporan Per Sales</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sales</th>
                        <th>Total Order</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($per_sales as $s): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $s->nama_sales ?></td>
                        <td><?= $s->total_order ?></td>
                        <td>Rp<?= number_format($s->total_pendapatan, 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Laporan Per Produk -->
    <div class="card shadow mb-4">
        <div class="card-header font-weight-bold text-success">Laporan Per Produk</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Total Terjual</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($per_produk as $pr): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $pr->nama_produk ?></td>
                        <td><?= $pr->total_terjual ?> unit</td>
                        <td>Rp<?= number_format($pr->total_pendapatan, 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Semua Sales Order -->
    <div class="card shadow mb-4">
        <div class="card-header font-weight-bold text-success">Semua Sales Order</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No Order</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Sales</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $o): ?>
                    <tr>
                        <td><?= $o->no_order ?></td>
                        <td><?= $o->tanggal_order ?></td>
                        <td><?= $o->nama_pelanggan ?></td>
                        <td><?= $o->nama_sales ?></td>
                        <td>Rp<?= number_format($o->total_harga, 0, ',', '.') ?></td>
                        <td>
                            <?php
                            $badge = ['draft'=>'warning','dikirim'=>'primary','selesai'=>'success','dibatalkan'=>'danger'];
                            $b = $badge[$o->status] ?? 'secondary';
                            ?>
                            <span class="badge badge-<?= $b ?>"><?= ucfirst($o->status) ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
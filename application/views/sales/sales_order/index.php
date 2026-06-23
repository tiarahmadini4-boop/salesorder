<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Order Saya</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Daftar Sales Order</h6>
            <a href="<?= site_url('sales/sales_order_tambah') ?>" class="btn btn-success btn-sm">
                <i class="fas fa-plus mr-1"></i> Buat Order Baru
            </a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No Order</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="6" class="text-center text-gray-500">Belum ada order</td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $o): ?>
                        <tr>
                            <td><?= $o->no_order ?></td>
                            <td><?= date('d/m/Y', strtotime($o->tanggal_order)) ?></td>
                            <td><?= $o->nama_pelanggan ?></td>
                            <td>Rp<?= number_format($o->total_harga, 0, ',', '.') ?></td>
                            <td>
                                <?php
                                $badge = ['draft'=>'warning','dikirim'=>'primary','selesai'=>'success','dibatalkan'=>'danger'];
                                $b = $badge[$o->status] ?? 'secondary';
                                ?>
                                <span class="badge badge-<?= $b ?>"><?= ucfirst($o->status) ?></span>
                            </td>
                            <td>
                                <?php if ($o->status == 'draft'): ?>
                                    <a href="<?= site_url('sales/sales_order_ubah_status/' . $o->id_order . '/dikirim') ?>"
                                       class="btn btn-primary btn-sm"
                                       onclick="return confirm('Ubah status ke Dikirim?')">
                                        <i class="fas fa-paper-plane"></i> Kirim
                                    </a>
                                    <a href="<?= site_url('sales/sales_order_ubah_status/' . $o->id_order . '/dibatalkan') ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Batalkan order ini?')">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                <?php elseif ($o->status == 'dikirim'): ?>
                                    <a href="<?= site_url('sales/sales_order_ubah_status/' . $o->id_order . '/selesai') ?>"
                                       class="btn btn-success btn-sm"
                                       onclick="return confirm('Tandai order sebagai Selesai?')">
                                        <i class="fas fa-check"></i> Selesai
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container-fluid">
 
    <h1 class="h3 mb-4 text-gray-800">Data Produk</h1>
 
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
 
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
 
    <div class="card shadow mb-4">
 
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Daftar Produk</h6>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambahProduk">
                <i class="fas fa-plus mr-1"></i> Tambah Produk
            </button>
        </div>
 
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($produk)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-gray-500">Belum ada data produk</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach ($produk as $p): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($p->kode_produk); ?></td>
                                    <td><?= htmlspecialchars($p->nama_produk); ?></td>
                                    <td>Rp<?= number_format($p->harga, 0, ',', '.'); ?></td>
                                    <td><?= $p->stok; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm"
                                            data-toggle="modal" data-target="#modalEditProduk"
                                            data-id="<?= $p->id_produk; ?>"
                                            data-kode="<?= htmlspecialchars($p->kode_produk); ?>"
                                            data-nama="<?= htmlspecialchars($p->nama_produk); ?>"
                                            data-harga="<?= $p->harga; ?>"
                                            data-stok="<?= $p->stok; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?= site_url('admin/produk_hapus/' . $p->id_produk); ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Hapus produk &quot;<?= htmlspecialchars($p->nama_produk); ?>&quot;? Tindakan ini tidak bisa dibatalkan.');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
 
    </div>
 
</div>
 
<!-- Modal Tambah Produk -->
<div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?= site_url('admin/produk_tambah'); ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text" name="kode_produk" class="form-control" placeholder="Contoh: TV-001" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: TV LED 32 Inch" required>
                    </div>
                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" min="0" step="1" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" min="0" step="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<!-- Modal Edit Produk -->
<div class="modal fade" id="modalEditProduk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?= site_url('admin/produk_edit'); ?>">
                <input type="hidden" name="id_produk" id="edit_id_produk">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Produk</label>
                        <input type="text" name="kode_produk" id="edit_kode_produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" id="edit_nama_produk" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" id="edit_harga" class="form-control" min="0" step="1" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" id="edit_stok" class="form-control" min="0" step="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<script>
$('#modalEditProduk').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    $('#edit_id_produk').val(button.data('id'));
    $('#edit_kode_produk').val(button.data('kode'));
    $('#edit_nama_produk').val(button.data('nama'));
    $('#edit_harga').val(button.data('harga'));
    $('#edit_stok').val(button.data('stok'));
});
</script>
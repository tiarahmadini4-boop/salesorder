<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Pelanggan</h1>

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
            <h6 class="m-0 font-weight-bold text-success">Daftar Pelanggan</h6>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambahPelanggan">
                <i class="fas fa-plus mr-1"></i> Tambah Pelanggan
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pelanggan)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-gray-500">Belum ada data pelanggan</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach ($pelanggan as $p): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($p->nama); ?></td>
                                    <td><?= htmlspecialchars($p->alamat); ?></td>
                                    <td><?= htmlspecialchars($p->telepon); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm"
                                            data-toggle="modal" data-target="#modalEditPelanggan"
                                            data-id="<?= $p->id_pelanggan; ?>"
                                            data-nama="<?= htmlspecialchars($p->nama); ?>"
                                            data-alamat="<?= htmlspecialchars($p->alamat); ?>"
                                            data-telepon="<?= htmlspecialchars($p->telepon); ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?= site_url('admin/pelanggan_hapus/' . $p->id_pelanggan); ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Hapus pelanggan &quot;<?= htmlspecialchars($p->nama); ?>&quot;? Tindakan ini tidak bisa dibatalkan.');">
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

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="modalTambahPelanggan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post"  action="<?= site_url('admin/pelanggan_tambah'); ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama pelanggan / toko" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
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

<!-- Modal Edit Pelanggan -->
<div class="modal fade" id="modalEditPelanggan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?= site_url('admin/pelanggan_edit'); ?>">
                <input type="hidden" name="id_pelanggan" id="edit_id_pelanggan">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="edit_alamat" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telepon" id="edit_telepon" class="form-control" required>
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
$(document).ready(function() {
    $('#modalEditPelanggan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id      = button.attr('data-id');
        var nama    = button.attr('data-nama');
        var alamat  = button.attr('data-alamat');
        var telepon = button.attr('data-telepon');

        $('#edit_id_pelanggan').val(id);
        $('#edit_nama').val(nama);
        $('#edit_alamat').val(alamat);
        $('#edit_telepon').val(telepon);
    });
});
</script>

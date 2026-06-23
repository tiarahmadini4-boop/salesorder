<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Sales</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-success">Daftar Sales</h6>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambahSales">
                <i class="fas fa-plus mr-1"></i> Tambah Sales
            </button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Kode Sales</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Username Login</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($sales)): ?>
                        <tr><td colspan="7" class="text-center text-gray-500">Belum ada data sales</td></tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($sales as $s): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($s->kode_sales); ?></td>
                            <td><?= htmlspecialchars($s->nama); ?></td>
                            <td><?= htmlspecialchars($s->telepon); ?></td>
                            <td>
                                <?php if ($s->punya_akun): ?>
                                    <span class="badge badge-success"><?= htmlspecialchars($s->username); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Belum punya akun</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($s->status == 'Aktif'): ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm"
                                    data-toggle="modal" data-target="#modalEditSales"
                                    data-id="<?= $s->id_sales; ?>"
                                    data-kode="<?= htmlspecialchars($s->kode_sales); ?>"
                                    data-nama="<?= htmlspecialchars($s->nama); ?>"
                                    data-telepon="<?= htmlspecialchars($s->telepon); ?>"
                                    data-status="<?= htmlspecialchars($s->status); ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= site_url('admin/sales_hapus/' . $s->id_sales); ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Hapus sales &quot;<?= htmlspecialchars($s->nama); ?>&quot; beserta akun loginnya?');">
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

<!-- Modal Tambah Sales -->
<div class="modal fade" id="modalTambahSales" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?= site_url('admin/sales_tambah'); ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sales</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Sales</label>
                        <input type="text" name="kode_sales" class="form-control" placeholder="Contoh: SLS-004" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <hr>
                    <p class="text-xs text-gray-600 mb-2">Akun login otomatis dibuat untuk sales ini:</p>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
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

<!-- Modal Edit Sales -->
<div class="modal fade" id="modalEditSales" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?= site_url('admin/sales_edit'); ?>">
                <input type="hidden" name="id_sales" id="edit_id_sales">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sales</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Sales</label>
                        <input type="text" name="kode_sales" id="edit_kode_sales" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telepon" id="edit_telepon" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="edit_status" class="form-control" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
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
    $('#modalEditSales').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $('#edit_id_sales').val(button.attr('data-id'));
        $('#edit_kode_sales').val(button.attr('data-kode'));
        $('#edit_nama').val(button.attr('data-nama'));
        $('#edit_telepon').val(button.attr('data-telepon'));
        $('#edit_status').val(button.attr('data-status'));
    });
});
</script>
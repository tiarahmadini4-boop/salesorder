<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Buat Order Baru</h1>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('sales/sales_order_simpan') ?>">

        <div class="card shadow mb-4">
            <div class="card-header font-weight-bold text-success">Informasi Order</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Pelanggan <span class="text-danger">*</span></label>
                    <select name="id_pelanggan" class="form-control" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php foreach ($pelanggan as $p): ?>
                            <option value="<?= $p->id_pelanggan ?>"><?= $p->nama ?> — <?= $p->telepon ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <span class="font-weight-bold text-success">Daftar Produk</span>
                <button type="button" class="btn btn-success btn-sm" onclick="tambahBaris()">
                    <i class="fas fa-plus mr-1"></i> Tambah Produk
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelProduk">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th width="120">Harga Satuan</th>
                                <th width="100">Jumlah</th>
                                <th width="150">Subtotal</th>
                                <th width="50"></th>
                            </tr>
                        </thead>
                        <tbody id="barisProduk">
                            <!-- baris produk dinamis -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right font-weight-bold">Total Harga:</td>
                                <td class="font-weight-bold text-success" id="totalHarga">Rp0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="<?= site_url('sales/sales_order') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save mr-1"></i> Simpan Order
            </button>
        </div>

    </form>
</div>

<script>
// Data produk dari PHP
const dataProduk = <?= json_encode(array_map(function($p) {
    return [
        'id'    => $p->id_produk,
        'nama'  => $p->nama_produk,
        'kode'  => $p->kode_produk,
        'harga' => $p->harga,
        'stok'  => $p->stok,
    ];
}, $produk)) ?>;

let barisCount = 0;

function tambahBaris() {
    barisCount++;
    const idx = barisCount;

    let optionsProduk = '<option value="">-- Pilih Produk --</option>';
    dataProduk.forEach(p => {
        optionsProduk += `<option value="${p.id}" data-harga="${p.harga}" data-stok="${p.stok}">${p.kode} - ${p.nama} (Stok: ${p.stok})</option>`;
    });

    const baris = `
    <tr id="baris_${idx}">
        <td>
            <select name="id_produk[]" class="form-control form-control-sm select-produk" required onchange="updateHarga(this, ${idx})">
                ${optionsProduk}
            </select>
        </td>
        <td>
            <input type="text" id="harga_${idx}" class="form-control form-control-sm" readonly placeholder="Rp0">
        </td>
        <td>
            <input type="number" name="jumlah[]" id="jumlah_${idx}" class="form-control form-control-sm"
                   min="1" value="1" required onchange="updateSubtotal(${idx})">
        </td>
        <td>
            <input type="text" id="subtotal_${idx}" class="form-control form-control-sm" readonly placeholder="Rp0">
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(${idx})">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>`;

    document.getElementById('barisProduk').insertAdjacentHTML('beforeend', baris);
}

function updateHarga(select, idx) {
    const opt = select.options[select.selectedIndex];
    const harga = parseInt(opt.dataset.harga) || 0;
    const stok  = parseInt(opt.dataset.stok) || 0;

    document.getElementById(`harga_${idx}`).value = harga > 0 ? 'Rp' + harga.toLocaleString('id-ID') : 'Rp0';
    document.getElementById(`jumlah_${idx}`).max = stok;
    updateSubtotal(idx);
}

function updateSubtotal(idx) {
    const hargaText = document.getElementById(`harga_${idx}`).value.replace(/[^0-9]/g, '');
    const harga   = parseInt(hargaText) || 0;
    const jumlah  = parseInt(document.getElementById(`jumlah_${idx}`).value) || 0;
    const subtotal = harga * jumlah;

    document.getElementById(`subtotal_${idx}`).value = 'Rp' + subtotal.toLocaleString('id-ID');
    hitungTotal();
}

function hapusBaris(idx) {
    document.getElementById(`baris_${idx}`).remove();
    hitungTotal();
}

function hitungTotal() {
    let total = 0;
    document.querySelectorAll('[id^="subtotal_"]').forEach(el => {
        total += parseInt(el.value.replace(/[^0-9]/g, '')) || 0;
    });
    document.getElementById('totalHarga').textContent = 'Rp' + total.toLocaleString('id-ID');
}

// Tambah 1 baris otomatis saat halaman load
tambahBaris();
</script>

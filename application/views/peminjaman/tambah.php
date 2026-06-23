<div class="container-fluid">
<h2 class="h3 mb-4 text-gray-800">Tambah Peminjaman</h2>

<div class="card shadow">
    <div class="card-body">
<form method="post" action="<?= site_url('peminjaman/simpan'); ?>">
    <div class="form-group">
    <label>Anggota</label><br>
    <select name="anggota_id" class="form-control">
        <?php foreach($anggota as $a): ?>
            <option value="<?= $a->id; ?>"><?= $a->nama;?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
    <label>Buku</label><br>
    <select name="buku_id" class="form-control">
        <?php foreach($buku as $b): ?>
            <option value="<?= $b->id; ?>"><?= $b->judul;?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Tanggal Jatuh Tempo</label>
            <input type="date" name="tanggal-jatuh_tempo" class="form-control" required>
        </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    

</form>
</div>
</div>
</div>
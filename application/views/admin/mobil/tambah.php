<div class="container-fluid">

    <h2 class="h3 mb-4 text-gray-800">Tambah Mobil</h2>

    <div class="card shadow">
        <div class="card-body">

            <form method="post" action="<?= site_url('mobil/simpan'); ?>">

                <div class="form-group">
                    <label>Merk Mobil</label>
                    <input type="text" name="merk" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Tipe Mobil</label>
                    <input type="text" name="tipe" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Plat Nomor</label>
                    <input type="text" name="plat_nomor" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Transmisi</label>
                    <select name="transmisi" class="form-control" required>
                        <option value="">-- Pilih Transmisi --</option>
                        <option value="Manual">Manual</option>
                        <option value="Matic">Matic</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kapasitas Kursi</label>
                    <input type="number" name="kapasitas_kursi" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Bahan Bakar</label>
                    <input type="text" name="bahan_bakar" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Harga Harian</label>
                    <input type="number" name="harga_harian" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Harga Mingguan</label>
                    <input type="number" name="harga_mingguan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Harga Bulanan</label>
                    <input type="number" name="harga_bulanan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Disewa">Disewa</option>
                        <option value="Servis">Servis</option>
                    </select>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="<?= site_url('mobil'); ?>" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
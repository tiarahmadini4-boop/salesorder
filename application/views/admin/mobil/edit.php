<div class="container-fluid">

    <h2 class="h3 mb-4 text-gray-800">Form Edit Mobil</h2>

    <div class="card shadow">
        <div class="card-body">

            <form method="post" action="<?= site_url('mobil/update'); ?>">

                <input type="hidden" name="id_mobil"
                       value="<?= $mobil->id_mobil; ?>">

                <div class="form-group">
                    <label>Merk Mobil</label>
                    <input type="text"
                           name="merk"
                           class="form-control"
                           value="<?= $mobil->merk; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Tipe Mobil</label>
                    <input type="text"
                           name="tipe"
                           class="form-control"
                           value="<?= $mobil->tipe; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Plat Nomor</label>
                    <input type="text"
                           name="plat_nomor"
                           class="form-control"
                           value="<?= $mobil->plat_nomor; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number"
                           name="tahun"
                           class="form-control"
                           value="<?= $mobil->tahun; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Transmisi</label>
                    <select name="transmisi" class="form-control">

                        <option value="Manual"
                        <?= ($mobil->transmisi == 'Manual') ? 'selected' : ''; ?>>
                            Manual
                        </option>

                        <option value="Matic"
                        <?= ($mobil->transmisi == 'Matic') ? 'selected' : ''; ?>>
                            Matic
                        </option>

                    </select>
                </div>

                <div class="form-group">
                    <label>Kapasitas Kursi</label>
                    <input type="number"
                           name="kapasitas_kursi"
                           class="form-control"
                           value="<?= $mobil->kapasitas_kursi; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Bahan Bakar</label>
                    <input type="text"
                           name="bahan_bakar"
                           class="form-control"
                           value="<?= $mobil->bahan_bakar; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Harga Harian</label>
                    <input type="number"
                           name="harga_harian"
                           class="form-control"
                           value="<?= $mobil->harga_harian; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Harga Mingguan</label>
                    <input type="number"
                           name="harga_mingguan"
                           class="form-control"
                           value="<?= $mobil->harga_mingguan; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Harga Bulanan</label>
                    <input type="number"
                           name="harga_bulanan"
                           class="form-control"
                           value="<?= $mobil->harga_bulanan; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="Tersedia"
                        <?= ($mobil->status == 'Tersedia') ? 'selected' : ''; ?>>
                            Tersedia
                        </option>

                        <option value="Disewa"
                        <?= ($mobil->status == 'Disewa') ? 'selected' : ''; ?>>
                            Disewa
                        </option>

                        <option value="Servis"
                        <?= ($mobil->status == 'Servis') ? 'selected' : ''; ?>>
                            Servis
                        </option>

                    </select>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="<?= site_url('mobil'); ?>"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
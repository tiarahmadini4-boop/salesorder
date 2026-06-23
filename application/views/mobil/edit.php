<div class="container-fluid">

<h2 class="h3 mb-4 text-gray-800">Form Edit Mobil</h2>

<div class="card shadow">
    <div class="card-body">

        <form method="post" action="<?= site_url('mobil/update/'.$mobil->id_mobil); ?>">

            <div class="form-group">
                <label>Merk Mobil</label>
                <input type="text" name="merk" class="form-control"
                       value="<?= $mobil->merk; ?>" required>
            </div>

            <div class="form-group">
                <label>Tipe Mobil</label>
                <input type="text" name="tipe" class="form-control"
                       value="<?= $mobil->tipe; ?>" required>
            </div>

            <div class="form-group">
                <label>Plat Nomor</label>
                <input type="text" name="plat_nomor" class="form-control"
                       value="<?= $mobil->plat_nomor; ?>" required>
            </div>

            <div class="form-group">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control"
                       value="<?= $mobil->tahun; ?>" required>
            </div>

            <div class="form-group">
                <label>Harga Sewa</label>
                <input type="number" name="harga_sewa" class="form-control"
                       value="<?= $mobil->harga_sewa; ?>" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">

                    <option value="Tersedia"
                    <?= ($mobil->status=='Tersedia') ? 'selected' : ''; ?>>
                        Tersedia
                    </option>

                    <option value="Disewa"
                    <?= ($mobil->status=='Disewa') ? 'selected' : ''; ?>>
                        Disewa
                    </option>

                    <option value="Servis"
                    <?= ($mobil->status=='Servis') ? 'selected' : ''; ?>>
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
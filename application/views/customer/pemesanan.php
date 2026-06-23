<div class="container-fluid">

    <h2 class="h3 mb-4 text-gray-800">
    Form Pemesanan Mobil
    </h2>

    <div class="card shadow-lg">
        <div class="card-body">

            <form action="<?= site_url('pemesanan/simpan'); ?>" method="post">

               <div class="form-group">
                <label>Nama Customer</label>

                <input type="text"
                    class="form-control"
                    name="nama_customer"
                    required>

                <input type="hidden"
    name="id_pelanggan"
    value="<?= $this->session->userdata('id_user'); ?>">

                <div class="form-group">
                    <label>Pilih Mobil</label>
                    <select name="id_mobil" class="form-control" required>
                        <option value="">-- Pilih Mobil --</option>

                        <?php foreach($mobil as $m){ ?>
                            <option value="<?= $m->id_mobil; ?>">
                                <?= $m->merk; ?> -
                                <?= $m->tipe; ?>
                                (Rp <?= number_format($m->harga_harian,0,',','.'); ?>/Hari)
                            </option>
                        <?php } ?>

                    </select>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <label>Tanggal Sewa</label>
                        <input type="date"
                                name="tanggal_sewa"
                                class="form-control"
                                required>
                    </div>

                    <div class="col-md-6">
                        <label>Tanggal Kembali</label>
                        <input type="date"
                               name="tanggal_kembali"
                               class="form-control"
                               required>
                    </div>

                </div>

                <br>

                <div class="form-group">
                    <label>Lama Sewa (Hari)</label>
                    <input type="number"
                           name="lama_sewa"
                           class="form-control"
                           min="1"
                           required>
                </div>

                <div class="form-group">
                    <label>Sewa Keluar Kota</label>

                    <select name="luar_kota" class="form-control">
                        <option value="Tidak">
                            Tidak (+0%)
                        </option>

                        <option value="Ya">
                            Ya (+20% dari Total Sewa)
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Supir</label>

                    <select name="id_supir" class="form-control">

                        <option value="">
                            Tanpa Supir
                        </option>

                        <?php foreach($supir as $s){ ?>

                        <option value="<?= $s->id_supir; ?>">
                            <?= $s->nama; ?>
                        </option>

                        <?php } ?>

                    </select>

                    <small class="text-muted">
                        Kosongkan jika ingin lepas kunci.
                    </small>

                </div>

                <div class="form-group">
                    <label>Metode Pembayaran</label>

                    <select name="metode_pembayaran"
                            class="form-control"
                            required>

                        <option value="">
                            -- Pilih Metode Pembayaran --
                        </option>

                        <option value="Transfer Bank">
                            Transfer Bank BCA
                        </option>

                        <option value="Transfer Bank">
                            Transfer Bank Mandiri
                        </option>

                        <option value="E-Wallet">
                            E-Wallet (Dana, OVO, GoPay)
                        </option>

                        <option value="Cash">
                            Cash
                        </option>

                    </select>
                </div>

                <div class="form-group">
                    <label>Alamat Penjemputan</label>

                    <textarea name="alamat"
                              class="form-control"
                              rows="3"
                              required></textarea>
                </div>

                <div class="form-group">
                    <label>Catatan Tambahan</label>

                    <textarea name="catatan"
                              class="form-control"
                              rows="2"></textarea>
                </div>

                <hr>

                <div class="alert alert-info">
                    <b>Informasi :</b><br>
                    • Sewa keluar kota dikenakan biaya tambahan <b>20%</b>.<br>
                    • Pemesanan akan diproses setelah pembayaran berhasil.<br>
                    • Customer dapat memilih menggunakan supir atau lepas kunci.
                </div>

                <button type="submit"
                        class="btn btn-success btn-lg">
                    <i class="fas fa-credit-card"></i>
                    Submit
                </button>

                <a href="<?= site_url('customer/dashboard'); ?>"
                    class="btn btn-secondary btn-lg">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
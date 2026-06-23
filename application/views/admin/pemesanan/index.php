<div class="container-fluid">

    <div class="card shadow mb-4">

        <div class="card-body">

            <h2 class="mb-4">
                Data Pemesanan Mobil
            </h2>

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead class="bg-primary text-white">

                        <tr>

                            <th>ID</th>
                            <th>Nama Customer</th>
                            <th>ID Mobil</th>
                            <th>Tanggal Sewa</th>
                            <th>Tanggal Kembali</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(!empty($pemesanan)): ?>

                        <?php foreach($pemesanan as $p): ?>

                        <tr>

                            <td><?= $p->id_pemesanan; ?></td>

                            <td><?= $p->nama_customer; ?></td>

                            <td><?= $p->id_mobil; ?></td>

                            <td><?= $p->tanggal_sewa; ?></td>

                            <td><?= $p->tanggal_kembali; ?></td>

                            <td>

                                <?php if($p->metode_pembayaran == 'Transfer Bank'): ?>

                                    <span class="badge badge-primary">
                                        Transfer Bank
                                    </span>

                                <?php elseif($p->metode_pembayaran == 'Cash'): ?>

                                    <span class="badge badge-success">
                                        Cash
                                    </span>

                                <?php elseif($p->metode_pembayaran == 'QRIS'): ?>

                                    <span class="badge badge-info">
                                        QRIS
                                    </span>

                                <?php elseif($p->metode_pembayaran == 'E-Wallet'): ?>

                                    <span class="badge badge-warning">
                                        E-Wallet
                                    </span>

                                <?php else: ?>

                                    <span class="badge badge-secondary">
                                        Belum Dipilih
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <?php if($p->status == 'Diproses'): ?>

                                    <span class="badge badge-warning">
                                        Diproses
                                    </span>

                                <?php elseif($p->status == 'Lunas'): ?>

                                    <span class="badge badge-success">
                                        Lunas
                                    </span>

                                <?php else: ?>

                                    <span class="badge badge-secondary">
                                        <?= $p->status; ?>
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <a href="<?= site_url('pemesanan/cetak_kwitansi/'.$p->id_pemesanan); ?>"
                                   target="_blank"
                                   class="btn btn-success btn-sm">

                                    <i class="fas fa-print"></i>
                                    Cetak

                                </a>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="8" class="text-center">

                                Tidak ada data pemesanan

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
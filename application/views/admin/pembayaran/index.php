<div class="container-fluid">

    <h2 class="mb-4">Data Pembayaran</h2>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>No</th>
                <th>ID Pemesanan</th>
                <th>Nama Customer</th>
                <th>Metode</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        <?php $no=1; foreach($pembayaran as $p): ?>

        <tr>

            <td><?= $no++; ?></td>

            <td><?= $p->id_pemesanan; ?></td>

            <td><?= $p->nama_customer; ?></td>

            <td><?= $p->metode_pembayaran; ?></td>

            <td>
                Rp <?= number_format($p->total_harga,0,',','.'); ?>
            </td>

            <td>

                <?php if($p->status_pembayaran=='verified'): ?>

                    <span class="badge badge-success">
                        Verified
                    </span>

                <?php else: ?>

                    <span class="badge badge-warning">
                        Pending
                    </span>

                <?php endif; ?>

            </td>

            <td>

                <?php if($p->status_pembayaran=='pending'): ?>

                <a href="<?= site_url('pembayaran/verifikasi/'.$p->id_pemesanan); ?>"
                   class="btn btn-primary btn-sm">

                    Verifikasi

                </a>

                <?php endif; ?>

            </td>

        </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>
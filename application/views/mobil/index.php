<div class="container-fluid">

<h2 class="h3 mb-4 text-gray-800">Data Mobil</h2>

<a href="<?= site_url('mobil/tambah'); ?>" class="btn btn-primary mb-3">
    Tambah Mobil
</a>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered" width="100%">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Merk</th>
                        <th>Tipe</th>
                        <th>Plat Nomor</th>
                        <th>Tahun</th>
                        <th>Harga Sewa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php $no=1; foreach($mobil as $m): ?>

                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $m->merk; ?></td>
                        <td><?= $m->tipe; ?></td>
                        <td><?= $m->plat_nomor; ?></td>
                        <td><?= $m->tahun; ?></td>
                        <td>
                            Rp <?= number_format($m->harga_sewa,0,',','.'); ?>
                        </td>
                        <td>
                            <?php if($m->status=='Tersedia'): ?>
                                <span class="badge badge-success">
                                    Tersedia
                                </span>
                            <?php elseif($m->status=='Disewa'): ?>
                                <span class="badge badge-warning">
                                    Disewa
                                </span>
                            <?php else: ?>
                                <span class="badge badge-danger">
                                    Servis
                                </span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="<?= site_url('mobil/edit/'.$m->id_mobil); ?>"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a href="<?= site_url('mobil/hapus/'.$m->id_mobil); ?>"
                               onclick="return confirm('Yakin ingin menghapus data ini?')"
                               class="btn btn-danger btn-sm">
                                Hapus
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>
    </div>
</div>

</div>
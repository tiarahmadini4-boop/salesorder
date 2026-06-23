<div class="container-fluid">

    <h2 class="h3 mb-4 text-gray-800">Data Mobil</h2>

    <a href="<?= site_url('mobil/tambah'); ?>"
       class="btn btn-primary mb-3">
        Tambah Mobil
    </a>

    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover" width="100%">

                    <thead class="thead-dark">
                        <tr align="center">
                            <th>No</th>
                            <th>Merk</th>
                            <th>Tipe</th>
                            <th>Plat Nomor</th>
                            <th>Tahun</th>
                            <th>Transmisi</th>
                            <th>Kursi</th>
                            <th>Bahan Bakar</th>
                            <th>Harian</th>
                            <th>Mingguan</th>
                            <th>Bulanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if(!empty($mobil)) : ?>

                        <?php $no = 1; foreach($mobil as $m): ?>

                        <tr>
                            <td align="center"><?= $no++; ?></td>
                            <td><?= $m->merk; ?></td>
                            <td><?= $m->tipe; ?></td>
                            <td><?= $m->plat_nomor; ?></td>
                            <td align="center"><?= $m->tahun; ?></td>
                            <td align="center"><?= $m->transmisi; ?></td>
                            <td align="center"><?= $m->kapasitas_kursi; ?></td>
                            <td><?= $m->bahan_bakar; ?></td>

                            <td>Rp <?= number_format($m->harga_harian,0,',','.'); ?></td>
                            <td>Rp <?= number_format($m->harga_mingguan,0,',','.'); ?></td>
                            <td>Rp <?= number_format($m->harga_bulanan,0,',','.'); ?></td>

                            <td align="center">

                                <?php if($m->status == 'Tersedia'): ?>
                                    <span class="badge badge-success">Tersedia</span>
                                <?php elseif($m->status == 'Disewa'): ?>
                                    <span class="badge badge-warning">Disewa</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Servis</span>
                                <?php endif; ?>

                            </td>

                            <td align="center">

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

                    <?php else: ?>

                        <tr>
                            <td colspan="13" class="text-center">
                                Data mobil belum tersedia
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>
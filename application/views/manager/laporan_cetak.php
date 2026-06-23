<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan - PT Maju Jaya</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; padding: 20px; }

        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { font-size: 16px; font-weight: bold; }
        .header p { font-size: 11px; color: #555; margin-top: 4px; }

        .periode { margin-bottom: 15px; font-size: 11px; }
        .periode span { font-weight: bold; }

        h3 { font-size: 13px; margin: 20px 0 8px; border-left: 4px solid #28a745; padding-left: 8px; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #28a745; color: white; padding: 7px 8px; text-align: left; font-size: 11px; }
        td { padding: 6px 8px; border-bottom: 1px solid #ddd; font-size: 11px; }
        tr:nth-child(even) td { background-color: #f9f9f9; }

        .footer { text-align: right; margin-top: 30px; font-size: 11px; color: #555; }

        .btn-print {
            display: block;
            margin: 0 auto 20px;
            padding: 8px 24px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
        }

        @media print {
            .btn-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body>

    <button class="btn-print" onclick="window.print()">
        🖨️ Cetak / Simpan PDF
    </button>

    <div class="header">
        <h2>LAPORAN PENJUALAN</h2>
        <h2>PT MAJU JAYA</h2>
        <p>Sistem Sales Order - Laporan Resmi</p>
    </div>

    <div class="periode">
        Periode:
        <span>
            <?php if ($tanggal_dari || $tanggal_sampai): ?>
                <?= $tanggal_dari ? date('d/m/Y', strtotime($tanggal_dari)) : '...' ?>
                s/d
                <?= $tanggal_sampai ? date('d/m/Y', strtotime($tanggal_sampai)) : '...' ?>
            <?php else: ?>
                Semua Periode
            <?php endif; ?>
        </span>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        Dicetak: <span><?= date('d/m/Y H:i') ?></span>
    </div>

    <!-- Laporan Per Sales -->
    <h3>Laporan Per Sales</h3>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Sales</th>
                <th width="15%">Total Order</th>
                <th width="25%">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; $grand_sales = 0; foreach ($per_sales as $s): $grand_sales += $s->total_pendapatan; ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $s->nama_sales ?></td>
                <td><?= $s->total_order ?> order</td>
                <td>Rp<?= number_format($s->total_pendapatan, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="font-weight:bold; text-align:right;">Total</td>
                <td style="font-weight:bold;">Rp<?= number_format($grand_sales, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Laporan Per Produk -->
    <h3>Laporan Per Produk</h3>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Produk</th>
                <th width="15%">Total Terjual</th>
                <th width="25%">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; $grand_produk = 0; foreach ($per_produk as $pr): $grand_produk += $pr->total_pendapatan; ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $pr->nama_produk ?></td>
                <td><?= $pr->total_terjual ?> unit</td>
                <td>Rp<?= number_format($pr->total_pendapatan, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" style="font-weight:bold; text-align:right;">Total</td>
                <td style="font-weight:bold;">Rp<?= number_format($grand_produk, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Semua Sales Order -->
    <h3>Detail Semua Sales Order</h3>
    <table>
        <thead>
            <tr>
                <th>No Order</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Sales</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $grand_order = 0; foreach ($orders as $o): $grand_order += $o->total_harga; ?>
            <tr>
                <td><?= $o->no_order ?></td>
                <td><?= date('d/m/Y', strtotime($o->tanggal_order)) ?></td>
                <td><?= $o->nama_pelanggan ?></td>
                <td><?= $o->nama_sales ?></td>
                <td>Rp<?= number_format($o->total_harga, 0, ',', '.') ?></td>
                <td><?= ucfirst($o->status) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4" style="font-weight:bold; text-align:right;">Total</td>
                <td style="font-weight:bold;">Rp<?= number_format($grand_order, 0, ',', '.') ?></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Laporan digenerate otomatis oleh Sistem Sales Order PT Maju Jaya
    </div>

</body>
</html>

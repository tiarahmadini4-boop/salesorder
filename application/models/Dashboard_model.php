<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Statistik untuk Admin & Manager (lihat semua data, tidak difilter sales)
     */
    public function get_statistik_global()
    {
        $data = [];

        // Total nilai order yang sudah selesai (dianggap sebagai "pendapatan")
        $total_pendapatan = $this->db->select_sum('total_harga')
            ->from('sales_order')
            ->where('status', 'selesai')
            ->get()->row();
        $data['total_pendapatan'] = $total_pendapatan->total_harga ?? 0;

        // Pendapatan bulan ini (order selesai di bulan & tahun berjalan)
        $pendapatan_bulan_ini = $this->db->select_sum('total_harga')
            ->from('sales_order')
            ->where('status', 'selesai')
            ->where('MONTH(tanggal_order)', date('m'))
            ->where('YEAR(tanggal_order)', date('Y'))
            ->get()->row();
        $data['pendapatan_bulan_ini'] = $pendapatan_bulan_ini->total_harga ?? 0;

        // Total seluruh sales order (semua status)
        $data['total_order'] = $this->db->count_all('sales_order');

        // Total stok produk tersedia (sum seluruh stok)
        $total_stok = $this->db->select_sum('stok')
            ->from('produk')
            ->get()->row();
        $data['total_stok_produk'] = $total_stok->stok ?? 0;

        // Breakdown jumlah produk
        $data['jumlah_produk'] = $this->db->count_all('produk');
        $data['jumlah_pelanggan'] = $this->db->count_all('pelanggan');
        $data['jumlah_sales'] = $this->db->count_all('sales');

        // Breakdown order per status
        $data['order_draft']     = $this->_hitung_order_per_status('draft');
        $data['order_dikirim']   = $this->_hitung_order_per_status('dikirim');
        $data['order_selesai']   = $this->_hitung_order_per_status('selesai');
        $data['order_dibatalkan'] = $this->_hitung_order_per_status('dibatalkan');

        // Data untuk chart pendapatan bulanan (6 bulan terakhir)
        $data['chart_pendapatan'] = $this->_get_chart_pendapatan_bulanan();

        return $data;
    }

    /**
     * Statistik untuk Sales (hanya order milik sales yang login)
     */
    public function get_statistik_sales($id_sales)
    {
        $data = [];

        $total_pendapatan = $this->db->select_sum('total_harga')
            ->from('sales_order')
            ->where('status', 'selesai')
            ->where('id_sales', $id_sales)
            ->get()->row();
        $data['total_pendapatan'] = $total_pendapatan->total_harga ?? 0;

        $pendapatan_bulan_ini = $this->db->select_sum('total_harga')
            ->from('sales_order')
            ->where('status', 'selesai')
            ->where('id_sales', $id_sales)
            ->where('MONTH(tanggal_order)', date('m'))
            ->where('YEAR(tanggal_order)', date('Y'))
            ->get()->row();
        $data['pendapatan_bulan_ini'] = $pendapatan_bulan_ini->total_harga ?? 0;

        $data['total_order'] = $this->db->where('id_sales', $id_sales)
            ->count_all_results('sales_order');

        $data['order_draft']      = $this->_hitung_order_per_status('draft', $id_sales);
        $data['order_dikirim']    = $this->_hitung_order_per_status('dikirim', $id_sales);
        $data['order_selesai']    = $this->_hitung_order_per_status('selesai', $id_sales);
        $data['order_dibatalkan'] = $this->_hitung_order_per_status('dibatalkan', $id_sales);

        $data['chart_pendapatan'] = $this->_get_chart_pendapatan_bulanan($id_sales);

        return $data;
    }

    /**
     * Helper: hitung jumlah order berdasarkan status, opsional difilter per sales
     */
    private function _hitung_order_per_status($status, $id_sales = null)
    {
        $this->db->where('status', $status);
        if ($id_sales !== null) {
            $this->db->where('id_sales', $id_sales);
        }
        return $this->db->count_all_results('sales_order');
    }

    /**
     * Helper: ambil data pendapatan 6 bulan terakhir untuk chart line
     * Mengembalikan array asosiatif ['labels' => [...], 'values' => [...]]
     */
    private function _get_chart_pendapatan_bulanan($id_sales = null)
    {
        $labels = [];
        $values = [];

        for ($i = 5; $i >= 0; $i--) {
            $bulan = date('m', strtotime("-$i months"));
            $tahun = date('Y', strtotime("-$i months"));
            $labels[] = date('M', strtotime("-$i months"));

            $this->db->select_sum('total_harga')
                ->from('sales_order')
                ->where('status', 'selesai')
                ->where('MONTH(tanggal_order)', $bulan)
                ->where('YEAR(tanggal_order)', $tahun);

            if ($id_sales !== null) {
                $this->db->where('id_sales', $id_sales);
            }

            $row = $this->db->get()->row();
            $values[] = (float) ($row->total_harga ?? 0);
        }

        return ['labels' => $labels, 'values' => $values];
    }
}

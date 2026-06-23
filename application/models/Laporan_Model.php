<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public function total_order()
    {
        return $this->db->count_all('sales_order');
    }

    public function total_pendapatan()
    {
        $this->db->where('status', 'selesai');
        return $this->db->select_sum('total_harga')->get('sales_order')->row()->total_harga ?? 0;
    }

    public function total_sales()
    {
        return $this->db->count_all('sales');
    }

    public function total_produk()
    {
        return $this->db->count_all('produk');
    }

    public function get_laporan($tanggal_dari = null, $tanggal_sampai = null, $id_sales = null, $id_produk = null)
    {
        $this->db->select('
            so.no_order, so.tanggal_order, so.status, so.total_harga,
            p.nama AS nama_pelanggan,
            s.nama AS nama_sales
        ');
        $this->db->from('sales_order so');
        $this->db->join('pelanggan p', 'p.id_pelanggan = so.id_pelanggan', 'left');
        $this->db->join('sales s', 's.id_sales = so.id_sales', 'left');

        if (!empty($tanggal_dari))
            $this->db->where('so.tanggal_order >=', $tanggal_dari);
        if (!empty($tanggal_sampai))
            $this->db->where('so.tanggal_order <=', $tanggal_sampai);
        if (!empty($id_sales))
            $this->db->where('so.id_sales', $id_sales);
        if (!empty($id_produk)) {
            $this->db->join('sales_order_detail sod', 'sod.id_order = so.id_order', 'left');
            $this->db->where('sod.id_produk', $id_produk);
            $this->db->group_by('so.id_order');
        }

        $this->db->order_by('so.tanggal_order', 'DESC');
        return $this->db->get()->result();
    }

    public function laporan_per_sales($tanggal_dari = null, $tanggal_sampai = null)
    {
        $this->db->select('s.nama AS nama_sales, COUNT(so.id_order) AS total_order, SUM(so.total_harga) AS total_pendapatan');
        $this->db->from('sales_order so');
        $this->db->join('sales s', 's.id_sales = so.id_sales', 'left');
        $this->db->where('so.status !=', 'dibatalkan');
        if (!empty($tanggal_dari))
            $this->db->where('so.tanggal_order >=', $tanggal_dari);
        if (!empty($tanggal_sampai))
            $this->db->where('so.tanggal_order <=', $tanggal_sampai);
        $this->db->group_by('so.id_sales');
        $this->db->order_by('total_pendapatan', 'DESC');
        return $this->db->get()->result();
    }

    public function laporan_per_produk($tanggal_dari = null, $tanggal_sampai = null)
    {
        $this->db->select('pr.nama_produk, SUM(sod.jumlah) AS total_terjual, SUM(sod.subtotal) AS total_pendapatan');
        $this->db->from('sales_order_detail sod');
        $this->db->join('produk pr', 'pr.id_produk = sod.id_produk', 'left');
        $this->db->join('sales_order so', 'so.id_order = sod.id_order', 'left');
        $this->db->where('so.status !=', 'dibatalkan');
        if (!empty($tanggal_dari))
            $this->db->where('so.tanggal_order >=', $tanggal_dari);
        if (!empty($tanggal_sampai))
            $this->db->where('so.tanggal_order <=', $tanggal_sampai);
        $this->db->group_by('sod.id_produk');
        $this->db->order_by('total_terjual', 'DESC');
        return $this->db->get()->result();
    }

    public function get_all_sales()
    {
        return $this->db->get('sales')->result();
    }

    public function get_all_produk()
    {
        return $this->db->order_by('nama_produk')->get('produk')->result();
    }
}
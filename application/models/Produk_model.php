<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->order_by('nama_produk', 'ASC')
            ->get('produk')
            ->result();
    }

    public function get_by_id($id_produk)
    {
        return $this->db->where('id_produk', $id_produk)
            ->get('produk')
            ->row();
    }

    public function cek_kode_produk($kode_produk, $exclude_id = null)
    {
        $this->db->where('kode_produk', $kode_produk);
        if ($exclude_id !== null) {
            $this->db->where('id_produk !=', $exclude_id);
        }
        return $this->db->get('produk')->row();
    }

    public function tambah($data)
    {
        return $this->db->insert('produk', $data);
    }

    public function update($id_produk, $data)
    {
        $this->db->where('id_produk', $id_produk);
        return $this->db->update('produk', $data);
    }

    public function hapus($id_produk)
    {
        $this->db->where('id_produk', $id_produk);
        return $this->db->delete('produk');
    }

    /**
     * Cek apakah produk ini sudah pernah dipakai di sales_order_detail.
     * Dipakai untuk mencegah hapus produk yang sudah ada transaksinya.
     */
    public function sudah_dipakai_di_order($id_produk)
    {
        $jumlah = $this->db->where('id_produk', $id_produk)
            ->count_all_results('sales_order_detail');
        return $jumlah > 0;
    }
}

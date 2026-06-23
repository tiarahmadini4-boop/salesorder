<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->order_by('nama', 'ASC')
            ->get('pelanggan')
            ->result();
    }

    public function get_by_id($id_pelanggan)
    {
        return $this->db->where('id_pelanggan', $id_pelanggan)
            ->get('pelanggan')
            ->row();
    }

    public function tambah($data)
    {
        return $this->db->insert('pelanggan', $data);
    }

    public function update($id_pelanggan, $data)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->update('pelanggan', $data);
    }

    public function hapus($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->delete('pelanggan');
    }

    /**
     * Cek apakah pelanggan ini sudah pernah dipakai di sales_order.
     * Dipakai untuk mencegah hapus pelanggan yang sudah ada transaksinya.
     */
    public function sudah_dipakai_di_order($id_pelanggan)
    {
        $jumlah = $this->db->where('id_pelanggan', $id_pelanggan)
            ->count_all_results('sales_order');
        return $jumlah > 0;
    }
}

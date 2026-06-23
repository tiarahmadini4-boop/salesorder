<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->order_by('nama', 'ASC')
            ->get('sales')
            ->result();
    }

    public function get_by_id($id_sales)
    {
        return $this->db->where('id_sales', $id_sales)
            ->get('sales')
            ->row();
    }

    public function cek_kode_sales($kode_sales, $exclude_id = null)
    {
        $this->db->where('kode_sales', $kode_sales);
        if ($exclude_id !== null) {
            $this->db->where('id_sales !=', $exclude_id);
        }
        return $this->db->get('sales')->row();
    }

    public function tambah($data)
    {
        $this->db->insert('sales', $data);
        return $this->db->insert_id();
    }

    public function update($id_sales, $data)
    {
        $this->db->where('id_sales', $id_sales);
        return $this->db->update('sales', $data);
    }

    public function hapus($id_sales)
    {
        $this->db->where('id_sales', $id_sales);
        return $this->db->delete('sales');
    }

    /**
     * Cek apakah sales ini sudah pernah dipakai di sales_order.
     * Dipakai untuk mencegah hapus sales yang sudah ada transaksinya.
     */
    public function sudah_dipakai_di_order($id_sales)
    {
        $jumlah = $this->db->where('id_sales', $id_sales)
            ->count_all_results('sales_order');
        return $jumlah > 0;
    }

    /**
     * Cek apakah username sudah dipakai di tabel users
     */
    public function cek_username($username)
    {
        return $this->db->where('username', $username)
            ->get('users')
            ->row();
    }

    /**
     * Buat akun login untuk sales baru (role otomatis 'sales')
     */
    public function buat_akun_user($id_sales, $username, $password)
    {
        return $this->db->insert('users', [
            'username' => $username,
            'password' => md5($password),
            'role'     => 'sales',
            'id_sales' => $id_sales,
            'nama'     => $this->get_by_id($id_sales)->nama,
        ]);
    }

    /**
     * Cek apakah sales ini sudah punya akun user terhubung
     */
    public function get_user_by_id_sales($id_sales)
    {
        return $this->db->where('id_sales', $id_sales)
            ->get('users')
            ->row();
    }

    /**
     * Hapus akun user yang terhubung dengan sales ini (dipanggil sebelum hapus sales)
     */
    public function hapus_akun_user($id_sales)
    {
        $this->db->where('id_sales', $id_sales);
        return $this->db->delete('users');
    }
}

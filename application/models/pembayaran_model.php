<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {

    public function get_all()
    {
        $this->db->select('
            pembayaran.*,
            pemesanan.nama_customer,
            pemesanan.total_harga,
            pemesanan.metode_pembayaran
        ');

        $this->db->from('pembayaran');

        $this->db->join(
            'pemesanan',
            'pemesanan.id_pemesanan = pembayaran.id_pemesanan'
        );

        $this->db->order_by('pembayaran.id_pembayaran', 'DESC');

        return $this->db->get()->result();
    }

    public function update_status($id_pemesanan, $data)
    {
        $this->db->where('id_pemesanan', $id_pemesanan);
        return $this->db->update('pembayaran', $data);
    }
}
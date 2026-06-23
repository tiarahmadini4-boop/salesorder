<?php

class pemesanan_model extends CI_Model {

    public function get_all()
    {
        $this->db->select('
            pemesanan.*,
            pelanggan.nama,
            mobil.merk,
            mobil.tipe,
            supir.nama as nama_supir
        ');

        $this->db->from('pemesanan');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan.id_pelanggan', 'left');
        $this->db->join('mobil', 'mobil.id_mobil = pemesanan.id_mobil', 'left');
        $this->db->join('supir', 'supir.id_supir = pemesanan.id_supir', 'left');

        return $this->db->get()->result();
    }

    public function insert($data)
    {
        return $this->db->insert('pemesanan', $data);
    }

    public function get_by_id($id)
    {
        $this->db->select('
            pemesanan.*,
            pelanggan.nama,
            mobil.merk,
            mobil.tipe,
            supir.nama as nama_supir
        ');

        $this->db->from('pemesanan');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = pemesanan.id_pelanggan', 'left');
        $this->db->join('mobil', 'mobil.id_mobil = pemesanan.id_mobil', 'left');
        $this->db->join('supir', 'supir.id_supir = pemesanan.id_supir', 'left');
        $this->db->where('pemesanan.id_pemesanan', $id);

        return $this->db->get()->row();
    }

    public function update_status($id, $status)
    {
        $this->db->where('id_pemesanan', $id);
        return $this->db->update('pemesanan', [
            'status' => $status
        ]);
    }

    public function delete($id)
    {
        return $this->db->delete('pemesanan', [
            'id_pemesanan' => $id
        ]);
    }
}
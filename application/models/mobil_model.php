<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mobil_model extends CI_Model {

    private $table = 'mobil';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_by_id($id)
    {
        $this->db->where('id_mobil', $id);
        return $this->db->get($this->table)->row();
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id_mobil' => $id]);
    }

    public function update($id, $data)
    {
        $this->db->where('id_mobil', $id);
        return $this->db->update($this->table, $data);
    }
}
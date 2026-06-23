<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_order_model extends CI_Model {

    public function get_by_sales($id_sales)
    {
        $this->db->select('so.*, p.nama AS nama_pelanggan');
        $this->db->from('sales_order so');
        $this->db->join('pelanggan p', 'p.id_pelanggan = so.id_pelanggan', 'left');
        $this->db->where('so.id_sales', $id_sales);
        $this->db->order_by('so.tanggal_order', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id_order)
    {
        $this->db->select('so.*, p.nama AS nama_pelanggan, s.nama AS nama_sales');
        $this->db->from('sales_order so');
        $this->db->join('pelanggan p', 'p.id_pelanggan = so.id_pelanggan', 'left');
        $this->db->join('sales s', 's.id_sales = so.id_sales', 'left');
        $this->db->where('so.id_order', $id_order);
        return $this->db->get()->row();
    }

    public function get_detail($id_order)
    {
        $this->db->select('sod.*, pr.nama_produk, pr.kode_produk');
        $this->db->from('sales_order_detail sod');
        $this->db->join('produk pr', 'pr.id_produk = sod.id_produk', 'left');
        $this->db->where('sod.id_order', $id_order);
        return $this->db->get()->result();
    }

    public function buat_no_order()
    {
        $tahun = date('Y');
        $this->db->like('no_order', 'SO-' . $tahun, 'after');
        $this->db->order_by('id_order', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get('sales_order')->row();

        if ($last) {
            $last_no = (int) substr($last->no_order, -4);
            $new_no  = $last_no + 1;
        } else {
            $new_no = 1;
        }

        return 'SO-' . $tahun . '-' . str_pad($new_no, 4, '0', STR_PAD_LEFT);
    }

    public function simpan($id_pelanggan, $id_sales, $produk_list)
    {
        $total = 0;
        foreach ($produk_list as $item) {
            $total += $item['subtotal'];
        }

        $order = [
            'no_order'      => $this->buat_no_order(),
            'id_pelanggan'  => $id_pelanggan,
            'id_sales'      => $id_sales,
            'tanggal_order' => date('Y-m-d'),
            'status'        => 'draft',
            'total_harga'   => $total,
        ];

        $this->db->insert('sales_order', $order);
        $id_order = $this->db->insert_id();

        foreach ($produk_list as $item) {
            $this->db->insert('sales_order_detail', [
                'id_order'    => $id_order,
                'id_produk'   => $item['id_produk'],
                'jumlah'      => $item['jumlah'],
                'harga_satuan'=> $item['harga_satuan'],
                'subtotal'    => $item['subtotal'],
            ]);
        }

        return $id_order;
    }

    public function ubah_status($id_order, $status)
    {
        $this->db->where('id_order', $id_order);
        return $this->db->update('sales_order', ['status' => $status]);
    }

    public function get_all()
{
    $this->db->select('so.*, p.nama AS nama_pelanggan, s.nama AS nama_sales');
    $this->db->from('sales_order so');
    $this->db->join('pelanggan p', 'p.id_pelanggan = so.id_pelanggan', 'left');
    $this->db->join('sales s', 's.id_sales = so.id_sales', 'left');
    $this->db->order_by('so.tanggal_order', 'DESC');
    return $this->db->get()->result();
}
}
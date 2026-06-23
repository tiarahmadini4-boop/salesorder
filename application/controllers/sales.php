<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sales extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_login')) {
            redirect('auth');
        }

        if ($this->session->userdata('role') != 'sales') {
            redirect('auth');
        }

        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $id_sales = $this->session->userdata('id_sales');

        $data['title'] = 'dashboard sales';

        $statistik = $this->Dashboard_model->get_statistik_sales($id_sales);
        $data = array_merge($data, $statistik);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_sales');
        $this->load->view('templates/topbar');
        $this->load->view('sales/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function sales_order()
{
    $this->load->model('Sales_order_model');
    $id_sales = $this->session->userdata('id_sales');

    $data['title']  = 'Order Saya';
    $data['orders'] = $this->Sales_order_model->get_by_sales($id_sales);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar_sales');
    $this->load->view('templates/topbar');
    $this->load->view('sales/sales_order/index', $data);
    $this->load->view('templates/footer');
}

public function sales_order_tambah()
{
    $this->load->model('Sales_order_model');
    $this->load->model('Produk_model');

    $data['title']   = 'Buat Order Baru';
    $data['produk']  = $this->Produk_model->get_all();
    $data['pelanggan'] = $this->db->get('pelanggan')->result();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar_sales');
    $this->load->view('templates/topbar');
    $this->load->view('sales/sales_order/tambah', $data);
    $this->load->view('templates/footer');
}

public function sales_order_simpan()
{
    $this->load->model('Sales_order_model');
    $this->load->model('Produk_model');

    $id_pelanggan = $this->input->post('id_pelanggan');
    $id_sales     = $this->session->userdata('id_sales');
    $produk_ids   = $this->input->post('id_produk');
    $jumlah_list  = $this->input->post('jumlah');

    if (empty($produk_ids)) {
        $this->session->set_flashdata('error', 'Pilih minimal 1 produk.');
        redirect('sales/sales_order_tambah');
    }

    $produk_list = [];
    foreach ($produk_ids as $i => $id_produk) {
        $jumlah = (int) $jumlah_list[$i];
        if ($jumlah <= 0) continue;

        $produk = $this->Produk_model->get_by_id($id_produk);
        $produk_list[] = [
            'id_produk'   => $id_produk,
            'jumlah'      => $jumlah,
            'harga_satuan'=> $produk->harga,
            'subtotal'    => $produk->harga * $jumlah,
        ];
    }

    $this->Sales_order_model->simpan($id_pelanggan, $id_sales, $produk_list);
    $this->session->set_flashdata('success', 'Order berhasil dibuat.');
    redirect('sales/sales_order');
}

public function sales_order_ubah_status($id_order, $status)
{
    $this->load->model('Sales_order_model');
    $allowed = ['draft', 'dikirim', 'selesai', 'dibatalkan'];

    if (!in_array($status, $allowed)) {
        redirect('sales/sales_order');
    }

    $this->Sales_order_model->ubah_status($id_order, $status);
    $this->session->set_flashdata('success', 'Status order berhasil diubah.');
    redirect('sales/sales_order');
}
}

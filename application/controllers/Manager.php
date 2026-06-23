<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_login')) {
            redirect('auth');
        }

        if ($this->session->userdata('role') != 'manager') {
            redirect('auth');
        }

        $this->load->model('Laporan_model');
    }

    public function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard Manager';
        $data['total_order']      = $this->Laporan_model->total_order();
        $data['total_pendapatan'] = $this->Laporan_model->total_pendapatan();
        $data['total_sales']      = $this->Laporan_model->total_sales();
        $data['total_produk']     = $this->Laporan_model->total_produk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_manager');
        $this->load->view('templates/topbar');
        $this->load->view('manager/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan Penjualan';

        $tanggal_dari   = $this->input->get('tanggal_dari');
        $tanggal_sampai = $this->input->get('tanggal_sampai');
        $id_sales       = $this->input->get('id_sales');
        $id_produk      = $this->input->get('id_produk');

        $data['orders']         = $this->Laporan_model->get_laporan($tanggal_dari, $tanggal_sampai, $id_sales, $id_produk);
        $data['per_sales']      = $this->Laporan_model->laporan_per_sales($tanggal_dari, $tanggal_sampai);
        $data['per_produk']     = $this->Laporan_model->laporan_per_produk($tanggal_dari, $tanggal_sampai);
        $data['list_sales']     = $this->Laporan_model->get_all_sales();
        $data['list_produk']    = $this->Laporan_model->get_all_produk();
        $data['tanggal_dari']   = $tanggal_dari;
        $data['tanggal_sampai'] = $tanggal_sampai;
        $data['filter_sales']   = $id_sales;
        $data['filter_produk']  = $id_produk;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_manager');
        $this->load->view('templates/topbar');
        $this->load->view('manager/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function laporan_cetak()
    {
        $tanggal_dari   = $this->input->get('tanggal_dari');
        $tanggal_sampai = $this->input->get('tanggal_sampai');
        $id_sales       = $this->input->get('id_sales');
        $id_produk      = $this->input->get('id_produk');

        $data['orders']         = $this->Laporan_model->get_laporan($tanggal_dari, $tanggal_sampai, $id_sales, $id_produk);
        $data['per_sales']      = $this->Laporan_model->laporan_per_sales($tanggal_dari, $tanggal_sampai);
        $data['per_produk']     = $this->Laporan_model->laporan_per_produk($tanggal_dari, $tanggal_sampai);
        $data['tanggal_dari']   = $tanggal_dari;
        $data['tanggal_sampai'] = $tanggal_sampai;

    $this->load->view('manager/laporan_cetak', $data);
    }
}
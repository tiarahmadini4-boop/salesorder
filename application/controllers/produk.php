<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_login')) {
            redirect('auth');
        }

        if ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }

        $this->load->model('Produk_model');
    }

    public function index()
    {
        $data['title'] = 'data produk';
        $data['produk'] = $this->Produk_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin');
        $this->load->view('templates/topbar');
        $this->load->view('admin/produk/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $kode_produk = $this->input->post('kode_produk');
        $nama_produk = $this->input->post('nama_produk');
        $harga       = $this->input->post('harga');
        $stok        = $this->input->post('stok');

        if (empty($kode_produk) || empty($nama_produk) || $harga === '' || $stok === '') {
            $this->session->set_flashdata('error', 'Semua field wajib diisi');
            redirect('admin/produk');
            return;
        }

        if ($this->Produk_model->cek_kode_produk($kode_produk)) {
            $this->session->set_flashdata('error', 'Kode produk sudah dipakai, gunakan kode lain');
            redirect('admin/produk');
            return;
        }

        $data = [
            'kode_produk' => $kode_produk,
            'nama_produk' => $nama_produk,
            'harga'       => (int) $harga,
            'stok'        => (int) $stok,
        ];

        $this->Produk_model->tambah($data);

        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan');
        redirect('admin/produk');
    }

    public function edit()
    {
        $id_produk   = $this->input->post('id_produk');
        $kode_produk = $this->input->post('kode_produk');
        $nama_produk = $this->input->post('nama_produk');
        $harga       = $this->input->post('harga');
        $stok        = $this->input->post('stok');

        if (empty($id_produk) || empty($kode_produk) || empty($nama_produk) || $harga === '' || $stok === '') {
            $this->session->set_flashdata('error', 'Semua field wajib diisi');
            redirect('admin/produk');
            return;
        }

        if ($this->Produk_model->cek_kode_produk($kode_produk, $id_produk)) {
            $this->session->set_flashdata('error', 'Kode produk sudah dipakai produk lain');
            redirect('admin/produk');
            return;
        }

        $data = [
            'kode_produk' => $kode_produk,
            'nama_produk' => $nama_produk,
            'harga'       => (int) $harga,
            'stok'        => (int) $stok,
        ];

        $this->Produk_model->update($id_produk, $data);

        $this->session->set_flashdata('success', 'Produk berhasil diperbarui');
        redirect('admin/produk');
    }

    public function hapus($id_produk)
    {
        if ($this->Produk_model->sudah_dipakai_di_order($id_produk)) {
            $this->session->set_flashdata('error', 'Produk tidak bisa dihapus karena sudah dipakai di sales order');
            redirect('admin/produk');
            return;
        }

        $produk = $this->Produk_model->get_by_id($id_produk);
        if (!$produk) {
            show_404();
        }

        $this->Produk_model->hapus($id_produk);

        $this->session->set_flashdata('success', 'Produk berhasil dihapus');
        redirect('admin/produk');
    }
}

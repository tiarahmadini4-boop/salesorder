<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pelanggan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_login')) {
            redirect('auth');
        }

        if ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }

        $this->load->model('Pelanggan_model');
    }

    public function index()
    {
        $data['title'] = 'data pelanggan';
        $data['pelanggan'] = $this->Pelanggan_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin');
        $this->load->view('templates/topbar');
        $this->load->view('admin/pelanggan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $nama    = $this->input->post('nama');
        $alamat  = $this->input->post('alamat');
        $telepon = $this->input->post('telepon');

        if (empty($nama) || empty($alamat) || empty($telepon)) {
            $this->session->set_flashdata('error', 'Semua field wajib diisi');
            redirect('admin/pelanggan');
            return;
        }

        $data = [
            'nama'    => $nama,
            'alamat'  => $alamat,
            'telepon' => $telepon,
        ];

        $this->Pelanggan_model->tambah($data);

        $this->session->set_flashdata('success', 'Pelanggan berhasil ditambahkan');
        redirect('admin/pelanggan');
    }

    public function edit()
    {
        $id_pelanggan = $this->input->post('id_pelanggan');
        $nama         = $this->input->post('nama');
        $alamat       = $this->input->post('alamat');
        $telepon      = $this->input->post('telepon');

        if (empty($id_pelanggan) || empty($nama) || empty($alamat) || empty($telepon)) {
            $this->session->set_flashdata('error', 'Semua field wajib diisi');
            redirect('admin/pelanggan');
            return;
        }

        $data = [
            'nama'    => $nama,
            'alamat'  => $alamat,
            'telepon' => $telepon,
        ];

        $this->Pelanggan_model->update($id_pelanggan, $data);

        $this->session->set_flashdata('success', 'Pelanggan berhasil diperbarui');
        redirect('admin/pelanggan');
    }

    public function hapus($id_pelanggan)
    {
        if ($this->Pelanggan_model->sudah_dipakai_di_order($id_pelanggan)) {
            $this->session->set_flashdata('error', 'Pelanggan tidak bisa dihapus karena sudah memiliki sales order');
            redirect('admin/pelanggan');
            return;
        }

        $pelanggan = $this->Pelanggan_model->get_by_id($id_pelanggan);
        if (!$pelanggan) {
            show_404();
        }

        $this->Pelanggan_model->hapus($id_pelanggan);

        $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus');
        redirect('admin/pelanggan');
    }
}

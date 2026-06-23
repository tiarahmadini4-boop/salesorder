<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sales_data extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_login')) {
            redirect('auth');
        }

        if ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }

        $this->load->model('Sales_model');
    }

    public function index()
    {
        $data['title'] = 'data sales';
        $data['sales'] = $this->Sales_model->get_all();

        // Tandai sales mana yang sudah punya akun login, untuk ditampilkan di tabel
        foreach ($data['sales'] as $s) {
            $user = $this->Sales_model->get_user_by_id_sales($s->id_sales);
            $s->punya_akun = $user ? true : false;
            $s->username   = $user ? $user->username : null;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin');
        $this->load->view('templates/topbar');
        $this->load->view('admin/sales/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $kode_sales = $this->input->post('kode_sales');
        $nama       = $this->input->post('nama');
        $telepon    = $this->input->post('telepon');
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');

        if (empty($kode_sales) || empty($nama) || empty($telepon) || empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Semua field wajib diisi');
            redirect('admin/sales_data');
            return;
        }

        if ($this->Sales_model->cek_kode_sales($kode_sales)) {
            $this->session->set_flashdata('error', 'Kode sales sudah dipakai, gunakan kode lain');
            redirect('admin/sales_data');
            return;
        }

        if ($this->Sales_model->cek_username($username)) {
            $this->session->set_flashdata('error', 'Username sudah dipakai, gunakan username lain');
            redirect('admin/sales_data');
            return;
        }

        $data = [
            'kode_sales' => $kode_sales,
            'nama'       => $nama,
            'telepon'    => $telepon,
            'status'     => 'Aktif',
        ];

        $id_sales = $this->Sales_model->tambah($data);
        $this->Sales_model->buat_akun_user($id_sales, $username, $password);

        $this->session->set_flashdata('success', 'Sales berhasil ditambahkan beserta akun loginnya');
        redirect('admin/sales_data');
    }

    public function edit()
    {
        $id_sales   = $this->input->post('id_sales');
        $kode_sales = $this->input->post('kode_sales');
        $nama       = $this->input->post('nama');
        $telepon    = $this->input->post('telepon');
        $status     = $this->input->post('status');

        if (empty($id_sales) || empty($kode_sales) || empty($nama) || empty($telepon) || empty($status)) {
            $this->session->set_flashdata('error', 'Semua field wajib diisi');
            redirect('admin/sales_data');
            return;
        }

        if ($this->Sales_model->cek_kode_sales($kode_sales, $id_sales)) {
            $this->session->set_flashdata('error', 'Kode sales sudah dipakai sales lain');
            redirect('admin/sales_data');
            return;
        }

        $data = [
            'kode_sales' => $kode_sales,
            'nama'       => $nama,
            'telepon'    => $telepon,
            'status'     => $status,
        ];

        $this->Sales_model->update($id_sales, $data);

        $this->session->set_flashdata('success', 'Data sales berhasil diperbarui');
        redirect('admin/sales_data');
    }

    public function hapus($id_sales)
    {
        if ($this->Sales_model->sudah_dipakai_di_order($id_sales)) {
            $this->session->set_flashdata('error', 'Sales tidak bisa dihapus karena sudah memiliki sales order. Ubah status menjadi Nonaktif sebagai gantinya.');
            redirect('admin/sales_data');
            return;
        }

        $sales = $this->Sales_model->get_by_id($id_sales);
        if (!$sales) {
            show_404();
        }

        // Hapus akun login yang terhubung dulu, baru hapus data sales-nya
        $this->Sales_model->hapus_akun_user($id_sales);
        $this->Sales_model->hapus($id_sales);

        $this->session->set_flashdata('success', 'Sales berhasil dihapus');
        redirect('admin/sales_data');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class admin extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
 
        if (!$this->session->userdata('is_login')) {
            redirect('auth');
        }
 
        if ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
 
        $this->load->model('pemesanan_model');
        $this->load->model('Dashboard_model');
    }
 
    public function index()
    {
        $this->dashboard();
    }
 
    public function dashboard()
    {
        $data['title'] = 'dashboard admin';
 
        $statistik = $this->Dashboard_model->get_statistik_global();
        $data = array_merge($data, $statistik);
 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin');
        $this->load->view('templates/topbar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }
 
    /*
     * --------------------------------------------------------------------
     * CATATAN: Method-method di bawah ini masih versi LAMA (konteks rental
     * mobil). Belum diganti ke konteks Sales Order (Produk/Pelanggan/Sales/
     * Sales Order/Laporan) karena modul-modul itu belum kita kerjakan satu
     * per satu. Sengaja DIPERTAHANKAN sementara agar menu sidebar lain
     * (data mobil, pemesanan, pembayaran, kwitansi) tidak langsung error.
     * Method-method ini akan diganti bertahap saat kita masuk ke masing-
     * masing modul.
     * --------------------------------------------------------------------
     */


    
 
    public function kendaraan()
    {
        $data['title'] = 'data mobil';
 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin');
        $this->load->view('templates/topbar');
        $this->load->view('admin/mobil/index');
        $this->load->view('templates/footer');
    }
 
    public function pemesanan()
    {
        $data['title'] = 'data pemesanan';
 
        $data['pemesanan'] = $this->pemesanan_model->get_all();
 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin');
        $this->load->view('templates/topbar');
        $this->load->view('admin/pemesanan/index', $data);
        $this->load->view('templates/footer');
    }
 
    public function pembayaran()
    {
        $data['title'] = 'data pembayaran';
 
        // 1. Load model (pastikan nama model sesuai dengan file di folder models)
        $this->load->model('Pembayaran_model');
 
        // 2. Ambil data dari model
        $data['pembayaran'] = $this->Pembayaran_model->get_all();
 
        // 3. Kirim $data ke view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin');
        $this->load->view('templates/topbar');
        $this->load->view('admin/pembayaran/index', $data); // <--- Tambahkan $data di sini
        $this->load->view('templates/footer');
    }
 
 
    public function laporan()
{
    $data['title'] = 'laporan';
    $this->load->model('Laporan_model');

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
    $this->load->view('templates/sidebar_admin');
    $this->load->view('templates/topbar');
    $this->load->view('admin/laporan/index', $data);
    $this->load->view('templates/footer');
}

public function laporan_cetak()
{
    $this->load->model('Laporan_model');

    $tanggal_dari   = $this->input->get('tanggal_dari');
    $tanggal_sampai = $this->input->get('tanggal_sampai');
    $id_sales       = $this->input->get('id_sales');
    $id_produk      = $this->input->get('id_produk');

    $data['orders']         = $this->Laporan_model->get_laporan($tanggal_dari, $tanggal_sampai, $id_sales, $id_produk);
    $data['per_sales']      = $this->Laporan_model->laporan_per_sales($tanggal_dari, $tanggal_sampai);
    $data['per_produk']     = $this->Laporan_model->laporan_per_produk($tanggal_dari, $tanggal_sampai);
    $data['tanggal_dari']   = $tanggal_dari;
    $data['tanggal_sampai'] = $tanggal_sampai;

    $this->load->view('admin/laporan/cetak', $data);
}
 
 
    public function kwitansi($id)
    {
        $this->db->select('
            p.id_pemesanan, p.nama_customer,
            pl.telepon, pl.nik,
            m.merk, m.tipe, m.plat_nomor,
            s.nama AS nama_supir,
            p.tanggal_sewa, p.tanggal_kembali,
            DATEDIFF(p.tanggal_kembali, p.tanggal_sewa) AS lama_sewa,
            p.total_harga, p.status, p.luar_kota, p.metode_pembayaran
        ');
        $this->db->from('pemesanan p');
        $this->db->join('pelanggan pl', 'pl.id_pelanggan = p.id_pelanggan', 'left');
        $this->db->join('mobil m',      'm.id_mobil      = p.id_mobil',      'left');
        $this->db->join('supir s',      's.id_supir      = p.id_supir',      'left');
        $this->db->where('p.id_pemesanan', $id);
 
        $data['p'] = $this->db->get()->row();
 
        if (!$data['p']) show_404();
 
        $this->load->view('admin/laporan/cetak', $data);
    }

    // ===================== PRODUK =====================

public function produk()
{
    $data['title'] = 'data produk';
    $this->load->model('Produk_model');
    $data['produk'] = $this->Produk_model->get_all();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar_admin');
    $this->load->view('templates/topbar');
    $this->load->view('admin/produk/index', $data);
    $this->load->view('templates/footer');
}

public function produk_tambah()
{
    $this->load->model('Produk_model');
    $kode = $this->input->post('kode_produk');

    if ($this->Produk_model->cek_kode_produk($kode)) {
        $this->session->set_flashdata('error', 'Kode produk sudah digunakan.');
        redirect('admin/produk');
    }

    $data = [
        'kode_produk' => $kode,
        'nama_produk' => $this->input->post('nama_produk'),
        'harga'       => $this->input->post('harga'),
        'stok'        => $this->input->post('stok'),
    ];

    $this->Produk_model->tambah($data);
    $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
    redirect('admin/produk');
}

public function produk_edit()
{
    $this->load->model('Produk_model');
    $id   = $this->input->post('id_produk');
    $kode = $this->input->post('kode_produk');

    if ($this->Produk_model->cek_kode_produk($kode, $id)) {
        $this->session->set_flashdata('error', 'Kode produk sudah digunakan produk lain.');
        redirect('admin/produk');
    }

    $data = [
        'kode_produk' => $kode,
        'nama_produk' => $this->input->post('nama_produk'),
        'harga'       => $this->input->post('harga'),
        'stok'        => $this->input->post('stok'),
    ];

    $this->Produk_model->update($id, $data);
    $this->session->set_flashdata('success', 'Produk berhasil diupdate.');
    redirect('admin/produk');
}

public function produk_hapus($id)
{
    $this->load->model('Produk_model');

    if ($this->Produk_model->sudah_dipakai_di_order($id)) {
        $this->session->set_flashdata('error', 'Produk tidak bisa dihapus karena sudah ada di Sales Order.');
        redirect('admin/produk');
    }

    $this->Produk_model->hapus($id);
    $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
    redirect('admin/produk');
}

// ===================== PELANGGAN =====================

public function pelanggan()
{
    $this->load->model('Pelanggan_model');
    $data['title']     = 'data pelanggan';
    $data['pelanggan'] = $this->Pelanggan_model->get_all();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar_admin');
    $this->load->view('templates/topbar');
    $this->load->view('admin/pelanggan/index', $data);
    $this->load->view('templates/footer');
}

public function pelanggan_tambah()
{
    $this->load->model('Pelanggan_model');

    $data = [
        'nama'    => $this->input->post('nama'),
        'alamat'  => $this->input->post('alamat'),
        'telepon' => $this->input->post('telepon'),
    ];

    $this->Pelanggan_model->tambah($data);
    $this->session->set_flashdata('success', 'Pelanggan berhasil ditambahkan.');
    redirect('admin/pelanggan');
}

public function pelanggan_edit()
{
    $this->load->model('Pelanggan_model');

    $id   = $this->input->post('id_pelanggan');
    $data = [
        'nama'    => $this->input->post('nama'),
        'alamat'  => $this->input->post('alamat'),
        'telepon' => $this->input->post('telepon'),
    ];

    $this->Pelanggan_model->update($id, $data);
    $this->session->set_flashdata('success', 'Pelanggan berhasil diupdate.');
    redirect('admin/pelanggan');
}

public function pelanggan_hapus($id)
{
    $this->load->model('Pelanggan_model');

    if ($this->Pelanggan_model->sudah_dipakai_di_order($id)) {
        $this->session->set_flashdata('error', 'Pelanggan tidak bisa dihapus karena sudah ada di Sales Order.');
        redirect('admin/pelanggan');
    }

    $this->Pelanggan_model->hapus($id);
    $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus.');
    redirect('admin/pelanggan');
}

// ===================== DATA SALES =====================

public function sales()
{
    $this->load->model('Sales_model');

    // Ambil semua sales + info username dari tabel users
    $this->db->select('s.*, u.username, IF(u.id IS NOT NULL, 1, 0) AS punya_akun');
    $this->db->from('sales s');
    $this->db->join('users u', 'u.id_sales = s.id_sales', 'left');
    $this->db->order_by('s.nama', 'ASC');
    $data['sales'] = $this->db->get()->result();

    $data['title'] = 'data sales';

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar_admin');
    $this->load->view('templates/topbar');
    $this->load->view('admin/sales/index', $data);
    $this->load->view('templates/footer');
}

public function sales_tambah()
{
    $this->load->model('Sales_model');

    $kode     = $this->input->post('kode_sales');
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    if ($this->Sales_model->cek_kode_sales($kode)) {
        $this->session->set_flashdata('error', 'Kode sales sudah digunakan.');
        redirect('admin/sales');
    }

    if ($this->Sales_model->cek_username($username)) {
        $this->session->set_flashdata('error', 'Username sudah digunakan.');
        redirect('admin/sales');
    }

    $data_sales = [
        'kode_sales' => $kode,
        'nama'       => $this->input->post('nama'),
        'telepon'    => $this->input->post('telepon'),
        'status'     => 'Aktif',
    ];

    $id_sales = $this->Sales_model->tambah($data_sales);
    $this->Sales_model->buat_akun_user($id_sales, $username, $password);

    $this->session->set_flashdata('success', 'Sales berhasil ditambahkan.');
    redirect('admin/sales');
}

public function sales_edit()
{
    $this->load->model('Sales_model');

    $id   = $this->input->post('id_sales');
    $kode = $this->input->post('kode_sales');

    if ($this->Sales_model->cek_kode_sales($kode, $id)) {
        $this->session->set_flashdata('error', 'Kode sales sudah digunakan.');
        redirect('admin/sales');
    }

    $data = [
        'kode_sales' => $kode,
        'nama'       => $this->input->post('nama'),
        'telepon'    => $this->input->post('telepon'),
        'status'     => $this->input->post('status'),
    ];

    $this->Sales_model->update($id, $data);
    $this->session->set_flashdata('success', 'Sales berhasil diupdate.');
    redirect('admin/sales');
}

public function sales_hapus($id)
{
    $this->load->model('Sales_model');

    if ($this->Sales_model->sudah_dipakai_di_order($id)) {
        $this->session->set_flashdata('error', 'Sales tidak bisa dihapus karena sudah memiliki Sales Order.');
        redirect('admin/sales');
    }

    $this->Sales_model->hapus_akun_user($id);
    $this->Sales_model->hapus($id);
    $this->session->set_flashdata('success', 'Sales berhasil dihapus.');
    redirect('admin/sales');
}

// ===================== SALES ORDER =====================

public function sales_order()
{
    $this->load->model('Sales_order_model');

    $data['title']  = 'sales order';
    $data['orders'] = $this->Sales_order_model->get_all();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar_admin');
    $this->load->view('templates/topbar');
    $this->load->view('admin/sales_order/index', $data);
    $this->load->view('templates/footer');
}

public function sales_order_ubah_status($id_order, $status)
{
    $this->load->model('Sales_order_model');
    $allowed = ['draft', 'dikirim', 'selesai', 'dibatalkan'];

    if (!in_array($status, $allowed)) {
        redirect('admin/sales_order');
    }

    $this->Sales_order_model->ubah_status($id_order, $status);
    $this->session->set_flashdata('success', 'Status order berhasil diubah.');
    redirect('admin/sales_order');
}
}
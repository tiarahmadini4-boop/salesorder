<?php
 
class laporan extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
    }
 
    public function index()
    {
        $tanggal_dari      = $this->input->get('tanggal_dari');
        $tanggal_sampai    = $this->input->get('tanggal_sampai');
        $status            = $this->input->get('status');
        $luar_kota         = $this->input->get('luar_kota');
        $metode_pembayaran = $this->input->get('metode_pembayaran');
 
        $this->db->select('
            p.id_pemesanan,
            p.nama_customer,
            pl.nama       AS nama_pelanggan,
            pl.telepon,
            pl.nik,
            m.merk,
            m.tipe,
            m.plat_nomor,
            s.nama        AS nama_supir,
            p.tanggal_sewa,
            p.tanggal_kembali,
            DATEDIFF(p.tanggal_kembali, p.tanggal_sewa) AS lama_sewa,
            p.total_harga,
            p.status,
            p.luar_kota,
            p.metode_pembayaran
        ');
        $this->db->from('pemesanan p');
        $this->db->join('pelanggan pl', 'pl.id_pelanggan = p.id_pelanggan', 'left');
        $this->db->join('mobil m',      'm.id_mobil      = p.id_mobil',      'left');
        $this->db->join('supir s',      's.id_supir      = p.id_supir',      'left');
 
        if (!empty($tanggal_dari))      $this->db->where('p.tanggal_sewa >=', $tanggal_dari);
        if (!empty($tanggal_sampai))    $this->db->where('p.tanggal_sewa <=', $tanggal_sampai);
        if (!empty($status))            $this->db->where('p.status',           $status);
        if (!empty($luar_kota))         $this->db->where('p.luar_kota',        $luar_kota);
        if (!empty($metode_pembayaran)) $this->db->where('p.metode_pembayaran',$metode_pembayaran);
 
        $this->db->order_by('p.tanggal_sewa', 'DESC');
        $pemesanan = $this->db->get()->result();
 
        $total_pendapatan = array_sum(array_column(
            array_map(fn($p) => ['h' => $p->total_harga], $pemesanan), 'h'
        ));
 
        $data = [
            'pemesanan'        => $pemesanan,
            'total_pendapatan' => $total_pendapatan,
            'total_transaksi'  => count($pemesanan),
            'tanggal_dari'     => $tanggal_dari,
            'tanggal_sampai'   => $tanggal_sampai,
            'filter_status'    => $status,
            'filter_luar_kota' => $luar_kota,
            'filter_metode'    => $metode_pembayaran,
        ];
 
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('laporan/pemesanan', $data);
        $this->load->view('templates/footer');
    }
 
    public function cetak()
    {
        $tanggal_dari      = $this->input->get('tanggal_dari');
        $tanggal_sampai    = $this->input->get('tanggal_sampai');
        $status            = $this->input->get('status');
        $luar_kota         = $this->input->get('luar_kota');
        $metode_pembayaran = $this->input->get('metode_pembayaran');
 
        $this->db->select('
            p.id_pemesanan,
            p.nama_customer,
            pl.nama       AS nama_pelanggan,
            pl.telepon,
            pl.nik,
            m.merk,
            m.tipe,
            m.plat_nomor,
            s.nama        AS nama_supir,
            p.tanggal_sewa,
            p.tanggal_kembali,
            DATEDIFF(p.tanggal_kembali, p.tanggal_sewa) AS lama_sewa,
            p.total_harga,
            p.status,
            p.luar_kota,
            p.metode_pembayaran
        ');
        $this->db->from('pemesanan p');
        $this->db->join('pelanggan pl', 'pl.id_pelanggan = p.id_pelanggan', 'left');
        $this->db->join('mobil m',      'm.id_mobil      = p.id_mobil',      'left');
        $this->db->join('supir s',      's.id_supir      = p.id_supir',      'left');
 
        if (!empty($tanggal_dari))      $this->db->where('p.tanggal_sewa >=', $tanggal_dari);
        if (!empty($tanggal_sampai))    $this->db->where('p.tanggal_sewa <=', $tanggal_sampai);
        if (!empty($status))            $this->db->where('p.status',           $status);
        if (!empty($luar_kota))         $this->db->where('p.luar_kota',        $luar_kota);
        if (!empty($metode_pembayaran)) $this->db->where('p.metode_pembayaran',$metode_pembayaran);
 
        $this->db->order_by('p.tanggal_sewa', 'ASC');
        $pemesanan = $this->db->get()->result();
 
        $total_pendapatan = array_sum(array_column(
            array_map(fn($p) => ['h' => $p->total_harga], $pemesanan), 'h'
        ));
 
        $data = [
            'pemesanan'        => $pemesanan,
            'total_pendapatan' => $total_pendapatan,
            'total_transaksi'  => count($pemesanan),
            'tanggal_dari'     => $tanggal_dari,
            'tanggal_sampai'   => $tanggal_sampai,
            'filter_status'    => $status,
            'filter_luar_kota' => $luar_kota,
            'filter_metode'    => $metode_pembayaran,
        ];
 
        // Cetak: tanpa template header/sidebar/footer
        $this->load->view('laporan/cetak_pemesanan', $data);
    }
}
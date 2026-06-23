<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // cek login
        if (!$this->session->userdata('is_login')) {
            redirect('auth');
        }

        // cek role customer
        if ($this->session->userdata('role') != 'customer') {
            redirect('auth');
        }
    }

    public function index()
    {
        redirect('customer/dashboard');
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard Customer';

        $this->load->view('templates/header', $data);
        $this->load->view('customer/dashboard');
        $this->load->view('templates/footer');
    }

    public function mobil()
    {
        $data['title'] = 'Daftar Mobil';

        $this->load->view('templates/header', $data);
        $this->load->view('customer/mobil');
        $this->load->view('templates/footer');
    }

    public function pemesanan()
{
    $data['title'] = 'Pemesanan Mobil';

    $data['mobil'] = $this->db->get('mobil')->result();

    $data['supir'] = $this->db->get('supir')->result();

    $this->load->view('templates/header', $data);
    $this->load->view('customer/pemesanan', $data);
    $this->load->view('templates/footer');
}

    public function riwayat()
    {
        $data['title'] = 'Riwayat Sewa';

        $this->load->view('templates/header', $data);
        $this->load->view('customer/riwayat');
        $this->load->view('templates/footer');
    }

    public function profil()
    {
        $data['title'] = 'Profil Saya';

        $this->load->view('templates/header', $data);
        $this->load->view('customer/profil');
        $this->load->view('templates/footer');
    }
}
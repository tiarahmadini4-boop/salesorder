<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('auth_model');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('auth/login');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Username dan password wajib diisi');
            redirect('auth');
            return;
        }

        $user = $this->auth_model->cek_login($username, $password);

        if ($user) {

            $data = [
                'id_user'  => $user->id,
                'nama'     => $user->nama,
                'username' => $user->username,
                'role'     => $user->role,
                'id_sales' => $user->id_sales,
                'is_login' => TRUE
            ];

            $this->session->set_userdata($data);

            $this->auth_model->update_last_login($user->id);

            switch ($user->role) {
                case 'admin':
                    redirect('admin/dashboard');
                    break;
                case 'sales':
                    redirect('sales/dashboard');
                    break;
                case 'manager':
                    redirect('manager/dashboard');
                    break;
                default:
                    $this->session->set_flashdata('error', 'Role pengguna tidak dikenali');
                    redirect('auth');
                    break;
            }

        } else {

            $this->session->set_flashdata(
                'error',
                'Username atau password salah'
            );

            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('auth');
    }
}